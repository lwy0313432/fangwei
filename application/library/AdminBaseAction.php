<?php
/**
 * @describe: 将 web action 抽象出一个基类,把常用的方法进行简化.
 * @author: liuwy
 * */
abstract class AdminBaseAction extends Yaf_Action_Abstract
{
    abstract public function run($arg = null);

    protected $current_controller   = null;
    protected $current_action_name  = null;

    private $adminId = 0;  //子类只允许用getAdminId()方法获取adminId

    public function getAdminId()
    {
        return $this->adminId;
    }

    private function _init()
    {
        session_start();

        /**
         * 一些常用公共数据
         */
        $current_controller  = strtolower($this->getRequest()->getControllerName());
        $current_action_name = strtolower($this->getRequest()->getActionName());
        $this->current_controller  = $current_controller;
        $this->current_action_name = $current_action_name;

        $this->adminId = Admin::getAdminIdFromSession(); 
        AdminAuthCheck::check($this->adminId,$current_action_name,$current_controller); //action name 就是flag 
        header('Content-Type:text/html; charset=utf-8');

	$this->backend_config();
        $this->assign("adminId", $this->adminId);
        
        return true;
    }

    protected function beforeExecute()
    {
	
    }

    protected function afterExecute()
    {
        return true;
    }
    /**
     * @param mixed $arg,...
     * @return mixed
     */
    public function execute($arg = null)
    {
        try {
            $this->_init();
            $this->beforeExecute();
            $this->run($arg);
            $this->afterExecute();
        } catch (Exception $e) {
            $this->assign('show_error', Util::isProductEnv() ? 0 : 1);
            $this->assign('exceptionMsg', $e->getMessage());
            $this->display('error/error.tpl');
        }
    }

    public function getCurrentActionName()
    {
        return $this->current_action_name;
    }

    /**
     * @param $name
     * @param string $defaultValue
     * @return string
     */
    public function getRequestParam($name, $default = '')
    {
        $request = Yaf_Dispatcher::getInstance()->getRequest();
        return Util::escape($request->get($name, $default));
    }

    /**
     * @param $name
     * @param string $defaultValue
     * @return string
     */
    public function getParam($name, $default = '')
    {
        return isset($_GET[$name]) ? Util::escape($_GET[$name]) : $default;
    }

    /**
     * @param $name
     * @param string $defaultValue
     * @return string
     */
    public function postParam($name, $default = '')
    {
        return isset($_POST[$name]) ? Util::escape($_POST[$name]) : $default;
    }

    public function postUnescape($name, $default = '')
    {
        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }

    // 简化 assign 模板变量的操作
    public function assign($key, $value)
    {
        $this->getView()->assign($key, $value);
    }

    // 简写,要写太多的长代码.
    public function display($tpl, array $parameters = null)
    {
        $this->getView()->display($tpl);
    }
    public function backend_config(){
        $module=strtolower($this->getRequest()->getModuleName());
       //vadump($module);
        $action=strtolower($this->getRequest()->getActionName());
        $controller=strtolower($this->getRequest()->getControllerName());
        $cdnurl= 'http://' . $_SERVER['HTTP_HOST'];
        $config=[
            'site'=>['name'=>'CRM','cdnurl'=>$cdnurl,'version'=>'1.1.0','timezone'=>'Asia/Shanghai','languages'=>''],
            'upload'=>['cdnurl'=>$cdnurl,'uploadurl'=>$cdnurl.'/upload/upload','maxsize'=>'10mb','multipart'=>[],'multiple'=>false,'mimetype'=>'*'],
            'modulename'=>'index',
            'controllername'=>$controller,
            'actionname'=>$action,
            'jsname'=>'backend/'.$controller,
            'moduleurl'=>'../',
            'language'=>'',
            'fastadmin'=>['login_background'=>'/assets/img/loginbg.jpg'],
            'referer'=>null,
        ];
        $this->assign("backend_config",json_encode($config));
    } 
}
/* vi:set ts=4 sw=4 et fdm=marker: */
