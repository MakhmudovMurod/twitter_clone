<?php
/**
 * @var $profile \common\models\User
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\bootstrap4\LinkPager;
?>
 


<div class="jumbotron jumbotron-fluid">
  <div class="container  ">
    <h1 class="display-4"><?php echo $profile->username ?></h1>
    <hr class="my-4">

    <?php  Pjax::begin()  ?>

        <?php echo $this->render('_subscribe',[
            'profile'=>$profile
        ])   ?> 

   <?php  Pjax::end()  ?>

</div>
</div>

 

  <?php  echo  ListView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
      'class' => LinkPager::class,
    ],
    'itemView' => '_profile_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions'=>[
      'tag' => false
    ]
  ]) ?>

 


 