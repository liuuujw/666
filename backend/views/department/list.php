<?php
$this->registerCssFile('/css/base.css');
?>

<div class="row">
    <div class="col-lg-4">
        <a href="/department/add"> <button class="btn btn-primary">添加</button></a>
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
                            <th>部门名称</th>
                            <th>部门编号</th>
                            <th>所属中心</th>
                            <th>部门主管</th>
                            <th>部门地址</th>
                            <th>部门电话</th>
                            <th>月运营费</th>
                            <th style="width: 15%">操作</th>
                        </tr>
                        </thead>
                        <?php
                        foreach ($data as $val) {
                            ?>
                            <tr>
                                <td><?= $val['id']; ?></td>
                                <td><?= $val['name']; ?></td>
                                <td><?= $val['code']; ?></td>
                                <td><?= $val['center_name'] ?></td>
                                <td><?= $val['manager_name']; ?></td>
                                <td><?= $val['address']; ?></td>
                                <td><?= $val['phone']; ?></td>
                                <td>￥<?= $val['per_month_cost']; ?></td>
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
