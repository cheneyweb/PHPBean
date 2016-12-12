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
	public $smartyUtil;
	public $_exampleService;
	
	// 执行体
	public function execute() {
		// 查询对象详细信息
		$query = new _Example ();
		$query->id = $_POST ['itemId'];
		$result = $this->_exampleService->queryObj ( $query );
		@session_start ();
		// 使用smarty模版显示结果
		$smarty = $this->smartyUtil->load ();
		$smarty->assign ( 'admin', $_SESSION ['admin'] );
		$smarty->assign ( '_example', $result );
		$smarty->display ( BASEURL . 'foreground/module/__example/__noprefixexample_edit.html' );
	}
}
?>
