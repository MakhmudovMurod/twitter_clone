<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
/** @var $model \common\models\Post */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Twitter Clone';
?>

<div class="post-post">

     <!-- Page Content -->
  <div class="container">

<div class="row">

  <!-- Post Content Column -->
  <div class="col-lg-8">

    <!-- Title -->
    <h1 class="mt-4"><?php echo $model->title ?></h1>by
      <a href="<?php echo Url::to(['/profile/view', 'username'=>$model->createdBy->username]) ?>"><?php echo $model->createdBy->username ?></a>
    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="<?php echo  $model->photo ?>" alt="">

    <hr>
    
    
    <div class="d-flex justify-content-between align-items-center ">
      
      <div>
        published <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
      </div>
      
      <div>
        
        <?php  Pjax::begin() ?>
          <?php echo $this->render('_buttons', [
            'model'=>$model
          ]) ?>
        <?php  Pjax::end() ?>

      </div>


    </div>


    <hr>

    <!-- Post Content -->
 
    <p><?php echo $model->body ?></p>
 
   
    <hr>

    <?php 
    // $this->render('_comment_item', [
    //              'model'=>$model,
    //              'comments'=>$comments,
    //              'comment_form'=>$comment_form
    // ])
    ?>

  </div>

  <!-- Sidebar Widgets Column -->
  <div class="col-md-4">

   
     

    <!-- Side Widget -->
    <div class="card my-4">
      <h5 class="card-header">Side Widget</h5>
      <div class="card-body">
        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
      </div>
    </div>

  </div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->


</div>