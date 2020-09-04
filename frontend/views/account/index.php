<?php
/**
 * @var $profile \common\models\User
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
 

 

?>
 
        
        

<div class="jumbotron jumbotron-fluid">
  <div class="container  ">
    <h1 class="display-4"><?php echo Yii::$app->user->identity->username ?></h1>
    
    <p><?=  Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?></p> <span class="btn btn-info">Subscribers : <?php  echo $profile->getSubscribers()->count() ?></span> 
    
    
    <hr class="my-4">
</div>
</div>

 

  <?php  echo  ListView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
      'class' => LinkPager::class,
    ],
    'itemView' => '_account_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions'=>[
      'tag' => false
    ]
  ]) ?>
