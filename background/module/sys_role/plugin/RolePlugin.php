<?php
/**
 * 插件
 * @author 宇帅
 *
 */
class RolePlugin {
	public $pDOUtil;
	// 执行体
	public function execute($inparam) {
		try {
			Log::info(__METHOD__.'：执行');
			return $inparam;
		} catch (Exception $e) {
			Log::error(__METHOD__.'：'.$e);
		}
	}
}
?>
