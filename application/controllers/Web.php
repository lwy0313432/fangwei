<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */
class WebController extends Yaf_Controller_Abstract{
    public $actions=array(
        'index'=>'actions/web/Index.php',
        'show_regist'=>'actions/web/Show_regist.php',
        'do_regist'=>'actions/web/Do_regist.php',
        'check_qrcode'=>'actions/web/Check_qrcode.php',
    );
}
/* vim:set ts=4 sw=4 et fdm=marker: */

