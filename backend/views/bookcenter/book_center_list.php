
<div class="layui-row">
    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
        <a href="/bookcenter/add">
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
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr>
        <th>#</th>
        <th>名称</th>
        <th>编号</th>
        <th>管理员</th>
        <th>花费</th>
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
            <td><?= $val['manager']; ?></td>
            <td>￥<?= $val['cost']; ?></td>
            <td>
                <button class="layui-btn layui-btn-sm layui-btn-normal layui-btn-radius">编辑</button>
                <button class="layui-btn layui-btn-sm layui-btn-danger layui-btn-radius">删除</button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
