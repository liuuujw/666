<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/materialize/css/materialize.min.css" media="screen,projection"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php

    $this->registerCssFile('/css/admin/bootstrap-theme.min.css');
    $this->registerCssFile('/css/admin/font-awesome.css');
    $this->registerCssFile('/css/admin/materialize.min.css');
    $this->registerCssFile('/css/admin/custom-styles.css', ['depends' => [\yii\web\JqueryAsset::className()]]);

    $this->head();
    ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="wrapper">
    <nav class="navbar navbar-default top-navbar" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse"
                    data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand waves-effect waves-dark" href="index.html"><i class="large material-icons">track_changes</i>
                购书中心管理系统</a>
            <div id="sideNav" href=""><i class="material-icons dp48">toc</i></div>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a class="dropdown-button waves-effect waves-dark" href="javascript:;" data-activates="dropdown1">
                    <i class="fa fa-user fa-fw"></i>
                    <b><?= (isset($this->context->user) && $this->context->user) ? $this->context->user['user_name'] : ''; ?></b>
                    <i class="material-icons right">arrow_drop_down</i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="#"
               id="<?= (isset($this->context->user) && $this->context->user) ? $this->context->user['id'] : ''; ?>"><i
                        class="fa fa-user fa-fw"></i> My Profile</a>
        </li>
        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
        </li>
        <li><a href="/site/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </li>
    </ul>
    <!--/. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu"
                style="max-height: 600px; width: 100%; overflow-y: auto; list-style: none; padding-right: 15px;">
                <?php
                if (isset($this->context->menu) && $this->context->menu) {
                    foreach ($this->context->menu as $menu) {
                        ?>
                        <li>
                            <a class="<?= ($menu['name'] == $this->params['m_name']) ? 'active-menu' : ''; ?>  waves-effect waves-dark"
                               href="<?= $menu['url'] ? $menu['url'] : '' ?>">
                                <i class="fa <?= $menu['icon'] ?>"></i>
                                <?= $menu['name'] ?>
                                <?= (isset($menu['item']) && $menu['item']) ? '<span class="fa arrow"></span>' : ''; ?>
                            </a>
                            <?php
                            if (isset($menu['item']) && $menu['item']) {
                                ?>
                                <ul class="nav nav-second-level">
                                    <?php
                                    foreach ($menu['item'] as $item) {
                                        ?>
                                        <li>
                                            <a href="<?= $item['url'] ?>"><?= $item['name'] ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>

        </div>

    </nav>
    <!-- /. NAV SIDE  -->

    <div id="page-wrapper">
        <div class="header">
            <h1 class="page-header">
                <?= isset($this->params['m_name']) ? $this->params['m_name'] : ''; ?>
            </h1>
            <ol class="breadcrumb">
                <!--                <li><a href="#">Home</a></li>-->
                <li><a href="#"><?= isset($this->params['m_name']) ? $this->params['m_name'] : ''; ?></a></li>
                <li class="active"><?= isset($this->params['c_name']) ? $this->params['c_name'] : ''; ?></li>
            </ol>

        </div>
        <div id="page-inner">
            <?= $content ?>
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<?php
$this->registerJsFile('js/admin/bootstrap.min.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/admin/materialize.min.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/admin/jquery.metisMenu.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/admin/morris/raphael-2.1.0.min.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/admin/morris/morris.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/admin/easypiechart.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/admin/easypiechart-data.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/admin/Lightweight-Chart/jquery.chart.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/admin/custom-scripts.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->endBody();
?>
</body>
</html>
<?php $this->endPage() ?>
