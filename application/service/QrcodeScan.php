<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class QrcodeScan{
    public static function statsticsByLocation($uid,$user_product_id=0,$start_date=null,$end_date=null){
        $res = array(
            'list'=>array(),
            'user_product_list'=>array(),
            'user_product_id'=>0,
            'start_date'=>'',
            'end_date'=>'',
        );
        $uid = intval($uid);
        $user_product_id = intval($user_product_id);
        $user_product_list = Product::productList($uid);
        if(!$user_product_id){
            if($user_product_list){
                $user_product_id = $user_product_list[0]['id'];
            }
        }
        $res['user_product_list']=$user_product_list;
        $res['user_product_id']=$user_product_id;
        if(!$uid ){
            WLog::warning("param_err",array('uid'=>$uid,'user_product_id'=>$user_product_id));
            return array();
        }
        if(!$start_date){
            $start_date = date("Ymd",strtotime("-1 month"));
        }else{
            $start_date = date("Ymd",strtotime($start_date));
            if(!$start_date){
                $start_date = date("Ymd",strtotime("-1 month"));
            }
        }
        if(!$end_date){
            $end_date=date("Ymd");
        }else{
            $end_date = date("Ymd",strtotime($end_date));
            if(!$end_date){
                $end_date=date("Ymd");
            }
        }
        $res['start_date']=$start_date;
        $res['end_date']=$end_date;
        $dao_qrcode_scan = new Dao_Default_QrcodeScanModel();
        $ret = $dao_qrcode_scan->fetch("select count(id) as count,user_product_id,location,product_name from qrcode_scan where user_id=$uid and user_product_id=$user_product_id and scan_date >= $start_date and scan_date<= $end_date group by location");
      
        $res['list']=$ret;

        return $res;
    }
    public static function statsticsByDate($uid,$user_product_id=0,$start_date=null,$end_date=null){
        $res = array(
            'list'=>array(),
            'user_product_list'=>array(),
            'user_product_id'=>0,
            'start_date'=>'',
            'end_date'=>'',
        );
        $uid = intval($uid);
        $user_product_id = intval($user_product_id);
        $user_product_list = Product::productList($uid);
        if(!$user_product_id){//需要默认值
            if($user_product_list){
                $user_product_id = $user_product_list[0]['id'];
            }
        }
        if(!$uid || !$user_product_id){
            WLog::warning("param_err",array('uid'=>$uid,'user_product_id'=>$user_product_id));
            return $res;
        }
        $res['user_product_list']=$user_product_list;
        $res['user_product_id'] = $user_product_id;
        if(!$start_date){
            $start_date = date("Ymd",strtotime("-1 month"));
        }else{
            $start_date = date("Ymd",strtotime($start_date));
            if(!$start_date){
                $start_date = date("Ymd",strtotime("-1 month"));
            }
        }
        if(!$end_date){
            $end_date=date("Ymd");
        }else{
            $end_date = date("Ymd",strtotime($end_date));
            if(!$end_date){
                $end_date=date("Ymd");
            }
        }
        $res['start_date']=$start_date;
        $res['end_date'] = $end_date;
        $dao_qrcode_scan = new Dao_Default_QrcodeScanModel();
        $ret = $dao_qrcode_scan->fetch("select count(id) as count,user_product_id,scan_date,product_name from qrcode_scan where user_id=$uid and user_product_id=$user_product_id and scan_date between $start_date and $end_date group by   scan_date");
        $res['list']=$ret;
        return $res;
    }
    public static function  addScanAddress($param){
        $qrcode_id=isset($param['qrcode_id'])?intval($param['qrcode_id']) :0 ;
        $address = isset($param['address'])?$param['address'] : array();
        $province = isset($address['province'])?$address['province'] : '';
        $city=isset($address['city'])?$address['city'] : '';
        $district=isset($address['district'])?$address['district'] : '';
        $street=isset($address['street'])?$address['street'] : '';
        $streetNumber=isset($address['streetNumber'])?$address['streetNumber'] : '';
        if($qrcode_id < 0){
            throw new CException(Errno::QRCODE__ID_NOT_EXIST); 
        }
        if(!$city || !$province){
            throw new CException(Errno::ADDRESS_INVALID); 
        }
        $dao_qrcode_scan = new Dao_Default_QrcodeScanModel();
        $ret = $dao_qrcode_scan->update(array('qrcode_id'=>$qrcode_id),array('location'=>$province.",".$city));
        return $ret;
    }
}


