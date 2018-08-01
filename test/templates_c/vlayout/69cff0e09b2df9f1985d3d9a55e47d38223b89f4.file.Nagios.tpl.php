<?php /* Smarty version Smarty-3.1.7, created on 2018-05-15 10:21:43
         compiled from "/var/www/html/vtigercrm65/includes/runtime/../../layouts/vlayout/modules/Instances/Nagios.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6181232385afab379abe8e6-90474631%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69cff0e09b2df9f1985d3d9a55e47d38223b89f4' => 
    array (
      0 => '/var/www/html/vtigercrm65/includes/runtime/../../layouts/vlayout/modules/Instances/Nagios.tpl',
      1 => 1526379696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6181232385afab379abe8e6-90474631',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5afab379ac419',
  'variables' => 
  array (
    'SERVER' => 0,
    'HOST' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5afab379ac419')) {function content_5afab379ac419($_smarty_tpl) {?>
<style>#iframeDiagram {background:url(loader.gif) center center no-repeat;}</style><div class="contentHeader row-fluid"><span class="pull-right"><button class="cancelLink" type="reset" onclick="javascript:window.history.back();">Back</button></span><div><iframe src="<?php echo $_smarty_tpl->tpl_vars['SERVER']->value;?>
cgi-bin/avail.cgi?host=<?php echo $_smarty_tpl->tpl_vars['HOST']->value;?>
" style="width: 1080px;height:1060px;border:none;" id="iframeDiagram" ><p>Your browser does not support iframes.</p></iframe></div></div><?php }} ?>