<?php

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>


<!--    <link rel="stylesheet" href="/css/layui.css">-->
<!--    <link rel="stylesheet" href="/css/base.css">-->
    <?= $this->head() ?>
</head>
<body class="layui-layout-body">
<?php $this->beginBody() ?>

<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">购书中心管理系统</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <!--<ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="">控制台</a></li>
            <li class="layui-nav-item"><a href="">商品管理</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>-->
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    <?= (isset($this->context->user['name'])) ? $this->context->user['name'] : '' ?>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree" lay-filter="test">
                <?php
                $url = \Yii::$app->request->getPathInfo();
                foreach ($this->context->menu as $menu) {
                    ?>
                    <li class="layui-nav-item <?= $menu['name'] == $this->params['m_name'] ? 'layui-nav-itemed' : '' ?> <?= (!isset($menu['item']) && $menu['url'] == '/' . $url) ? 'layui-this' : '' ?>">
                        <a href="<?= isset($menu['item']) ? 'javascript:;' : $menu['url'] ?>" class="">
                            <?= $menu['name'] ?>
                        </a>
                        <?php
                        if (isset($menu['item']) && $menu['item']) {
                            $html = '<dl class="layui-nav-child">';
                            foreach ($menu['item'] as $child) {
                                $selected = ($child['url'] == '/' . \Yii::$app->request->getPathInfo()) ? ' class="layui-this"' : '';
                                $html .= '<dd' . $selected . '><a href="' . $child['url'] . '">' . $child['name'] . '</a></dd>';
                            }
                            $html .= '<dl class="layui-nav-child">';
                            echo $html;
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
                <li class="layui-nav-item"><a href=""></a></li>
                <li class="layui-nav-item"><a href=""></a></li>

            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">
            <div class="layui-row breadcrumb">
                <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
                    <span class="layui-breadcrumb">
                        <?= isset($this->params['m_name']) ? "<a>" . $this->params['m_name'] . "</a>" : '' ?>
                        <?= isset($this->params['c_name']) ? "<a>" . $this->params['c_name'] . "</a>" : '' ?>
                    </span>
                </div>
            </div>
            <?= $content ?>
        </div>
    </div>

    <div class="layui-footer"></div>
</div>
<script src="/js/layui.all.js"></script>
<script>
    //JavaScript代码区域
    layui.use('element', function () {
        var element = layui.element;
    });
</script>
</body>
<?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>
