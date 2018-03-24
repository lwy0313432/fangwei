<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Download_qrcode_fileAction extends WebBaseAction{
    public $uid=0;
    public function beforeExecute(){
        $this->uid=$this->getUid();
        if(!$this->uid){
            header("Location:/web/show_login");
            die;
        }
    }
    public function run($args=null){
        $qrcode_task_id = isset($_REQUEST['qrcodeTaskId']) ? $_REQUEST['qrcodeTaskId'] :0;
        $detail = Qrcode::getById($qrcode_task_id);
        if(!$detail || $detail['status']!='done' ){
            throw new CException(Errno::FILE_DOWNLOAD_FAILED);   
        }
        $file_name = Qrcode::getFileName($detail['id'],$detail['user_id']);
        ob_clean();
        if(!file_exists($file_name)){
            throw new CException(Errno::FILE_NOT_EXIST);   
        }
        $fp=fopen($file_name,"r");
        $filesize=filesize($file_name);
        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Accept-Length:".$filesize);
        header("Content-Disposition: attachment; filename=code.txt");
        $buffer=1024;
        $buffer_count=0;
        while(!feof($fp)&&$filesize-$buffer_count>0){
            $data=fread($fp,$buffer);
            $buffer_count+=$buffer;
            echo $data;
        }
        fclose($fp);

    }
}
