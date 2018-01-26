<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Product{
    public static function productAdd($uid,$param){
        $uid = intval($uid);
        $dao_user_info = new Dao_Default_UserInfoModel();
        $user_info = $dao_user_info->where(array("user_id"=>$uid))->find();
        if(!$user_info || $user_info['autid_status'] !=Config::USER_AUDIT_STATUS_AUDIT_SUCCESS){
            throw new CException(Errno::USER_INFO_AUDIT_STATUS_ERR);
        }
        $product_name = isset($param['product_name']) ? $param['product_name'] : ''; 
        $level = isset($param['level']) ? $param['level'] : ''; 
        $due_yield = isset($param['due_yield']) ? $param['due_yield'] : ''; 
        if($level!='high' && $level!='low'){
            throw new CException(Errno::USER_PRODUCE_LEVEL_INVALID);
        }
        if( !$due_yield  ||  $due_yield != intval($due_yield) ){
            throw new CException(Errno::USER_PRODUCE_DUE_YIELD_INVALID);
        }
        if(!$product_name){
            throw new CException(Errno::USER_PRODUCE_PRODUCT_INVALID);
        }
        $arrIn = array(
            'user_id'=>$uid,
            'product_name'=>addslashes($product_name),
            'level'=>$level,
            'due_yield'=>$due_yield,
            'dt'=>date("Y-m-d H:i:s"),
        );
        $dao_user_product = new Dao_Default_UserProductModel();
        $ret = $dao_user_product->insert($arrIn);
        if(!$ret){
            throw new CException(Errno::DB_ERROR);
        }
        return true;
    }
    public static function productList($uid){
        $uid = intval($uid);
        if($uid<=0){
            throw new CException(Errno::ERR_INPUT_PARAMS_INVALID);
        }
        $dao_user_product = new Dao_Default_UserProductModel();
        $ret = $dao_user_product-> where(array("user_id"=>$uid))->select();
        if(!$ret){
            return array();
        }
        return $ret;
    }
}
