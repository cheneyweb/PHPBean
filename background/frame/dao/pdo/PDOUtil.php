
<?php
include_once 'PDOBind.php';
include_once 'SQLUtil.php';
/**
 *
 * @author CheneyXu
 *         PDO工具父类，封装了增删改查的基础数据库操作
 */
class PDOUtil extends PDOBind{
	/**
	 * 插入数据（实体的ID会被自动赋值）
	 *
	 * @param 实体 $entity
	 */
	public function insert($entity) {
		// 根据实体初始化SQL
		$sql = SQLUtil::insertSQL ( $entity );
		// 绑定参数并执行
		$this->bindParam ( $sql, $entity, false );
		// 将新插入的id返回
		$entity->id = $this->dbh->lastInsertId ();
	}
	/**
	 * 删除数据
	 *
	 * @param 实体 $entity
	 */
	public function delete($entity) {
		$sql = SQLUtil::deleteSQL ( $entity );
		$this->bindParam ( $sql, $entity, false );
	}

	/**
	 * 更新数据（NULL不更新）
	 *
	 * @param 实体 $entity
	 * @param 条件 $query（可以为空）
	 */
	public function update($entity, $query) {
		$sql = SQLUtil::updateSQL ( $entity, $query );
		$this->bindParam ( $sql, $entity, false );
	}
	/**
	 * 更新数据（NULL也更新）
	 *
	 * @param 实体 $entity
	 * @param 条件 $query（可以为空）
	 */
	public function updateAll($entity, $query) {
		$sql = SQLUtil::updateAllSQL ( $entity, $query );
		$this->bindParam ( $sql, $entity, true );
	}

	/**
	 * 查询单个数据Obj
	 *
	 * @param 实体 $entity
	 * @return obj
	 */
	public function queryObj($entity) {
		$sql = SQLUtil::selectSQL ( $entity );
		return $this->bindParamAndExecForObj ( $sql, $entity, false );
	}

	/**
	 * 查询数据Obj数组
	 *
	 * @param 实体 $entity
	 * @return arr[obj]
	 */
	public function queryArr($entity) {
		$sql = SQLUtil::selectSQL ( $entity );
		return $this->bindParamAndExecForObjArr ( $sql, $entity, false );
	}
}
?>