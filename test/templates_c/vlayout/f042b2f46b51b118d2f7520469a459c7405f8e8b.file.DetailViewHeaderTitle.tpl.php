<?php /* Smarty version Smarty-3.1.7, created on 2018-05-15 09:25:36
         compiled from "/var/www/html/vtigercrm65/includes/runtime/../../layouts/vlayout/modules/Vtiger/DetailViewHeaderTitle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12336415585afaa790519659-46467658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f042b2f46b51b118d2f7520469a459c7405f8e8b' => 
    array (
      0 => '/var/www/html/vtigercrm65/includes/runtime/../../layouts/vlayout/modules/Vtiger/DetailViewHeaderTitle.tpl',
      1 => 1468488064,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12336415585afaa790519659-46467658',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD' => 0,
    'MODULE_MODEL' => 0,
    'NAME_FIELD' => 0,
    'FIELD_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5afaa79052fb9',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5afaa79052fb9')) {function content_5afaa79052fb9($_smarty_tpl) {?>
<span class="span10 margin0px"><span class="row-fluid"><span class="recordLabel font-x-x-large textOverflowEllipsis span pushDown" title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
"><?php  $_smarty_tpl->tpl_vars['NAME_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['NAME_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getNameFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['NAME_FIELD']->key => $_smarty_tpl->tpl_vars['NAME_FIELD']->value){
$_smarty_tpl->tpl_vars['NAME_FIELD']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getField($_smarty_tpl->tpl_vars['NAME_FIELD']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPermissions()){?><span class="<?php echo $_smarty_tpl->tpl_vars['NAME_FIELD']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME_FIELD']->value);?>
</span>&nbsp;<?php }?><?php } ?></span></span></span><?php }} ?>