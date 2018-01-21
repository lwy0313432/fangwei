<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class LogoutAction extends ApiBaseAction{
    public function beforeExecute(){
    }
    public function run($args=null){
        $this->message='success';
        User::destroySession();
    }
}
