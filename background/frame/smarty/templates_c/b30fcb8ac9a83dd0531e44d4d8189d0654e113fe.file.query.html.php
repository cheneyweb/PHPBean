<?php /* Smarty version Smarty-3.1.14, created on 2016-12-14 03:38:24
         compiled from "/Users/cheney/Documents/github/PHPBean/foreground/module/sys_query/query.html" */ ?>
<?php /*%%SmartyHeaderCode:13846577325850b0a0c1bf09-69824951%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b30fcb8ac9a83dd0531e44d4d8189d0654e113fe' => 
    array (
      0 => '/Users/cheney/Documents/github/PHPBean/foreground/module/sys_query/query.html',
      1 => 1481531097,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13846577325850b0a0c1bf09-69824951',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'query' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5850b0a0cedb56_76438564',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5850b0a0cedb56_76438564')) {function content_5850b0a0cedb56_76438564($_smarty_tpl) {?>
<div class="col-md-offset-<?php if ($_smarty_tpl->tpl_vars['query']->value['pageCount']>5){?>3<?php }else{ ?>4<?php }?>">
	<nav>
		<ul class="pagination">
			<li><a href="javascript:previousPage()"> &laquo;</a></li>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['loop'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['name'] = 'loop';
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['query']->value['pageCount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total']);
?>
				<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']<5||$_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']>$_smarty_tpl->tpl_vars['query']->value['pageCount']-6){?>
					<li <?php if ($_smarty_tpl->tpl_vars['query']->value['queryBegin']/$_smarty_tpl->tpl_vars['query']->value['queryCount']==$_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']){?> class="active" <?php }?> ><a href="javascript:selectPage(<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['loop']['index'];?>
)"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']+1;?>
</a></li>
				<?php }elseif($_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']==5){?>
					<li><a href="#">...</a></li>
				<?php }?>
			<?php endfor; endif; ?>
			<li><a href="javascript:nextPage()">&raquo;</a></li>
			<?php if ($_smarty_tpl->tpl_vars['query']->value['pageCount']>10){?>
			<div class="col-xs-2">
				<div class="input-group">
			      <input id="pageIndex" type="text" class="form-control _inputNumber" placeholder="页码">
			      <span class="input-group-btn">
			        <button class="btn btn-primary" type="button" onclick="javascript:jumpPage()">跳转</button>
			      </span>
			    </div>
		    </div>
		    <?php }?>
		</ul>
	</nav>
</div>

<script type="text/javascript">
$(function () {
	//校验控件
	defaultInputValidator();
});
function jumpPage(){
	selectPage($('#pageIndex').val()-1);
}
</script><?php }} ?>