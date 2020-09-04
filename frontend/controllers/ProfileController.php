<?php
namespace frontend\controllers;

use common\models\Post;
use common\models\PostLike;
use common\models\User;
use common\models\Subscriber;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\filters\AccessRule;

 
/**
 * Post controller
 */
class ProfileController extends Controller
{   
    public function behaviors()
    {
        return 
        [
            'access'=>
            [
                'class' => AccessControl::class,
                'only' =>['subscribe'],
                'rules'=>
                [
                    [
                        'allow' => true,
                        'roles' =>['@'],
                    ]
                ]
            ],
            

        ];
    }
    
    public function actionView($username)
    {
        $profile = $this->findProfile($username);
        
        $dataProvider = new ActiveDataprovider([
            'query' => Post::find()->creator($profile->id),
        ]);
        
        return $this->render('view', [
            'profile' => $profile,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * ${CARET}
     * 
     * @param $username
     * @throws \yii\web\NotFoundHttpException
     * 
     */

    protected function findProfile($username)
    {
        $profile = User::findByUsername($username);

        if(!$profile)
        {
            throw new NotFoundHttpException("Profile does not exist");
        }

        return $profile;
    }


    public function actionSubscribe($username)
    {
        $profile = $this->findProfile($username);
        
        $user_id = \Yii::$app->user->id;
        $subscriber = $profile->isSubscribed($user_id);
        
        if(!$subscriber)
        {
            $subscriber = new Subscriber();
            $subscriber->profile_id = $profile->id;
            $subscriber->user_id = $user_id;
            $subscriber->created_at = time();
            $subscriber->save();
        }
        else
        {
            $subscriber->delete();
        }

        return $this->renderAjax('_subscribe',[
            'profile'=>$profile
        ]);
    }
}
