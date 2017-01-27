<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/__example/entity/_Example.php';
// 根路径，模块名称，Action名称
import ( '__example', 'update_ExampleAction' );

/**
 * 更新Action
 *
 * @author CheneyXu
 *
 */
class Update_ExampleAction {
	public $struts;
	public $_exampleService;
	public $_exampleValidate;

	// 执行体
	public function execute() {
		// 入参对象
		$entity = $this->struts->genEntity ();
		// 入参校验
		$checkResult = $this->_exampleValidate->checkEntity ( $entity );
		if ($checkResult['respMsg'] != 'Y') {
			echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
			return;
		}
		// 更新
		if(!$this->_exampleService->update ( $entity )){
			$checkResult['respMsg'] = '更新数据错误';
		}
		echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
	}
}
?>
