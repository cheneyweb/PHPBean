
<?php
include_once 'PDOBase.php';
include_once 'SQLUtil.php';
/**
 *
 * @author 宇帅
 *         PDO工具父类，用于数据库基本底层查询操作
 */
class PDOUtil extends PDOBase{
	/**
	 * 插入数据
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
	 * @param 条件 $query
	 */
	public function update($entity, $query) {
		$sql = SQLUtil::updateSQL ( $entity, $query );
		$this->bindParam ( $sql, $entity, false );
	}
	/**
	 * 更新数据（NULL也更新）
	 *
	 * @param 实体 $entity
	 * @param 条件 $query
	 */
	public function updateAll($entity, $query) {
		$sql = SQLUtil::updateAllSQL ( $entity, $query );
		$this->bindParam ( $sql, $entity, true );
	}
	/**
	 * 查询数据Obj数组
	 *
	 * @param 实体 $entity
	 */
	public function queryArr($entity) {
		$sql = SQLUtil::selectSQL ( $entity );
		return $this->bindParamAndExecForObjArr ( $sql, $entity, false );
	}

	/**
	 * 查询单个数据Obj
	 *
	 * @param 实体 $entity
	 */
	public function queryObj($entity) {
		$sql = SQLUtil::selectSQL ( $entity );
		return $this->bindParamAndExecForObj ( $sql, $entity, false );
	}

	/**
	 * 绑定参数并查询Obj数组
	 *
	 * @param unknown $sql
	 * @param unknown $entity
	 * @param unknown $isFullBind
	 * @return 实体数组
	 */
	public function bindParamAndExecForObjArr($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->execute ( $varArr );
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		return $stmt->fetchAll (); // 获取数据对象数组
	}
	/**
	 * 绑定参数并查询单个Obj
	 *
	 * @param unknown $sql
	 * @param unknown $entity
	 * @param unknown $isFullBind
	 * @return 实体
	 */
	public function bindParamAndExecForObj($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->execute ( $varArr );
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		$result = $stmt->fetch ();
		if ($result != null) {
			return parseToEntity($result); // 获取数据对象，格式化成JavaBean风格
		} else {
			return null;
		}
	}
	/**
	 * 绑定参数并查询分页
	 *
	 * @param unknown $sql
	 * @param unknown $entity
	 * @param unknown $isFullBind
	 * @return 实体数组
	 */
	public function bindParamAndExecForPage($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->execute ( $varArr );
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		return $stmt->fetchAll (); // 获取数据对象数组
	}
	/**
	 * 绑定参数并查询分页数量
	 *
	 * @param unknown $sql
	 * @param unknown $entity
	 * @param unknown $isFullBind
	 * @return 实体
	 */
	public function bindParamAndExecForPageCount($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		$stmt->execute ( $varArr );
		$result = $stmt->fetch (); // 获取分页数
		if ($result != null) {
			$entity->pageCount = ( int ) $result->pageCount;
		} else {
			$entity->pageCount = 0;
		}
		return parseToEntity($entity);// 获取数据对象，格式化成JavaBean风格
	}

	/**
	 * 私有方法：反射获取实体属性值入参
	 *
	 * @param SQL语句 $sql
	 * @param 实体 $entity
	 * @param 是否全参数 $isFullBind
	 */
	private function getStmtVarArr($entity, $isFullBind) {
		// 反射获取实体的属性
		$r = new ReflectionClass ( $entity );
		$varArr = array ();
		// 循环每个实体属性，绑定到SQL变量参数
		foreach ( $r->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			// 生成绑定数组
			if (! isEmpty ( $value ) && $key != 'queryBegin' && $key != 'queryCount' && $key != 'pageCount' && $key != 'queryResult' || $isFullBind) {
				$varArr += array (
						':' . $key => $value
				);
			}
		}
		return $varArr;
	}

	/**
	 * 私有方法：绑定SQL参数
	 *
	 * @param SQL语句 $sql
	 * @param 实体 $entity
	 * @param 是否全参数 $isFullBind
	 */
	private function bindParam($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->execute ( $varArr );
	}
}
?>