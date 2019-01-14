<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-content">
                <div id="zonglirun" style="width: 100%;height:300px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-content">
                <div id="total_wages" style="width: 100%;height:300px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-content">
                <div id="sold_total" style="width: 100%;height:300px;"></div>
            </div>
        </div>
    </div>
</div>




<?php
$this->registerJsFile('js/charts/echarts.js',['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('js/charts/center_charts.js',['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
?>
