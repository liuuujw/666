<?php

use yii\helpers\Html;

$this->registerCssFile('/css/chance.css');

?>
<div class="site-index" style="margin-top: 75px;">

    <div class="row">
        <div class="col-md-12">
            日期： <?= $date ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>序号</td>
                    <td>期数</td>
                    <td>开奖</td>
                    <td>相隔期数</td>
                </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($data) && $data){
                        foreach($data as $key => $val){
                            ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= substr($val['stage'],8) ?></td>
                                <td>
                                    <div>
                                        <span class="number num_<?= $val['one'] ?>"><?= $val['one'] ?></span>
                                    </div>
                                </td>
                                <td><?= $val['apart'] ?></td>
                            </tr>
                <?php
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>