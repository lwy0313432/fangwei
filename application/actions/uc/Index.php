<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class IndexAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if(!$this->uid){
            header("Location:/web/show_login");
            die;
        }
    }
    public function run($args=null){
        $uid = $this->uid;
        $this->data = User::getUserInfo($uid);
        var_export($this->data);
    }
}
