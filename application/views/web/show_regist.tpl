    <{include file="header.tpl"}>
    <div  class="login">
        <div style='clear:both;height:64px;'></div>
        <div  class="login-1">
            <div style='clear:both;height:45px;'></div>
            <span class="title">欢迎登录杉世创意</span>
            <div style='clear:both;height:60px;'></div>
            
            <div  class="title-1">
                注册 <span class="" style='font-size:18px;'>REGISTER</span>
            </div>
            <div style='clear:both;height:30px;'></div>

            <form action="" >
            <div  class="login-1-1" style='position:relative;left:-7px'>
                <span class="" style='color:red'>*</span>手机号码：  <input type="text" id='mobile' name="mobile"  placeholder="&nbsp;&nbsp;输入您的手机号码"/>
            </div>



            <div style='clear:both;height:15px;'></div>
            <div  class="login-1-1">
                登陆密码：  <input type="text" name=""  placeholder="&nbsp;&nbsp;输入您的登录密码"/>&nbsp;&nbsp;<span class="qiehuan" style='color:red'>*8-18位字母数字下划线</span>
            </div>
           <div style='clear:both;height:15px;'></div>
            <div  class="login-1-1">
                &nbsp;&nbsp;&nbsp;验证码：  <input type="text" name="vcode" id='vcode'  placeholder="&nbsp;&nbsp;输入右侧计算结果" style='width:124px;'/> <img src="/vcode" style='width:69px;height:31px;position:relative;top:10px;'/>&nbsp;&nbsp;<span class="qiehuan">换一张</span>
            </div>

            <div style='clear:both;height:15px;'></div>
            <div  class="login-1-1" style='position:relative;left:-18px'>
                手机验证码：  <input type="text" name=""  placeholder="&nbsp;&nbsp;输入6位短信验证码"/>&nbsp;&nbsp;<span onclick='send_sms()' class="qiehuan" style='padding:5px 10px 5px 10px;background:rgb(235,235,235);color:#464646'>获取短信验证码</span></a>
            </div>
            <div style='clear:both;height:15px;'></div>
            <input type="submit" name=""  class="logining" value="提交"/>
              </form>
            <span class="title-3"><a href="#">已有账号?返回登录<a></span>

        </div>
        
    </div>
    <script type="text/javascript">
        function send_sms(){
            vcode=$("#vcode").val();
            $.ajax({
                type: 'POST',
                url:'/api/send_mobile_code',
                data: {type:1,vcode:vcode,mobile:$("#mobile").val()},
                success: function(){},
                dataType: 'json'
             });
        }
    </script>
    <{include file='footer.tpl'}>
