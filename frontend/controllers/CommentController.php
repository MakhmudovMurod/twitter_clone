<?php
namespace frontend\controllers;

use common\models\Post;
use common\models\PostLike;
use common\models\User;
use common\models\Subscriber;
use common\models\Comment;
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
    
    public function actionComment($id,$comment)
    {
        $post = $this->findPost($id);

        $username = Yii::$app->user->identity->username;

        $comment = new Comment();

        $comment->post_id = $id;
        $comment->author = $username;
        $comment->comment = 


        
    }
     

    protected function findPost($id)
    {
        $post = Post::findOne($id);

        if(!$post)
        {
            throw new NotFoundHttpException("Post does not exist");
        }

        return $post;
    }

 
}
