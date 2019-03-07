<div class="layui-row">
    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
        <a href="/department/add">
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
                <button class="layui-btn layui-btn-radius layui-btn-normal layui-btn-sm">编辑</button>
                <button class="layui-btn layui-btn-radius layui-btn-danger layui-btn-sm">删除</button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

