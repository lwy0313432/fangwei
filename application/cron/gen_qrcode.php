<?php                                                                                                                      
/**
 *  * @describe:生成二维码的任务
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
require_once('common.php');
$config  =  Yaf_Registry::get('config');
$save_path = $config['qrcode']['save_path'];
$scan_url = $config['scan_url'];
$dao_qrcode_task = new Dao_Default_QrcodeTaskModel();
$dao_qrcode = new Dao_Default_QrcodeModel();
$todo_list = $dao_qrcode_task ->where(array('status'=>'init'))->limit(0,10)->select();
foreach($todo_list as $item){
    if($item['status']!='init'){
        echo date('Y-m-d H:i:s').' status error'.var_export($item,true)."\n";
        continue;
    }   
    $dao_qrcode_task->update(array('id'=>$item['id']),array('status'=>'doing'));
    $user_save_path = $save_path.$item['user_id'];
    if(!is_dir($user_save_path)){
        mkdir($user_save_path);
    }
    $file_name = $user_save_path."/".$item['id'].".txt";
    $index = 0;
    for($index=0; $index<$item['number'];$index++){
        $in_arr = array(
            'user_id'=>$item['user_id'],
            'qrcode_task_id'=>$item['id'],
            'dt'=>date("Y-m-d H:i:s"),
            'random_str'=>random(),
        );
        $qrcode_id = $dao_qrcode->insert($in_arr); 
        $encode_qrcode_id=Encrypt::encode($qrcode_id );
        $str = $scan_url."?code=".$encode_qrcode_id."\n";
        file_put_contents($file_name,$str,FILE_APPEND);      
    }

    $dao_qrcode_task->update(array('id'=>$item['id']),array('status'=>'done'));

}


function random($length = 6)  
{  
        $string =  'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $code = '';  
        $strlen = strlen($string) - 1;  
        for ($i = 0; $i < $length; $i++) {  
            $code .= $string{mt_rand(0, $strlen)};  
        }  
        return $code;  
}
