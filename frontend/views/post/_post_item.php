<?php

/** @var $model \common\models\Post */
use yii\helpers\StringHelper;
use yii\helpers\Url;
?>

<!-- Blog Post -->
<div class="card mb-4">
<div class="card-header">
    <!-- <img src="#" alt="user image"> -->
    <a href="<?php echo Url::to(['/profile/view', 'username'=>$model->createdBy->username]) ?>"><?php echo $model->createdBy->username ?></a>
  </div>  
<a href="<?php echo Url::to(['/post/view', 'id'=>$model->id])    ?>"><img class="card-img-top" src="<?php echo  $model->photo ?>" alt="Card image cap" ></a>
  <div class="card-body">
    <h2 class="card-title"><?php echo $model->title ?></h2>
    <p class="card-text"><?php echo StringHelper::truncate($model->body,150) ?></p>
    <a href="<?php echo Url::to(['/post/view', 'id'=>$model->id])    ?>" class="btn btn-primary">Read More &rarr;</a>
  </div>
 
</div>


 

 