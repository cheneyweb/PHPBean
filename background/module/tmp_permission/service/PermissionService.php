<?php
include_once BASEURL . 'background/module/sys_module_manager/service/BaseService.php';
include_once BASEURL . 'background/module/tmp_permission/entity/Permission.php';
/**
 * Service业务封装
 * @author 宇帅
 *
 */
class PermissionService extends BaseService{
	public $pDOUtil;
	public $permissionDao;

	/**
	 * 分页查询(自定义SQL)
	 *
	 * @param unknown $entity
	 * @return unknown
	 */
	public function queryPage($entity) {
		$result = $this->permissionDao->queryPage ( $entity );
		$query = $this->permissionDao->queryPageCount ( $entity );

		$resp = array('result' => $result, 'query' => $query);
		return $resp;
	}

	/**
	 * 查询数据Obj数组(自定义SQL)
	 * @param unknown $entity
	 * @return unknown(查询不到时返回null)
	 */
	public function queryPermissionArr($entity){
		$result = $this->permissionDao->queryPermissionArr($entity);
		return $result;
	}

	/**
	 * 查询单个数据Obj(自定义SQL)
	 * @param 实体 $entity
	 * @return unknown(查询不到时返回null)
	 */
	public function queryPermission($entity){
		$result = $this->permissionDao->queryPermission($entity);
		return $result;
	}

	/**
	 * 删除(通过ids批量删除)
	 *
	 * @param unknown $entity
	 * @return boolean
	 */
	public function deleteByIds($ids) {
		// 循环删除记录
		foreach ($ids as $id){
			$entity = new Permission();
			$entity->id = $id;
			$this->pDOUtil->delete ( $entity );
		}
		return true;
	}
}
?>