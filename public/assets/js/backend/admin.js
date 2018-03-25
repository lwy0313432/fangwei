define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        admin: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: '/admin/admin',
                    add_url: '/admin/add',
                    edit_url: '/admin/edit',
                    del_url: '/admin/del',
                    multi_url: '/admin/multi',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                columns: [
                    [
                        {field: 'state', checkbox: true, },
                        {field: 'id', title: 'ID'},
                        {field: 'username', title: __('Username')},
                        {field: 'nickname', title: __('Nickname')},
                     //   {field: 'groups_text', title: __('Group'), operate:false, formatter: Table.api.formatter.label},
                        {field: 'email', title: __('Email')},
                        {field: 'status', title: __("Status"), formatter: Table.api.formatter.status},
                        {field: 'logintime', title: __('Login time'), formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: function (value, row, index) {
                   //             if(row.id == Config.admin.id){
                   //                 return '';
                    //            }
                                return Table.api.formatter.operate.call(this, value, row, index);
                            }}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Form.api.bindevent($("form[role=form]"));
        },
        edit: function () {
            Form.api.bindevent($("form[role=form]"));
        },
        adminlog: function () {
            // 初始化表格参数配置
            var table = $("#table");
            Table.api.init({
                extend: {
                    index_url: '/admin/adminlog',
                    add_url: false,
                    edit_url: table.data('operate-edit'),
                    del_url: table.data('operate-del'),
                //    multi_url: '/store/multi',
                }
            });
            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                columns: [
                    [
                        {field: 'state', checkbox: true},
                        {field: 'id', title: 'ID',operate:false},
                        {field: 'admin_id', title: '管理员ID'},
                        {field: 'username', title: '管理员姓名'},
                        {field: 'url', title: '动作'},
                        {field: 'title', title: '标题'},
                        {field: 'createtime', title: '操作时间', formatter: Table.api.formatter.datetime, operate: 'BETWEEN', type: 'datetime', addclass: 'datetimepicker', data: 'data-date-format="YYYY-MM-DD"'},
                    ]
                ],
                pagination: true,
                search: false,
                commonSearch: true,
            });
            // 为表格绑定事件
            Table.api.bindevent(table);
        //    $('.search input').attr('placeholder', '搜索门店名称');
        },
    };
    return Controller;
});
