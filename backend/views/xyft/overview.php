<?php

use yii\helpers\Html;

$this->registerCssFile('/css/chance.css');

?>
<div class="site-index" style="margin-top: 75px;">

    <div class="row">
        <div class="col-md-12 rank-btn-div">
            <?php
            if(isset(Yii::$app->params['xyftRank']) && Yii::$app->params['xyftRank']){
                foreach(Yii::$app->params['xyftRank'] as $key=>$val){
                    ?>
                    <a class="btn <?= ($key == $rank) ? 'btn-danger' : 'btn-success' ?>" href="/xyft?rank=<?= $key ?>" role="button"><?= $val['rankDesc'] ?></a>
                    <?php
                }
            }
            ?>
            <a class="btn <?= ($rank == 'all') ? 'btn-danger' : 'btn-success' ?>" href="/xyft/overview" role="button">总览</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <?php
                if (isset($data) && $data) {
                    foreach ($data as $key => $val) {
                        ?>
                        <tr>
                            <td colspan="3" style="line-height: 28px;"><?= $val['rankDesc'] ?></td>
                            <td colspan="3" style="line-height: 28px;">第<?= $val['stage'] ?>期</td>
                            <td>
                                <span class="number num_<?= $val['kjRes'] ?> "> <?= $val['kjRes'] ?> </span>
                            </td>
                        </tr>
                        <tr>
                            <?php
                            if (isset($val['chance']) && $val['chance']) {
                                foreach ($val['chance'] as $k => $c) {

                                    ?>

                                    <td>
                                        <div>
                                            <span class="number num_<?= $k ?>"><?= $k ?></span>
                                        </div>
                                        <div>
                                            <small><?= (number_format($c / $val['stageCount'], 2) * 100) . '%' ?></small>
                                        </div>
                                    </td>

                                    <?php
                                }
                            }
                            ?>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>