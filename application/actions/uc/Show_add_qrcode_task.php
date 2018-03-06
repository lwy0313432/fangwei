<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Show_add_qrcode_taskAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if(!$this->uid){
            header("Location:/web/show_login"); 
            die;
        }
    }
    public function run($args=null){
        $my_product_list = Product::productList($this->uid);
        $this->assign('my_product_list',$my_product_list);
        $this->display('uc/add_qrcode_task.tpl');
    }
}

