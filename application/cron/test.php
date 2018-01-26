<?php
require_once('common.php');
//var_export(SendMsg::do_send_mlrt(18511878663,'您正在进行注册操作，验证码为：1298989'));
echo SendMsg::genCode();
