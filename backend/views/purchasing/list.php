<div class="layui-row">
    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
        <a href="/publisher/edit?t=add">
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
        <col width="200">
    </colgroup>
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
        foreach ($data as $key => $val) {
            ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $val['center_info_name']; ?></td>
                <td><?= $val['book_name']; ?></td>
                <td>￥<?= number_format($val['purchase_price'], 2); ?></td>
                <td><?= $val['purchase_number']; ?></td>
                <td><?= $val['create_time']; ?></td>
                <td>
                    <button class="layui-btn layui-btn-radius  layui-btn-sm layui-btn-normal">编辑</button>
                    <button class="layui-btn layui-btn-radius  layui-btn-sm layui-btn-danger">删除</button>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>