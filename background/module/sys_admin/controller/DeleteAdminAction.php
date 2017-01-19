<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_admin/entity/Admin.php';
// 根路径，模块名称，Action名称
import ( 'sys_admin', 'deleteAdminAction' );
class DeleteAdminAction {
	public $smartyUtil;
	public $adminValidate;
	public $adminService;

	// 执行体
	public function execute() {
		// 入参ids
		$ids = $_POST ['ids'];
		// 入参校验
		$checkResult = $this->adminValidate->checkEmpty ( $ids );
		if ($checkResult['respMsg'] != 'Y') {
			echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
			return;
		}
		// 循环删除记录
		foreach ( $ids as $id ) {
			$entity = new Admin ();
			$entity->id = $id;
			$this->adminService->delete ( $entity );
		}
		echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
	}
}
?>
