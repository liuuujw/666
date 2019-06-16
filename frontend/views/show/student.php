<?php

use yii\helpers\Html;
use yii\web\View;

$this->registerCssFile('/css/show.css');
?>

    <div class="student-main">
        <div class="student-content show">
            <img src="/image/s1.jpg">
        </div>
        <div class="student-content hide">
            <img src="/image/s2.jpg">
        </div>
        <div class="student-content hide">
            <img src="/image/s3.jpg">
        </div>
        <div class="student-content hide">
            <img src="/image/s4.jpg">
        </div>
        <div class="student-content hide">
            <img src="/image/s5.jpg">
        </div>
        <div class="student-content hide">
            <img src="/image/s6.jpg">
        </div>
        <div class="student-content hide">
            <img src="/image/s7.jpg">
        </div>
    </div>


    <ul class="pager">
        <li><a href="javascript:;" id="pre">上一页</a></li>
        <li><a href="javascript:;" id="next">下一页</a></li>
    </ul>


<?php
$this->registerJsFile('/js/student.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
