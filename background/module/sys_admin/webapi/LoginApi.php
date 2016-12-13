<?php
// header ( 'Content-Type:application/json;charset=utf-8' );
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_admin/entity/Admin.php';

// 根路径，模块名称，Action名称
import ( 'sys_admin', 'loginApi' );

/**
 * 加载问题列表
 *
 * @author 宇帅
 *
 */
class LoginApi {
	public $struts;
	public $adminService;
	// public $webServiceInOut;
	/**
	 * 执行体
	 */
	public function execute() {
		// Log::info($_POST ['bean']);
		// $entity = $this->struts->genEntity ();
		// Log::info($entity->account);
		// Log::info($entity->password);
		// Log::info($entity->captcha);

		// 获取入参对象
		// $inObj = $this->webServiceInOut->getInObj();
		// if(is_object($inObj)){
		// }else{
		// 	echo $inObj;
		// }
	}
}