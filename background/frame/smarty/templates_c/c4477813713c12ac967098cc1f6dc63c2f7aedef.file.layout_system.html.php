<?php /* Smarty version Smarty-3.1.14, created on 2017-01-11 09:17:45
         compiled from "../../../../foreground/module/layout/layout_system.html" */ ?>
<?php /*%%SmartyHeaderCode:7575195065875ea29781900-52009499%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4477813713c12ac967098cc1f6dc63c2f7aedef' => 
    array (
      0 => '../../../../foreground/module/layout/layout_system.html',
      1 => 1484106874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7575195065875ea29781900-52009499',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5875ea297e1991_56986592',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5875ea297e1991_56986592')) {function content_5875ea297e1991_56986592($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>PHPBean 管理系统</title>
	<?php echo $_smarty_tpl->getSubTemplate ("./common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
<?php echo $_smarty_tpl->getSubTemplate ("./common/nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("./common/left_system.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>