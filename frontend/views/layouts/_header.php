<?php
    use yii\helpers\Html;
    use yii\bootstrap4\Nav;
    use yii\bootstrap4\NavBar;
    use yii\bootstrap4\Breadcrumbs;
    use frontend\assets\AppAsset;
    use common\widgets\Alert;
    use yii\widgets\ListView;
    use yii\helpers\Url;
    use yii\bootstrap4\LinkPager;
    
    NavBar::begin([
        'brandLabel' =>   Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'fixed-top navbar navbar-expand-lg navbar-light bg-light',
        ],
    ]);
    // $menuItems = [
    //     ['label' => 'Home', 'url' => ['/site/index']],
    //     ['label' => 'Profile', 'url' => ['/site/about']],
    //     // ['label' => 'Contact', 'url' => ['/site/contact']],
    // ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label'=> 'Logout ('. Yii::$app->user->identity->username . ')' , 'url'=>['/site/logout'],'linkOptions' => ['data-method'=>'post']];
         
        $menuItems[] = ['label' => 'Profile', 'url' => ['/account/index'], 'username'=>[Yii::$app->user->identity->username]];
        
        
            
    } ?>
     
  <form action="<?php echo Url::to(['/post/search']) ?>" class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search"  name="keyword" value="<?php echo Yii::$app->request->get('keyword') ?>" >
    <button class="btn btn-outline-primary my-2 my-sm-0"  >Search</button>
  </form>

    <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>