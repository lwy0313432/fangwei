<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class My_info_updateAction extends WebBaseAction{
    public $uid;
    public function beforeExecute(){
        $this->uid = $this->getUid();
        if(!$this->uid){
            header('location:/');
            die;
        }
    }
    public function run($args=null){
        $ret = User::updateUserInfo($this->uid,$_REQUEST);
        var_export($ret);
    }
}
