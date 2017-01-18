<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/tmp_permission/entity/Permission.php';

// 根路径，模块名称，Action名称
import ( 'tmp_permission', 'updatePermissionView' );

/**
 * 更新页面
 *
 * @author 宇帅
 *
 */
class UpdatePermissionView {
	public $struts;
	public $permissionService;
	public $permissionValidate;

	/**
	 * 执行体
	 */
	public function execute() {
		// 1、查询条件
		$query = $this->struts->genEntity ();
		// 2、入参校验
		$checkResult = $this->permissionValidate->checkQuery ( $query );
		if ($checkResult['respMsg'] != 'Y') {
			echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
			return;
		}
		// 3、业务查询
		$resp =  $this->permissionService->queryObj ( $query );
		// 4、数据返回
		$resp->respMsg = 'Y';
		$resp = json_encode ( $resp, JSON_UNESCAPED_UNICODE );
		echo $resp;
	}
}
?>
