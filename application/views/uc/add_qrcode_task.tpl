<{include file="header.tpl"}>
    <div  class="i_18">
        <{include file="left_menu.tpl"}>
                <div  class="i_22">
                    <span class="title">首页 / 添加任务 </span>
                    <div style='clear:both;height:5px;'></div>
                    <div  class="i_23">
                        添加任务
                    </div>
                    <div style='clear:both;height:20px;'></div>
                    <form class="layui-form" id="form1" action="">
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">产品ID:</label>
                        <div class="layui-input-inline">
                         <input type="text" name="user_product_id" lay-verify="required" autocomplete="off" placeholder="产品id" class="layui-input">
                       </div>
                      </div>
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">生产日期:</label>
                        <div class="layui-input-inline">
                         <input type="text" id="date" name="made_date" lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
                       </div>
                      </div>
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">产品批次号:</label>
                        <div class="layui-input-inline">
                         <input type="text" name="batch_no" lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
                       </div>
                      </div>
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">数量:</label>
                        <div class="layui-input-inline">
                         <input type="text" name="number" lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
                       </div>
                      </div>
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">备注:</label>
                        <div class="layui-input-block">
                        <textarea name="remark" style="width:400px" placeholder="请输入内容" class="layui-textarea"></textarea>
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
    layui.use(['form','laydate'], function(){
          var form = layui.form,laydate=layui.laydate;
            laydate.render({
                elem: '#date'
            });
        //监听提交
          form.on('submit(form1)', function(data){
                var data=$("#form1").serialize();
                $.getJSON('/uc/add_qrcode_task',data,function(ret){
                    if(ret.code==0){
                        layer.msg('提交成功');
                        location.href='/uc/qrcode_task_list'
                    }else{
                        layer.msg(ret.message);
                    
                    }
                })
         });
    })
    </script>
<{include file="footer.tpl"}>

