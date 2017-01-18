<?php /* Smarty version Smarty-3.1.14, created on 2017-01-11 09:17:43
         compiled from "/Users/cheney/Documents/github/PHPBean/foreground/module/sys_module_manager/module_welcome.html" */ ?>
<?php /*%%SmartyHeaderCode:18237372715875ea27afbe76-14825720%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bae82b0bcfebb978b566ddaaa7cdaec06507a520' => 
    array (
      0 => '/Users/cheney/Documents/github/PHPBean/foreground/module/sys_module_manager/module_welcome.html',
      1 => 1484104757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18237372715875ea27afbe76-14825720',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5875ea27b001d0_46369084',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5875ea27b001d0_46369084')) {function content_5875ea27b001d0_46369084($_smarty_tpl) {?>
		<div class="container" style="margin-top:25px;margin-left:-15px;">
			<h1>PHPBean 管理系统</h1>
			<p>欢迎使用PHPBean 管理系统</p>
			<p><a class="btn btn-primary btn-lg" href="#" role="button">官网主页 &raquo;</a></p>
			<div class="row">
				<div class="col-md-4">
					<h2>模块管理</h2>
					<p>管理所有模块数据</p>
					<p><a class="btn btn-default" href="javascript:showView('sys_module_manager','ModuleManagerView')" role="button">查看 &raquo;</a></p>
				</div>
			</div>
	      <hr>
	      <footer>
	        <p>&copy; Cheney.Xu 2016</p>
	      </footer>
	   </div>
<?php }} ?>