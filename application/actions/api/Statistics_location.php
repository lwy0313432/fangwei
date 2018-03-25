<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    按地区维度进行统计
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Statistics_locationAction extends ApiBaseAction{
    public function run($args=null){
        $uid = $this->getUid(); 
        if(!$uid){//已经登录了，再调登录接口，那就返回成功吧                                                                               
            throw new CException(Errno::USER_IS_NO_LOGIN_ERROR);
        }
        $this->data = QrcodeScan::statsticsByLocation($uid);
    }
}
