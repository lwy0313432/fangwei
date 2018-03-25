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
    public static function getById($qrcodeTaskId){
        $qrcodeTaskId = intval($qrcodeTaskId);
        $dao_qrcode_task = new Dao_Default_QrcodeTaskModel();
        $info = $dao_qrcode_task->where(array('id'=> $qrcodeTaskId ))->find();
        return $info;
    }
    public static function getFileName($qrcodeTaskId,$uid){
        $config  =  Yaf_Registry::get('config');
        $save_path = $config['qrcode']['save_path'];
        return $save_path.$uid."/".$qrcodeTaskId.".txt";

    }
    public static function qrcodeList($uid,$pageNum,$limit=50){
        $dao_qrcode_task = new Dao_Default_QrcodeTaskModel();
        $uid = intval($uid);
        $limit = intval($limit);
        $pageNum = intval($pageNum);
        if($pageNum <= 0){
            $pageNum=1;
        }
        if($limit<=0){
            $limit = 50;
        }
        $offset = ($pageNum-1) * $limit;
        if($uid<=0){
            WLog::warning('uid_error',array('uid'=>$uid,));
            throw new CException(Errno::ERR_INPUT_PARAMS_INVALID);
        }
        $dao_qrcode_task = new Dao_Default_QrcodeTaskModel();
        $total = $dao_qrcode_task->Fetch("select count(id) from qrcode_task,user_product where qrcode_task.user_product_id=user_product.id and qrcode_task.user_id=$uid");

        $sql = "select qrcode_task.* ,user_product.level ,user_product.product_name from qrcode_task,user_product where qrcode_task.user_product_id=user_product.id and qrcode_task.user_id=$uid limit $offset,$limit";
        $list = $dao_qrcode_task->Fetch($sql);
        return array('total'=>intval($total[0]['count(id)']),'list'=>$list);
    }
    public static function checkQrcode($qrcode_id){
        $qrcode_id = intval($qrcode_id);
        $dao = new Dao_Default_QrcodeModel();
        $info = $dao->where(array('id'=>$qrcode_id))->find();
        if(!$info){
            throw new CException(Errno::QRCODE_ERR);
        }
        $qrcode_task_id = $info['qrcode_task_id'];        
        $dao_qrcode_task = new Dao_Default_QrcodeTaskModel();
        $task_info = $dao_qrcode_task->where(array('id'=>$qrcode_task_id))->find();
        $dao_user_product = new Dao_Default_UserProductModel();
        $product_info = $dao_user_product->where(array('id'=>intval($task_info['user_product_id'])))->find();
        if(!$product_info){
            WLog::warning('qrcode_scan,product_info_err',array('qrocde_id'=>$qrcode_id));
            throw new CException(Errno::INNER_ERR);
        }
        $dao_qrcode_scan = new Dao_Default_QrcodeScanModel();
        $exist = $dao_qrcode_scan->where(array('qrcode_id'=>$qrcode_id))->find();
        $scan_num = 0;
        $last_scan_dt = '';
        if($exist){
            $scan_num=$exist['scan_num'];
            $last_scan_dt=$exist['last_scan_dt'];
            $arr_up=array(
                'scan_num'=>$exist['scan_num']+1,
                'last_scan_dt'=>date("Y-m-d H:i:s"),
            );
            $ret = $dao_qrcode_scan->update(array('id'=>$exist['id']),$arr_up);
            if(!$ret){
                WLog::warning('update_qrcode_scan_err',array('exist'=>$exist,'arr_up'=>$arr_up));
                throw new CException(Errno::INNER_ERR);
            }
        }else{
            $arr_in=array(
                'user_id'=>$info['user_id'],
                'user_product_id'=>$product_info['id'],
                'product_name'=>$product_info['product_name'],
                'location'=>'',
                'qrcode_id'=>$qrcode_id,
                'scan_num'=>1,
                'dt'=>date("Y-m-d H:i:s"),
                'last_scan_dt'=>date("Y-m-d H:i:s"),
                'scan_date'=>date("Ymd"),
            );
            $ret = $dao_qrcode_scan->insert($arr_in);
            if(!$ret){
                WLog::warning('insert_qrcode_scan_err',array('qrcode_id'=>$qrcode_id,'arr_in'=>$arr_in));
                throw new CException(Errno::INNER_ERR);
            }
        }
        $res=array(
            'last_scan_dt'=>$last_scan_dt,
            'scan_num'=> $scan_num,
            'random_str'=>$info['random_str'],
        );
        return array('detail'=>$res);
    }
}



