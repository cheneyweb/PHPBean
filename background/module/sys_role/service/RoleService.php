<?php
include_once BASEURL . 'background/module/sys_role/entity/Role.php';
include_once BASEURL . 'background/module/sys_role/entity/RolePermission.php';
/**
 * Service业务封装
 *
 * @author 宇帅
 *        
 */
class RoleService {
	public $pDOUtil;
	public $roleDao;
	
	/**
	 * 分页查询(自定义SQL)
	 *
	 * @param unknown $entity        	
	 * @return unknown
	 */
	public function queryPage($entity) {
		$result = $this->roleDao->queryPage ( $entity );
		return $result;
	}
	public function queryPageCount($entity) {
		$result = $this->roleDao->queryPageCount ( $entity );
		return $result;
	}
	
	/**
	 * 查询数据Obj数组(自定义SQL)
	 *
	 * @param unknown $entity        	
	 * @return unknown(查询不到时返回null)
	 */
	public function queryRoleArr($entity) {
		$result = $this->roleDao->queryRoleArr ( $entity );
		return $result;
	}
	
	/**
	 * 查询单个数据Obj(自定义SQL)
	 *
	 * @param 实体 $entity        	
	 * @return unknown(查询不到时返回null)
	 */
	public function queryRole($entity) {
		$result = $this->roleDao->queryRole ( $entity );
		return $result;
	}
	
	/**
	 * 查询数据Obj数组
	 *
	 * @param unknown $entity        	
	 * @return unknown(查询不到时返回null)
	 */
	public function queryArr($entity) {
		$result = $this->pDOUtil->queryArr ( $entity );
		return $result;
	}
	
	/**
	 * 查询单个数据Obj
	 *
	 * @param 实体 $entity        	
	 * @return unknown(查询不到时返回null)
	 */
	public function queryObj($entity) {
		$result = $this->pDOUtil->queryObj ( $entity );
		return $result;
	}
	
	/**
	 * 插入单个数据对象
	 *
	 * @param unknown $entity        	
	 * @return boolean
	 */
	public function insert($entity) {
		// 0、事务开启
		$this->pDOUtil->beginTransaction ();
		// 1、插入角色
		$permissionIds = $entity->permissionIds;
		$entity->permissionIds = null;
		$this->pDOUtil->insert ( $entity );
		// 结果判断
		if (empty ( $entity->id )) {
			return false;
		}
		// 2、逐条插入角色权限
		$permissionCodeArr = explode ( ',', $permissionIds );
		foreach ( $permissionCodeArr as $permissionCode ) {
			$rolePermission = new RolePermission ();
			$rolePermission->roleId = $entity->id;
			$rolePermission->permissionId = $permissionCode;
			$this->pDOUtil->insert ( $rolePermission );
		}
		// 3、事务提交
		$this->pDOUtil->commit ();
		return true;
	}
	
	/**
	 * 删除单个数据对象
	 *
	 * @param unknown $entity        	
	 * @return boolean
	 */
	public function delete($entity) {
		$this->pDOUtil->delete ( $entity );
		return true;
	}
	
	/**
	 * 删除(通过ids批量删除)
	 *
	 * @param unknown $entity        	
	 * @return boolean
	 */
	public function deleteByIds($ids) {
		// 0、事务开启
		$this->pDOUtil->beginTransaction ();
		// 1、循环删除记录
		foreach ( $ids as $id ) {
			$entity = new Role ();
			$entity->id = $id;
			$this->pDOUtil->delete ( $entity );
			// 2、删除对应角色所有权限
			$rolePermission = new RolePermission ();
			$rolePermission->roleId = $entity->id;
			$this->pDOUtil->delete ( $rolePermission );
		}
		// 3、事务提交
		$this->pDOUtil->commit ();
		return true;
	}
	
	/**
	 * 更新
	 *
	 * @param unknown $entity        	
	 * @return boolean
	 */
	public function update($entity) {
		// 0、事务开启
		$this->pDOUtil->beginTransaction ();
		// 1、删除对应角色所有权限
		$rolePermission = new RolePermission ();
		$rolePermission->roleId = $entity->id;
		$this->pDOUtil->delete ( $rolePermission );
		// 2、逐条插入角色权限
		$permissionCodeArr = explode ( ',', $entity->permissionIds );
		foreach ( $permissionCodeArr as $permissionCode ) {
			$rolePermission->id = null;
			$rolePermission->permissionId = $permissionCode;
			$this->pDOUtil->insert ( $rolePermission );
			// 结果判断
			if (empty ( $rolePermission->id )) {
				return false;
			}
		}
		// 3、更新角色信息
		$this->pDOUtil->update ( $entity, null );
		// 4、事务提交
		$this->pDOUtil->commit ();
		return true;
	}
}
?>