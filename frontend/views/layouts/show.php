<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\BootstrapAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
        <div class="menu-left">
            <div class="main-title">
                <div class="stars">
                    <div class="topic"></div>
                </div>
            </div>
            <div class="menu">
                <!--<ul class="nav nav-pills nav-stacked">
                    <?php
/*                    $args = '/' . Yii::$app->request->getPathInfo();
                    $menuList = Yii::$app->params['menuList'];
                    foreach ($menuList as $menu) {
                        if(($args == '/show/ppt' || $args == '/show/tzyd' || $args == '/show') && $menu['url'] == '/show/index'){
                            $active = 'active';
                        }else{
                            $active = ($args == $menu['url']) ? 'active' : '';
                        }
                        echo '<li role="presentation" class="' . $active . '"><a href="' . $menu['url'] . '">' . $menu['name'] . '</a></li>';
                    }
                    */?>
                </ul>-->
                <ul class="menu-list">
                    <?php
                    $menuList = Yii::$app->params['menuList'];
                    foreach ($menuList as $menu) {
                        /*if(($args == '/show/ppt' || $args == '/show/tzyd' || $args == '/show') && $menu['url'] == '/show/index'){
                            $active = 'active';
                        }else{
                            $active = ($args == $menu['url']) ? 'active' : '';
                        }*/
                        echo '<li><a href="' . $menu['url'] . '">' . $menu['name'] . '</a></li>';
                    }
                    ?>
<!--                    <li><a href="javascript:;">aaaa</a></li>-->
<!--                    <li><a href="javascript:;">aaaa</a></li>-->
<!--                    <li><a href="javascript:;">aaaa</a></li>-->
<!--                    <li><a href="javascript:;">aaaa</a></li>-->
<!--                    <li><a href="javascript:;">aaaa</a></li>-->
<!--                    <li><a href="javascript:;">aaaa</a></li>-->
                </ul>
            </div>

        </div>
        <div class="main-content">
            <?= $content ?>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="pull-right name">广州市荔湾区培真小学   饶可旋</p>
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
