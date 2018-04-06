<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>itcast</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="/css/Public.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="/layui/css/layui.css"  media="all">
<script type="text/javascript" src="/layui/layui.js" charset="utf-8"></script>
</head>
<body>
    <div  class="head">
        <div  class="head-1">
           <a href=""><img src="/images/logo.jpg" style='flaot:left;'/></a> 
           <div  class="head-1-1">
                <div style='clear:both;height:15px;'></div>
                <{if isset($userInfo)}>
                <div  class="head-1-2" style="width:200px;">
                        欢迎:<a href="/uc/my_info"><{$userInfo['mobile']}></a>登陆
                        <a href="javascript:void(0);" id="logout">退出</a>
                </div>
                <{else}>

                <div  class="head-1-2">
                    <div  class="">
                        <a href="/web/show_login">登录</a>
                    </div>
                    <div  class="" style='float:right'>
                         <a href="/web/Show_regist">注册</a>
                    </div>
                </div>
                <{/if}>
                <div style='clear:both;height:15px;'></div>
                <span class="back_index">
                   <a href="/"> 返回首页</a>
                </span>
                 <span class="tel">客服热线：400-800-000</span>
           </div>
        </div>
    </div>

