<?php /* Smarty version Smarty-3.1.14, created on 2016-12-14 03:38:35
         compiled from "../../../../foreground/module/sys_module_manager/module_manager.html" */ ?>
<?php /*%%SmartyHeaderCode:9772326165850b0ab609aa2-29682042%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70229a6afbff8bd5b966906934d94ab23d50eb1c' => 
    array (
      0 => '../../../../foreground/module/sys_module_manager/module_manager.html',
      1 => 1481531097,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9772326165850b0ab609aa2-29682042',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'query' => 0,
    'modules' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5850b0ab6b45d5_00103902',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5850b0ab6b45d5_00103902')) {function content_5850b0ab6b45d5_00103902($_smarty_tpl) {?><h2 class="sub-header">模块管理</h2>
<!-- 查询表单 -->
<form id="queryForm" class="form-horizontal" method="POST">
	<!-- 隐藏域值 -->
	<input type=hidden name="bean" value="Module" />
	<input type=hidden id="queryBegin" name="queryBegin" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['queryBegin'];?>
" />
	<input type=hidden id="queryCount" name="queryCount" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['queryCount'];?>
" />
	<input type=hidden id="pageCount" name="pageCount" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['pageCount'];?>
" />
	<div class="form-group">
		<div class="col-sm-3">
			<div class="input-group">
				<div class="input-group-addon">模块前缀</div>
				<input type="text" name="code" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['code'];?>
" class="form-control">
			</div>
		</div>
		<div class="col-sm-3">
			<div class="input-group">
				<div class="input-group-addon">模块名</div>
				<input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['query']->value['name'];?>
" class="form-control">
			</div>
		</div>
		<div class="col-sm-3">
			<div class="input-group">
				<div class="input-group-addon">创建日期</div>
				<input type="text" class="form-control">
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-1">
			<button id="queryBtn" type=button class="btn btn-default" onclick="javascript:queryLoad('queryForm','sys_module_manager','ModuleManagerView')">查询</button>
		</div>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">新增</button>
		<button type="button" class="btn btn-danger" onclick="javascript:operateSelectedItem('sys_module_manager','DeleteModuleAction')">删除</button>
	</div>
</form>
<!-- 展示列表 -->
<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th><input onClick="javascript:selectAll(this,'sysModuleManager')" type="checkbox"/></th>
			<th>模块前缀</th>
			<th>模块名</th>
			<th>创建日期</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
		<tr>
			<th scope="row"><input name="sysModuleManagerItem" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" /></th>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value->datetime_create;?>
</td>
			<td><a href="#">详情</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!-- 分页控件 -->
<?php echo $_smarty_tpl->getSubTemplate ("../../../foreground/module/sys_query/query.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<!-- 新增帐号弹出窗口 -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog"
	aria-labelledby="#addModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="#addModalLabel">新增模块</h4>
			</div>
			<div class="modal-body">
				<!-- 新增表单 -->
				<form id="addForm" class="form-horizontal" method="POST">
					<!-- Admin实体 -->
					<input type=hidden name="bean" value="Module" />
					<div class="form-group">
						<div class="col-sm-4">
							<div class="input-group">
								<div class="input-group-addon">模块前缀</div>
								<input name="code" type="text" placeholder="全小写" class="form-control">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="input-group">
								<div class="input-group-addon">模块名</div>
								<input name="name" type="text" placeholder="全小写,下划线间隔" class="form-control">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" onclick="javascript:formModuleActionModal('addForm','sys_module_manager','AddModuleAction','addModal')">保存</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
</script>

<?php }} ?>