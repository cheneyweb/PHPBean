<?php
include_once BASEURL . 'background/frame/security/EnumPermission.php';
function hasPermission($args) {
	// 获取所有权限枚举Map
	$permissionMap = EnumPermission::getMap();
	if (! isset ( $_SESSION ['admin'] )) {
		@session_start ();
	}
	// 当前用户拥有的权限
	$rolePermissionIds = $_SESSION ['admin'] ['role_permission_ids'];
	// 需要的权限
	$permissionNeeds = $permissionMap[$args ['code']];
	// 拥有的权限中包含了需要的权限，则允许访问
	if (stripos ( $rolePermissionIds, $permissionNeeds ) === false) {
		return false;
	} else {
		return true;
	}
}
class SmartyUtil {
	public function load() {
		// 引用类文件
		require_once BASEURL . 'background/frame/smarty/class/Smarty.class.php';
		$smarty = new Smarty ();
		// 设置各个目录的路径，这里是安装的重点
		$smarty->template_dir = BASEURL . "background/frame/smarty/templates";
		$smarty->compile_dir = BASEURL . "background/frame/smarty/templates_c";
		$smarty->config_dir = BASEURL . "background/frame/smarty/config";
		$smarty->cache_dir = BASEURL . "background/frame/smarty/cache";
		$smarty->caching = false;
		$smarty->cache_lifetime = 3600;
		$smarty->left_delimiter = "<{";
		$smarty->right_delimiter = "}>";
		$smarty->registerPlugin ( 'function', 'hasPermission', 'hasPermission' );
		return $smarty;
	}
}
?>