<?php /* Smarty version Smarty-3.1.13, created on 2018-01-05 15:17:12
         compiled from "/home/www/miyou/application/views/error/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12297167825a4f25fac03df7-40674774%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cdf38fbd9d7c6fdd72f6bef343deba05a9ac95c' => 
    array (
      0 => '/home/www/miyou/application/views/error/error.tpl',
      1 => 1515136629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12297167825a4f25fac03df7-40674774',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a4f25fac15674_98299941',
  'variables' => 
  array (
    'show_error' => 0,
    'errMsg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a4f25fac15674_98299941')) {function content_5a4f25fac15674_98299941($_smarty_tpl) {?><html>
<body>
<?php if ($_smarty_tpl->tpl_vars['show_error']->value){?>
    <?php echo $_smarty_tpl->tpl_vars['errMsg']->value;?>

<?php }?>
</body>
</html>
<?php }} ?>