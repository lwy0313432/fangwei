<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class My_infoAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if(!$this->uid){
            header("Location:/");
            die;
        }
    }
    public function run($args=null){
        $uid = $this->uid;
        $this->data = User::getUserInfo($uid);
        var_export($this->data);
    }
}
