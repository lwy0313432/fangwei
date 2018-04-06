<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class UcController extends Yaf_Controller_Abstract
{
    public $actions = array(
        //'index'=>'actions/uc/Index.php',
        'my_info'=>'actions/uc/My_info.php', //我的资料
        'my_info_update'=>'actions/uc/My_info_update.php', //提交完善我的资料
        'product_list'=>'actions/uc/Product_list.php',
        'product_add'=>'actions/uc/Product_add.php',
        'show_add_qrcode_task'=>'actions/uc/Show_add_qrcode_task.php',
        'add_qrcode_task'=>'actions/uc/Add_qrcode_task.php',  
        'qrcode_task_list'=>'actions/uc/Qrcode_task_list.php',
        'download_qrcode_file'=>'actions/uc/Download_qrcode_file.php',
        'statistics_date'=>'actions/uc/Statistics_date.php',
        'statistics_location'=>'actions/uc/Statistics_location.php',
    );
}
