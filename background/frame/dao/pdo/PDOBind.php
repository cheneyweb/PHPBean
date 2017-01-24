
<?php
include_once 'EntityUtil.php';
include_once 'PDOBase.php';
include_once BASEURL . 'background/frame/security/EnumErrorMsg.php';
/**
 *
 * @author CheneyXu
 *         PDO的SQL与参数绑定基类，用于绑定SQL与入参实体对象，并执行SQL
 */
class PDOBind extends PDOBase {
	/**
	 * 绑定SQL参数并执行，无返回，用于增删改
	 *
	 * @param SQL语句 $sql
	 * @param 实体 $entity
	 * @param 是否全参数，即空属性也处理 $isFullBind
	 */
	public function bindParam($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性键值对
		$varArr = EntityUtil::getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE . $sql);
		}
	}
	/**
	 * 绑定参数并查询Obj数组（查询不到返回空数组）
	 *
	 * @param SQL预处理字符串 $sql
	 * @param 实体对象 $entity
	 * @param 是否全绑定布尔值 $isFullBind
	 * @return arr[obj]
	 */
	public function bindParamAndExecForObjArr($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性键值对
		$varArr = EntityUtil::getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE . $sql);
		}
		$stmt->setFetchMode ( PDO::FETCH_OBJ );	// 设置获取数组的模式，关联数组
		return $stmt->fetchAll (); 				// 获取数据对象数组
	}
	/**
	 * 绑定参数并查询单个Obj（查询不到返回null）
	 *
	 * @param SQL预处理字符串 $sql
	 * @param 实体对象 $entity
	 * @param 是否全绑定布尔值 $isFullBind
	 * @return obj
	 */
	public function bindParamAndExecForObj($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = EntityUtil::getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE . $sql);
		}
		$stmt->setFetchMode ( PDO::FETCH_OBJ );	// 设置获取数组的模式，关联数组
		$result = $stmt->fetch ();
		// 获取数据对象，格式化成JavaBean风格
		if ($result != null) {
			return parseToEntity($result);
		}else{
			return null;
		}
	}
	/**
	 * 绑定参数并查询分页（查询不到返回空数组）
	 *
	 * @param SQL预处理字符串 $sql
	 * @param 实体对象 $entity
	 * @param 是否全绑定布尔值 $isFullBind
	 * @return arr[obj]
	 */
	public function bindParamAndExecForPage($sql, $entity, $isFullBind) {
		// 自动校正实体属性和其映射的数据表列映射
		EntityUtil::autoCheckAttr($entity,$this->dbh);
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = EntityUtil::getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE . $sql);
		}
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		return $stmt->fetchAll (); 				// 获取数据对象数组
	}
	/**
	 * 绑定参数并查询分页数量（查询不到设置分页数量为0）
	 *
	 * @param SQL预处理字符串 $sql
	 * @param 实体对象 $entity
	 * @param 是否全绑定布尔值 $isFullBind
	 * @return obj
	 */
	public function bindParamAndExecForPageCount($sql, $entity, $isFullBind) {
		// 自动校正实体属性和其映射的数据表列映射
		EntityUtil::autoCheckAttr($entity,$this->dbh);
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = EntityUtil::getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE . $sql);
		}
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		$result = $stmt->fetch ();
		// 获取分页数
		if ($result != null) {
			$entity->pageCount = ( int ) $result->pageCount;
		} else {
			$entity->pageCount = 0;
		}
		// 获取数据对象，格式化成JavaBean风格返回
		return parseToEntity($entity);
	}
}
?>