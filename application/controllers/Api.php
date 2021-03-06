<?php
/**
 * @describe:app端所有的接口都放到这里面
 * @author: liuwy(liuwy@yindou.com)
 * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class ApiController extends Yaf_Controller_Abstract{
    /*
    public function indexAction(){
        echo 'index';
        return false;
    }
     */
    public $actions=array(
        'index'     =>'actions/api/Index.php',
        'login'     =>'actions/api/Login.php',
        'logout'    =>'actions/api/Logout.php',
        'is_login'  =>'actions/api/Is_login.php',
        'send_mobile_code'=>'actions/api/Send_mobile_code.php',
        'product_list'=>'actions/api/Product_list.php',
        'statistics_location'=>'actions/api/Statistics_location.php',
        'statistics_date'=>'actions/api/Statistics_date.php',
        'qrcode_address_save'=>'actions/api/Qrcode_address_save.php',
    );
}
