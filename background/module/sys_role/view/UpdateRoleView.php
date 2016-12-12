<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_role/entity/Role.php';

// 根路径，模块名称，Action名称
import ( 'sys_role', 'updateRoleView' );

/**
 * 更新页面
 *
 * @author 宇帅
 *        
 */
class UpdateRoleView {
	public $smartyUtil;
	public $roleService;
	
	// 执行体
	public function execute() {
		// 查询对象详细信息
		$query = new Role ();
		$query->id = $_POST ['itemId'];
		$result = $this->roleService->queryRole ( $query );
		@session_start ();
		// 使用smarty模版显示结果
		$smarty = $this->smartyUtil->load ();
		$smarty->assign ( 'admin', $_SESSION ['admin'] );
		$smarty->assign ( 'role', $result );
		$smarty->display ( BASEURL . 'foreground/module/sys_role/role_edit.html' );
	}
}
?>
