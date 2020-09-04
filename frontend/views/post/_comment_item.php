<?php 

/** @var $model \common\models\Post */
use yii\helpers\Url;

?>
<?php if(!Yii::$app->user->isGuest):?>
<div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            
          
          <?php $form = \yii\widgets\ActiveForm::begin([
            'action'=>['post/comment', 'id'=>$post->id],
            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
              <div class="form-group">
              <?= $form->field($comment_form, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
              </div>
              <button type="submit" class="btn btn-primary">Post Comment</button>
            
              <?php \yii\widgets\ActiveForm::end();?>

          </div>
</div>

<?php endif;?>
    
<?php if(!empty($comments)):  ?>
      
      <?php foreach($comments as $comment): ?>

        <div class="media mb-4">
            
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                <h5 class="mt-0"><?php echo  $comment->user->name; ?> </h5>
                <?php echo $comment->text; ?>
             </div>
        </div>

      <?php endforeach; ?>
    
    <?php endif;  ?>