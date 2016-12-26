<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';

// 根路径，模块名称，Action名称
import ( 'sys_admin', 'addAdminAction' );
class AddAdminAction {
	public $struts;
	public $adminValidate;
	public $adminService;

	// 执行体
	public function execute() {
		// 入参对象
		$entity = $this->struts->genEntity ();
		$entity->password = sha1 ( $entity->password );
		// 入参校验
		$checkResult = $this->adminValidate->checkEntity ( $entity );
		if ($checkResult['respMsg'] != 'Y') {
			echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
			return;
		}
		// 保存
		if (!$this->adminService->save ( $entity )) {
			$checkResult['respMsg'] = '保存数据错误';
		}
		echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
	}
}
?>
