<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class QrcodeScan{
    public static function statsticsByLocation($uid,$start_date=null,$end_date=null){
        $uid = intval($uid);
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
        $dao_qrcode_scan = new Dao_Default_QrcodeScanModel();
        $ret = $dao_qrcode_scan->fetch("select count(id) as count,user_product_id,location,product_name from qrcode_scan where user_id=$uid and scan_date >= $start_date and scan_date<= $end_date group by user_product_id , location");
        $res = array(
            'list'=>$ret,
            'start_date'=>$start_date,
            'end_date'=>$end_date
        );
        return $res;
    }
    public static function statsticsByDate($uid,$start_date=null,$end_date=null){
        $uid = intval($uid);
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
        $dao_qrcode_scan = new Dao_Default_QrcodeScanModel();
        $ret = $dao_qrcode_scan->fetch("select count(id) as count,user_product_id,scan_date,product_name from qrcode_scan where user_id=$uid and scan_date between $start_date and $end_date group by user_product_id , scan_date");
        $res = array(
            'list'=>$ret,
            'start_date'=>$start_date,
            'end_date'=>$end_date
        );
        return $res;
    }
}
