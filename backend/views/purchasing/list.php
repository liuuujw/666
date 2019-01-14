<?php
$this->registerCssFile('/css/base.css');
?>

<div class="row">
    <div class="col-lg-4">
        <a href="/publisher/edit?t=add">
            <button class="btn btn-primary">添加</button>
        </a>
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
                            <th>购书中心</th>
                            <th>书名</th>
                            <th>采购价格</th>
                            <th>采购数量</th>
                            <th>采购时间</th>
                            <th style="width: 12%">操作</th>
                        </tr>
                        </thead>
                        <?php
                        if ($data) {
                            foreach ($data as $key=>$val) {
                                ?>
                                <tr>
                                    <td><?= $key+1 ?></td>
                                    <td><?= $val['center_info_name']; ?></td>
                                    <td><?= $val['book_name']; ?></td>
                                    <td>￥<?= number_format($val['purchase_price'],2); ?></td>
                                    <td><?= $val['purchase_number']; ?></td>
                                    <td><?= $val['create_time']; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">编辑</button>
                                        <button class="btn btn-sm btn-danger">删除</button>
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
