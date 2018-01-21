<?php
/**
 * @describe:
 * @author: liuwy(liuwy@yindou.com)
 * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Config{
    const USER_AUDIT_STATUS_AUDIT_FAILED = -1;
    const USER_AUDIT_STATUS_TO_AUDIT = 0;
    const USER_AUDIT_STATUS_AUDIT_SUCCESS = 1;
    //短信相关end
    //喉管管理系统中不需要登录的接口。
    public static $adminNotNeedAuthController=array(
        'dologin',
        'islogin',
        'logout',
        'admin_my_menu',
        'usercenter_changepasswd',
    );
    private static $routeRule=array(
        'hdgg_page'=>array(
            'regex'=>'#/hdgg/page_(\d)\.html#',
            'control'=>array('module'=>'Index', 'controller'=>'hdgg', 'action'=>'page', ),
            'param'=>array(1=>'page',),
        ),
    );
    public static function getCustomerRoute(){
        return self::$routeRule;
    }
    public static function getSmartyConf(){   
        $smarty = array(
            'left_delimiter'  => '<{',
            'right_delimiter' => '}>',
            'template_dir' => APPLICATION_PATH . '/application/views/',
            'compile_dir'  => APPLICATION_PATH . '/application/cache/smarty_compile',
            'cache_dir'    => APPLICATION_PATH . '/application/cache/smarty_cache',
        );
        return $smarty;
    }
}
