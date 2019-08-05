<?php

use yii\helpers\Html;

$this->registerCssFile('/css/chance.css');

?>
<div class="site-index" style="margin-top: 75px;">

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <?php
                if (isset($data) && $data) {
                    foreach ($data as $val) {
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
                            <td colspan="4">
                                <?= substr($val['stage'],8) ?>
                            </td>
                            <td>
                                <div>
                                    <span class="number num_<?= $val[$rank] ?>"><?= $val[$rank] ?></span>
                                </div>
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