<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Encrypt{
    private static $cipher = MCRYPT_RIJNDAEL_192;
    private static $key = '#l12k2D&3SP0Km8$';
    private static $mode = MCRYPT_MODE_ECB;
    public static function encode($str){
        $code = mcrypt_encrypt(self::$cipher,self::$key,$str,self::$mode);
        return urlencode (base64_encode($code));
    }
    public static function decode($code){
        $code = base64_decode($code);
        return mcrypt_decrypt(self::$cipher,self::$key,$code,self::$mode);
    }
}
