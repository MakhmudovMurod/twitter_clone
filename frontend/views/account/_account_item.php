<?php

/** @var $model \common\models\Post */
use yii\helpers\StringHelper;
use yii\helpers\Url;
?>

<!-- Blog Post -->
<div class="card ml-4 mb-4" style="width:300px;height:400px" >

    <a href="<?php echo Url::to(['/post/view', 'id'=>$model->id])  ?>"><img class="card-img-top" width="300px" height="250px" src="<?php echo  $model->photo ?>" alt="Card image cap"   ></a>
    <div class="card-body">
        <h5 class="card-title"><?php echo $model->title ?></h5>
        <p class="card-text"><?php echo StringHelper::truncate($model->body,50) ?></p>
    </div>
 
</div>


 

 