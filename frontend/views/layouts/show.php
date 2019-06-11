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
<!--    <div class="top">
        <h2>aaaaa</h2>
    </div>-->


    <div class="container">
        <div class="menu-left">
            <ul class="nav nav-pills nav-stacked">
                <li data-value="jxsj" role="presentation"><a href="javascript:;">教学设计</a></li>
                <li data-value="video" role="presentation"><a href="javascript:;">教学录像</a></li>
                <li data-value="ppt" role="presentation" class="active"><a href="javascript:;">教学资源</a></li>
                <li data-value="jxfs" role="presentation"><a href="javascript:;">教学反思</a></li>
                <li data-value="student" role="presentation"><a href="javascript:;">学生作品</a></li>
                <li data-value="zjpj" role="presentation"><a href="javascript:;">专家评价</a></li>
            </ul>
        </div>
        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
