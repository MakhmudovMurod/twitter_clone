<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subscriber}}".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $surname
 * @property string|null $birthday
 * @property int|null $profile_id
 * @property int|null $user_id
 * @property int|null $created_at
 *
 * @property User $profile
 * @property User $user
 */
class Subscriber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subscriber}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthday'], 'safe'],
            [['profile_id', 'user_id', 'created_at'], 'integer'],
            [['first_name', 'surname'], 'string', 'max' => 255],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['profile_id' => 'id']],
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
            'first_name' => 'First Name',
            'surname' => 'Surname',
            'birthday' => 'Birthday',
            'profile_id' => 'Profile ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getProfile()
    {
        return $this->hasOne(User::className(), ['id' => 'profile_id']);
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
     * @return \common\models\query\SubscriberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SubscriberQuery(get_called_class());
    }
}
