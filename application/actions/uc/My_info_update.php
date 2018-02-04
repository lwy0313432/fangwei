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
            header('location:/web/show_login');
            die;
        }
    }
    public function run($args=null){
        $ret = User::updateUserInfo($this->uid,$_REQUEST);
        $code=$ret==true?0:1;
        $res = array(
            'code'    => $code,
            'message' => $ret,
            'data'    =>'' 
        );
        echo  json_encode($res);exit;
    }
}
