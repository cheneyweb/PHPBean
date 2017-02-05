<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';

// 根路径，模块名称，Action名称
import ( 'sys_role', 'deleteRoleAction' );

/**
 * 删除Action
 *
 * @author CheneyXu
 *
 */
class DeleteRoleAction {
	public $roleValidate;
	public $roleService;

	// 执行体
	public function execute() {
		// 入参ids
		$ids = $_POST ['ids'];
		// 入参校验
		$checkResult = $this->roleValidate->checkEmpty ( $ids );
		if ($checkResult['respMsg'] != 'Y') {
			echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
			return;
		}
		// 删除
		if (!$this->roleService->deleteByIds ( $ids )) {
			$checkResult['respMsg'] = '删除数据错误';
		}
		echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
	}
}
?>
