<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/__example/entity/_Example.php';

// 根路径，模块名称，Action名称
import ( '__example', 'update_ExampleView' );

/**
 * 更新页面
 *
 * @author 宇帅
 *
 */
class Update_ExampleView {
	public $struts;
	public $_exampleService;
	public $_exampleValidate;

	/**
	 * 执行体
	 */
	public function execute() {
		// 1、查询条件
		$query = $this->struts->genEntity ();
		// 2、入参校验
		$checkResult = $this->_exampleValidate->checkQuery ( $query );
		if ($checkResult['respMsg'] != 'Y') {
			echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
			return;
		}
		// 3、业务查询
		$resp =  $this->_exampleService->queryObj ( $query );
		// 4、数据返回
		$resp->respMsg = 'Y';
		$resp = json_encode ( $resp, JSON_UNESCAPED_UNICODE );
		echo $resp;
	}
}
?>
