<?php
/**
 * @describe: 自定义异常类
 * @author: Jerry Yang(hy0kle@gmail.com)
 * */
class CException extends Exception
{
    protected $code = -1;
    protected $message = '';
    public function __construct($code)
    {
        $this->code = $code;
        $this->message =Errno::getMessage($code);
        //临时处理异常报错信息 支持ajax异步报错
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $res = array(
                'code'    =>$this->code,
                'message' =>$this->message,
                'data'    =>'' 
            );
            echo  json_encode($res);exit;
        }
    }
}
/* vi:set ts=4 sw=4 et fdm=marker: */
