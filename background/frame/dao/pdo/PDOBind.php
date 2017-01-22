
<?php
include_once 'PDOBase.php';
include_once BASEURL . 'background/frame/security/EnumErrorMsg.php';
/**
 *
 * @author CheneyXu
 *         PDO的SQL与参数绑定基类，用于绑定SQL与入参实体对象，并执行SQL
 */
class PDOBind extends PDOBase {
	// 是否开启实体属性自动校正功能
	protected $enableAutoCheckAttr = true;
	// 系统保留查询字段
	protected $queryAttrArr = ["queryBegin" => true,"queryCount" => true, "pageCount" => true, "queryResult" => true];

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
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE);
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
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE);
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
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE);
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
		$this->autoCheckAttr($entity,$this->enableAutoCheckAttr);
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE);
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
		$this->autoCheckAttr($entity,$this->enableAutoCheckAttr);
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$executeResult = $stmt->execute ( $varArr );
		// 检查执行结果
		if($executeResult === false){
			Log::error(__METHOD__.EnumErrorMsg::SQL_EXECUTE);
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

	/**
	 * 私有方法：反射获取实体属性键值对
	 *
	 * @param 实体 $entity
	 * @param 是否全参数 $isFullBind
	 * @return arr[]
	 */
	private function getStmtVarArr($entity, $isFullBind) {
		// 反射获取实体的属性
		$r = new ReflectionClass ( $entity );
		$varArr = array ();
		// 循环每个实体的public属性，绑定到SQL变量参数
		foreach ( $r->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			// 排除特殊属性后，生成绑定数组
			if ( $this->checkAttrValue($key, $value, $isFullBind) ) {
				$varArr += array (
					':' . $key => $value
				);
			}
		}
		return $varArr;
	}

	/**
	 * 私有方法：检查实体对象的属性值是否合法
	 *
	 * @param 实体属性名 $key
	 * @param 实体属性值 $value
	 * @param 是否全绑定 $isFullBind
	 * @return boolean
	 */
	private function checkAttrValue($key,$value,$isFullBind){
		// 属性值类型检查
		if(is_array($value)){
			Log::error(__METHOD__.EnumErrorMsg::ATTR_TYPE_ARRARY);
		}
		if(is_object($value)){
			Log::error(__METHOD__.EnumErrorMsg::ATTR_TYPE_OBJECT);
		}
		// 如果是非全绑定，则空属性不处理（系统内置查询字段除外）
		if ( ( !isEmpty ( $value ) || $isFullBind ) && !isset( $this->queryAttrArr[$key] ) ) {
			return true;
		}
		return false;
	}

	/**
	 * 自动查询输入的实体对象属性和数据表列自动的匹配，因为需要查询一次数据库表，会有轻微的性能损失，如果不需要系统自动保证对象属性的正确性，可以关闭这一功能
	 *
	 * @param 实体 $entity
	 * @param 是否启用该功能 $enable
	 */
	protected function autoCheckAttr($entity,$enable){
		if($enable){
			// 反射获取实体的属性
			$r = new ReflectionClass ( $entity );
			$tableName = SQLUtil::getTableName($entity,$r);
			// 获取实体对应的数据表的所有列字段
			$columnArr = [];
			$result = $this->dbh->query ( 'select * from ' . $tableName . ' limit 0' );
			for($i = 0; $i < $result->columnCount (); $i ++) {
				$col = $result->getColumnMeta ( $i );
				$columnArr += array (
						$col ['name'] => true
					);
			}
			// 循环每个实体的public属性，绑定到SQL变量参数
			foreach ( $r->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
				$key = $prop->getName ();
				$value = $prop->getValue ( $entity );
				// 对于在数据表上不存在的属性，置空（系统内置查询字段除外）
				if( !isset( $columnArr[formatPHPStyle($key)] ) && !isset( $this->queryAttrArr[$key] )){
					$prop->setValue ( $entity, null );
				}
			}
		}
	}
}
?>