<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <div class="row">
        
        <div class="col-sm-8 " style="margin-left:3%">    
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Check Again', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'photo',
                    'title',
                    'body:ntext',
                  
                ],
            ]) ?>
        
        <div> 

    </div>
   
         

</div>
