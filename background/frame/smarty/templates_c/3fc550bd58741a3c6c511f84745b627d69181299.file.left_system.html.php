<?php /* Smarty version Smarty-3.1.14, created on 2017-01-11 09:17:45
         compiled from "/Users/cheney/Documents/github/PHPBean/foreground/module/layout/common/left_system.html" */ ?>
<?php /*%%SmartyHeaderCode:20201747395875ea297ea3b9-18168855%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fc550bd58741a3c6c511f84745b627d69181299' => 
    array (
      0 => '/Users/cheney/Documents/github/PHPBean/foreground/module/layout/common/left_system.html',
      1 => 1484106592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20201747395875ea297ea3b9-18168855',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5875ea297fd156_04639815',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5875ea297fd156_04639815')) {function content_5875ea297fd156_04639815($_smarty_tpl) {?><div class="container-fluid">
	<div class="col-md-2 sidebar">
		<ul class="nav nav-sidebar">
			<?php ob_start();?><?php echo hasPermission(array('code'=>"SYSTEM"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>
			<li><a data-toggle="collapse" href="#system">系统管理</a></li>
			<ul id="system" class="collapse">
				<li><a href="javascript:showHtml('sys_admin','admin.html')">帐号管理</a></li>
				<li><a href="javascript:showHtml('sys_role','role.html')">角色管理</a></li>
				<!-- <li><a href="#">系统公告</a></li> -->
			</ul>
			<?php }?>
		</ul>
	</div>
	<div id="content" class="col-md-10 main" style="margin-top:0px;margin-left:-60px;">
	<?php echo $_smarty_tpl->getSubTemplate ("../../sys_module_manager/system_welcome.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>
</div>
<?php }} ?>