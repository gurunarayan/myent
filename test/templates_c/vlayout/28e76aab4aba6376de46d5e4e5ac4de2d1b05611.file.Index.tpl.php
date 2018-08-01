<?php /* Smarty version Smarty-3.1.7, created on 2018-05-15 12:27:49
         compiled from "/var/www/html/vtigercrm65/includes/runtime/../../layouts/vlayout/modules/Settings/Nagios/Index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18005788335afaab71c98d24-89370822%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28e76aab4aba6376de46d5e4e5ac4de2d1b05611' => 
    array (
      0 => '/var/www/html/vtigercrm65/includes/runtime/../../layouts/vlayout/modules/Settings/Nagios/Index.tpl',
      1 => 1526377148,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18005788335afaab71c98d24-89370822',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5afaab71cb0a0',
  'variables' => 
  array (
    'DATA' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5afaab71cb0a0')) {function content_5afaab71cb0a0($_smarty_tpl) {?>
<style></style><div class="container-fluid"><div class="widget_header"><h3><?php echo 'Nagios Settings';?>
</h3></div><hr><form action="index.php" id="formSettings"><input type="hidden" name="parent" value="Settings"/><input type="hidden" name="module" value="Nagios"/><input type="hidden" name="action" value="IndexAjax"/><input type="hidden" name="mode" value="nagiosSettings"/><div class="summaryWidgetContainer"><table class="table table-bordered equalSplit" style="width: 50%;"><tr><td><label>Server</label></td><td><div class="row-fluid"><span class="span10"><input type="text" class="input-large fieldInput" name="server" value="<?php echo $_smarty_tpl->tpl_vars['DATA']->value[0];?>
" /></span></div></td></tr><!--<tr><td><label>Username</label></td><td><div class="row-fluid"><span class="span10"><input type="text" class="input-large fieldInput" name="user" value="<?php echo $_smarty_tpl->tpl_vars['DATA']->value[1];?>
" /></span></div></td></tr><tr><td><label>Password</label></td><td><div class="row-fluid"><span class="span10"><input type="text" class="input-large fieldInput" name="pwd" value="<?php echo $_smarty_tpl->tpl_vars['DATA']->value[2];?>
" /></span></div></td></tr>--></table><div style="margin-top: 20px;"><span><button class="btn btn-success" type="button" id="btnSaveNagiosSettings"><?php echo vtranslate('LBL_SAVE');?>
</button></span></div></div></form></div>

<script>
</script>
   
<?php }} ?>