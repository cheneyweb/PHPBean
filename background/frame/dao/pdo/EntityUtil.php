<?php
/**
 * @descriptor:	实体反射处理及实体属性处理工具类
 * @author:		CheneyXu
 * @date:		2017年1月24日
 */
class EntityUtil {
	// 是否开启实体属性自动校正功能
	private static $enableAutoCheckAttr = true;
	// 系统保留查询字段
	private static $queryAttrArr = ["queryBegin" => true,"queryCount" => true, "pageCount" => true, "queryResult" => true];
	// 系统指定的表名称字段
	private static $tablePrefixAttr = "tablePrefix";
	/**
	 * 获取表名
	 *
	 * @param 实体对象 $entity
	 * @param 实体对象反射 $r
	 * @return 表名
	 */
	public static function getTableName($entity, $r) {
		// 获取表前缀
		$tablePrefix = self::getTablePrefix ( $entity, $r );
		// 返回表名
		return $tablePrefix . formatPHPStyle ( get_class ( $entity ) );
	}

	/**
	 * 获取SQL绑定执行属性键值对
	 *
	 * @param 实体对象 $entity
	 * @param 是否全绑定 $isFullBind
	 * @return stmt属性键值对
	 */
	public static function getStmtVarArr($entity, $isFullBind){
		// 反射获取实体的属性
		$r = new ReflectionClass ( $entity );
		$varArr = array ();
		// 循环每个实体的public属性，绑定到SQL变量参数
		foreach ( $r->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			// 排除特殊属性后，生成绑定数组
			if ( self::checkAttrValue($key, $value, $isFullBind) ) {
				$varArr += array (
					':' . $key => $value
				);
			}
		}
		return $varArr;
	}
	/**
	 * 获取普通实体属性键值对
	 *
	 * @param 实体对象 $entity
	 * @param 实体反射 $r
	 * @param 是否全绑定 $isFullBind
	 * @return 实体属性键值对
	 */
	public static function getPropArr($entity,$r,$isFullBind){
		$varArr = array ();
		// 循环每个实体的public属性，绑定到SQL变量参数
		foreach ( $r->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			// 排除特殊属性后，生成绑定数组
			if ( self::checkAttrValue($key, $value, $isFullBind) ) {
				$varArr += array (
					$key => $value
				);
			}
		}
		return $varArr;
	}
	/**
	 * 自动查询输入的实体对象属性和数据表列自动的匹配，因为需要查询一次数据库表，会有轻微的性能损失，如果不需要系统自动保证对象属性的正确性，可以关闭这一功能
	 *
	 * @param 实体 $entity
	 * @param 数据库连接 $dbh
	 */
	public static function autoCheckAttr($entity,$dbh){
		if(self::$enableAutoCheckAttr){
			// 反射获取实体的属性
			$r = new ReflectionClass ( $entity );
			$tableName = self::getTableName($entity,$r);
			// 获取实体对应的数据表的所有列字段
			$columnArr = [];
			$result = $dbh->query ( 'select * from ' . $tableName . ' limit 0' );
			if($result != false){
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
					if( !isset( $columnArr[formatPHPStyle($key)] ) && !isset( self::$queryAttrArr[$key] )){
						$prop->setValue ( $entity, null );
					}
				}
			}
		}
	}

	/**
	 * 私有方法：检查实体对象的属性值是否合法
	 *
	 * @param 实体属性名 $key
	 * @param 实体属性值 $value
	 * @param 是否全绑定 $isFullBind
	 * @return boolean
	 */
	private static function checkAttrValue($key,$value,$isFullBind){
		// 属性值类型检查
		if(is_array($value)){
			Log::error(__METHOD__.EnumErrorMsg::ATTR_TYPE_ARRARY);
		}
		if(is_object($value)){
			Log::error(__METHOD__.EnumErrorMsg::ATTR_TYPE_OBJECT);
		}
		// 如果是非全绑定，则空属性不处理（系统内置查询字段除外）
		if ( ( !isEmpty ( $value ) || $isFullBind ) && !isset( self::$queryAttrArr[$key] ) ) {
			return true;
		}
		return false;
	}

	/**
	 * 私有方法：获取表前缀
	 *
	 * @param 实体对象 $entity
	 * @param 实体对象反射 $r
	 * @return 实体表前缀
	 */
	private static function getTablePrefix($entity, $r) {
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PRIVATE );
		foreach ( $entityVars as $prop ) {
			if ($prop->getName () == self::$tablePrefixAttr) {
				$prop->setAccessible ( true );
				return $prop->getValue ( $entity ) . "_";
			}
		}
		return "sys_";
	}
}
?>