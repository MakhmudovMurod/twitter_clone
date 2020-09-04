<?php

    use yii\bootstrap4\Nav;
    use yii\bootstrap4\Navbar;
    
    NavBar::begin([
        
        'brandLabel' => '<i class="fa fa-twitter"></i>'. Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => ' navbar navbar-expand-lg navbar-dark bg-dark',
        ],
        
     
    ]);
    
    $menuItems = [
        ['label' => 'New Post ', 'url' => ['/post/create']],
        ['label' => ' Posts', 'url' => ['/post/index']],
       
    ];
    
        
     
    
    if (Yii::$app->user->isGuest) 
    {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } 
    else 
    {
        $menuItems[] = [
            'label' => 'Logout ('. Yii::$app->user->identity->username .')',
            'url' => ['/site/logout'],
            'linkOptions' => [
                'data-method' => 'post'
            ]
        ];
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>