<?php

use yii\helpers\Html;

$this->registerCssFile('/css/chance.css');

?>

<div class="site-index" style="margin-top: 75px;">

    <div class="row">
        <div class="col-md-12">
        冠军
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>序号</td>
                    <td>期数</td>
                    <td>开奖结果</td>
                    <td>相隔期数</td>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($first as $key => $val){
                    ?>
                    <tr>
                        <td><?= ($key+1) ?></td>
                        <td><?= $val['stage'] ?></td>
                        <td><span class="number num_<?= $val['kj'] ?> "> <?= $val['kj'] ?> </span></td>
                        <td><?= $val['partition'] ?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            第十名
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>序号</td>
                    <td>期数</td>
                    <td>开奖结果</td>
                    <td>相隔期数</td>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($ten as $key => $val){
                    ?>
                    <tr>
                        <td><?= ($key+1) ?></td>
                        <td><?= $val['stage'] ?></td>
                        <td><span class="number num_<?= $val['kj'] ?> "> <?= $val['kj'] ?> </span></td>
                        <td><?= $val['partition'] ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
