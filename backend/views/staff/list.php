<?php
$this->registerCssFile('/css/base.css');
?>

<div class="row">
    <div class="col-lg-4">
        <a href="/staff/edit?t=add"> <button class="btn btn-primary">添加</button></a>
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
                            <th>编号</th>
                            <th>姓名</th>
                            <th>所属中心</th>
                            <th>年龄</th>
                            <th>性别</th>
                            <th>职称</th>
                            <th>工资</th>
                            <th style="width: 12%">操作</th>
                        </tr>
                        </thead>
                        <?php
                        foreach ($data as $key=>$val) {
                            ?>
                            <tr>
                                <td><?= $key+1; ?></td>
                                <td><?= $val['code']; ?></td>
                                <td><?= $val['name']; ?></td>
                                <td><?= $val['center_info_name']; ?></td>
                                <td><?= $val['age']; ?></td>
                                <td><?= $val['gender'] == 1 ? '男' : '女'; ?></td>
                                <td><?= $val['title_name'] ?></td>
                                <td>￥<?= number_format($val['wages'],2) ?></td>
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
