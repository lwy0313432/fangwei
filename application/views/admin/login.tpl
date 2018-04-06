<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title>后台管理系统</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="renderer" content="webkit">
        
        <link rel="shortcut icon" href="/assets/img/favicon.ico" />
        <!-- Loading Bootstrap -->
        <link href="/assets/css/backend.css" rel="stylesheet">
        
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="/assets/js/html5shiv.js"></script>
          <script src="/assets/js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            var require = {config:<{$backend_config}>};
            require.config.controllername="index"; 
            require.config.action="login"; 
            require.config.jsname="backend/index"; 
        </script>

        <style type="text/css">
            body {
                color:#999;
                background:url('https://cdn.demo.fastadmin.net/assets/img/loginbg.jpg');
                background-size:cover;
            }
            a {
                color:#fff;
            }
            .login-panel{margin-top:150px;}
            .login-screen {
                max-width:400px;
                padding:0;
                margin:100px auto 0 auto;

            }
            .login-screen .well {
                border-radius: 3px;
                -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background: rgba(255,255,255, 0.2);
            }
            .login-screen .copyright {
                text-align: center;
            }
            @media(max-width:767px) {
                .login-screen {
                    padding:0 20px;
                }
            }
            .profile-img-card {
                width: 100px;
                height: 100px;
                margin: 10px auto;
                display: block;
                -moz-border-radius: 50%;
                -webkit-border-radius: 50%;
                border-radius: 50%;
            }
            .profile-name-card {
                text-align: center;
            }

            #login-form {
                margin-top:20px;
            }
            #login-form .input-group {
                margin-bottom:15px;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="login-wrapper">
                <div class="login-screen">
                    <div class="well">
                        <div class="login-form">
                            <p id="profile-name" class="profile-name-card"></p>

                            <form action="/adminapi/dologin" method="post" id="login-form">
                                <div id="errtips" class="hide"></div>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
                                    <input type="text" class="form-control" id="pd-form-username" placeholder="用户名" name="username" autocomplete="off" value="" data-rule="用户名:required;username" />
                                </div>

                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
                                    <input type="password" class="form-control" id="pd-form-password" placeholder="密码" name="password" autocomplete="off" value="" data-rule="密码:required;password" />
                                </div>
                                <?php if($openLoginCaptcha):?>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></div>
                                    <input type="text" name="vcode" class="form-control" placeholder="验证码" data-rule="required;" />
                                    <span class="input-group-addon" style="padding:0;border:none;">
                                        <img src="/Vcode/index" onclick="this.src='/Vcode/index?'+Math.random()"   width="100" height="30" />
                                    </span>
                                </div>
                                <?php endif;?>
                                <div class="form-group">
                                    <label class="inline" for="keeplogin">
                                        <input type="checkbox" name="keeplogin" id="keeplogin" value="1" />
                                        保持会话 
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">登录</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require.js" data-main="/assets/js/require-backend.js"></script>
    </body>
</html>
