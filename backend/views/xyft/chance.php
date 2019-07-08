<?php

use yii\helpers\Html;

$this->registerCssFile('/css/chance.css');
?>

<div class="site-index" style="margin-top: 75px;">


    <div class="row">
        <div class="col-md-12" style="margin-bottom: 10px;">
            <form class="form-inline">
                <div class="form-group">
                    <label for="exampleInputEmail1">日期</label>
                    <input type="text" class="form-control" id="date" placeholder="<?= $date ?>">
                </div>
                <a id="search" class="btn btn-default">Submit</a>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p>2号下期小</p>
            <div class="content">
                <?= $two; ?>
            </div>
        </div>
        <div class="col-md-6">
            <p>3号下期单</p>
            <div class="content">
                <?= $three; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p>7号下期单</p>
            <div class="content">
                <?= $seven; ?>
            </div>
        </div>
        <div class="col-md-6">
            <p>10号下期双</p>

            <div class="content">
                <?= $ten; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p>冠军1-6号</p>
            <div class="content">
                <?= $oneLessThanSix ?>
            </div>
        </div>
        <div class="col-md-6">
            <p>冠军为上一期的1-6名</p>
            <div class="content">
                <?= $championOneToSix ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJsFile('/js/chance.js',['depends'=>['backend\assets\AppAsset'], 'position'=> $this::POS_END]);
