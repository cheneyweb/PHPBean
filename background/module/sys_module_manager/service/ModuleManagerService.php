<?php
include_once BASEURL . 'background/module/sys_module_manager/service/BaseService.php';
include_once BASEURL . 'background/module/sys_module_manager/entity/Module.php';
include_once BASEURL . 'background/frame/util/FileDir.php';

class ModuleManagerService extends BaseService{
	public $pDOUtil;
	public $moduleManagerDao;

	/**
	 * 分页查询(自定义SQL)
	 *
	 * @param unknown $entity
	 * @return unknown
	 */
	public function queryPage($entity) {
		$result = $this->moduleManagerDao->queryPage ( $entity );
		$query = $this->moduleManagerDao->queryPageCount ( $entity );

		$resp = array('result' => $result, 'query' => $query);
		return $resp;
	}

	// 新增
	public function save($entity) {
		$this->pDOUtil->insert ( $entity );
		// 结果判断
		if (empty ( $entity->id )) {
			return false;
		}
		return true;
	}

	/**
	 * 删除(通过ids批量删除)
	 *
	 * @param unknown $entity
	 * @return boolean
	 */
	public function deleteByIds($ids) {
		$path = '../../';
		try {
			// 循环删除记录
			foreach ($ids as $id){
				$entity = new Module();
				$entity->id = $id;
				// 删除模块文件
				$module = $this->pDOUtil->queryObj ( $entity );
				FileDir::recurseDelete ( $path . $module->code . '_' . $module->name . '/' );
				FileDir::recurseDelete ( $path . '../../foreground/module/' . $module->code . '_' . $module->name );
				// 删除模块记录
				$this->pDOUtil->delete ( $entity );
			}
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
?>