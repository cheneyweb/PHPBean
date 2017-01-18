<?php /* Smarty version Smarty-3.1.14, created on 2017-01-11 09:17:45
         compiled from "/Users/cheney/Documents/github/PHPBean/foreground/module/sys_module_manager/system_welcome.html" */ ?>
<?php /*%%SmartyHeaderCode:6988982455875ea29802408-39630532%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ce70d67d6801c17ad6649682a106888073d1f95' => 
    array (
      0 => '/Users/cheney/Documents/github/PHPBean/foreground/module/sys_module_manager/system_welcome.html',
      1 => 1484106556,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6988982455875ea29802408-39630532',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5875ea298059e2_46408565',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5875ea298059e2_46408565')) {function content_5875ea298059e2_46408565($_smarty_tpl) {?><div class="container" style="margin-top: 25px; margin-left: -15px;">
	<h1>PHPBean 管理系统</h1>
	<p>欢迎使用PHPBean 管理系统</p>
	<p>
		<a class="btn btn-primary btn-lg" href="#" role="button">官网主页
			&raquo;</a>
	</p>
	<div class="row">
		<div class="col-md-4">
			<h2>账号管理</h2>
			<p>管理所有账号数据</p>
			<p>
				<a class="btn btn-default" href="javascript:showView('admin','AdminView')" role="button">查看&raquo;</a>
			</p>
		</div>
	</div>
	<hr />
	<footer>
		<p>&copy; Cheney.Xu 2016</p>
	</footer>
</div>
<?php }} ?>