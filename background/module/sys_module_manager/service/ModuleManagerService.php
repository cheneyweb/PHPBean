<?php
include_once BASEURL . 'background/module/sys_module_manager/entity/Module.php';
include_once BASEURL . 'background/frame/util/fileDir.php';

class ModuleManagerService {
	public $pDOUtil;
	public $moduleManagerDao;
	
	// 分页查询
	public function queryPage($entity) {
		$result = $this->moduleManagerDao->queryPage ( $entity );
		return $result;
	}
	public function queryPageCount($entity) {
		$result = $this->moduleManagerDao->queryPageCount ( $entity );
		return $result;
	}
	
	// 查询
	public function queryArr($entity) {
		$result = $this->pDOUtil->queryArr ( $entity );
		return $result;
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
				recurse_delete ( $path . $module['code'] . '_' . $module['name'] . '/' );
				recurse_delete ( $path . '../../foreground/module/' . $module['code'] . '_' . $module['name'] );
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