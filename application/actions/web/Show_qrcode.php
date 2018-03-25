<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *   扫码验证二维码 
*/

/* vim:set ts=4 sw=4 et fdm=marker: */
class Show_qrcodeAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){

    }
    public function run($args=null){
        $this->display('web/phone.tpl');
    }
}
