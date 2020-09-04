<?php

namespace common\models\query;
use common\models\PostLike;

/**
 * This is the ActiveQuery class for [[\common\models\PostLike]].
 *
 * @see \common\models\PostLike
 */
class PostLikeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\PostLike[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\PostLike|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function user_post_id($user_id,$post_id)
    {
        return $this->andWhere([
            'post_id' => $post_id,
            'user_id' => $user_id,
        ]);
    }

    public function liked()
    {
        return $this->andWhere(['type'=>PostLike::TYPE_LIKE]);
    }

    public function disliked()
    {
        return $this->andWhere(['type'=>PostLike::TYPE_DISLIKE]);
    }
}
