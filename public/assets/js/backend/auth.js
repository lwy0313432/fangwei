define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'jstree','template'], function ($, undefined, Backend, Table, Form, undefined,Template) {
    //读取选中的条目
    $.jstree.core.prototype.get_all_checked = function (full) {
        var obj = this.get_selected(), i, j;
        for (i = 0, j = obj.length; i < j; i++) {
            obj = obj.concat(this.get_node(obj[i]).parents);
        }
        obj = $.grep(obj, function (v, i, a) {
            return v != '#';
        });
        obj = obj.filter(function (itm, i, a) {
            return i == a.indexOf(itm);
        });
        return full ? $.map(obj, $.proxy(function (i) {
            return this.get_node(i);
        }, this)) : obj;
    };

    var Controller = {
        admin: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: '/auth/admin',
                    add_url: '/auth/add',
                    edit_url: '/auth/edit',
                    del_url: '/auth/del',
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
                        {field: 'auth_name', title: __('Group'), operate:false},
                        {field: 'email', title: __('Email')},
                        {field: 'status', title: __("Status"), formatter: Table.api.formatter.status},
                        {field: 'logintime', title: __('Login time'), formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: function (value, row, index) {
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
        group: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: '/auth/group',
                    add_url: '/auth/groupAdd',
                    edit_url: '/auth/groupEdit',
                    del_url: '/auth/groupDel',
                    multi_url: '/admin/multi',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                escape: false,
                columns: [
                    [
                        {field: 'state', checkbox: true, },
                        {field: 'id', title: 'ID'},
                        {field: 'pid', title: __('Parent')},
                        {field: 'name', title: __('Name'), align: 'left'},
                        {field: 'status', title: __('Status'), formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: function (value, row, index) {
                                if (Config.admin.group_ids.indexOf(parseInt(row.id)) > -1) {
                                    return '';
                                }
                                return Table.api.formatter.operate.call(this, value, row, index);
                            }}
                    ]
                ],
                pagination: false,
                search: false,
                commonSearch: false,
            });

            // 为表格绑定事件
            Table.api.bindevent(table);//当内容渲染完成后


        },
        groupadd: function () {
            Form.api.bindevent($("form[role=form]"));
            Controller.api.bindevent();
        },
        groupedit: function () {
            Form.api.bindevent($("form[role=form]"));
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"), null, null, function () {
                    if ($("#treeview").size() > 0) {
                        var r = $("#treeview").jstree("get_all_checked");
                        $("input[name='row[rules]']").val(r.join(','));
                    }
                    return true;
                });
                //渲染权限节点树
                //变更级别后需要重建节点树
                $(document).on("change", "select[name='row[pid]']", function () {
                    var pid = $(this).data("pid");
                    var id = $(this).data("id");
                    if ($(this).val() == id) {
                        $("option[value='" + pid + "']", this).prop("selected", true).change();
                        Backend.api.toastr.error('不能设置父节点为自己');
                        return false;
                    }
                    $.ajax({
                        url: "/auth/roletree",
                        type: 'post',
                        dataType: 'json',
                        data: {id: id, pid: $(this).val()},
                        success: function (ret) {
                            if (ret.hasOwnProperty("code")) {
                                var data = ret.hasOwnProperty("data") && ret.data != "" ? ret.data : "";
                                if (ret.code === 1) {
                                    //销毁已有的节点树
                                    $("#treeview").jstree("destroy");
                                    Controller.api.rendertree(data);
                                } else {
                                    Backend.api.toastr.error(ret.data);
                                }
                            }
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });
                });
                //全选和展开
                $(document).on("click", "#checkall", function () {
                    $("#treeview").jstree($(this).prop("checked") ? "check_all" : "uncheck_all");
                });
                $(document).on("click", "#expandall", function () {
                    $("#treeview").jstree($(this).prop("checked") ? "open_all" : "close_all");
                });
                $("select[name='row[pid]']").trigger("change");
            },
            rendertree: function (content) {
                $("#treeview")
                        .on('redraw.jstree', function (e) {
                            $(".layer-footer").attr("domrefresh", Math.random());
                        })
                        .jstree({
                            "themes": {"stripes": true},
                            "checkbox": {
                                "keep_selected_style": false,
                            },
                            "types": {
                                "root": {
                                    "icon": "fa fa-folder-open",
                                },
                                "menu": {
                                    "icon": "fa fa-folder-open",
                                },
                                "file": {
                                    "icon": "fa fa-file-o",
                                }
                            },
                            "plugins": ["checkbox", "types"],
                            "core": {
                                'check_callback': true,
                                "data": content
                            }
                        });
            }
        },
        rule: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    "index_url": "/auth/rule",
                    "add_url": "/auth/ruleAdd",
                    "edit_url": "/auth/ruleEdit",
                    "del_url": "/auth/ruleDel",
                    "multi_url": "auth/rule/multi",
                    "table": "auth_rule"
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                sortName: 'weigh',
                escape:false, 
                columns: [
                    [
                        {field: 'state', checkbox: true, },
                        {field: 'id', title: 'ID'},
                        {field: 'title', title: '标题', align: 'left', align: 'left', formatter: Controller.ruleapi.formatter.title},
                        {field: 'icon', title: '图标', formatter: Controller.ruleapi.formatter.icon},
                        {field: 'name', title: '规则URL', align: 'left', formatter: Controller.ruleapi.formatter.name},
                        {field: 'weigh', title: '权重'},
                        {field: 'status', title: '状态', formatter: Table.api.formatter.status},
                        {field: 'ismenu', title: '菜单', align: 'center', formatter: Controller.ruleapi.formatter.menu},
                        {field: 'id', title: '<a href="javascript:;" class="btn btn-success btn-xs btn-toggle"><i class="fa fa-chevron-up"></i></a>', operate: false, formatter: Controller.ruleapi.formatter.subnode},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ],
                pagination: false,
                search: false,
                commonSearch: false,
            });

            // 为表格绑定事件
            Table.api.bindevent(table);//当内容渲染完成后

            //默认隐藏所有子节点
            table.on('post-body.bs.table', function (e, settings, json, xhr) {
                //$("a.btn[data-id][data-pid][data-pid!=0]").closest("tr").hide();
             //   $(".btn-node-sub.disabled").closest("tr").hide();
                $("a.btn[data-id][data-pid][data-pid!=0]").closest("tr").hide();
                //显示隐藏子节点
                $(".btn-node-sub").off("click").on("click", function (e) {
                    var status = $(this).data("shown") ? true : false;
                    $("a.btn[data-pid='" + $(this).data("id") + "']").each(function () {
                        $(this).closest("tr").toggle(!status);
                    });
                    $(this).data("shown", !status);
                    return false;
                });

            });
            //展开隐藏一级
            $(document.body).on("click", ".btn-toggle", function (e) {
                $("a.btn[data-id][data-pid][data-pid!=0].disabled").closest("tr").hide();
                var that = this;
                var show = $("i", that).hasClass("fa-chevron-down");
                $("i", that).toggleClass("fa-chevron-down", !show);
                $("i", that).toggleClass("fa-chevron-up", show);
                $("a.btn[data-id][data-pid][data-pid!=0]").not('.disabled').closest("tr").toggle(show);
                $(".btn-node-sub[data-pid=0]").data("shown", show);
            });
            //展开隐藏全部
            $(document.body).on("click", ".btn-toggle-all", function (e) {
                var that = this;
                var show = $("i", that).hasClass("fa-plus");
                $("i", that).toggleClass("fa-plus", !show);
                $("i", that).toggleClass("fa-minus", show);
                $(".btn-node-sub.disabled").closest("tr").toggle(show);
                $(".btn-node-sub").data("shown", show);
            });
        },
        ruleadd: function () {
            Controller.ruleapi.bindevent();
        },
        ruleedit: function () {
            Controller.ruleapi.bindevent();
        },
        ruleapi: {
            formatter: {
                title: function (value, row, index) {
                    return !row.ismenu ? "<span class='text-muted'>" + value + "</span>" : value;
                },
                name: function (value, row, index) {
                    return !row.ismenu ? "<span class='text-muted'>" + value + "</span>" : value;
                },
                menu: function (value, row, index) {
                    return "<a href='javascript:;' class='btn btn-" + (value ? "info" : "default") + " btn-xs btn-change' data-id='"
                            + row.id + "' data-params='ismenu=" + (value ? 0 : 1) + "'>" + (value ? __('Yes') : __('No')) + "</a>";
                },
                icon: function (value, row, index) {
                    return '<i class="' + value + '"></i>';
                },
                subnode: function (value, row, index) {
                    return '<a href="javascript:;" data-id="' + row['id'] + '" data-pid="' + row['pid'] + '" class="btn btn-xs '
                            + (row['haschild'] == 1 ? 'btn-success' : 'btn-default disabled') + ' btn-node-sub"><i class="fa fa-sitemap"></i></a>';
                }
            },
            bindevent: function () {
                var iconlist = [];
                Form.api.bindevent($("form[role=form]"));
                $(document).on('click', ".btn-search-icon", function () {
                    if (iconlist.length == 0) {
                        $.get(Config.site.cdnurl + "/assets/libs/font-awesome/less/variables.less", function (ret) {
                            var exp = /fa-var-(.*):/ig;
                            var result;
                            while ((result = exp.exec(ret)) != null) {
                                iconlist.push(result[1]);
                            }
                            Layer.open({
                                type: 1,
                                area: ['460px', '300px'], //宽高
                                content: Template('chooseicontpl', {iconlist: iconlist})
                            });
                        });
                    } else {
                        Layer.open({
                            type: 1,
                            area: ['460px', '300px'], //宽高
                            content: Template('chooseicontpl', {iconlist: iconlist})
                        });
                    }
                });
                $(document).on('click', '#chooseicon ul li', function () {
                    $("input[name='row[icon]']").val('fa fa-' + $(this).data("font"));
                    Layer.closeAll();
                });
                $(document).on('keyup', 'input.js-icon-search', function () {
                    $("#chooseicon ul li").show();
                    if ($(this).val() != '') {
                        $("#chooseicon ul li:not([data-font*='" + $(this).val() + "'])").hide();
                    }
                });
            }
        }
    };
    return Controller;
});
