<?php

use yii\helpers\Html;

$this->registerCssFile('./css/show.css');
?>
    <div class="main-content">
        <div id="ppt">
            <div></div>
            <div class="row">
                <div class="col-md-4" align="center">
                    <button class="btn btn-primary" type="button">
                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                        上一页
                    </button>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4" align="center">
                    <button class="btn btn-primary" type="button">
                        下一页
                        <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
        <div id="video">
            <p align="center">
                <video src="./video/1.mp4" width="640" height="325" controls="controls"></video>
            </p>
        </div>


        <div id="lw">
            sddd
        </div>
    </div>

<?php
$this->registerJsFile('./js/show.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);