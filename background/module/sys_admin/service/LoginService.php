<?php
class LoginService
{
	public $pDOUtil;
	public $adminService;
	
	public function login($admin){
		$admin->password = sha1($admin->password);
		$password = $admin->password;
		$admin->password = null;
		$adminResult = $this->adminService->queryArr($admin);
		if($adminResult == null){
			return '帐号不存在';
		}else{
			$admin->password = $password;
			$adminResult = $this->adminService->queryArr($admin);
			if($adminResult == null){
				return '密码错误';
			}
		}
		return 'Y';
	}
}
?>