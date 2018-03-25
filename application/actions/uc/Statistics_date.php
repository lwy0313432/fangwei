<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Statistics_dateAction extends WebBaseAction{
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
        $data = QrcodeScan::statsticsByDate($this->uid);
        $this->assign('count_list',json_encode($data));
	    $this->display('uc/statistics_date.tpl');
    }
}
