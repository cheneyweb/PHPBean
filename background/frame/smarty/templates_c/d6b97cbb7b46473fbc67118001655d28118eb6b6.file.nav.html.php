<?php /* Smarty version Smarty-3.1.14, created on 2017-01-11 09:17:43
         compiled from "/Users/cheney/Documents/github/PHPBean/foreground/module/layout/common/nav.html" */ ?>
<?php /*%%SmartyHeaderCode:89725705875ea27a90459-40255936%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6b97cbb7b46473fbc67118001655d28118eb6b6' => 
    array (
      0 => '/Users/cheney/Documents/github/PHPBean/foreground/module/layout/common/nav.html',
      1 => 1484106404,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89725705875ea27a90459-40255936',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5875ea27ad9b13_46501524',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5875ea27ad9b13_46501524')) {function content_5875ea27ad9b13_46501524($_smarty_tpl) {?><nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
				<li><a href="javascript:alert('PHPBean 管理系统\n\n版本：v3.0');">About</a></li>
				<!-- <li><a href="javascript:alert('开发方：CheneyXu(许宇帅)\n\nEmail：457299596@qq.com');">Contact</a></li> -->
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>欢迎您：<?php echo (($tmp = @$_smarty_tpl->tpl_vars['admin']->value['account'])===null||$tmp==='' ? '' : $tmp);?>
(<?php echo (($tmp = @$_smarty_tpl->tpl_vars['admin']->value['roleNames'])===null||$tmp==='' ? '' : $tmp);?>
)</a></li>
				<!-- <li><a href="#">待办</a></li> -->
				<li><a href="../../../../index.html">登出</a></li>
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
</script><?php }} ?>