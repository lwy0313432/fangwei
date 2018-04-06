<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Statistics_locationAction extends WebBaseAction{
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

        $user_product_id = isset($_REQUEST['user_product_id'])?intval($_REQUEST['user_product_id']) : 0;
        $data = QrcodeScan::statsticsByLocation($this->uid,$user_product_id);
        $this->assign('list',json_encode($data['list']));

        $this->assign('data',$data);
	    $this->display('uc/statistics_location.tpl');
    }
}
