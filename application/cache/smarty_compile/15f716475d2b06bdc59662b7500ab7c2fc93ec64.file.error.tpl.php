<?php /* Smarty version Smarty-3.1.13, created on 2017-12-13 11:31:00
         compiled from "/home/www/personal_loan/application/views/error/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10692789495a309ef43b0a73-68714311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15f716475d2b06bdc59662b7500ab7c2fc93ec64' => 
    array (
      0 => '/home/www/personal_loan/application/views/error/error.tpl',
      1 => 1513135855,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10692789495a309ef43b0a73-68714311',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'show_error' => 0,
    'exceptionMsg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a309ef43bce19_38936380',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a309ef43bce19_38936380')) {function content_5a309ef43bce19_38936380($_smarty_tpl) {?><html>
<body>
<?php if ($_smarty_tpl->tpl_vars['show_error']->value){?>
    <?php echo $_smarty_tpl->tpl_vars['exceptionMsg']->value;?>

<?php }?>
</body>
</html>
<?php }} ?>