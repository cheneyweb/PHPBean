<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/module/sys_admin/entity/Admin.php';

// 根路径，模块名称，Action名称
import ( 'sys_admin', 'loginAction' );
class LoginAction {
	// 需要注入的属性必须声明为public，且首字母为类名首字母小写
	public $struts;
	public $loginService;
	public $loginValidate;
	public $smartyUtil;
	public $adminService;

	// 执行体
	public function execute() {
		// 使用struts，连接表单与实体，从而生成实体
		$entity = $this->struts->genEntity ();
		if (empty ( $entity )) {
			$entity = new Admin ();
		}
		@session_start ();
		// 重试次数校验
		if (! isset ( $_SESSION ['retry'] )) {
			$_SESSION ['retry'] = 0;
			$_SESSION ['firstLoginTime'] = date ( 'y-m-d h:i:s', time () );
		} else {
			// 重试次数增加
			$_SESSION ['retry'] += 1;
			// 大于10次则限制访问
			if ($_SESSION ['retry'] > 10) {
				echo '请30秒后再尝试';
				// 计算时间间隔
				$second = floor ( (strtotime ( date ( 'y-m-d h:i:s', time () ) ) - strtotime ( $_SESSION ['firstLoginTime'] )) % 86400 % 60 );
				// 间隔时间大于30秒，恢复
				if ($second > 30) {
					$_SESSION ['retry'] = 0;
					$_SESSION ['firstLoginTime'] = date ( 'y-m-d h:i:s', time () );
				}
				return;
			}
		}
		// 验证码校验
		/*
		if (strtolower ( $entity->captcha ) != strtolower ( $_SESSION ['captcha'] )) {
			echo '验证码错误';
			return;
		}*/

		$entity->captcha = null;
		// 用户登录
		$result = $this->loginService->login ( $entity );
		// 如果登录成功则显示
		if ($result == 'Y') {
			// 查询用户详细信息
			$resp = $this->adminService->queryAdmin ( $entity );
			$adminDetail = $resp['result'];
			// 存储用户详细信息到session中
			$_SESSION ['admin'] = (array)$adminDetail;
			// 使用smarty模版显示结果
			echo 'Y';
		} else {
			$smarty = $this->smartyUtil->load ();
			echo $result;
		}
	}
}
?>
