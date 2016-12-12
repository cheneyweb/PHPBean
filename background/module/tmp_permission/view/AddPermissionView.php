<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';

// 根路径，模块名称，Action名称
import ( 'tmp_permission', 'addPermissionView' );

/**
 * 新增页面
 *
 * @author 宇帅
 *        
 */
class AddPermissionView {
	public $smartyUtil;
	
	// 执行体
	public function execute() {
		@session_start ();
		// 使用smarty模版显示结果
		$smarty = $this->smartyUtil->load ();
		$smarty->assign ( 'admin', $_SESSION ['admin'] );
		$smarty->display ( BASEURL . 'foreground/module/tmp_permission/permission_add.html' );
	}
}
?>
