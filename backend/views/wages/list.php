<?php
$this->registerCssFile('/css/base.css');
?>

<div class="row">
    <div class="col-lg-4">
        <a href="/wages/edit?t=add"> <button class="btn btn-primary">添加</button></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>姓名</th>
                            <th>基本工资</th>
                            <th>提成奖金</th>
                            <th>扣税金额</th>
                            <th>迟到次数</th>
                            <th>扣款金额</th>
                            <th>实发工资</th>
                            <th style="width: 12%">操作</th>
                        </tr>
                        </thead>
                        <?php
                        foreach ($data as $val) {
                            ?>
                            <tr>
                                <td><?= $val['id']; ?></td>
                                <td><?= $val['name']; ?></td>
                                <td>￥<?= $val['wages']; ?></td>
                                <td>￥<?= $val['commission']; ?></td>
                                <td>￥<?= $val['deductions']; ?></td>
                                <td><?= $val['late_times']; ?></td>
                                <td>￥<?= $val['buckle_money']; ?></td>
                                <td>￥<?= $val['should_pay']; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">编辑</button>
                                    <button class="btn btn-sm btn-danger">删除</button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

<?php
$this->registerJsFile('js/admin/dataTables/jquery.dataTables.js');
$this->registerJsFile('js/admin/dataTables/dataTables.bootstrap.js');
?>
