<?php /* Smarty version Smarty-3.1.14, created on 2016-12-14 03:38:24
         compiled from "../../../../foreground/module/sys_admin/admin.html" */ ?>
<?php /*%%SmartyHeaderCode:2916332155850b0a0b16594-44641264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '118b3ef08ad0636c45966a8250e80c8e429a473c' => 
    array (
      0 => '../../../../foreground/module/sys_admin/admin.html',
      1 => 1481531097,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2916332155850b0a0b16594-44641264',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'query' => 0,
    'admins' => 0,
    'item' => 0,
    'roles' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5850b0a0c15ec1_16537326',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5850b0a0c15ec1_16537326')) {function content_5850b0a0c15ec1_16537326($_smarty_tpl) {?><h2 class="sub-header">帐号管理</h2>
<!-- 操作成功提示 -->
<div class="alert alert-success fade in" style="display:none">
	<a class="close" data-dismiss="alert">×</a> <strong>操作成功</strong>
</div>
<!-- 查询表单 -->
<form id="queryForm" class="form-horizontal" method="POST">
	<!-- 隐藏域值 -->
	<input type=hidden name="bean" value="Admin" />
	<input type=hidden id="queryBegin" name="queryBegin" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['queryBegin'];?>
" />
	<input type=hidden id="queryCount" name="queryCount" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['queryCount'];?>
" />
	<input type=hidden id="pageCount" name="pageCount" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['pageCount'];?>
" />
	<div class="form-group">
		<div class="col-sm-3">
			<div class="input-group">
				<div class="input-group-addon">帐号</div>
				<input type="text" name="account" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['account'];?>
" class="form-control"/>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="input-group">
				<div class="input-group-addon">创建日期</div>
				<input type="text" name="datetimeCreate" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['datetimeCreate'];?>
" class="form-control datetimepicker" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-1">
			<!-- 如果使用查询分页控件，查询按钮的id需要设置成queryBtn，并且使用queryLoad(moduleName,viewName)方法 -->
			<button id="queryBtn" type=button class="btn btn-default" onclick="javascript:queryLoad('queryForm','sys_admin','AdminView')">查询</button>
		</div>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">新增</button>
		<button type="button" class="btn btn-danger" onclick="javascript:operateSelectedItem('sys_admin','DeleteAdminAction')">删除</button>
	</div>
</form>
<!-- 展示列表 -->
<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th><input onClick="javascript:selectAll(this,'sys_admin')" type="checkbox"/></th>
			<th>帐号</th>
			<th>创建日期</th>
			<th>修改日期</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['admins']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
		<tr>
			<td scope="row"><input name="sysAdminItem" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" /></td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->account;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->datetime_create;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->datetime_modify;?>
</td>
			<td><!-- <a href="#">详情</a> | --> <a href="javascript:updateModal('addModal','sys_admin','UpdateAdminAction','<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
')">编辑</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!-- 分页控件 -->
<?php echo $_smarty_tpl->getSubTemplate ("../../../foreground/module/sys_query/query.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>




<!-- 新增帐号弹出窗口 -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="addModalLabel">新增帐号</h4>
			</div>
			<div class="modal-body">
				<!-- 新增表单 -->
				<form id="addForm" class="form-horizontal" method="POST">
					<!-- Admin实体 -->
					<input type=hidden name="bean" value="Admin" />
					<input type="hidden" name="id" />
					<div class="form-group">
						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">帐号</div>
								<input name="account" type="text" class="form-control" maxlength="10" placeholder="10位字符内"/>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">密码</div>
								<input name="password" type="password" class="form-control" maxlength="16" placeholder="6至16位字符内"/>
							</div>
						</div>
						<div class="col-sm-3">
							<select name="roleIds" class="form-control">
								<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['roles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</option>
							  	<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
					<!-- 
					
					 -->
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button id="addBtn" type="button" class="btn btn-primary" onclick="javascript:formModuleActionModal('addForm','sys_admin','AddAdminAction','addModal')">保存</button>
				<button id="updateBtn" style="display:none;" type="button" class="btn btn-primary" onclick="javascript:formModuleActionModal('addForm','sys_admin','UpdateAdminAction','addModal')">更新</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
/*
	function updateModal(itemId,moduleName,actionName){
		// 更换提交按钮
		$('#updateBtn').show();
		$('#addBtn').hide();
		// 修改主题文字
		$('#addModalLabel').html($('#addModalLabel').html().replace('新增','编辑'));
		// 获取当前值
		var action = '../../../../background/module/' + moduleName + '/controller/' + actionName + '.php';
		$.ajax({
			url : action,
			type : 'POST',
			data : {itemId:itemId},
			success : function(response) {
				var dataObj = eval("("+response+")");
				var roleIds;
				for (key in dataObj){
					$("#addForm input[name='" + formatJavaStyle(key) + "']").val(dataObj[key]);
					// 获取关联角色
					if(key == 'role_ids'){
						roleIds = dataObj[key].split(',');
					}
				}
				// 勾选关联角色
				$('#addForm input[name="roles[]"]').each(function(){
					for(var i=0;i<roleIds.length;i++){
						if(roleIds[i] == $(this).val()){
							$(this).prop('checked',true);
						}
					} 
				});
			}
		});
		// 显示更新弹出框
		$('#addModal').modal();
	}
*/
</script>

<?php }} ?>