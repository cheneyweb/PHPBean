<?php
include_once BASEURL . 'background/module/sys_module_manager/service/BaseService.php';
include_once BASEURL . 'background/module/tmp_permission/entity/Permission.php';
/**
 * Service业务封装
 * @author 宇帅
 *
 */
class PermissionService extends BaseService{
	public $permissionDao;

	/**
	 * 分页查询(自定义SQL)
	 *
	 * @param 实体对象 $entity
	 * @return arr[objarr,query,返回结果]
	 */
	public function queryPage($entity) {
		$result = $this->permissionDao->queryPage ( $entity );
		$query = $this->permissionDao->queryPageCount ( $entity );

		$resp = array('result' => $result, 'query' => $query, 'respMsg' => 'Y');
		return $resp;
	}

	/**
	 * 查询数据Obj数组(自定义SQL)
	 * @param 实体对象 $entity
	 * @return arr[objarr,返回结果]
	 */
	public function queryPermissionArr($entity){
		$result = $this->permissionDao->queryPermissionArr($entity);

		$resp = array('result' => $result, 'respMsg' => 'Y');
		return $resp;
	}

	/**
	 * 查询单个数据Obj(自定义SQL)
	 * @param 实体对象 $entity
	 * @return arr[obj,返回结果]
	 */
	public function queryPermission($entity){
		$result = $this->permissionDao->queryPermission($entity);

		$resp = array('result' => $result, 'respMsg' => 'Y');
		return $resp;
	}
	/**
	 * 删除(通过ids批量删除)
	 *
	 * @param 实体对象 $entity
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