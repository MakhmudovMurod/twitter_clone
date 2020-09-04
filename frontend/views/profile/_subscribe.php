<?php
/**
 * @var $profile \common\models\User
 */
use yii\helpers\Url;

?>



<a class="btn <?php echo $profile->isSubscribed(Yii::$app->user->id) ? 'btn-secondary' : 'btn-primary'  ?>" href="<?php echo Url::to(['profile/subscribe', 'username'=>$profile->username ]) ?>" 
    data-method="post" data-pjax="1">
    <?php echo $profile->isSubscribed(Yii::$app->user->id) ? 'Unsubscribe ' : 'Subscribe '  ?>
: <?php  echo $profile->getSubscribers()->count() ?> </a>    