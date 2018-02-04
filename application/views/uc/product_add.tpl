<{include file="header.tpl"}>
    <div  class="i_18">
        <{include file="left_menu.tpl"}>
                <div  class="i_22">
                    <span class="title">首页 / 添加产品 </span>
                    <div style='clear:both;height:5px;'></div>
                    <div  class="i_23">
                        添加产品
                    </div>
                    <form class="layui-form" id="form1" action="">
                        <div class="layui-form-item">
                          <label class="layui-form-label" style="width:100px">类型</label>
                          <div class="layui-input-block">
                            <input type="radio" name="level" value="high" title="高级" checked="">
                            <input type="radio" name="level" value="low" title="普通">
                          </div>
                        </div> 
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">产品名称:</label>
                        <div class="layui-input-inline">
                         <input type="text" name="product_name" lay-verify="required" autocomplete="off" placeholder="公司名称" class="layui-input">
                       </div>
                      </div>
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">预计年产量:</label>
                        <div class="layui-input-inline">
                         <input type="text" name="due_yield" lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
                       </div>
                      </div>
                                                                                                    
                       <div class="layui-form-item" style="width:300px;text-align:center">
                            <button class="layui-btn"  lay-submit lay-filter="form1" type="button">提交</button>
                       </div>
                    </form>
                </div>
                <div style='clear:both;height:115px;'></div>
            </div>
       
        </div>
    </div>
    <script>
    layui.use(['form'], function(){
          var form = layui.form
        //监听提交
          form.on('submit(form1)', function(data){
                var data=$("#form1").serialize();
                $.getJSON('/uc/product_add',data,function(ret){
                    if(ret.code==0){
                        layer.msg('提交成功');
                        location.href='/uc/product_list'
                    }else{
                        layer.msg(ret.message);
                    
                    }
                })
         });
    })
    </script>
<{include file="footer.tpl"}>

