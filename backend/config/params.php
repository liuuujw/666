<?php
return [
    'adminEmail' => 'admin@example.com',
    'menu_list' => [
        ['name' => '主页', 'url' => '/index', 'icon' => 'glyphicon glyphicon-home'],
        ['name' => '账号管理', 'url' => '/role', 'icon' => '', 'item' => [
            ['name' => '角色', 'url' => '/role/add']
        ]],
        ['name' => '购书中心管理', 'url' => '/bookcenter', 'icon' => 'glyphicon glyphicon-align-center'],
        ['name' => '部门管理', 'url' => '/department', 'icon' => 'glyphicon glyphicon-menu-hamburger'],
        ['name' => '员工管理', 'url' => '/staff', 'icon' => 'glyphicon glyphicon-user'],
        ['name' => '书籍管理', 'url' => '/book', 'icon' => 'glyphicon glyphicon-book'],
        ['name' => '出版商管理', 'url' => '/publisher', 'icon' => 'glyphicon glyphicon-edit'],
        ['name' => '采购记录', 'url' => '/purchasing', 'icon' => 'glyphicon glyphicon-list-alt'],
        ['name' => '仓库管理', 'url' => '/warehouse', 'icon' => 'fa fa-truck'],
        ['name' => '销售记录', 'url' => '/sale', 'icon' => 'glyphicon glyphicon-list-alt'],
        ['name' => '工资管理', 'url' => '/wages', 'icon' => 'glyphicon glyphicon-yen'],
        ['name' => '报表', 'url' => '/charts', 'icon' => 'glyphicon glyphicon-stats', 'item' => [
            ['name' => '月利润报表', 'url' => '/charts/profit'],
            ['name' => '销售报表', 'url' => '/charts/sold'],
            ['name' => '工资报表', 'url' => '/charts/wages'],
            ['name' => '进货报表', 'url' => '/charts/purchase'],
            ['name' => '运营报表', 'url' => '/charts/operate'],
            ['name' => '仓库存储报表', 'url' => '/charts/warehouse'],
        ]],
    ],
    'department' => array(
        '行政部',
        '财务部',
        '质量管理部',
        '营销部',
        '运营部',
        '技术部',
        '维护部',
        '人力资源部',
        '客户服务部',
    ),
];
