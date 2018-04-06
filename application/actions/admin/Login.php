<?php
/**
 * @describe:
 * @author: liuwy(liuwy@yindou.com)
 * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class LoginAction extends AdminBaseAction{
    public function beforeExecute(){
    }
    public function run($args=null){
//        $adminInfo = Admin::getAdminInfo(1);
//var_dump($adminInfo);exit;
//        $this->display('admin/index.tpl');
//var_dump(111111111);
//exit;
        $this->display('admin/login.tpl');
    }
}
