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

            <form action="/web/do_regist" method='post' >
            <div  class="login-1-1" style='position:relative;left:-7px'>
                <span class="" style='color:red'>*</span>手机号码：  <input type="text" id='mobile' name="mobile"  placeholder="&nbsp;&nbsp;输入您的手机号码"/>
            </div>



            <div style='clear:both;height:15px;'></div>
            <div  class="login-1-1">
                登陆密码：  <input type="password" name="passwd" id='passwd'  placeholder="&nbsp;&nbsp;输入您的登录密码"/>&nbsp;&nbsp;<span class="qiehuan" style='color:red'>*8-18位字母数字下划线</span>
            </div>
           <div style='clear:both;height:15px;'></div>
            <div  class="login-1-1">
                &nbsp;&nbsp;&nbsp;验证码：  <input type="text" name="vcode"  id="vcode_val" placeholder="&nbsp;&nbsp;输入右方字符" style='width:124px;'/> <img src="/Vcode/index" onclick="this.src='/Vcode/index?'+Math.random()"  id="vcode" style='width:69px;height:31px;position:relative;top:10px;'/>&nbsp;&nbsp;<span class="qiehuan"  >换一张</span>
            </div>

            <div style='clear:both;height:15px;'></div>
            <div  class="login-1-1" style='position:relative;left:-18px'>
                手机验证码：  <input type="text" name="mobile_code"  placeholder="&nbsp;&nbsp;输入6位短信验证码"/>&nbsp;&nbsp;<span id="btn_span" isOff='true' onclick='send_sms()'  style='padding:5px 10px 5px 10px;background:rgb(235,235,235);color:#464646'>获取短信验证码</span></a>
            </div>
            <div style='clear:both;height:15px;'></div>
            <input type="submit" name=""  class="logining" value="提交"/>
              </form>
            <span class="title-3"><a href="/web/show_login">已有账号?返回登录<a></span>

        </div>
        
    </div>
    <script>
        function send_sms(){
            vcode=$("#vcode_val").val();
	    if(vcode==''){
     		  layui.use('layer',function () {
		    layer.msg('验证码不能为空',{time: 1000});
		  });
		return false;
		
	    }
        if($('#btn_span').attr('isOff')=='false'){
            return false
        }
            $.ajax({
                type: 'POST',
                url:'/api/send_mobile_code',
                data: {type:1,vcode:vcode,mobile:$("#mobile").val()},
                success: function(ret){
                if(ret.code==0){
            var src='/Vcode/index?'+Math.random();
            $("#vcode").attr('src',src);
            resetCode();
                }else{
		var src='/Vcode/index?'+Math.random();
		$("#vcode").attr('src',src);
     		  layui.use('layer',function () {
                   layer.msg(ret.message,{time: 1000});
		  });
                }
			
		},
                dataType: 'json'
             });
        }
    $(function(){
        $('form').submit(function(){
            var data=$(this).serialize();
            $.getJSON('/web/do_regist',data,function(ret){
                if(ret.code==0){
                    window.location.href='/uc/my_info';
                }else{
        layui.use('layer',function () {
                layer.msg(ret.message,{time: 1000});
        });
                }
            })
            return false;
        });
        $('.qiehuan').click(function(){
            var src='/Vcode/index?'+Math.random();
            $("#vcode").attr('src',src);
        });
    
    })
//倒计时
function resetCode(){
    var obj = $("#btn_span");
    obj.html('60');
    obj.attr('isOff','false'); 
    var second = 60;
    var timer = null;
    timer = setInterval(function(){
            second -= 1;
            if(second >0 ){
            obj.html(second);
            }else{
            obj.attr('isOff','true'); 
            obj.html('重新发送验证码');
            clearInterval(timer);
            }
            },1000);
}
    </script>
    <{include file='footer.tpl'}>
