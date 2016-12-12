<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_module_manager/entity/Module.php';

// 根路径，模块名称，Action名称
import ( "sys_module_manager", "moduleManagerView" );
/**
 *
 * @author 宇帅
 *         模块管理界面
 */
class ModuleManagerView {
	public $struts;
	public $smartyUtil;
	public $moduleManagerService;
	
	/**
	 * 执行体
	 */
	public function execute() {
		// 获得查询条件
		$query = $this->struts->genEntity ();
		if (empty ( $query )) {
			$query = new Module ();
		}
		// 结果列表
		$result = $this->moduleManagerService->queryPage ( $query );
		// 分页结果
		$query = $this->moduleManagerService->queryPageCount ( $query );
		
		// 使用smarty模版显示结果
		$smarty = $this->smartyUtil->load ();
		$smarty->assign ( 'modules', $result );
		$smarty->assign ( 'query', $query );

		$smarty->display ( BASEURL . 'foreground/module/sys_module_manager/module_manager.html' );
	}
}
?>
