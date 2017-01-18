<?php
class BaseService {
	public $pDOUtil;

	/**
	 * 查询数据Obj数组
	 *
	 * @param 实体对象 $entity
	 * @return arr[obj] (查询不到时返回null)
	 */
	public function queryArr($entity) {
		$result = $this->pDOUtil->queryArr ( $entity );
		return $result;
	}

	/**
	 * 查询单个数据Obj
	 *
	 * @param 实体对象 $entity
	 * @return obj(查询不到时返回null)
	 */
	public function queryObj($entity) {
		$result = $this->pDOUtil->queryObj ( $entity );
		return $result;
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