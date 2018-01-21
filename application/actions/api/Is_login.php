<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Is_loginAction extends ApiBaseAction{
    public function beforeExecute(){
    }
    public function run($args=null){
        $uid = $this->getUid();
        $this->data = User::isLogin($uid);

    }
}
