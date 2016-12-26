<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_role/entity/Role.php';
// 根路径，模块名称，Action名称
import ( 'sys_role', 'updateRoleAction' );

/**
 * 更新Action
 *
 * @author 宇帅
 *
 */
class UpdateRoleAction {
	public $struts;
	public $roleService;
	public $roleValidate;

	// 执行体
	public function execute() {
		// 入参对象
		$entity = $this->struts->genEntity ();
		// 入参校验
		$checkResult = $this->roleValidate->checkEntity ( $entity );
		if ($checkResult['respMsg'] != 'Y') {
			echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
			return;
		}
		// 更新
		if(!$this->roleService->update ( $entity )){
			$checkResult['respMsg'] = '更新数据错误';
		}
		echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
	}
}
?>
