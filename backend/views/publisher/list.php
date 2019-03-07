<div class="layui-row">
    <div class="col-lg-4">
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
        <th>名称</th>
        <th>编号</th>
        <th>电话</th>
        <th>地址</th>
        <th>创建时间</th>
        <th style="width: 12%">操作</th>
    </tr>
    </thead>
    <?php
    foreach ($data as $val) {
        ?>
        <tr>
            <td><?= $val['id']; ?></td>
            <td><?= trim($val['name']); ?></td>
            <td><?= $val['code']; ?></td>
            <td><?= $val['phone']; ?></td>
            <td><?= $val['address']; ?></td>
            <td><?= $val['create_time']; ?></td>
            <td>
                <button class="layui-btn layui-btn-radius layui-btn-normal layui-btn-sm">编辑</button>
                <button class="layui-btn layui-btn-radius layui-btn-danger layui-btn-sm">删除</button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
