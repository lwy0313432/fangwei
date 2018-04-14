<?php
/**
 * @describe:
 * @author: liuwy(liuwy@yindou.com)
 * */

/* vim:set ts=4 sw=4 et fdm=marker: */

class AdminController extends Yaf_Controller_Abstract{
    public $actions=array(
        'index'=>'actions/admin/Index.php',
        'qrcode_task_list'=>'actions/admin/Qrcode_task_list.php',
        'userlist'=>'actions/admin/Userlist.php',
        'login'=>'actions/admin/Login.php'
    );
}
