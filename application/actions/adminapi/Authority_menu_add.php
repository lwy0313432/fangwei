<?php
/**
 * @describe:
 * @author: liuwy(liuwy@yindou.com)
 * */

/* vim:set ts=4 sw=4 et fdm=marker: */
class Authority_menu_addAction extends AdminApiBaseAction
{
    protected function beforeExecute(){
    }
    public function run($arg = null){
        $this->code=Errno::SUCCESS;
        $this->message = Errno::getMessage($this->code);
        $this->data = AdminMenu::add_menu($_REQUEST);

    }
}
