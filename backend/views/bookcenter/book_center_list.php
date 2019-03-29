<div class="layui-row">
    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
        <button id="add_btn" class="layui-btn layui-btn-radius">添加</button>
    </div>
</div>

<table id="book_center_list" lay-filter="book_center"></table>


<div id="form" style="display: none">
    <div style="width: 100%;padding: 10px;">
        <form class="layui-form" action="" id="add-form" lay-filter="add-form">
            <input type="hidden" name="id" value="" />
            <div class="layui-form-item">
                <label class="layui-form-label">中心名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" placeholder="请输入购书中心名称" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">编号</label>
                <div class="layui-input-block">
                    <input type="text" name="code" lay-verify="number" placeholder="请输入编号" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">管理员</label>
                <div class="layui-input-block">
                    <input type="text" name="manager" lay-verify="required" placeholder="请输入管理员姓名" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">花费</label>
                <div class="layui-input-block">
                    <input type="text" name="cost" lay-verify="required" placeholder="请输入花费" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="add">添加</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/html" id="buttons">
    <button class="layui-btn layui-btn-sm layui-btn-normal layui-btn-radius" lay-event="edit_btn">编辑</button>
    <button class="layui-btn layui-btn-sm layui-btn-danger layui-btn-radius" lay-event="del_btn">删除</button>
</script>
<?php
$this->registerJsFile('/js/v1/bookcenter.js');

