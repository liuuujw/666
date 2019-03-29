
var $ = layui.jquery, layer = layui.layer;
var formData = {
    'name':'',
    'code':'',
    'manager':'',
    'cost':'',
    'id':'',
};

layui.use(['table','layer','form'], function () {
    var table = layui.table;
    var form = layui.form;
    var html = $('#form').html();
    var layerOption = {
        type: 1,
        area: ['50%', '350px'],
        id: 'add_btn1',
        anim: 5,
        shadeClose: false, //点击遮罩关闭
        content: '\<\div width:50%; padding:20px;">'+html+'\<\/div>',
        shade: 0,
    };
    table.init('book_center_list', {
        height: 800,
        loading: true,
    });
    //第一个实例
    var tableIns = table.render({
        elem: '#book_center_list'
        , height: 650
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
    table.on('tool(book_center)', function(obj){
        var detail = obj.data;
        if(obj.event === 'edit-btn'){
            layer.open(
                layerOption
            );
            form.val('add-form', detail);
        }else if(obj.event === 'del_btn'){
            //当前页
            var currentPage = tableIns.config.page.curr;
            console.log(currentPage);
            console.log(tableIns.config.page);
            // tableIns.reload({
            //     pages:{curr: currentPage}
            // })
            if(confirm("确定要删除吗？") === true){
                $.ajax({
                    url: '/bookcenter/del',
                    data: {id: obj.data.id},
                    type: 'POST',
                    success: function(data){
                        console.log(data);
                        tableIns.reload({
                            pages:{curr: 1}
                        });
                    }
                });

            }

        }


    });

    $('#add_btn').on('click', function () {
        layer.open(
            layerOption
        );
    });

    form.on('submit(add)', function (data) {
        console.log(data.field);
        // layui.layer.closeAll();
        return false;
    });

    form.val('add-form',formData);

});