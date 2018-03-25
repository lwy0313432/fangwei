define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'common'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        list: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: '/returncash/list',
                    add_url: '/returncash/add',
                    edit_url: '/returncash/edit',
                    del_url: '/returncash/delete',
                    multi_url: '/returncash/multi',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                columns: [
                    [
                        {field: 'state', checkbox: true},
                        {field: 'id', title: 'ID'},
                        {field: 'userName', title: '用户姓名'},
                        {field: 'userMobile', title: '用户手机号'},
                        {field: 'name', title: '开户人姓名'},
                        {field: 'bank', title: '银行', operate:false},
                        {field: 'bankcard', title: '银行卡号', operate:false},
                        {field: 'money', title: '提现金额', operate:false},

                        {field: 'identity', title: '身份', formatter: function(value, row, index,custom){
                                var statusType = {'1':'顾客', '2':'店员', '3':'供应商'};
                                var html = statusType[value] ;
                                return html;
                            }, searchList: {'1':'顾客', '2':'店员', '3':'供应商'}},
                        {field: 'isplaymoney', title: '状态', formatter: function(value, row, index,custom){
                                var statusType = {'0':'未打款', '2':'已打款', '1':'已驳回'};
                                var statusTypeColorArr = {'2': 'success', '1': 'danger', '0': 'success'};
                                var html = '<span class="text-' + statusTypeColorArr[value] + '"><i class="fa fa-circle"></i> ' + statusType[value] + '</span>';
                                return html;
                            }, searchList: {'0':'未打款', '2':'已打款', '1':'已驳回'}},
                        {field: 'addtime', title: '提现时间', formatter: Table.api.formatter.datetime, operate: 'BETWEEN', type: 'datetime', addclass: 'datetimepicker', data: 'data-date-format="YYYY-MM-DD"'},
                        {field: 'operate', title: '操作',align: 'left', table: table, events: Controller.api.events.operate,
                            formatter: function (value, row, index) {
                                var detail='';
                                if(row['isplaymoney'] == 0){
                                    detail += '<a class="btn btn-xs btn-success btn-list" data-callback="'+row['id']+'">审核</a> ';
                                }
                                return detail;
                            }}
                    ]
                ],
                pagination: true,
                search: true,
                commonSearch: true,
                searchFormVisible: true,
            });


            // 为表格绑定事件
            Table.api.bindevent(table);
            $('.search input').attr('placeholder', '搜索ID');
        },
        add: function () {
            Form.api.bindevent($("form[role=form]"));
        },
        edit: function () {
            Form.api.bindevent($("form[role=form]"));
        },
        api: {
            bindevent: function () {
                $(document).on("click", ".img-sm", function () {
                    var src=$(this).attr('src');
                    $(".imgmask").show();
                    $(".imgmask img").attr("src",src);
                });
                $(document).on("click", ".imgmask", function () {
                    $(this).hide();
                });
            },
            listbindevent: function(){
            },
            events: {//绑定事件的方法
                operate: $.extend({
                    'click .btn-list': function (e, value, row, index) {
                        e.stopPropagation();
                        layer.confirm('确认打款?', {icon: 3, title:'审核',btn: ['打款', '驳回','取消']}, function(index){
                            $.getJSON('/returncash/ajaxCheckReturnCash?id='+row['id']+'&status=2',function(ret){
                                if(ret.code==1){
                                    Toastr.success(ret.msg);
                                    $("#table").bootstrapTable('refresh');
                                }else{
                                    Toastr.error(ret.msg);
                                }
                                layer.close(index);
                            });


                        },function(index){
                            $.getJSON('/OrderUnderline/ajaxCheckOrder?id='+row['id']+'&status=1',function(ret){
                                if(ret.code==1){
                                    Toastr.success(ret.msg);
                                    $("#table").bootstrapTable('refresh');
                                }else{
                                    Toastr.error(ret.msg);
                                }
                                layer.close(index);
                            });

                        });
                    },
                }, Table.api.events.operate)
            }
        },
    };
    return Controller;
});
