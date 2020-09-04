<?php
namespace frontend\controllers;

use common\models\Post;
use common\models\PostLike;
use common\models\User;
use common\models\Comment;
use common\models\CommentForm;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\filters\AccessRule;

 
/**
 * Post controller
 */
class PostController extends Controller
{   

    public function behaviors()
    {
        return 
        [
            'access'=>
            [
                'class' => AccessControl::class,
                'only' =>['like','dislike'],
                'rules'=>
                [
                    [
                        'allow' => true,
                        'roles' =>['@'],
                    ]
                ]
            ],
            'verb' => 
            [
                'class' => VerbFilter::class,
                'actions'=>
                [
                    'like'=>['post'],
                    'dislike'=>['post'],
                ]
            ],

        ];
    }
    
    /**
     * Action Index 
    */
    public function actionIndex()
    {   
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->latest(),
            'pagination' => [
                'pageSize'=> 3
            ]
        ]);
        return $this->render('index',[
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Action View Post 
    */
    public function actionView($id)
    { 
        $post = $this->findPost($id);
        
        $comments = $post->getComments();

        $comment_form = new CommentForm();

        return $this->render('post',[
            'model'=>$post,
            // 'comments'=>$comments,
            // 'comment_form'=>$comment_form,
        ]);
    }
    

    /**
     * Action Like 
    */ 
    public function actionLike($id)
    {
        $post = $this->findPost($id);

        $user_id = \Yii::$app->user->id;


        $post_like_dislike = PostLike::find()
        ->user_post_id($user_id,$id)
        ->one();

        if(!$post_like_dislike)
        {
            $this->save_like_dislike($id,$user_id,PostLike::TYPE_LIKE);

        }
        else if($post_like_dislike->type === PostLike::TYPE_LIKE)
        {
            $post_like_dislike->delete();
        }
        else
        {
            $post_like_dislike->delete();
            
            $this->save_like_dislike($id,$user_id,PostLike::TYPE_LIKE);
        }
        

        return $this->renderAjax('_buttons',[
            'model'=>$post,
        ]);
    }


    /**
     * Action Dislike 
    */ 
    public function actionDislike($id)
    {
        $post = $this->findPost($id);

        $user_id = \Yii::$app->user->id;


        $post_like_dislike = PostLike::find()
        ->user_post_id($user_id,$id)
        ->one();

        if(!$post_like_dislike)
        {
            $this->save_like_dislike($id,$user_id,PostLike::TYPE_DISLIKE);

        }
        else if($post_like_dislike->type === PostLike::TYPE_DISLIKE)
        {
            $post_like_dislike->delete();
        }
        else
        {
            $post_like_dislike->delete();
            
            $this->save_like_dislike($id,$user_id,PostLike::TYPE_DISLIKE);
        }
        

        return $this->renderAjax('_buttons',[
            'model'=>$post,
        ]);
    }

    /**
     * Search Action 
    */
    public function actionSearch($keyword)
    {   
        $query = Post::find()
        ->with('createdBy')
        ->latest();
        if($keyword){
            $query->byKeyword($keyword);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query, 
        ]);

        return $this->render('search',[
            'dataProvider'=> $dataProvider
        ]);

    }

    public function actionComment($id)
    {
        $model = new CommentForm();
        
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                return $this->redirect(['post/view','id'=>$id]);
            }
        }
    }

    
 

    /**
     * Protected Functions 
    */
    protected function findPost($id)
    {
        $post = Post::findOne($id);

        if(!$post)
        {
            throw new NotFoundHttpException("Post does not exist");
        }

        return $post;
    }

    protected function save_like_dislike($post_id,$user_id,$type)
    {   
        $post_like_dislike = new PostLike();

        $post_like_dislike->post_id = $post_id;

        $post_like_dislike->user_id = $user_id;

        $post_like_dislike->type = $type;

        $post_like_dislike->created_at = time();

        $post_like_dislike->save();

    }

}
