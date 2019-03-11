layui.use('table', function () {
    var table = layui.table;
    table.init('book_center_list', {
        height: 800,
        loading: true,
    });
    //第一个实例
    table.render({
        elem: '#book_center_list'
        , height: 700
        , url: '/bookcenter/getdata' //数据接口
        , limit: 20
        , page: true //开启分页
        , cols: [[ //表头
            {field: 'id', title: 'ID', width: 100, sort: true, fixed: 'center'}
            , {field: 'name', title: '名称',}
            , {field: 'code', title: '编号', sort: true}
            , {field: 'manager', title: '管理员',}
            , {field: 'cost', title: '花费', sort: true}
            , {field: '', title: '操作', templet: '#buttons'}
        ]]
    });
});

layui.use('layer', function(){
    var $ = layui.jquery, layer = layui.layer;

    var active = {
        add: function(){
            var type = othis.data('type')
                ,text = othis.text();

            layer.open({
                type: 1
                ,offset: type //具体配置参考：http://www.layui.com/doc/modules/layer.html#offset
                ,id: 'layerDemo'+type //防止重复弹出
                ,content: '<div style="padding: 20px 100px;">'+ text +'</div>'
                ,btn: '关闭全部'
                ,btnAlign: 'c' //按钮居中
                ,shade: 0 //不显示遮罩
                ,yes: function(){
                    layer.closeAll();
                }
            });
        }
    };
    /*$('.layui-btn').on('click', function(){
        // alert('a')
        var othis = $(this), method = othis.data('method');
        active[method] ? active[method].call(this, othis) : '';
    });*/

    $('#add_btn').on('click', function(){
        layer.open({
            type: 1,
            area: ['600px', '360px'],
            shadeClose: true, //点击遮罩关闭
            content: '\<\div style="padding:20px;">自定义内容\<\/div>'
        });
    });
});