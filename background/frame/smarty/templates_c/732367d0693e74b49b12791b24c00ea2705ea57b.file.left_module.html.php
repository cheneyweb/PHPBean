<?php /* Smarty version Smarty-3.1.14, created on 2017-01-18 04:57:54
         compiled from "/Users/cheney/Documents/github/PHPBean/foreground/module/layout/common/left_module.html" */ ?>
<?php /*%%SmartyHeaderCode:997973325875ea27aded41-05534546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '732367d0693e74b49b12791b24c00ea2705ea57b' => 
    array (
      0 => '/Users/cheney/Documents/github/PHPBean/foreground/module/layout/common/left_module.html',
      1 => 1484711872,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '997973325875ea27aded41-05534546',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5875ea27af48c6_91383595',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5875ea27af48c6_91383595')) {function content_5875ea27af48c6_91383595($_smarty_tpl) {?><div class="container-fluid">
	<div class="col-md-2 sidebar">
		<ul class="nav nav-sidebar">
			<?php ob_start();?><?php echo hasPermission(array('code'=>"SYSTEM"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>
			<li><a data-toggle="collapse" href="#module">模块管理</a></li>
			<ul id="module" class="collapse">
				<li><a href="javascript:showHtml('sys_module_manager','module_manager.html')">模块管理</a></li>
				<li><a href="javascript:showHtml('tmp_permission','permission.html')">Permission管理</a></li>
				<!-- $_moduleUrl -->
			</ul>
			<?php }?>
		</ul>
	</div>
	<div id="content" class="col-md-10 main" style="margin-top:0px;margin-left:-60px;">
	<?php echo $_smarty_tpl->getSubTemplate ("../../sys_module_manager/module_welcome.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>
</div>
<?php }} ?>