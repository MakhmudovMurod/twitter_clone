<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\models\PostLike;
use common\models\Comment;
 

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property string $photo
 * @property string $title
 * @property string|null $body
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $createdBy
 * @property \common\models\PostLike[]  $likes
 * @property \common\models\PostLike[]  $dislikes
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class'=> BlameableBehavior::class,
                'updatedByAttribute'=> false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo'], 'file','extensions'=>'jpeg,jpg,png,gif'],
            [['title'], 'required'],
            [['body'], 'string'],
            [['created_by', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo'=>'Post Image',
            'title' => 'Title',
            'body' => 'Body',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PostQuery(get_called_class());
    }

    public function isLikedBy($user_id)
    {
        return PostLike::find()
            ->user_post_id($user_id,$this->id)
            ->liked()
            ->one();
    }

    public function isDislikedBy($user_id)
    {
        return PostLike::find()
            ->user_post_id($user_id,$this->id)
            ->disliked()
            ->one();
    }

    /**
     * 
     */
    public function getLikes()
    {
        return $this->hasMany(PostLike::class,['post_id'=>'id'])
        ->liked();
    }

    public function getDislikes()
    {
        return $this->hasMany(PostLike::class,['post_id'=>'id'])
        ->disliked();
    }
    

    public function getComments()
    {
        return $this->hasMany(Comment::className(),['post_id'=>'id']);
    }

   
    

}
