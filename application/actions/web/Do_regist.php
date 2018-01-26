<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Do_registAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if($this->uid){ //已经登录的情况下，就跳到首页吧
            header("Location:/");
        }
    }
    public function run($args=null){
        $user = new User();
        $mobile= $this->getRequestParam('mobile');
        $pass= $this->getRequestParam('passwd');
        $mobile_code= $this->getRequestParam('mobile_code');
        $ret = $user->addUser($mobile,$pass,$mobile_code);
        if($ret['uid']){
            $user->createSession($ret['uid']);
        }
        var_export($ret);
    }
}
