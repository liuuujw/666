<div class="layui-row">
    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
        <a href="/sale/edit?t=add">
            <button class="layui-btn layui-btn-radius">添加</button>
        </a>
    </div>
</div>
<table class="layui-table">
    <colgroup>
        <col width="20">
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
        <th>购书中心</th>
        <th>书名</th>
        <th>售价</th>
        <th>数量</th>
        <th>折扣</th>
        <th>总价</th>
        <th>销售时间</th>
        <th style="width: 12%">操作</th>
    </tr>
    </thead>
    <?php
    foreach ($data as $val) {
        ?>
        <tr>
            <td>#</td>
            <td><?= $val['center_info_name']; ?></td>
            <td><?= $val['book_name']; ?></td>
            <td><?= $val['sold_price']; ?></td>
            <td><?= $val['sold_number']; ?></td>
            <td><?= $val['total_discount'] * 100; ?> 折</td>
            <td><?= $val['total_price'] ?></td>
            <td><?= $val['create_time'] ?></td>
            <td>
                <button class="layui-btn layui-btn-sm layui-btn-radius layui-btn-normal">编辑</button>
                <button class="layui-btn layui-btn-sm layui-btn-radius layui-btn-danger">删除</button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
