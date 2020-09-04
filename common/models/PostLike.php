<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%post_like}}".
 *
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property int|null $type
 * @property int|null $created_at
 *
 * @property Post $post
 * @property User $user
 */
class PostLike extends \yii\db\ActiveRecord
{

    const TYPE_LIKE = 1;
    const TYPE_DISLIKE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_like}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id'], 'required'],
            [['post_id', 'user_id', 'type', 'created_at'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PostQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PostLikeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PostLikeQuery(get_called_class());
    }
}
