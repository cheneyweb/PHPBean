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
		// 如果接收到ID则查询实体详情,否则就更新实体
		if (isset ( $_POST ['itemId'] )) {
			$query = new Role ();
			$query->id = $_POST ['itemId'];
			$result = $this->roleService->queryRole ( $query );
			echo json_encode ( $result, JSON_UNESCAPED_UNICODE );
		} else {
			$entity = $this->struts->genEntity ();
			$this->roleService->update ( $entity );
			echo 'Y';
		}
	}
}
?>
