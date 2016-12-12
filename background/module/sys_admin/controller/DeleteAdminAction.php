<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_admin/entity/Admin.php';
// 根路径，模块名称，Action名称
import ( 'sys_admin', 'deleteAdminAction' );
class DeleteAdminAction {
	public $smartyUtil;
	public $adminService;
	
	// 执行体
	public function execute() {
		$ids = $_POST ['ids'];
		// 循环删除记录
		foreach ( $ids as $id ) {
			$entity = new Admin ();
			$entity->id = $id;
			$this->adminService->delete ( $entity );
		}
		echo 'Y';
	}
}
?>
