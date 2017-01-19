<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_admin/entity/Admin.php';
include_once BASEURL . 'background/module/sys_role/entity/Role.php';

// 根路径，模块名称，Action名称
import ( 'sys_admin', 'adminView' );
/**
 *
 * @author 宇帅
 *         账号管理界面
 */
class AdminView {
	public $struts;
	public $adminValidate;
	public $roleService;
	public $adminService;

	/**
	 * 执行体
	 */
	public function execute() {
		// 1、查询条件
		$query = $this->struts->genEntity ();
		// 2、入参校验
		$checkResult = $this->adminValidate->checkQuery ( $query );
		if ($checkResult['respMsg'] != 'Y') {
			echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
			return;
		}
		// 3、业务查询
		$resp = $this->adminService->queryPage ( $query );

		// 查询所有的角色
		$roleQuery = new Role ();
		$rolesResp = $this->roleService->queryArr ( $roleQuery );
		$roles = $rolesResp['result'];
		// 4、数据返回
		$resp['roles'] = $roles;
		$resp = json_encode ( $resp, JSON_UNESCAPED_UNICODE );
		echo $resp;
	}
}
?>
