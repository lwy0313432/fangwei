<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Qrcode{
    public static function addTask($uid,$param){
        $uid = intval($uid);
        if($uid<=0){
            WLog::warning('uid_error',array('uid'=>$uid,'param'=>$param));
            throw new CException(Errno::ERR_INPUT_PARAMS_INVALID);
        }
        $daoUserInfo = new Dao_Default_UserInfoModel();
        $user_info =$daoUserInfo->where(array('user_id'=>$uid))->find(); 
        if(!$user_info || $user_info['autid_status'] != Config::USER_AUDIT_STATUS_AUDIT_SUCCESS){
            WLog::warning('user_info_error',array('user_info'=>$user_info,'param'=>$param));
            throw new CException(Errno::USER_INFO_AUDIT_STATUS_ERR);
            
        }
        $user_product_id = isset($param['user_product_id']) ? $param['user_product_id'] : ''; 
        $made_date = isset($param['made_date']) ? $param['made_date'] : ''; 
        $batch_no = isset($param['batch_no']) ? $param['batch_no'] : ''; 
        $number = isset($param['number']) ? $param['number'] : ''; 
        $remark = isset($param['remark']) ? $param['remark'] : ''; 
        $dao_user_product = new Dao_Default_UserProductModel();
        $product = $dao_user_product->where(array('id'=>$user_product_id))->find(); 
        if(!$product|| $product['user_id'] !=$uid){
            WLog::warning('user_product_id_error',array('uid'=>$uid,'param'=>$param,'product'=>$product));
            throw new CException(Errno::ERR_INPUT_PARAMS_INVALID); 
        }
        if(!strtotime($made_date) ){
            WLog::warning('made_date_error',array('uid'=>$uid,'param'=>$param,));
            throw new CException(Errno::ERR_INPUT_PARAMS_INVALID); 
        }
        $made_date = date("Y-m-d",strtotime($made_date));
        if(!Tools::is_flag($batch_no)){
            WLog::warning('batch_no_error',array('uid'=>$uid,'param'=>$param,));
            throw new CException(Errno::ERR_INPUT_PARAMS_INVALID); 
        }
        if(intval($number)<=0){
            WLog::warning('num_error',array('uid'=>$uid,'param'=>$param,));
            throw new CException(Errno::ERR_INPUT_PARAMS_INVALID); 
        }
        $in_array = array(
            'user_id'=>$uid,
            'user_product_id'=>$user_product_id,
            'made_date'=>$made_date,
            'batch_no'=>$batch_no,
            'number'=>$number,
            'remark'=>addslashes($remark),
            'dt'=>date("Y-m-d H:i:s"),
        );
        $dao_qrcode_task = new Dao_Default_QrcodeTaskModel();
        $qr_code_task_id = $dao_qrcode_task->insert($in_array);
        if(!$qr_code_task_id){
            throw new CException(Errno::DB_ERROR);
        }
        return array('qr_code_task_id'=>$qr_code_task_id);
    }
    public static function qrcodeList($uid){
        $dao_qrcode_task = new Dao_Default_QrcodeTaskModel();
        $uid = intval($uid);
        if($uid<=0){
            WLog::warning('uid_error',array('uid'=>$uid,));
            throw new CException(Errno::ERR_INPUT_PARAMS_INVALID);
        }
        $dao_qrcode_task = new Dao_Default_QrcodeTaskModel();
        $sql = "select qrcode_task.* ,user_product.level ,user_product.product_name from qrcode_task,user_product where qrcode_task.user_product_id=user_product.id and qrcode_task.user_id=$uid";
        $list = $dao_qrcode_task->Fetch($sql);
        return array('list'=>$list);
    }
}



