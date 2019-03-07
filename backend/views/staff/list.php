<div class="row">
    <div class="col-lg-4">
        <a href="/staff/edit?t=add">
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
        <col width="200">
    </colgroup>
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
    foreach ($data as $key => $val) {
        ?>
        <tr>
            <td><?= $key + 1; ?></td>
            <td><?= $val['code']; ?></td>
            <td><?= $val['name']; ?></td>
            <td><?= $val['center_info_name']; ?></td>
            <td><?= $val['age']; ?></td>
            <td><?= $val['gender'] == 1 ? '男' : '女'; ?></td>
            <td><?= $val['title_name'] ?></td>
            <td>￥<?= number_format($val['wages'], 2) ?></td>
            <td>
                <button class="layui-btn layui-btn-radius layui-btn-normal layui-btn-sm">编辑</button>
                <button class="layui-btn layui-btn-radius layui-btn-danger layui-btn-sm">删除</button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>