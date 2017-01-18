<?php /* Smarty version Smarty-3.1.14, created on 2017-01-11 09:17:43
         compiled from "../../../../foreground/module/layout/layout_module.html" */ ?>
<?php /*%%SmartyHeaderCode:9794585945875ea27a2bdb8-56174504%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d5b392120b7d2b6066fda228c2c824ece86270f' => 
    array (
      0 => '../../../../foreground/module/layout/layout_module.html',
      1 => 1484106901,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9794585945875ea27a2bdb8-56174504',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5875ea27a84d90_73077714',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5875ea27a84d90_73077714')) {function content_5875ea27a84d90_73077714($_smarty_tpl) {?><!DOCTYPE html>
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

<?php echo $_smarty_tpl->getSubTemplate ("./common/left_module.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>