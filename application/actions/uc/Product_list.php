<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */

class Product_listAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if(!$this->uid){
            header("Location:/web/show_regist");
            die;
        }
    }
    public function run($args=null){
        $this->data=Product::productList($this->uid);
        $this->assign('list',$this->data);
        var_export($this->data);
    }
}
