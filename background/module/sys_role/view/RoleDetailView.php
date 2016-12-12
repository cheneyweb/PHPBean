<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_role/entity/Role.php';

// 根路径，模块名称，Action名称
import ( 'sys_role', 'roleDetailView' );

/**
 * 详情页面
 *
 * @author 宇帅
 *        
 */
class RoleDetailView {
	public $smartyUtil;
	public $roleService;
	
	/**
	 * 执行体
	 */
	public function execute() {
		$query = new Role ();
		if (isset ( $_POST ['id'] )) {
			$query->id = $_POST ['id'];
		} else {
			$query->code = $_POST ['code'];
		}
		$result = $this->roleService->queryArr ( $query ) [0];
		
		// 使用smarty模版显示结果
		$smarty = $this->smartyUtil->load ();
		$smarty->assign ( 'item', $result );
		$smarty->display ( BASEURL . 'foreground/module/sys_role/role_detail.html' );
	}
}
?>
