<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Check_qrcodeAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if($this->uid){ //已经登录的情况下，就跳到首页吧
            header("Location:/");
        }
    }
    public function run($args=null){
        $this->display('web/show_regist.tpl');
    }
}
