<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class User_listAction extends  Yaf_Action_Abstract{
    public function execute(){
        $admin_id = 1;//$this->getAdminId();
        if($admin_id){
            //$list = Newadmin::getUserList(1);
            $res = Newadmin::audit($admin_id,1,1,'通过');
        }
    }  
}

