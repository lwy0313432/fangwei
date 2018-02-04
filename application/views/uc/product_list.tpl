<{include file="header.tpl"}>
    <div  class="i_18">
        <{include file="left_menu.tpl"}>
                <div  class="i_22">
                    <span class="title">首页 / 产品列表 </span>
                    <div style='clear:both;height:5px;'></div>
                    <div  class="i_23">
                        产品列表
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
    ,url:'/uc/product_list'
    ,cols: [[
      {field:'id', width:80, title: 'ID', sort: true}
      ,{field:'user_id', width:80, title: '用户id'}
      ,{field:'product_name', width:200, title: '产品名称', sort: true}
      ,{field:'level', width:120, title: '防伪级别', sort: true}
      ,{field:'due_yield', width:150, title: '预计年产量', sort: true}
    ]]
    ,page: true
  });
});
    </script>
<{include file="footer.tpl"}>

