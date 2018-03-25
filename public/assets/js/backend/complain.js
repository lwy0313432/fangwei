define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'common'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        list: function () {
            // 初始化表格参数配置
            var table = $("#table");
            Table.api.init({
                extend: {
                    index_url: '/complain/list',
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
                        {field: 'id', title: '投诉ID',operate:false},
                        {field: 'addtime', title: '投诉时间', formatter: Table.api.formatter.datetime, operate: 'BETWEEN', type: 'datetime', addclass: 'datetimepicker', data: 'data-date-format="YYYY-MM-DD"',operate:false},
						{field: 'type', title: '投诉类型', formatter: function(value, row, index){
                            var _item={1:'服务问题',2:'质量问题',3:'价格问题'};
                            var txt= '';
                            if(_item.hasOwnProperty(row['type'])){
							    txt= _item[row['type']];
                            }
                            return txt;
                            }, searchList: {'0': '未加精', '1': '已加精'}},
                        {field: 'act_brand_name', title: '品牌'},
                        {field: 'store_name', title: '门店名称'},
                        {field: 'username', title: '业主姓名',operate:false},
                        {field: 'mobile', title: '业主手机号',operate:false},

						{field: 'status', title: '状态', formatter: function(value, row, index){
                            var _item=['提问问题','小蜜核实情况','商户出具方案','维权完毕'];
                            var txt= '';
                            if(_item.hasOwnProperty(row['status'])){
							    txt= _item[row['status']];
                            }
                            return txt;
                            }, searchList: {'0': '未审核', '1': '已通过','2':'未不通'}},
                        {field: 'operate', title: '操作', table: table, events: Controller.api.events.operate, 
								formatter: function (value, row, index) {
                                var detail = '';
                                detail += '<a class="btn btn-xs btn-success btn-info" data-callback="'+row['id']+'">查看</a> ';
                                return detail+Table.api.formatter.operate.call(this, value,row, index,table);
                             //   return detail;
                            }}
                    ]
                ],
                pagination: true,
                search: false,
                commonSearch: true,
            });
            // 为表格绑定事件
            Table.api.bindevent(table);
            $('.search input').attr('placeholder', '搜索门店名称');
            Controller.api.bindevent();
        },
        info: function () {
            Form.api.bindevent($("form[role=form]"));
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                $(document).on("click", ".btn_edit", function () {
                    var  type= $(this).attr('data-type');
                    var  val= $(this).attr('data-val');
                    var  id= $(this).attr('data-id');
                    var that=this;
                    $.getJSON('/complain/ajaxAddOper?id='+id,function(ret){
                        var html='';
                            $(that).hide();
                             $("#div_oper").removeClass('hidden');
                        if(ret.code==1){
    						 Toastr.success(ret.msg);
                             $("#div_oper").removeClass('hidden');
    						//parent.Toastr.success(ret.msg);
                           // parent.$(".btn-refresh").trigger("click");
                           // var index = parent.Layer.getFrameIndex(window.name);
                            //parent.Layer.close(index);
                        }else{
    						 Toastr.success(ret.msg);
                        }
                    });
                }),
                $(document).on("click", ".btn_add", function () {
                    var data=$('#ajaxform').serialize();
                    var  id= $(this).attr('data-id');
                    $.getJSON('/complain/ajaxSaveComplainBack?id='+id,data,function(ret){
                        if(ret.code==1){
    						 //Toastr.success(ret.msg);
                        //     $("#div_oper").removeClass('hidden');
    						//parent.Toastr.success(ret.msg);
                           // parent.$(".btn-refresh").trigger("click");
                            var index = parent.Layer.getFrameIndex(window.name);
                            parent.Layer.close(index);
                        }else{
    						 Toastr.success(ret.msg);
                        }
                    });
                })
            },
            events: {//绑定事件的方法
                operate: $.extend({
                    'click .btn-info': function (e, value, row, index) {
                        e.stopPropagation();
                        Backend.api.open('/complain/info?id=' + row['id'], 'ID  '+row['id']+'-详情')
                    }
                }, Table.api.events.operate)
            }
        },


    };
    return Controller;
});
