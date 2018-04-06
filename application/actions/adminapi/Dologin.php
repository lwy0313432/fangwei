<?php
/**
 * @describe:
 * @author: liuwy(liuwy@yindou.com)
 * */

/* vim:set ts=4 sw=4 et fdm=marker: */

class DologinAction extends AdminApiBaseAction{
    public function beforeExecute(){
    }
    public function run($args=null){
        $this->code=Errno::SUCCESS;
        $this->message = Errno::getMessage($this->code);
        $username= $this->getRequestParam('username','');
        $password=$this->getRequestParam('password','');
        $vcode=$this->getRequestParam('vcode','');
    
        $this->data = Admin::dologin($username, $password,$vcode);
	if($this->data){
        $this->code=1;
        $this->message = '成功';//兼容前段框架 修改 成功0为1  
	}
    }
}
