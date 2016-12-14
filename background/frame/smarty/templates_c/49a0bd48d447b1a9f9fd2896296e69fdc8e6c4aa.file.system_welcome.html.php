<?php /* Smarty version Smarty-3.1.14, created on 2016-12-14 03:03:50
         compiled from "../../../../foreground/module/sys_module_manager/system_welcome.html" */ ?>
<?php /*%%SmartyHeaderCode:19039648945850a886574760-66857006%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49a0bd48d447b1a9f9fd2896296e69fdc8e6c4aa' => 
    array (
      0 => '../../../../foreground/module/sys_module_manager/system_welcome.html',
      1 => 1481531097,
      2 => 'file',
    ),
    '808932a90882f8d40a83e70082d5c99cb9401d4b' => 
    array (
      0 => '/Users/cheney/Documents/github/PHPBean/foreground/module/layout/left_system.html',
      1 => 1481531097,
      2 => 'file',
    ),
    'd6b97cbb7b46473fbc67118001655d28118eb6b6' => 
    array (
      0 => '/Users/cheney/Documents/github/PHPBean/foreground/module/layout/common/nav.html',
      1 => 1481531097,
      2 => 'file',
    ),
    '87c5e0e4360bf53c2a39ef6605b84274fc16378a' => 
    array (
      0 => '/Users/cheney/Documents/github/PHPBean/foreground/module/layout/common/header.html',
      1 => 1481598774,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19039648945850a886574760-66857006',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5850a886749502_48449635',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5850a886749502_48449635')) {function content_5850a886749502_48449635($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>PHPBean 管理系统</title>
	<!-- Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="../../../../foreground/frame/bootstrap3/css/bootstrap.min.css" />
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="../../../../foreground/frame/jquery/jquery-2.0.3.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="../../../../foreground/frame/bootstrap3/js/bootstrap.min.js"></script>
	<!-- jQuery Ajax插件 -->
	<!-- <script src="http://malsup.github.io/jquery.form.js"></script> -->
	<script src="../../../../foreground/frame/jquery/jquery.form.js"></script>
	<!-- 日期控件 -->
	<link rel="stylesheet" href="../../../../foreground/frame/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />
	<script src="../../../../foreground/frame/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<!-- 树形控件 -->
	<link rel="stylesheet" href="../../../../foreground/frame/ztree/css/metroStyle/metroStyle.css" />
	<script src="../../../../foreground/frame/ztree/js/jquery.ztree.core.js"></script>
	<script src="../../../../foreground/frame/ztree/js/jquery.ztree.excheck.js"></script>
	<!-- 自定义分页查询插件 -->
	<script src="../../../../foreground/custom/js/query/query.js"></script>
	<script src="../../../../foreground/custom/js/query/action.js"></script>
	<script src="../../../../foreground/custom/js/query/modal.js"></script>
	<script src="../../../../foreground/custom/js/query/show.js"></script>
	<!-- 自定义校验插件 -->
	<script src="../../../../foreground/custom/js/runtime_validator/runtime_validator.js"></script>
	<!-- 自定义树形插件 -->
	<script src="../../../../foreground/custom/js/tree/tree_permission.js"></script>
	<style>
	body {
		padding-top: 50px;
	}
	.main .page-header {
		margin-top: 0;
	}
	.table{
		font-size: 14px;
	}

  	.sidebar {
    position: fixed;
    top: 50px;
    bottom: 0;
    left: 0;
    display: block;
    overflow-x: hidden;
    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    }

	.main {
	bottom: 0;
	left: 250px;
	overflow-x: hidden;
	overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
	}

	.main .page-header {
	  margin-top: 0;
	}

	</style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<!--../../../../background/module/admin/controller/LoginAction.php-->
			<a class="navbar-brand" href="#">PHPBean&nbsp;&nbsp;管理系统</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-left">
				<?php ob_start();?><?php echo hasPermission(array('code'=>"SYSTEM"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>
					<li><a href="../../../../background/module/sys_module_manager/view/ModuleWelcomeView.php">模块管理</a></li>
					<li><a href="../../../../background/module/sys_module_manager/view/SystemWelcomeView.php">系统管理</a></li>
				<?php }?>
				<li><a href="javascript:alert('PHPBean 管理系统\n\n版本：v2.0');">About</a></li>
				<!-- <li><a href="javascript:alert('开发方：CheneyXu(许宇帅)\n\nEmail：457299596@qq.com');">Contact</a></li> -->
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>欢迎您：<?php echo (($tmp = @$_smarty_tpl->tpl_vars['admin']->value['account'])===null||$tmp==='' ? '' : $tmp);?>
(<?php echo (($tmp = @$_smarty_tpl->tpl_vars['admin']->value['role_names'])===null||$tmp==='' ? '' : $tmp);?>
)</a></li>
				<!-- <li><a href="#">待办</a></li> -->
				<li><a href="../../../../index.php">登出</a></li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>
<div id="changePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="changePasswordModalLabel">修改账号密码</h4>
			</div>
			<div class="modal-body">
				<!-- 修改密码表单 -->
				<form id="changePasswordForm" class="form-horizontal" method="POST">
					<!-- Admin实体 -->
					<input type=hidden name="bean" value="Admin" />
					<div class="form-group">
						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">帐号</div>
								<input value="<?php echo $_smarty_tpl->tpl_vars['admin']->value['account'];?>
" readonly="true" type="text" class="form-control"/>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">新密码</div>
								<input name="password" vlaue="" type="password" class="form-control" maxlength="16" placeholder="6至16位字符内"/>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" onclick="javascript:updateProviderPassword('sys_admin','UpdatePasswordAction','changePasswordForm')">更新</button>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="col-md-2 sidebar">
		<ul class="nav nav-sidebar">				
			<?php ob_start();?><?php echo hasPermission(array('code'=>"SYSTEM"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>
			<li><a data-toggle="collapse" href="#system">系统管理</a></li>
			<ul id="system" class="collapse">
				<li><a href="javascript:showView('sys_admin','AdminView')">帐号管理</a></li>
				<li><a href="javascript:showView('sys_role','RoleView')">角色管理</a></li>
				<!-- <li><a href="#">系统公告</a></li> -->
			</ul>
			<?php }?>
		</ul>
	</div>
	<div id="content" class="col-md-10 main" style="margin-top:-30px;margin-left:-60px;">
		
<div class="container" style="margin-top: 25px; margin-left: -15px;">
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

	</div>
</div>



<script>
function updateProviderPassword(moduleName,actionName,formName){
	if(window.confirm('确认修改密码？')){
		var action = '../../../../background/module/' + moduleName + '/controller/' + actionName + '.php';
		$('#'+formName).ajaxSubmit({
			url : action,
			success : function(data) {
				newData = data.replace(/\s/g, '');
				if (newData == 'Y') {
					//$('#changePassword').modal('hide');
					window.location.href='../../../../index.php';
				} else {
					alert(data);
				}
			}
		});
	}
}
</script>

</body>
</html><?php }} ?>