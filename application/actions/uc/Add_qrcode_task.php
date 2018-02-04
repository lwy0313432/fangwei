<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Add_qrcode_taskAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if(!$this->uid){
            header("Location:/web/show_login");
            die;
        }
    }
    public function run($args=null){
        if(Util::isAjax()){//新增ajax 判断
            $ret = Qrcode::addTask($this->uid,$_REQUEST);
            $code=$ret==true?0:1;
            $res = array(
                'code'    => $code,
                'message' => $ret,
                'data'    =>'' 
            );
            echo  json_encode($res);exit;
        }

	    $this->display('uc/add_qrcode_task.tpl');
    }
}
