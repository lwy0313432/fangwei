<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class LoginAction extends ApiBaseAction{
    public function beforeExecute(){
    } 
    public function run($args=null){
        $uid = $this->getUid();
        if($uid){//已经登录了，再调登录接口，那就返回成功吧。
            $this->message = '成功';
            $this->data=array();
        }else{
            $mobile=$this->getRequestParam('mobile');
            $passwd=$this->getRequestParam('passwd');
            $vcode=$this->getRequestParam('vcode');
            User::login($mobile,$passwd,$vcode); 
        }
    }
}
