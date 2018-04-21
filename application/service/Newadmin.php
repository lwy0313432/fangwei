<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Newadmin{
    /*
     * $audit_status 取值 -1，0，1
     * $page页数
     * $num每页展示条数
     * */
    public static function getUserList($audit_status,$page=0,$num=0){
        $dao_user = new Dao_Default_UserModel();
        $audit_status = intval($audit_status);
        $page = intval($page);
        $num=intval($num);
        if($page<=0){
            $page=1;
        }
        if($num<=0||$num>=500){
            $num=500;
        }
        $limit = $num;
        $offset  = ($page -1)*$num;
        $count = $dao_user->fetch('select count(id) from user where audit_status='.$audit_status);
        $total = $count[0]['count(id)'];
        $list = $dao_user->fetch($sql = 'select * from user where audit_status='.$audit_status." limit $offset,$limit");
        return array('list'=>$list,'page'=>$page,'num'=>$num);


    }
    /*
     * $admin_id 审核的管理员的id
     * $user_id 被审核的用户id
     * $audit_status 审核状态
     * */
    public static function audit($admin_id,$user_id,$audit_status,$audit_remark){
        $admin_id = intval($admin_id);
        $user_id=intval($user_id);
        $audit_status = intval($audit_status);
        $audit_remark = addslashes($audit_remark);
        $dao_admin = new Dao_Default_AdminModel();
        $dao_user = new Dao_Default_UserModel();
        $admin_info = $dao_admin->where(array('id'=>$admin_id))->find();
        $user_info = $dao_user->where(array('id'=>$user_id))->find();
        if(!$admin_info || !$user_info || $user_info['audit_status'] !=0 || ($audit_status!=1 && $audit_status!=-1)){
            WLog::warning("user_aduit_param_err",array('admin_id'=>$admin_id,'user_id'=>$user_id,'audit_status'=>$audit_status));
            throw new CException(Errno::USER_AUDIT_PARAM_ERR); 
        }
        $arr_up = array(
            'audit_status'=>$audit_status,
            'audit_dt'=>date("Y-m-d H:i:s"),
            'audit_remark'=>$audit_remark,
        );
        $up_ret = $dao_user->update(array('id'=>$user_id),$arr_up);
        if(!$up_ret){
            WLog::warning("user_aduit_update_err",array('arr_up'=>$arr_up,'admin_id'=>$admin_id,'user_id'=>$user_id,'audit_status'=>$audit_status));
            throw new CException(Errno::INNER_ERR);
        }
        return true;
    }
}




