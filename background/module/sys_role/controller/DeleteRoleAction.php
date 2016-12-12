<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';

// 根路径，模块名称，Action名称
import ( 'sys_role', 'deleteRoleAction' );

/**
 * 删除Action
 *
 * @author 宇帅
 *        
 */
class DeleteRoleAction {
	public $smartyUtil;
	public $roleService;
	
	// 执行体
	public function execute() {
		$ids = $_POST ['ids'];
		if ($this->roleService->deleteByIds ( $ids )) {
			echo 'Y';
		} else {
			echo '删除数据出错';
		}
	}
}
?>
