<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title>杉世创意科技有限公司</title>
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
            require.config.action="index"; 
            require.config.jsname="backend/index"; 

        </script>
    </head>
    <body class="hold-transition skin-green sidebar-mini fixed" id="tabs">
        <div class="wrapper">

            <header id="header" class="main-header">
		<{include file="admin/header.tpl"}>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                
		<{include file="admin/menu.tpl"}>
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper tab-content tab-addtabs">
                    <div class="col-xs-12 col-md-offset-2 text-success">
                    <h2>
                    欢迎  衫世创意科技有限公司 管理平台
                    </h2>
                    </div>

            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer hide">
                <div class="pull-right hidden-xs">
                </div>
                <strong>Copyright &copy; 2017-2018 <a href="http://fastadmin.net">Fastadmin</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
		<{include file="admin/control.tpl"}>
        </div>
        <!-- ./wrapper -->
        <!-- end main content -->
        <script src="/assets/js/require.js" data-main="/assets/js/require-backend.js"></script>
    </body>
</html>
