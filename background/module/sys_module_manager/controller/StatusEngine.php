<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
include_once BASEURL . 'background/frame/util/package.php';
include_once BASEURL . 'background/frame/dao/pdo/PDOUtil.php';
/**
 * 状态引擎
 *
 * @author 宇帅
 *
 */
class StatusEngine {
	/**
	 * 加载并执行插件
	 *
	 * @param unknown $moduleName
	 * @param unknown $pluginName
	 */
	public static function importPlugin($moduleName, $pluginName) {
		// 载入Spring工厂文件
		include_once BASEURL . 'background/frame/spring/BeanFactory.php';

		// 载入plugin.xml配置文件
		BeanFactory::init ( BASEURL, "background/module/" . $moduleName . "/config/plugin.xml" );

		// IOC依赖注入生成Action的Bean
		$plugin = BeanFactory::getNewBeanByName ( $pluginName );
		return $plugin;
	}

	/**
	 * 校验状态
	 *
	 * @param unknown $status
	 */
	public static function checkStatus($entity) {
		$flag = 'N';
		// 载入状态引擎的XML文件
		$doc = new DOMDocument ();
		$doc->load ( $_SERVER['DOCUMENT_ROOT'].'/' . 'background/module/' . 'sys_module_manager' . '/config/' . 'status' . '.xml' );
		$statusMap = $doc->getElementsByTagName ( 'statusMap' );
		$modules = $statusMap->item ( 0 )->getElementsByTagName ( 'module' );
		// 获取实体名，状态名
		$entityName = get_class ( $entity );
		$statusValue = $entity->status;
		// 遍历匹配实体
		foreach ( $modules as $module ) {
			if ($module->getAttribute ( 'entity' ) == $entityName) {
				$statusArr = $module->getElementsByTagName ( 'status' );
				// 遍历匹配状态
				foreach ( $statusArr as $status ) {
					if ($status->getAttribute ( 'name' ) == $statusValue) {
						// 得到前置状态
						$preStatusStr = $status->getAttribute ( 'pre' );
						$preStatusArr = explode ( '|', $preStatusStr );
						// 查询当前状态
						$entity->status = null;
						$pDOUtil = new PDOUtil ();
						$result = $pDOUtil->queryObj ( $entity );
						if ($result != null) {
							foreach ( $preStatusArr as $preStatus ) {
								// 前置状态中存在当前状态，则状态校验通过
								if ($result ['status'] == $preStatus) {
									$flag = 'Y';
									break;
								}
							}
						}
						break;
					}
				}
				break;
			}
		}
		if ($flag == 'Y') {
			return $flag;
		} else {
			return '当前状态不可执行该操作';
		}
	}

	/**
	 * 变更状态
	 *
	 * @param unknown $inparam
	 *        	操作入参
	 * @param obj $entity
	 *        	状态对象
	 */
	public static function changeStatus($inparam, $entity) {
		// 执行操作序列
		// 1，载入状态引擎的XML文件
		$doc = new DOMDocument ();
		$doc->load ( $_SERVER['DOCUMENT_ROOT'].'/' . 'background/module/' . 'sys_module_manager' . '/config/' . 'status' . '.xml' );
		$statusMap = $doc->getElementsByTagName ( 'statusMap' );
		$modules = $statusMap->item ( 0 )->getElementsByTagName ( 'module' );
		// 获取实体和状态名
		$entityName = get_class ( $entity );
		$statusValue = $entity->status;
		$moduleName = ''; // 模块名称
		$resp = null; // 上操作序列返回值
		// 2，遍历匹配实体
		foreach ( $modules as $module ) {
			if ($module->getAttribute ( 'entity' ) == $entityName) {
				$moduleName = $module->getAttribute ( 'name' );
				$statusArr = $module->getElementsByTagName ( 'status' );
				// 3，遍历匹配状态
				foreach ( $statusArr as $status ) {
					if ($status->getAttribute ( 'name' ) == $statusValue) {
						$operateArr = $status->getElementsByTagName ( 'operate' );
						// 4，遍历操作序列并执行
						foreach ( $operateArr as $operate ) {
							$plugin = self::importPlugin ( $moduleName, lcfirst ( $operate->nodeValue ) );
							if ($resp == null) {
								$resp = $inparam;
							}
							$resp = $plugin->execute ( $resp );
							if($resp == null){
								Log::error(__METHOD__."：".$moduleName."/".$entityName.$statusValue."状态变更失败");
								break;
							}
						}
						break;
					}
				}
				break;
			}
		}
		// 变更对象状态
		if($entity->id != null){
			$pDOUtil = new PDOUtil ();
			$pDOUtil->update ( $entity, null );
		}
		return 'Y';
	}
}
?>
