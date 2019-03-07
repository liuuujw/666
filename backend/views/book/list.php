<div class="layui-row">
    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
        <a href="/book/edit?t=add">
            <button class="layui-btn layui-btn-radius">添加</button>
        </a>
    </div>
</div>

<table class="layui-table">
    <colgroup>
        <col width="50">
        <col width="150">
        <col width="150">
        <col width="150">
        <col width="150">
        <col width="150">
        <col width="150">
        <col width="150">
        <col width="150">
        <col width="200">
    </colgroup>
    <thead>
    <tr>
        <th>#</th>
        <th>书籍名称</th>
        <th>作者</th>
        <th>书籍编号</th>
        <th>所属出版商</th>
        <th>所属仓库</th>
        <th>采购成本</th>
        <!--                            <th>批发价</th>-->
        <!--                            <th>零售价</th>-->
        <th>总数量</th>
        <th>销量</th>
        <th style="width: 12%">操作</th>
    </tr>
    </thead>
    <?php
    foreach ($data as $val) {
        ?>
        <tr>
            <td><?= $val['id']; ?></td>
            <td><?= $val['book_name']; ?></td>
            <td><?= $val['editor']; ?></td>
            <td><?= $val['book_code']; ?></td>
            <td><?= $val['publisher_name']; ?></td>
            <td><?= $val['warehouse_name']; ?></td>
            <td>￥<?= $val['purchasing_price']; ?></td>
            <!--                                <td>￥--><?//= $val['wholesale_price']; ?><!--</td>-->
            <!--                                <td>￥--><?//= $val['sell_price']; ?><!--</td>-->
            <td><?= $val['total']; ?></td>
            <td><?= $val['sold_number']; ?></td>
            <td>
                <button class="btn btn-sm btn-primary">编辑</button>
                <button class="btn btn-sm btn-danger">删除</button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>


<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

<?php
$this->registerJsFile('js/admin/dataTables/jquery.dataTables.js');
$this->registerJsFile('js/admin/dataTables/dataTables.bootstrap.js');
?>
