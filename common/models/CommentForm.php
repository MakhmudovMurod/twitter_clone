<?php

namespace common\models;

use Yii;
 
use common\models\Comment;

class CommentForm extends \yii\db\ActiveRecord
{
    public $comment;
    
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    public function saveComment($article_id)
    {
        $comment = new Comment();
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->post_id = $article_id;
        return $comment->save();
    }
}