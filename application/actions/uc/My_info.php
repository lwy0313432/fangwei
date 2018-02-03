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
        $this->data = User::getUserInfo($this->uid);
        $this->assign('userInfo',$this->data);
    }
    public function run($args=null){
     //   var_dump($this->data);
	$this->display('uc/my_info.tpl');
   //     var_export($this->data);
    }
}
