<?php

use yii\helpers\Html;
use yii\web\View;

$this->registerCssFile('/css/show.css');
?>

    <div class="jxzy-menu">
        <p><a href="/file/长城.pptx">PPT下载</a></p>
        <p><a href="/show/ppt">PPT展示</a></p>
        <p><a href="/show/tzyd">阅读素材</a></p>
    </div>


<?php
$this->registerJsFile('./js/show.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);

