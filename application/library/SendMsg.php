<?php

/**
 * @package yindou
 * @brief  短信发送基类
 * @author weixiaotong <liuwy@yindou.com>
 * @date 2017-03-1
 * @encoding UTF-8
 * @copyright (c) yindou
 */
class SendMsg
{
    /*
     * 短信发送
     */
    public static function do_send($mobile, $type,$user_id = 0 )
    {
        if(!Tools::is_mobile($mobile)){
            throw new CException(Errno::USER_IS_MOBILE_ERROR);
        }
        if($type==Config::MOBILE_CODE_TYPE_REGIST){
            $content = '您正在进行注册操作，验证码为：%s;有效期10分钟。';
        }elseif($type==Config::MOBILE_CODE_TYPE_FIND_PASSWD){
            $content = '您正在进行找回密码操作，验证码为：%s;有效期10分钟。';
        }else{
            throw new CException(Errno::GET_MOBILE_CODE_TYPE_ERR);
        }
        $exist_id = User::getUidByMobile($mobile);
        if($exist_id){
            throw new CException(Errno::USER_IS_MOBILE_REGISTER_ERROR);
        }
        $daoMobileCode = new Dao_Default_MobileCodeModel();
        $arr_conds = array('mobile'=>$mobile,'type'=>$type,'is_expired'=>0);
        $lastMobileCode = $daoMobileCode->where($arr_conds)->order('id desc')->find();
        $ten_minutes_ago = date("Y-m-d H:i:s",time()-600);
        if($lastMobileCode && $lastMobileCode['is_expired']==0 && $lastMobileCode['left_times'] >0&& $lastMobileCode['dt']>=$ten_minutes_ago){
            $code = $lastMobileCode['code'];
        }else{
            $code = self::genCode();
        }
        $ret = $daoMobileCode ->update($arr_conds,array('is_expired'=>1));
        $content = sprintf($content,$code);
        $in_arr = array(
            'user_id'=>$user_id,
            'mobile'=>$mobile,
            'type'=>$type,
            'code'=>$code,
            'dt'=>date("Y-m-d H:i:s"),
        );
        $daoMobileCode->insert($in_arr);
        $ret_1 = $dao_sms = new Dao_Default_SmsModel();
        $send_ret = self::do_send_mlrt($mobile, $content);
        $sms_in_arr = array(
            'user_id'=>$user_id,
            'mobile'=>$mobile,
            'send_type'=>$type,
            'content'=>$content,
            'dt'=>date('Y-m-d H:i:s'),
            'status'=>$send_ret? 1:-1,
            'update_dt'=>date('Y-m-d H:i:s'),
        );
        $ret_2 = $dao_sms->insert($sms_in_arr);
        if(!$ret_1  ||  !$ret_2){
           throw new CException(Errno::DB_ERROR); 
        }
        return true;
    }
    public static function genCode(){
        $str = microtime(true);
        $str= str_replace('.','',$str);
        return substr($str,-6);
    }
    /**
     * 美联软通,发短信
     */
    public static function do_send_mlrt($mobile, $content)
    {
        $mlrt_account = Yaf_Registry::get('config')->SMS_MLRT_ACCOUNT;
        $mlrt_passwd = Yaf_Registry::get('config')->SMS_MLRT_PASS;
        $mlrt_api_key = Yaf_Registry::get('config')->SMS_MLRT_API_KEY;
        if (!$mlrt_account or !$mlrt_passwd or !$mlrt_api_key) {
            // 注：在本地测试时，将两个常量定义为空，返回true，但是实际上不发送短信
            return true;
        }
        $param['username'] = $mlrt_account; //'bjdfcy';
        $param['password'] = $mlrt_passwd; //'YinDou2910Zhaiquan01';
        $param['apikey']   = $mlrt_api_key;
        $param['mobile']   = $mobile;
        $param['content']  = iconv('utf-8', 'gbk', $content);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://m.5c.com.cn/api/send/');
        curl_setopt($ch, CURLOPT_PORT, 80);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);                // 关闭输出，返回字符串
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);                        // 返回header
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);    //注意，毫秒超时设置这个
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 5000);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 5000);
        $ret = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if (strtolower(substr($ret, 0, 7)) == 'success') {
            return true;
        } else {
            WLog::warning('MLRT SEND SMS IS ERROR'.json_encode(array('ret' => $ret, 'mobile' => $mobile, 'content' => $content, 'curl_error' => $error)), array(), 'send_sms');
            return false;
        }
    }

    /**
     * 美联软通，绑定ip地址，指定，只有绑定的ip地址才能发短信。其他地址无法发送。
     */
    public static function mlrt_bind_ip($ip)
    {
        $mlrt_account = Yaf_Registry::get('config')->SMS_MLRT_ACCOUNT;
        $mlrt_passwd = Yaf_Registry::get('config')->SMS_MLRT_PASS;
        $mlrt_api_key = Yaf_Registry::get('config')->SMS_MLRT_API_KEY;
        if (!$mlrt_account or !$mlrt_passwd or !$mlrt_api_key) {
            // 注：在本地测试时，将两个常量定义为空，返回true，但是实际上不发送短信
            return true;
        }

        $param['username'] = $mlrt_account; //'bjdfcy';
        $param['password'] = $mlrt_passwd; //'YinDou2910Zhaiquan01';
        $param['apikey'] = $mlrt_api_key;
        $param['ip'] = $ip;
        $param['action'] = 0;    //0 为绑定ip，1为查询，2为清空

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://m.5c.com.cn/api/bind/index.php');
        curl_setopt($ch, CURLOPT_PORT, 80);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);                // 关闭输出，返回字符串
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);                        // 返回header
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
        $ret = curl_exec($ch);
        curl_close($ch);
        if (strtolower(substr($ret, 0, 7)) == 'success') {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 美联软通，查询发送状态报告，
     */
    public static function mlrt_query_send_report()
    {
        $mlrt_account = Yaf_Registry::get('config')->SMS_MLRT_ACCOUNT;
        $mlrt_passwd = Yaf_Registry::get('config')->SMS_MLRT_PASS;
        $mlrt_api_key = Yaf_Registry::get('config')->SMS_MLRT_API_KEY;
        if (!$mlrt_account or !$mlrt_passwd or !$mlrt_api_key) {
            // 注：在本地测试时，将两个常量定义为空，返回true，但是实际上不发送短信
            return true;
        }

        $param['username'] = $mlrt_account; //'bjdfcy';
        $param['password'] = $mlrt_passwd; //'YinDou2910Zhaiquan01';
        $param['apikey']   = $mlrt_api_key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://m.5c.com.cn/api/recv');
        curl_setopt($ch, CURLOPT_PORT, 80);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);                // 关闭输出，返回字符串
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);                        // 返回header
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
        $ret = curl_exec($ch);
        curl_close($ch);
        
        return $ret;
    }
      
}
