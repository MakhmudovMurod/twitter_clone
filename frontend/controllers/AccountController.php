<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\filters\AccessRule;


/**
 * AccountController implements the CRUD actions for Post model.
 */
class AccountController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=> [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' =>true,
                        'roles' =>['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $profile = $this->findProfile(Yii::$app->user->identity->username);

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()
            ->creator(Yii::$app->user->id)
            ->latest(),
        ]);

        return $this->render('index', [
            'profile' => $profile,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findProfile($username)
    {
        $profile = User::findByUsername($username);

        if(!$profile)
        {
            throw new NotFoundHttpException("Profile does not exist");
        }

        return $profile;
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
 
       if ($model->load(Yii::$app->request->post())) {

        $model->photo = UploadedFile::getInstance($model,'photo');

        $image_name = $model->title.rand(1,2000).'.'.$model->photo->extension;
       
        $image_path = Yii::getAlias('@frontend/web/uploads/images/'.$image_name);

        $model->photo->saveAs($image_path);

        $model->photo = '../web/uploads/images/'.$image_name;

        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
