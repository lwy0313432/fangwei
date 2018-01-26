<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Send_mobile_codeAction extends ApiBaseAction{
    public function beforeExecute(){
    
    }
    public function run($args=null){
        $vcode = $this->getRequestParam('vcode','');
        $mobile = $this->getRequestParam('mobile','');
        $serverVcode = isset($_SESSION['vcode']) ? $_SESSION['vcode'] : '' ;
        if($vcode  ===  '' || $serverVcode === '' || $vcode != $serverVcode){
            throw new CException(Errno::VCODE_ERR);
        }
        unset($_SESSION['vcode']);
        $this->data = SendMsg::do_send($mobile,Config::MOBILE_CODE_TYPE_REGIST);

    }
}
