<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';

// 根路径，模块名称，Action名称
import ( 'sys_role', 'addRoleAction' );

/**
 * 新增Action
 *
 * @author 宇帅
 *        
 */
class AddRoleAction {
	public $struts;
	public $roleService;
	public $roleValidate;
	
	// 执行体
	public function execute() {
		$entity = $this->struts->genEntity ();
		// 保存
		if ($this->roleService->insert ( $entity )) {
			echo 'Y';
		} else {
			echo '保存数据错误';
		}
	}
}
?>
