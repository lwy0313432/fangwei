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
            throw new CException(Errno::ERR_INPUT_PARAMS_INVALID);
        }
        $product_name = isset($param['product_name']) ? $param['product_name'] : ''; 

    }
}
