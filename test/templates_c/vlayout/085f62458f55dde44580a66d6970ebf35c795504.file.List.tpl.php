<?php /* Smarty version Smarty-3.1.7, created on 2018-05-15 09:47:18
         compiled from "/var/www/html/vtigercrm65/includes/runtime/../../layouts/vlayout/modules/Settings/Nagios/List.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4667462405afaab8e804b41-51291996%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '085f62458f55dde44580a66d6970ebf35c795504' => 
    array (
      0 => '/var/www/html/vtigercrm65/includes/runtime/../../layouts/vlayout/modules/Settings/Nagios/List.tpl',
      1 => 1526377632,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4667462405afaab8e804b41-51291996',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5afaab8e8168d',
  'variables' => 
  array (
    'DATA' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5afaab8e8168d')) {function content_5afaab8e8168d($_smarty_tpl) {?>
<style></style><div class="container-fluid"><div class="widget_header"><h3><?php echo 'Nagios';?>
</h3></div><hr><div><iframe src="<?php echo $_smarty_tpl->tpl_vars['DATA']->value[0];?>
map.php?host=all" style="width: 1080px;height:1060px;border:none;" id="iframeDiagram" ><p>Your browser does not support iframes.</p></iframe></div></div>

<script>
</script>
   
<?php }} ?>