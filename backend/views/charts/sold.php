<?php
$this->registerCssFile('/css/admin/charts-public.css');
?>
<div class="layui-row">
    <div class="layui-col-md12">
            <div class="card-content">
                <div class="select-div">
                    <select id="year" title="年" class="browser-default">
                        <?php
                        for ($i=0;$i<7;$i++){
                            ?>
                            <option value="<?= 2018-$i ?>"><?= 2018-$i ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select id="month" title="月" class="browser-default">
                        <?php
                        for ($i=1;$i<13;$i++){
                            ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div style="margin-bottom: 40px">
                    时间：<span class="select-time"></span>
<!--                    <span class="show_time_year"></span>-<span class="show_time-month"></span>-->
                </div>
                <div id="sold_total_number" style="width: 100%;height:500px;"></div>
            </div>
    </div>
</div>


<div class="layui-row">
    <div class="layui-col-md12">
            <div class="card-content">
                <div class="select-div">
                    <select id="sold_price_year" title="年" class="browser-default">
                        <?php
                        for ($i=0;$i<7;$i++){
                            ?>
                            <option value="<?= 2018-$i ?>"><?= 2018-$i ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select id="sold_price_month" title="月" class="browser-default">
                        <?php
                        for ($i=1;$i<13;$i++){
                            ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div style="margin-bottom: 40px">
                    时间：<span class="select-time"></span>
                    <!--                    <span class="show_time_year"></span>-<span class="show_time-month"></span>-->
                </div>
                <div id="sold_total_price" style="width: 100%;height:500px;"></div>
            </div>
    </div>
</div>



<?php
$this->registerJsFile('js/admin/bootstrap-select.js',['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/charts/echarts.js',['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/charts/public.js',['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/charts/sold.js',['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
?>
