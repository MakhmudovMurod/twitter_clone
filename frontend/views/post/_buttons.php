<?php 

/** @var $model \common\models\Post */
use yii\helpers\Url;

?>


<a href="<?php echo Url::to(['/post/like', 'id'=>$model->id]) ?>" 
class="btn  <?php echo $model->isLikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary'  ?>" data-method="post" data-pjax="1">
    
    <i class="fas fa-thumbs-up"></i> <?php echo $model->getLikes()->count() ?>  
</a>
          
<a href="<?php echo Url::to(['/post/dislike', 'id'=>$model->id]) ?>" 
class="btn  <?php echo $model->isDislikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary'  ?>" data-method="post" data-pjax="1">
    
    <i class="fas fa-thumbs-down"></i> <?php echo $model->getDislikes()->count() ?>  
</a>