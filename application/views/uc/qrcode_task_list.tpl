<{include file="header.tpl"}>
    <div  class="i_18">
        <{include file="left_menu.tpl"}>
                <div  class="i_22">
                    <span class="title">首页 / 二维码列表 </span>
                    <div style='clear:both;height:5px;'></div>
                    <div  class="i_23">
                        二维码列表
                    </div>
                    <table class="layui-hide" id="test"></table>
                                                                                                    
                </div>
                <div style='clear:both;height:115px;'></div>
            </div>
       
        </div>
    </div>
    <script>
layui.use('table', function(){
  var table = layui.table;
  
  table.render({
    elem: '#test'
    ,url:'/uc/qrcode_task_list'
    ,cols: [[
      {field:'id', title: 'ID', sort: true}
      ,{field:'user_id',  title: '用户id'}
      ,{field:'user_product_id', title: '产品名称', sort: true}
      ,{field:'made_data', title: '生产日期'}
      ,{field:'batch_no',  title: '产品批次号'}
      ,{field:'number',  title: '数量'}
      ,{field:'remark',  title: '备注'}
      ,{field:'dt', width:120, title: '记录时间'}
      ,{field:'status', width:80, title: '状态'}
      ,{field:'downloand_file', width:150, title: '二维码地址', sort: true}
    ]]
    ,page: true
  });
});
    </script>
<{include file="footer.tpl"}>

