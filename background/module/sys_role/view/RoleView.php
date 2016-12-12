<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_role/entity/Role.php';

// 根路径，模块名称，Action名称
import ( 'sys_role', 'roleView' );

/**
 * 列表页面
 *
 * @author 宇帅
 *        
 */
class RoleView {
	public $struts;
	public $smartyUtil;
	public $roleService;
	
	/**
	 * 执行体
	 */
	public function execute() {
		// 获得查询条件
		$query = $this->struts->genEntity ();
		if (empty ( $query )) {
			$query = new Role ();
		}
		// 结果列表
		$result = $this->roleService->queryPage ( $query );
		// 分页结果
		$query = $this->roleService->queryPageCount ( $query );
		
		// 使用smarty模版显示结果
		$smarty = $this->smartyUtil->load ();
		$smarty->assign ( 'roles', $result );
		$smarty->assign ( 'query', $query );
		$smarty->display ( BASEURL . 'foreground/module/sys_role/role.html' );
	}
}
?>
