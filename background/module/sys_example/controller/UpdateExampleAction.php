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
 * @author 宇帅
 *        
 */
class Update_ExampleAction {
	public $struts;
	public $_exampleService;
	public $_exampleValidate;
	
	// 执行体
	public function execute() {
		// 如果接收到ID则查询实体详情,否则就更新实体
		if (isset ( $_POST ['itemId'] )) {
			$query = new _Example ();
			$query->id = $_POST ['itemId'];
			$result = $this->_exampleService->queryObj ( $query );
			echo json_encode ( $result, JSON_UNESCAPED_UNICODE );
		} else {
			$entity = $this->struts->genEntity ();
			$this->_exampleService->update ( $entity );
			echo 'Y';
		}
	}
}
?>
