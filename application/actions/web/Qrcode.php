<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *   扫码验证二维码 
*/

/* vim:set ts=4 sw=4 et fdm=marker: */
class QrcodeAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){

    }
    public function run($args=null){
        $qrcodeId = isset($_REQUEST['code']) ? $_REQUEST['code'] : '';
        if(!$qrcodeId){
            throw new CException(Errno::PARAM_INVALID);
        
        }
        $qrcodeId=Encrypt::decode($qrcodeId );
        if(intval($qrcodeId) != $qrcodeId){
            throw new CException(Errno::QRCODE_ERR);
        }
        $detail = Qrcode::checkQrcode($qrcodeId);
        $this->assign('detail',$detail);
        $this->display('web/qrcode.tpl'); 
    }
}
