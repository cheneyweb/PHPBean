<?php
include_once BASEURL . 'background/module/sys_module_manager/service/BaseService.php';
include_once BASEURL . 'background/module/sys_admin/entity/AdminRole.php';
/**
 * @author 宇帅
 * 用户业务服务层
 */
class AdminService extends BaseService{
	public $pDOUtil;
	public $adminDao;

	/**
	 * 分页查询(自定义SQL)
	 *
	 * @param unknown $entity
	 * @return unknown
	 */
	public function queryPage($entity) {
		$result = $this->adminDao->queryPage ( $entity );
		$query = $this->adminDao->queryPageCount ( $entity );

		$resp = array('result' => $result, 'query' => $query);
		return $resp;
	}

	/**
	 * 查询详情
	 * @param unknown $entity
	 * @return unknown
	 */
	public function queryAdmin($entity) {
		$result = $this->adminDao->queryAdmin ( $entity );
		return $result;
	}

	// 新增
	public function save($entity) {
		// 0、开启事务
		$this->pDOUtil->beginTransaction();
		// 1、获取选中角色
		$roleIds = $entity->roleIds;
		$entity->roleIds = null;

		$this->pDOUtil->insert ( $entity );

		// 结果判断
		if (empty ( $entity->id )) {
			return false;
		}
		// 2、保存角色数据
// 		for($i=0;$i<count($roleIds);$i++){
			$adminRole = new AdminRole();
			$adminRole->adminId = $entity->id;
			$adminRole->roleId = $roleIds;//[$i];
			$this->pDOUtil->insert ( $adminRole );
// 		}
		// 3、提交事务
		$this->pDOUtil->commit();
		return true;
	}

	/**
	 * 删除
	 *
	 * @param unknown $entity
	 * @return boolean
	 */
	public function delete($entity) {
		// 0、开启事务
		$this->pDOUtil->beginTransaction();
		// 1、删除用户主数据
		$this->pDOUtil->delete ( $entity );
		// 2、删除关联的角色数据
		$adminRole = new AdminRole();
		$adminRole->adminId = $entity->id;
		$this->pDOUtil->delete ( $adminRole );
		// 3、提交事务
		$this->pDOUtil->commit();
		return true;
	}

	/**
	 * 更新
	 *
	 * @param unknown $entity
	 * @return boolean
	 */
	public function update($entity) {
		// 0、开启事务
		$this->pDOUtil->beginTransaction();
		// 1、获取选中角色
		$roleIds = $entity->roleIds;
		$entity->roleIds = null;

		// 2、更新用户主数据
		$this->pDOUtil->update ( $entity , null);

		// 3、删除原有关联的角色数据
		$adminRole = new AdminRole();
		$adminRole->adminId = $entity->id;
		$this->pDOUtil->delete ( $adminRole );

		// 4、保存角色数据
// 		for($i=0;$i<count($roleIds);$i++){
			$adminRole = new AdminRole();
			$adminRole->adminId = $entity->id;
			$adminRole->roleId = $roleIds;//[$i];
			$this->pDOUtil->insert ( $adminRole );
// 		}
		// 5、提交事务
		$this->pDOUtil->commit();
		return true;
	}

	/**
	 * 更新密码
	 *
	 * @param unknown $entity
	 * @return boolean
	 */
	public function updatePassword($entity) {
		// 更新用户主数据
		$this->pDOUtil->update ( $entity , null);
		return true;
	}
}
?>