<?php
$this->registerCssFile('/css/base.css');
?>

<div class="row">
    <div class="col-lg-4">
        <a href="/warehouse/edit?t=add"> <button class="btn btn-primary">添加</button></a>
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
                            <th>名称</th>
                            <th>编号</th>
                            <th>管理员</th>
                            <th>电话</th>
                            <th>运营成本</th>
                            <th>所属中心</th>
                            <th style="width: 12%">操作</th>
                        </tr>
                        </thead>
                        <?php
                        foreach ($data as $val) {
                            ?>
                            <tr>
                                <td><?= $val['id']; ?></td>
                                <td><?= $val['name']; ?></td>
                                <td><?= $val['code']; ?></td>
                                <td><?= $val['manager']; ?></td>
                                <td><?= $val['phone']; ?></td>
                                <td><?= $val['operating_costs']; ?></td>
                                <td><?= $val['center_name']; ?></td>
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
