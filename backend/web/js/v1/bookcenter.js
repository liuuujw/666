layui.use('table', function(){
    var table = layui.table;
    table.init('book_center_list',{
        height: 800,
        loading: true,
    });
    //第一个实例
    table.render({
        elem: '#book_center_list'
        ,height: 700
        ,url: '/bookcenter/getdata' //数据接口
        ,limit: 20
        ,page: true //开启分页
        ,cols: [[ //表头
            {field: 'id', title: 'ID', width: 100,  sort: true, fixed: 'center'}
            ,{field: 'name', title: '名称', }
            ,{field: 'code', title: '编号', sort: true}
            ,{field: 'manager', title: '管理员', }
            ,{field: 'cost', title: '花费',sort: true}
            ,{field:'', title: '操作', templet: '#buttons'}
        ]]
    });

});