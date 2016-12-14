<?php /* Smarty version Smarty-3.1.14, created on 2016-12-14 03:38:25
         compiled from "../../../../foreground/module/sys_role/role.html" */ ?>
<?php /*%%SmartyHeaderCode:18966303065850b0a1861619-95627119%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f90018bd791aaa6798eb83193e5174fc9e5da54b' => 
    array (
      0 => '../../../../foreground/module/sys_role/role.html',
      1 => 1481531097,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18966303065850b0a1861619-95627119',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'query' => 0,
    'roles' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5850b0a1914f09_74318207',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5850b0a1914f09_74318207')) {function content_5850b0a1914f09_74318207($_smarty_tpl) {?><h2 class="sub-header">角色管理</h2>
<!-- 查询表单 -->
<form id="queryForm" class="form-horizontal" method="POST">
	<!-- 隐藏域值 -->
	<input type=hidden name="bean" value="Role" />
	<input type=hidden id="queryBegin" name="queryBegin" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['queryBegin'];?>
" />
	<input type=hidden id="queryCount" name="queryCount" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['queryCount'];?>
" />
	<input type=hidden id="pageCount" name="pageCount" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['pageCount'];?>
" />
	<div class="form-group">
		<div class="col-sm-3">
			<div class="input-group">
				<div class="input-group-addon">编号</div>
				<input type="text" name="code" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['code'];?>
" class="form-control" />
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
			<button id="queryBtn" type="button" class="btn btn-default" onclick="javascript:queryLoad('queryForm','sys_role','RoleView')">查询</button>
		</div>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">新增</button>
		<button type="button" class="btn btn-primary" onclick="javascript:showView('sys_role','AddRoleView')">新增页面</button>
		<button type="button" class="btn btn-danger" onclick="javascript:operateSelectedItem('sys_role','DeleteRoleAction')">删除</button>
	</div>
</form>

<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th><input onClick="javascript:selectAll(this,'sys_role')" type="checkbox"/></th>
			<th>角色编码</th>
			<th>角色名称</th>
			<th>创建者</th>
			<th>创建日期</th>
			<th>修改者</th>
			<th>修改日期</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['roles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
		<tr>
			<td scope="row"><input name="sysRoleItem" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" /></td>
			<td><a href="javascript:showDetailModal('roleDetailModal','sys_role','RoleDetailView','<?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
')"><?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
</a></td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->operator_create;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->datetime_create;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->operator_modify;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->datetime_modify;?>
</td>
			<td>
				<a href="javascript:showDetailView('sys_role','RoleDetailView',<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
)">详情页面</a> |
				<a href="javascript:updateView('sys_role','UpdateRoleView','<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
')">编辑页面</a> |
				<a href="javascript:updateModal('addModal','sys_role','UpdateRoleAction','<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
',checkNode)">编辑</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!-- 分页控件 -->
<?php echo $_smarty_tpl->getSubTemplate ("../../../foreground/module/sys_query/query.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



<!-- Modal -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="addModalLabel">新增角色</h4>
			</div>
			<div class="modal-body">
				<form id="addForm" class="form-horizontal" method="POST">
					<!-- Bean实体 -->
					<input type="hidden" name="bean" value="Role" />
					<input type="hidden" name="id" />
					<div class="form-group">
						<div class="col-sm-4">
							<div class="input-group">
								<div class="input-group-addon">角色编码</div>
								<input type="text" name="code" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="input-group">
								<div class="input-group-addon">角色名称</div>
								<input type="text" name="name" class="form-control" />
							</div>
						</div>
					</div>
					<div>
						<hr/>
						<h5>权限控制</h4>
						<input type="hidden" id="permissionIds" name="permissionIds" value="" />
						<ul id="treePermission" class="ztree"></ul>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button id="addBtn" type="button" class="btn btn-primary" onclick="javascript:formModuleActionModal('addForm','sys_role','AddRoleAction','addModal')">保存</button>
				<button id="updateBtn" style="display:none;" type="button" class="btn btn-primary" onclick="javascript:formModuleActionModal('addForm','sys_role','UpdateRoleAction','addModal')">更新</button>
			</div>
		</div>
	</div>
</div>
<!-- 详情弹出框 -->
<div id="roleDetailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="roleDetailModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="roleDetailModalLabel">角色详情</h4>
			</div>
			<div id="roleDetailModalContent" class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		treeObj = $.fn.zTree.init($('#treePermission'), setting, zNodes);
	});
</script>

<?php }} ?>