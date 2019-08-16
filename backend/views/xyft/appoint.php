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
                <?php
                if (isset($data) && $data) {
                    $dataCount = count($data);
                    foreach ($data as $key => $val) {
                        ?>
                        <tr>
                            <?php
                            foreach($val as $k=>$v){
                                if($k =='stage' || $k=='apart') continue;
                                ?>
                                <td>
                                    <div>
                                        <span class="number num_<?= $v ?>"><?= $v ?></span>
                                    </div>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>
                                <?= $dataCount - $key ?>
                            </td>
                            <td colspan="4">
                                第<?= substr($val['stage'],8) ?>期
                            </td>
                            <td>
                                <div>
                                    <span class="number num_<?= $val[$rank] ?>"><?= $val[$rank] ?></span>
                                </div>
                            </td>
                            <td colspan="3">
                                <?= isset($val['apart']) ? "相隔 " . $val['apart'] . "期" : "" ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

</div>