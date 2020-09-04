<?php

/** @var $this yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */
 
$this->title = 'Twitter Clone';
?>



<div class="site-index">

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <?php echo  \yii\widgets\ListView::widget([
          'dataProvider'=>$dataProvider,
          'pager' => [
            'class'=> \yii\bootstrap4\LinkPager::class,
          ],
          'itemView' => '_post_item',
          'itemOptions'=>[
            'tag'=>false
          ],
          'summary'=>''
          ]);?>
    

      </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4 ">
         <!-- Side Widget -->
          <div class="card my-4 ">
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
