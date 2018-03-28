<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel hidden-xs">
        <div class="pull-left image">
            <a href="/index/testDB" class="addtabsit"><img src="/assets/img/avatar.png" class="img-circle" /></a>
        </div>
        <div class="pull-left info">
            <p><?php echo $userInfo['name']?></p>
            <i class="fa fa-circle text-success"></i> Online
        </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <!--如果想始终显示子菜单,则给ul加上show-submenu类即可-->
    <ul class="sidebar-menu show-submenu">

         <li class=" treeview"><a href="javascript:;" addtabs="1" url="javascript:;" py="@py" pinyin="@pinyin"><i class="fa fa-group"></i> <span>业务管理</span> <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a> 
            <ul class="treeview-menu">
              <li class=""><a href="OrderUnderline/info?ref=addtabs" addtabs="2" url="/OrderUnderline/info?style_type=2" py="@py" pinyin="@pinyin"><i class="fa fa-user"></i> <span>二维码列表</span> <span class="pull-right-container"> </span></a> </li>
              <li class=""><a href="OrderUnderline/list?ref=addtabs" addtabs="3" url="/OrderUnderline/list" py="@py" pinyin="@pinyin"><i class="fa fa-group"></i> <span>产品列表</span> <span class="pull-right-container"> </span></a> </li>
              <li class=""><a href="OrderUnderline/info?ref=addtabs" addtabs="2" url="/OrderUnderline/info?style_type=2" py="@py" pinyin="@pinyin"><i class="fa fa-user"></i> <span>扫描记录</span> <span class="pull-right-container"> </span></a> </li>
              </ul></li>
         <li class=" treeview"><a href="javascript:;" addtabs="4" url="javascript:;" py="@py" pinyin="@pinyin"><i class="fa fa-group"></i> <span>用户管理</span> <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a> 
            <ul class="treeview-menu">
              <li class=""><a href="caiwu/list?ref=addtabs" addtabs="6" url="/caiwu/list" py="@py" pinyin="@pinyin"><i class="fa fa-bars"></i> <span>会员列表</span> <span class="pull-right-container"> </span></a> </li>
              </ul></li>
         <li class=" treeview"><a href="javascript:;" addtabs="10" url="javascript:;" py="@py" pinyin="@pinyin"><i class="fa fa-group"></i> <span>系统管理</span> <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span></a> 
            <ul class="treeview-menu">
              <li class=""><a href="user/info?ref=addtabs" addtabs="9" url="/user/info" py="@py" pinyin="@pinyin"><i class="fa fa-bars"></i> <span>个人信息</span> <span class="pull-right-container"> </span></a> </li>
              <li class=""><a href="user/editPasswd?ref=addtabs" addtabs="11" url="/user/editPasswd" py="@py" pinyin="@pinyin"><i class="fa fa-bars"></i> <span>密码管理</span> <span class="pull-right-container"> </span></a> </li>
              </ul></li>
    </ul>
</section>
<!-- /.sidebar -->
