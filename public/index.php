<?php
ini_set("display_errors", "On");

error_reporting(E_ALL^E_NOTICE | E_STRICT);
define('APPLICATION_PATH', dirname(dirname(__FILE__)));
$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");
$application->bootstrap()->run();
