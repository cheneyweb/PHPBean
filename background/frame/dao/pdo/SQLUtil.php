<?php
/**
 * @descriptor:	根据传入实体动态组建SQL类
 * @author:		CheneyXu
 * @date:		2015年5月5日
 */
class SQLUtil {
	// 系统保留查询字段
	protected static $queryAttrArr = ["queryBegin" => true,"queryCount" => true, "pageCount" => true];

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
	 * 动态InsertSQL语句
	 *
	 * @param 实体对象 $entity
	 * @return “insert into tablename (entity_column,...)values(:entityColumn,...)”的预处理插入SQL语句
	 */
	public static function insertSQL($entity) {
		// 反射获得属性信息
		$r = new ReflectionClass ( $entity );
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PUBLIC );
		$i = 1;
		// 获取表名
		$tableName = self::getTableName ( $entity, $r );
		// 开始初始化SQL
		$sqlstr = 'insert into ' . $tableName;
		$sqlstr1 = '(';
		$sqlstr2 = '(';
		// 先计算非空值字段数量
		$count = self::countProp ( $entityVars, $entity ,false );
		// 遍历属性，开始组合SQL
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			if ( self::checkAttrValue($key, $value, false) ) {
				if ($i < $count) {
					$sqlstr1 .= formatPHPStyle ( $key ) . ',';
					$sqlstr2 .= ':' . $key . ',';
				} else {
					$sqlstr1 .= formatPHPStyle ( $key );
					$sqlstr2 .= ':' . $key;
				}
				$i ++;
			}
		}
		$sqlstr1 .= ')';
		$sqlstr2 .= ')';
		$sqlstr .= $sqlstr1 . ' values ' . $sqlstr2;

		return $sqlstr;
	}
	/**
	 * 动态DeleteSQL语句
	 *
	 * @param 实体对象 $entity
	 * @return “delete from tablename where entity_column=:entityColumn and...”的预处理删除SQL语句
	 */
	public static function deleteSQL($entity) {
		// 反射获得属性信息
		$r = new ReflectionClass ( $entity );
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PUBLIC );
		$i = 1;
		// 获取表名
		$tableName = self::getTableName ( $entity, $r );
		// 初始化SQL
		$sqlstr = 'delete from ' . $tableName . ' where ';
		$sqlstr1 = '';
		// 遍历属性，开始组合SQL
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			if ( self::checkAttrValue($key, $value, false) ) {
				if ($i == 1) {
					$sqlstr1 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
				} else {
					$sqlstr1 .= ' and ' . formatPHPStyle ( $key ) . '=' . ':' . $key;
				}
				$i ++;
			}
		}
		$sqlstr .= $sqlstr1;
		return $sqlstr;
	}
	/**
	 * 动态UpdateSQL语句
	 *
	 * @param 实体对象 $entity
	 * @param 查询对象 $query
	 * @return update tablename set entity_column=:entityColumn,... where query_column=:queryColumn and...”的预处理更新SQL语句
	 */
	public static function updateSQL($entity, $query) {
		// 反射获得属性信息
		$r = new ReflectionClass ( $entity );
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PUBLIC );
		$i = 1;
		// 获取表名
		$tableName = self::getTableName ( $entity, $r );
		// 初始化SQL
		$sqlstr = 'update ' . $tableName . ' set ';
		$sqlstr1 = '';
		// 先计算非空属性数量
		$count = self::countProp ( $entityVars, $entity, false );
		// 遍历属性，开始组合SQL
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			// 空值不设值
			if ( self::checkAttrValue($key, $value, false) ) {
				if ($i < $count) {
					$sqlstr1 .= formatPHPStyle ( $key ) . '=' . ':' . $key . ',';
				} else {
					$sqlstr1 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
				}
				$i ++;
			}
		}

		// 生成条件代码
		$sqlstr2 = ' where ';
		if ($query != null) {
			$r = new ReflectionClass ( $query );
			$entityVars = $r->getProperties ( ReflectionProperty::IS_PUBLIC );
			$i = 1;

			foreach ( $entityVars as $prop ) {
				$key = $prop->getName ();
				$value = $prop->getValue ( $query );

				if (! isEmpty ( $value )) {
					if ($i == 1) {
						$sqlstr2 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
					} else {
						$sqlstr2 .= ' and ' . formatPHPStyle ( $key ) . '=' . ':' . $key;
					}
					$i ++;
				}
			}
		} else {
			$sqlstr2 .= 'id=:id';
		}
		$sqlstr .= $sqlstr1 . $sqlstr2;
		return $sqlstr;
	}
	/**
	 * 动态UpdateAllSQL语句
	 *
	 * @param 实体对象 $entity
	 * @param 查询对象 $query
	 * @return update tablename set entity_column=:entityColumn,... where query_column=:queryColumn and...”的预处理更新SQL语句
	 */
	public static function updateAllSQL($entity, $query) {
		// 反射获得属性信息
		$r = new ReflectionClass ( $entity );
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PUBLIC );
		// 先计算属性数量
		$count = self::countProp ( $entityVars, $entity, true );
		$i = 1;
		// 获取表名
		$tableName = self::getTableName ( $entity, $r );
		// 初始化SQL
		$sqlstr = 'update ' . $tableName . ' set ';
		$sqlstr1 = '';
		// 遍历属性，开始组合SQL
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $query );

			// 空值也设值，设置isFullBind=true
			if ( self::checkAttrValue($key, $value, true) ) {
				if ($i < $count) {
					$sqlstr1 .= formatPHPStyle ( $key ) . '=' . ':' . $key . ',';
				} else {
					$sqlstr1 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
				}
				$i ++;
			}
		}
		// 生成条件代码
		$r = new ReflectionClass ( $query );
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PUBLIC );
		$i = 1;
		// 初始化条件SQL
		$sqlstr2 = ' where ';
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $query );

			if ( self::checkAttrValue($key, $value, false) ) {
				if ($i == 1) {
					$sqlstr2 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
				} else {
					$sqlstr2 .= ' and ' . formatPHPStyle ( $key ) . '=' . ':' . $key;
				}
				$i ++;
			}
		}
		$sqlstr .= $sqlstr1 . $sqlstr2;
		return $sqlstr;
	}
	/**
	 * 动态SelectSQL语句
	 *
	 * @param 实体对象 $entity
	 * @return select from tablename where entity_column=:entityColumn and...”的预处理查询SQL语句
	 */
	public static function selectSQL($entity) {
		// 反射获得属性信息
		$r = new ReflectionClass ( $entity );
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PUBLIC );
		// 获取表名
		$tableName = self::getTableName ( $entity, $r );
		// 初始化SQL
		$sqlstr = 'select * from ' . $tableName . ' where ';
		$sqlstr1 = '';
		// 遍历属性，开始组合SQL
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			if ( self::checkAttrValue($key, $value, false) ) {
				$sqlstr1 .= formatPHPStyle ( $key ) . '=' . '\'' . $value . '\'' . ' and ';
			}
		}
		$sqlstr1 .= '1=1';
		$sqlstr .= $sqlstr1;
		return $sqlstr;
	}

	/**
	 * 私有方法：计算属性数量
	 *
	 * @param 实体对象键值对 $entityVars
	 * @param 实体对象 $entity
	 * @param 是否全绑定 $isFullBind
	 * @return number
	 */
	private static function countProp($entityVars, $entity, $isFullBind) {
		$count = 0;
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			if ( self::checkAttrValue($key, $value, $isFullBind) ) {
				$count ++;
			}
		}
		return $count;
	}

	/**
	 * 私有方法：获取表前缀
	 *
	 * @param 实体对象键值对 $entityVars
	 * @param 实体对象 $entity
	 * @return number
	 */
	private static function getTablePrefix($entity, $r) {
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PRIVATE );
		foreach ( $entityVars as $prop ) {
			if ($prop->getName () == "tablePrefix") {
				$prop->setAccessible ( true );
				return $prop->getValue ( $entity ) . "_";
			}
		}
		return "sys_";
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
}
?>