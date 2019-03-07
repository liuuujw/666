<div class="layui-row">
    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
        <a href="/wages/edit?t=add">
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
        <col>
    </colgroup>
    <thead>
    <tr>
        <th>#</th>
        <th>姓名</th>
        <th>基本工资</th>
        <th>提成奖金</th>
        <th>扣税金额</th>
        <th>迟到次数</th>
        <th>扣款金额</th>
        <th>实发工资</th>
        <th style="width: 12%">操作</th>
    </tr>
    </thead>
    <?php
    foreach ($data as $val) {
        ?>
        <tr>
            <td><?= $val['id']; ?></td>
            <td><?= $val['name']; ?></td>
            <td>￥<?= $val['wages']; ?></td>
            <td>￥<?= $val['commission']; ?></td>
            <td>￥<?= $val['deductions']; ?></td>
            <td><?= $val['late_times']; ?></td>
            <td>￥<?= $val['buckle_money']; ?></td>
            <td>￥<?= $val['should_pay']; ?></td>
            <td>
                <button class="layui-btn layui-btn-sm layui-btn-radius layui-btn-normal">编辑</button>
                <button class="layui-btn layui-btn-sm layui-btn-radius layui-btn-danger">删除</button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>