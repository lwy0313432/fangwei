<!-- Logo -->
<a href="javascript:;" class="logo">
    <!-- 迷你模式下Logo的大小为50X50 -->
    <span class="logo-mini">防伪管理平台</span>
    <!-- 普通模式下Logo -->
    <span class="logo-lg">防伪管理平台</span>
</a>
<!-- 顶部通栏样式 -->
<nav class="navbar navbar-static-top">
    <!-- 边栏切换按钮-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div id="nav" class="pull-left">
        <!--如果不想在顶部显示角标,则给ul加上disable-top-badge类即可-->
        <ul class="nav nav-tabs nav-addtabs disable-top-badge" role="tablist">
        </ul>
    </div>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">




            <li class="hidden-xs">
                <a href="#" data-toggle="fullscreen"><i class="fa fa-arrows-alt"></i></a>
            </li>
            <!-- 账号信息下拉框 -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="/assets/img/avatar.png" class="user-image" alt="">
                    <span class="hidden-xs"><?php echo 'test'?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="/assets/img/avatar.png" class="img-circle" alt="">

                        <p>
                            <?php echo $userInfo['name']?>
                            <small><?php echo date('Y-m-d H:i:s')?></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="/user/editPasswd" class="btn btn-primary addtabsit"><i class="fa fa-user"></i>个人配置</a>
                        </div>
                        <div class="pull-right">
                            <a href="/auth/logout" class="btn btn-danger"><i class="fa fa-sign-out"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- 控制栏切换按钮 -->
            <li>
                <a href="javascript:;" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
        </ul>
    </div>
</nav>
