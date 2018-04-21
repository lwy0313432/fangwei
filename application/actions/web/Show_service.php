<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Show_serviceAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if($this->uid){ //已经登录的情况下，就跳到首页吧
            header("Location:/");
        }
    }
    public function run($args=null){
        $type = isset($_REQUEST['type'])?intval($_REQUEST['type']):1;
        $this->assign('type',$type);
	if($type==1){
        $this->display('web/show_service.tpl');
	}else{
        $this->display('web/std_money.tpl');

	}
    }
}
