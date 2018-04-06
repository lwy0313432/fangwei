<?php                                                                                                                      
/**
 *  * @describe:
 *   * @author: liuwy(liuwy@yindou.com)
 *    * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Qrcode_address_saveAction extends ApiBaseAction{
    public function run($args=null){
        //$uid = $this->getUid();
        $this->data = QrcodeScan::addScanAddress($_REQUEST);
    }
}
