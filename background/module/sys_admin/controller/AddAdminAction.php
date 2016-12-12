<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';

// 根路径，模块名称，Action名称
import ( 'sys_admin', 'addAdminAction' );
class AddAdminAction {
	public $struts;
	public $adminService;
	
	// 执行体
	public function execute() {
		$entity = $this->struts->genEntity ();
		$entity->password = sha1 ( $entity->password );
		// 保存新系统用户
		$this->adminService->save ( $entity );
		echo 'Y';
	}
}
?>
