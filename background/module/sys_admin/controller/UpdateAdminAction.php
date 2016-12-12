<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_admin/entity/Admin.php';
// 根路径，模块名称，Action名称
import ( 'sys_admin', 'updateAdminAction' );
class UpdateAdminAction {
	public $struts;
	public $adminService;
	// 执行体
	public function execute() {
		// 如果接收到ID则查询实体详情,否则就更新实体
		if (isset ( $_POST ['itemId'] )) {
			$query = new Admin ();
			$query->id = $_POST ['itemId'];
			$result = $this->adminService->queryAdmin ( $query );
			$result ['password'] = '123456';
			echo json_encode ( $result, JSON_UNESCAPED_UNICODE );
		} else {
			$entity = $this->struts->genEntity ();
			$entity->password = sha1 ( $entity->password );
			$this->adminService->update ( $entity );
			echo 'Y';
		}
	}
}
?>
