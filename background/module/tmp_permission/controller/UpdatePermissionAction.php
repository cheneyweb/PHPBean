<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/tmp_permission/entity/Permission.php';
// 根路径，模块名称，Action名称
import ( 'tmp_permission', 'updatePermissionAction' );

/**
 * 更新Action
 *
 * @author 宇帅
 *        
 */
class UpdatePermissionAction {
	public $struts;
	public $permissionService;
	public $permissionValidate;
	
	// 执行体
	public function execute() {
		// 如果接收到ID则查询实体详情,否则就更新实体
		if (isset ( $_POST ['itemId'] )) {
			$query = new Permission ();
			$query->id = $_POST ['itemId'];
			$result = $this->permissionService->queryObj ( $query );
			echo json_encode ( $result, JSON_UNESCAPED_UNICODE );
		} else {
			$entity = $this->struts->genEntity ();
			$this->permissionService->update ( $entity );
			echo 'Y';
		}
	}
}
?>
