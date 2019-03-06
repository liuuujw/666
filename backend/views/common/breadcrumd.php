<div class="layui-row breadcrumb">
    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
        <span class="layui-breadcrumb">
            <?= isset($this->params['m_name']) ? "<a>".$this->params['m_name']."</a>" : '' ?>
            <?= isset($this->params['c_name']) ? "<a>".$this->params['c_name']."</a>" : '' ?>

        </span>
    </div>
</div>