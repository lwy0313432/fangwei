<{include file="header.tpl"}>

    <div  class="login">
        <div style='clear:both;height:64px;'></div>
        <div  class="login-1">
            <div style='clear:both;height:45px;'></div>
            <span class="title">欢迎登录杉世创意</span>
            <div style='clear:both;height:60px;'></div>
            
            <form action="/uc/login" id="form" method="get">
            <div  class="title-1">
                登录 <span class="" style='font-size:18px;'>LOGIN</span>
            </div>
            <div style='clear:both;height:30px;'></div>
            <div  class="login-1-1">
                手机号码：  <input type="text" name="mobile"  placeholder="&nbsp;&nbsp;输入您的手机号码"/>
            </div>
            <div style='clear:both;height:15px;'></div>
            <div  class="login-1-1">
                登陆密码：  <input type="password" name="passwd"  placeholder="&nbsp;&nbsp;输入您的登录密码"/>&nbsp;&nbsp;<span class="qiehuan">忘记密码</span>
            </div>
           <div style='clear:both;height:15px;'></div>
            <div  class="login-1-1">
                &nbsp;&nbsp;&nbsp;验证码：  <input type="text" name="vcode"  placeholder="&nbsp;&nbsp;输入右方字符" style='width:124px;'/> <img src="/Vcode/index" onclick="this.src='/Vcode/index?'+Math.random()"  id="vcode" style='width:69px;height:31px;position:relative;top:10px;'/>&nbsp;&nbsp;<span class="qiehuan"  >换一张</span>
            </div>
            <div style='clear:both;height:15px;'></div>
            <input type="submit" name="" id="submit"  class="logining" value="登陆"/>
             </form>
            <span class="title-3">未注册？请先<a href="#">注册<a></span>
         


            
        </div>
        
    </div>
    <script>
    $(function(){
        $('form').submit(function(){
            var data=$(this).serialize();
            $.getJSON('/api/login',data,function(ret){
                if(ret.code==0){
                    window.location.href='/uc/my_info';
                }else{
                    alert(ret.message);
                }
            
            })
            return false;
        });
        $('.qiehuan').click(function(){
            var src='/Vcode/index?'+Math.random();
            $("#vcode").attr('src',src);
        });
    
    })
    </script>
    <{include file="footer.tpl"}>
