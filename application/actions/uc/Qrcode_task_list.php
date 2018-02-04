<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Qrcode_task_listAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if(!$this->uid){
            header("Location:/web/show_login");
            die;
        }
    }
    public function run($args=null){
        //Tools::pre_echo($this->data);   
        if(Util::isAjax()){//新增ajax 判断
            $this->data = Qrcode::qrcodeList($this->uid);
           $retArr= ['code'=>0,'count'=>30,'data'=>$this->data['list']];
           echo json_encode($retArr);
           exit;
        }

	    $this->display('uc/qrcode_task_list.tpl');
    }
}

