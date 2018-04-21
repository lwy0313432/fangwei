<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Qrcode_task_listAction extends AdminBaseAction{
    public function beforeExecute(){
    }
    public function run($args=null){
        //Tools::pre_echo($this->data);   
        if(Util::isAjax()){//新增ajax 判断
            //$pageNum = isset($_REQUEST['page'])?intval($_REQUEST['page']):1;
            $offset = isset($_REQUEST['offset'])?intval($_REQUEST['offset']):0;
            $limit = isset($_REQUEST['limit'])?intval($_REQUEST['limit']):10;
            $pageNum = (int)$offset/$limit;
           $this->data = Newadmin::getUserList(0,$pageNum,$limit);
           $retArr= ['total'=>$this->data['total'],'rows'=>$this->data['list']];
           echo json_encode($retArr);
           exit;
        }
	  $this->display('admin/qrcode_task_list.tpl');
    }
}

