<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */
class WebController extends Yaf_Controller_Abstract{
    public $actions=array(
        'index'=>'actions/web/Index.php',
        'show_login'=>'actions/web/Show_login.php',
        'show_regist'=>'actions/web/Show_regist.php',
        'show_service'=>'actions/web/Show_service.php',
        'about'=>'actions/web/About.php',
        'linkus'=>'actions/web/Linkus.php',
        'do_regist'=>'actions/web/Do_regist.php',
        'qrcode'=>'actions/web/Qrcode.php',
        'show_qrcode'=>'actions/web/Show_qrcode.php',
    );
}
/* vim:set ts=4 sw=4 et fdm=marker: */

