<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';

// 根路径，模块名称，Action名称
import ( "sys_module_manager", "systemWelcomeView" );
class SystemWelcomeView {
	// 需要注入的属性必须声明为public，且首字母为类名首字母小写
	public $smartyUtil;

	// 执行体
	public function execute() {
		@session_start ();
		$adminDetail = $_SESSION ['admin'];
		if (! isEmpty ( $adminDetail )) {
			$smarty = $this->smartyUtil->load ();
			$smarty->assign ( 'admin', $adminDetail );
			$smarty->display ( BASEURL . 'foreground/module/layout/layout_system.html' );
		} else {
			echo '非法登陆';
		}
	}
}
?>
