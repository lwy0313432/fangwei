<{include file="header.tpl"}>
    <div  class="i_18">
        <{include file="left_menu.tpl"}>
                <div  class="i_22">
                    <span class="title">首页 / 我的资料 </span>
                    <div style='clear:both;height:45px;'></div>
                    <div  class="i_23">
                        我的资料
                    </div>
                    <div style='clear:both;height:15px;'></div>
                    <span class="title-1"><span class="">*</span>如果公司资料未完善，将无法通过审核，部分业务无法正常开通</span>
                    <div style='clear:both;height:15px;'></div>

                    <form class="layui-form" action="">
                        <div class="layui-form-item">
                          <label class="layui-form-label" style="width:100px">类型</label>
                          <div class="layui-input-block">
                            <input type="radio" name="type" value="company" title="公司" checked="">
                            <input type="radio" name="type" value="individal" title="个人">
                          </div>
                        </div> 
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">真实姓名:</label>
                        <div class="layui-input-inline">
                         <input type="text" name="real_name" lay-verify="required" autocomplete="off" placeholder="公司名称" class="layui-input">
                       </div>
                      </div>
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">身份证号码:</label>
                        <div class="layui-input-inline">
                         <input type="text" name="id_no" lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
                       </div>
                      </div>
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">地址:</label>
                        <div class="layui-input-inline">
                         <input type="text" name="address" lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
                       </div>
                      </div>
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:100px">邮箱:</label>
                        <div class="layui-input-inline">
                         <input type="text" name="mail" lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
                       </div>
                      </div>
                       <div class="layui-form-item">
                         <label class="layui-form-label" style="width:120px">法人身份证照片:</label>
                      <div class="layui-upload">
                      <button type="button" class="layui-btn" id="test1">上传图片</button>
                      <div class="layui-upload-list">
                      <img class="layui-upload-img" id="demo1">
                      <p id="demoText"></p>
                      </div>
                      </div> 
                      </div>
                       <div class="layui-form-item">
                            <button class="layui-btn" lay-submit lay-filter="form1" type="button">提交</button>
                       </div>
                    </form>
                    <div  class="i_26" style="display: none;">
                        <div style='clear:both;height:40px;'></div>
                        <p id="i_27">
                            恭喜你，资料提交成功，<br/>
                            我们的工作人员会在三个工作日内审核您的资料<br/>
                            审核结果将以短信方式通知您<br/>
                        </p>
                        <a href="/" class='i_28'>返回首页</a>
                    </div>
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
              layer.alert(JSON.stringify(data.field), {
                    title: '最终的提交信息'
                        })
                            return false;
         });
    })
    </script>
<{include file="footer.tpl"}>

