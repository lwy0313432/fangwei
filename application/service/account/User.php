<?php
/**
 * @describe:
 * @author: liuwy(liuwy@yindou.com)
 * */

/* vim:set ts=4 sw=4 et fdm=marker: */

class User{
    public static function getUidFromSession(){
        $uid = 0;
        $session = Yaf_Session::getInstance();
        $uid = $session->get('uid');
        return $uid;
    }
    public static function createSession($uid){
        $session = Yaf_Session::getInstance();
        $session->set('uid',$uid);
    }
    
    public static function destroySession()
    {   
        $session = Yaf_Session::getInstance();
        $session->del('uid');
    }
    //校验用户的短信验证码是否正确
     public static function checkSmsCode($mobile,$type,$sms_code){
         if(empty($sms_code) || intval($sms_code)==0){
             throw new CException(Errno::USER_IS_SMS_CODE_ERROR);
         }
         $ret=Util_Sms::get_sms_result_info($mobile, $type, $sms_code);
         return $ret;
     }
     //校验手机号是否已注册
     public static function getUidByMobile($mobile){
         if(!$mobile){
             WLog::warning('mobile is error '.json_encode(array('mobile'=>$mobile)), array(), 'register');
             throw new CException(Errno::USER_IS_MOBILE_ERROR);
         }
         $dao_user=new Dao_Default_UserModel();
         $user_info=$dao_user->where(array('mobile'=>$mobile))->find();
         if($user_info){
             throw new CException(Errno::USER_IS_MOBILE_REGISTER_ERROR);
         }
         return true;
     }
     //登录
     public static function login($mobile,$pass,$vcode){

         if(empty($mobile) || !Tools::is_mobile($mobile)){
             throw new CException(Errno::USER_IS_MOBILE_ERROR);
         }
         if(empty($pass)){
             throw new CException(Errno::USER_IS_PASS_ERROR);
         }
         if(!self::checkVcode($vcode)){
            throw new CException(Errno::VCODE_ERR);
         }
         $dao_user=new Dao_Default_UserModel();
         $where_arr=array(
             'mobile'=>$mobile,
             'password'=>md5($pass),
         );
         $user_info=$dao_user->where($where_arr)->find();
         if(!$user_info){
             WLog::warning('login xx is error '.json_encode($where_arr), array(), 'login');
             throw new CException(Errno::USER_IS_USERNAME_ERROR);
         }
         //登录成功以后 给用户生成token=返回给app
         self::createSession($user_info['id']);
         return array('user_info'=>$user_info);
     }
     public static function isLogin($uid){
        $userInfo = self::getUserInfo($uid);
        if(!$userInfo){
            return array('isLogin'=>'no','userInfo'=>$userInfo);
        }
        return array('isLogin'=>'yes','userInfo'=>$userInfo);
     }
     public static function getUserInfo($uid){
        $dao_user=new Dao_Default_UserModel();
        $uid=intval($uid);
        if(!$uid){
            return array();
        }
        $user=$dao_user->where(array('id'=>$uid))->find();
        if(!$user){
            return array();
        }
        return $user;
     }
     private static function checkVcode($vcode){
         $sessVcode=isset($_SESSION['vcode'])? $_SESSION['vcode'] : null;
         unset($_SESSION['vcode']);
         if(!isset($sessVcode)){
            return false;
         }
         if($vcode !=$sessVcode){
            return false;
         }
         return true;
     }
     //注册   
     public static function addUser($mobile,$pass,$mobile_code){
       if (!Tools::is_mobile($mobile)) {
            WLog::warning('mobile is error '.json_encode(array('mobile'=>$mobile)), array(), 'register');
            throw new CException(Errno::USER_IS_MOBILE_ERROR);
        }
        if (!Tools::is_valid_passwd($pass)) {
            WLog::warning('pass is error '.json_encode(array('pass'=>$pass)), array(), 'register');
            throw new CException(Errno::USER_IS_PASS_ERROR);
        }
        if (!Tools::is_valid_mobile_code($mobile_code)) {
            throw new CException(Errno::USER_IS_SMS_CODE_ERROR);
        }
        $dao_mobile_code = new Dao_Default_MobileCodeModel();
        $ten_minus_ago = date("Y-m-d H:i:s",time()-600);
        $conds = array(
            'mobile'=>$mobile,
            'is_expired'=>0,
            'type'=>Config::MOBILE_CODE_TYPE_REGIST,
        );
        $db_mobile_code = $dao_mobile_code->where($conds)->order('id desc')->find();
        if(!$db_mobile_code){
            throw new CException(Errno::USER_IS_SMS_CODE_ERROR);
        }
        if($db_mobile_code['dt']<=$ten_minus_ago || $db_mobile_code['left_times']<=0){
            throw new CException(Errno::USER_IS_SMS_CODE_ERROR);
        }
        $up_ret['left_times'] = $db_mobile_code['left_times'] -1; 
        if($up_ret['left_times'] <=0){
            $up_ret['is_expired'] = 1 ; 
        }
        $dao_mobile_code->update(array('id'=>$db_mobile_code['id']),$up_ret);
        if($db_mobile_code['code'] != $mobile_code){
            throw new CException(Errno::USER_IS_SMS_CODE_ERROR);
        }
        //校验手机号是否已注册
        self::getUidByMobile($mobile);
        $dao_user=new Dao_Default_UserModel();
        $in_user_arr=array(
            'password'=>md5($pass),
            'mobile'  =>$mobile,
            'dt'      =>date('Y-m-d H:i:s'),
        );
        $in_user_id=$dao_user->Insert($in_user_arr);        
        if(!$in_user_id){
            WLog::warning('in user is error '.json_encode(array('in_data'=>$in_user_arr)), array(), 'register');
            throw new CException(Errno::USER_IS_REGISTER_ERROR);
        }
        //注册成功以后 给用户生成token=返回给app
        return array('uid'=>$in_user_id); 
     }
     //更新user_info表的记录
     public static function updateUserInfo($uid,$param){
         $uid= intval($uid);
         $dao_user = new Dao_Default_UserModel();

         $user = $dao_user->where(array("id"=>$uid))->find();
         if(!$user){
            throw new CException(Errno::USER_NOT_EXIST);
         }
         $type = isset($param['type']) ? $param['type'] : '' ;
         $real_name = isset($param['real_name']) ? $param['real_name'] : '' ;
         $id_no = isset($param['id_no']) ? $param['id_no'] : '' ;
         $address = isset($param['address']) ? $param['address'] : '' ;
         $email = isset($param['email']) ? $param['email'] : '' ;
         $product_type = isset($param['product_type']) ? $param['product_type'] : '' ;
         if($type !='company' && $type!='individal'){ //type必须未公司或个人
            throw new CException(Errno::USER_INFO_TYPE_ERR);
         }
         $product_type = intval($product_type);
         if($product_type >9 || $product_type <=0 ){ //type必须未公司或个人
            throw new CException(Errno::USER_INFO_PRODUCT_ERR);
         }
         if ( $type =='company' &&  !Tools::is_company_id_no($id_no) ){
            throw new CException(Errno::USER_COMPANY_ID_NO_ERR);
         }
         if ( $type =='individal' &&  !Tools::is_id_card_num($id_no) ){
            throw new CException(Errno::USER_ID_NO_IS_ERROR);
         }
         $arr_up = array(
             'type'=>$type,
             'real_name'=>addslashes($real_name),
             'id_no'=>$id_no,
             'address'=>addslashes($address),
             'email'=>addslashes($email),
             'product_type'=>$product_type,
             'dt'=>date("Y-m-d H:i:s"),
         );
         
         $ret = $dao_user->update(array("id"=>$uid),$arr_up);
         if(!$ret){
            throw new CException(Errno::DB_ERROR);
         }
         return true;
     }
     //找回密码
     public static function forgetPwd($mobile,$new_pass){
         if (!Tools::is_mobile($mobile)) {
             WLog::warning('mobile is error '.json_encode(array('mobile'=>$mobile)), array(), 'forget_pwd');
             throw new CException(Errno::USER_IS_MOBILE_ERROR);
         }
         if (!Tools::is_valid_passwd($new_pass)) {
             WLog::warning('pass is error '.json_encode(array('pass'=>$new_pass)), array(), 'forget_pwd');
             throw new CException(Errno::USER_IS_PASS_ERROR);
         }
         //校验手机号是否是注册用户
         $dao_user=new Dao_Default_UserModel();
         $user_info=$dao_user->where(array('mobile'=>$mobile))->find();
         if(!$user_info){
             throw new CException(Errno::USER_MOBILE_NO_REG_ERROR);
         }
         if($user_info['password']==md5($new_pass)){
             throw new CException(Errno::USER_PASS_AS_OLD_ERROR);
         }
         //修改原密码
         $up_ret=$dao_user->Update(array('mobile'=>$mobile),array('password'=>md5($new_pass)));
         if($up_ret===false){
             WLog::warning('pass is error '.json_encode(array('sql'=>$dao_user->getLastSql())), array(), 'forget_pwd');
             throw new CException(Errno::USER_PASS_RESET_ERROR);
         }
         return true;
     }

     //重置密码
     public static function resetPwd($uid,$old_pass,$new_pass){
         $uid=intval($uid);
         if($uid==0){
             throw new CException(Errno::USER_IS_NO_LOGIN_ERROR);
         }
         $dao_user      = new Dao_Default_UserModel();
         $user_info=$dao_user->where(array('id'=>$uid))->find();
         if(!$user_info){
             throw new CException(Errno::USER_IS_NO_LOGIN_ERROR);
         }
         if($user_info['password']!=$old_pass){
             throw new CException(Errno::USER_IS_OLD_PASS_ERROR);
         }
         if($user_info['password']==md5($new_pass)){
             throw new CException(Errno::USER_PASS_AS_OLD_ERROR);
         }
         $ret=$dao_user->Update(array('id'=>$uid),array('password'=>md5($new_pass)));
         if($ret===false){
             throw new CException(Errno::USER_PASS_RESET_ERROR);
         }
         return true;
     }
     //获取推荐人列表
     public static function getAgentList($uid,$city_name,$start_time,$end_time,$page){
         $uid =intval($uid);
         $page=intval($page) >1 ? $page : 1;
         if($uid==0){
             throw new CException(Errno::USER_IS_NO_LOGIN_ERROR);
         }
         $offset=($page-1)*Config::DATA_DEFAULT_LIMIT;
         $dao_user_agent=new Dao_Default_UserAgentModel();
         $dao_user      =new Dao_Default_UserModel();
         $sql="SELECT user.mobile,user.city,user.dt FROM user,user_agent WHERE user.id=user_agent.user_id AND user_agent.pid=$uid";
         if(!empty($start_time) || empty($end_time)){
             $sql.=" AND user.dt >='{$start_time}' and user.dt<='{$end_time}'";
         }
         if(!empty($city_name)){
             $sql.="AND city='{$city_name}'";
         }
         $result=array(
             'page'=>$page,
             'list'=>array(),
         );
         $agent_info=$dao_user->Fetch($sql,false);
         if(!$agent_info){
             return $result;
         }
         foreach ($agent_info as $key=>$val){
             $arr=array();
             $arr['mobile']   =isset($val['mobile'])?$val['mobile']:'';
             $arr['dt']       =isset($val['dt'])?$val['dt']:'';
             $arr['city_name']=isset($val['city_name'])?$val['city_name']:'';
             array_push($$result['list'], $arr);
         }
         return $result;
     }


}
