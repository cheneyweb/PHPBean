<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';

// 根路径，模块名称，Action名称
import ( 'tmp_permission', 'addPermissionAction' );

/**
 * 新增Action
 *
 * @author 宇帅
 *        
 */
class AddPermissionAction {
	public $struts;
	public $permissionService;
	public $permissionValidate;
	
	// 执行体
	public function execute() {
		$entity = $this->struts->genEntity ();
		// 保存
		if ($this->permissionService->insert ( $entity )) {
			echo 'Y';
		} else {
			echo '保存数据错误';
		}
	}
}
?>
