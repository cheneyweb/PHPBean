<?php
class BaseService {
	public $pDOUtil;

	/**
	 * 查询数据Obj数组
	 *
	 * @param 实体对象 $entity
	 * @return arr[objarr,返回结果]
	 */
	public function queryArr($entity) {
		$result = $this->pDOUtil->queryArr ( $entity );

		$resp = array('result' => $result, 'respMsg' => 'Y');
		return $resp;
	}

	/**
	 * 查询单个数据Obj
	 *
	 * @param 实体对象 $entity
	 * @return arr[obj,返回结果]
	 */
	public function queryObj($entity) {
		$result = $this->pDOUtil->queryObj ( $entity );

		$resp = array('result' => $result, 'respMsg' => 'Y');
		return $resp;
	}

	/**
	 * 插入单个数据对象
	 * @param 实体对象 $entity
	 * @return boolean
	 */
	public function insert($entity) {
		$this->pDOUtil->insert ( $entity );
		// 结果判断
		if (empty ( $entity->id )) {
			return false;
		}
		return true;
	}

	/**
	 * 删除单个数据对象
	 *
	 * @param 实体对象 $entity
	 * @return boolean
	 */
	public function delete($entity) {
		$this->pDOUtil->delete ( $entity );
		return true;
	}

	/**
	 * 更新
	 *
	 * @param 实体对象 $entity
	 * @return boolean
	 */
	public function update($entity) {
		$this->pDOUtil->update ( $entity, null );
		return true;
	}
}
?>