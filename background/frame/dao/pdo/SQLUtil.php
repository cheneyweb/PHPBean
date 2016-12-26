<?php
/**
 * @descriptor:	根据传入实体动态组建SQL类
 * @author:		许宇帅
 * @date:		2015年5月5日
 */
class SQLUtil {
	/**
	 * 获取表名
	 *
	 * @param unknown $entity        	
	 * @param unknown $r        	
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
	 * @param unknown $entity        	
	 * @return SQL
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
		$count = self::countNotNullProp ( $entityVars, $entity );
		// 遍历属性，开始组合SQL
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			if (! isEmpty ( $value ) && $key != 'queryBegin' && $key != 'queryCount' && $key != 'pageCount') {
				if ($i < $count) {
					$sqlstr1 = $sqlstr1 . formatPHPStyle ( $key ) . ',';
					$sqlstr2 = $sqlstr2 . ':' . $key . ',';
				} else {
					$sqlstr1 = $sqlstr1 . formatPHPStyle ( $key );
					$sqlstr2 = $sqlstr2 . ':' . $key;
				}
				$i ++;
			}
		}
		$sqlstr1 = $sqlstr1 . ')';
		$sqlstr2 = $sqlstr2 . ')';
		$sqlstr = $sqlstr . $sqlstr1 . ' values ' . $sqlstr2;
		
		return $sqlstr;
	}
	/**
	 * 动态DeleteSQL语句
	 *
	 * @param unknown $entity        	
	 * @return SQL
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
			if (! isEmpty ( $value ) && $key != 'queryBegin' && $key != 'queryCount' && $key != 'pageCount') {
				if ($i == 1) {
					$sqlstr1 = $sqlstr1 . formatPHPStyle ( $key ) . '=' . ':' . $key;
				} else {
					$sqlstr1 = $sqlstr1 . ' and ' . formatPHPStyle ( $key ) . '=' . ':' . $key;
				}
				$i ++;
			}
		}
		$sqlstr = $sqlstr . $sqlstr1;
		return $sqlstr;
	}
	/**
	 * 动态UpdateSQL语句
	 *
	 * @param unknown $entity        	
	 * @param unknown $query        	
	 * @return SQL
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
		$count = self::countNotNullProp ( $entityVars, $entity );
		// 遍历属性，开始组合SQL
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			// 空值不设值
			if (! isEmpty ( $value ) && $key != 'queryBegin' && $key != 'queryCount' && $key != 'pageCount') {
				if ($i < $count) {
					$sqlstr1 = $sqlstr1 . formatPHPStyle ( $key ) . '=' . ':' . $key . ',';
				} else {
					$sqlstr1 = $sqlstr1 . formatPHPStyle ( $key ) . '=' . ':' . $key;
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
						$sqlstr2 = $sqlstr2 . formatPHPStyle ( $key ) . '=' . ':' . $key;
					} else {
						$sqlstr2 = $sqlstr2 . ' and ' . formatPHPStyle ( $key ) . '=' . ':' . $key;
					}
					$i ++;
				}
			}
		} else {
			$sqlstr2 .= 'id=:id';
		}
		$sqlstr = $sqlstr . $sqlstr1 . $sqlstr2;
		return $sqlstr;
	}
	/**
	 * 动态UpdateAllSQL语句
	 *
	 * @param unknown $entity        	
	 * @param unknown $query        	
	 * @return SQL
	 */
	public static function updateAllSQL($entity, $query) {
		// 反射获得属性信息
		$r = new ReflectionClass ( $entity );
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PUBLIC );
		$count = count ( $entityVars );
		$i = 1;
		// 获取表名
		$tableName = self::getTableName ( $entity, $r );
		// 初始化SQL
		$sqlstr = 'update ' . $tableName . ' set ';
		$sqlstr1 = '';
		// 遍历属性，开始组合SQL
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			// 空值也设值
			if ($i < $count) {
				$sqlstr1 = $sqlstr1 . formatPHPStyle ( $key ) . '=' . ':' . $key . ',';
			} else {
				$sqlstr1 = $sqlstr1 . formatPHPStyle ( $key ) . '=' . ':' . $key;
			}
			$i ++;
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
			
			if (! isEmpty ( $value ) && $key != 'queryBegin' && $key != 'queryCount' && $key != 'pageCount') {
				if ($i == 1) {
					$sqlstr2 = $sqlstr2 . formatPHPStyle ( $key ) . '=' . ':' . $key;
				} else {
					$sqlstr2 = $sqlstr2 . ' and ' . formatPHPStyle ( $key ) . '=' . ':' . $key;
				}
				$i ++;
			}
		}
		$sqlstr = $sqlstr . $sqlstr1 . $sqlstr2;
		return $sqlstr;
	}
	/**
	 * 动态SelectSQL语句
	 *
	 * @param unknown $entity        	
	 * @return SQL
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
			if (! isEmpty ( $value ) && $key != 'queryBegin' && $key != 'queryCount' && $key != 'pageCount') {
				$sqlstr1 = $sqlstr1 . formatPHPStyle ( $key ) . '=' . '\'' . $value . '\'' . ' and ';
			}
		}
		$sqlstr1 = $sqlstr1 . '1=1';
		$sqlstr = $sqlstr . $sqlstr1;
		return $sqlstr;
	}
	
	/**
	 * 计算非空属性数量
	 *
	 * @param unknown $entityVars        	
	 * @param unknown $entity        	
	 * @return number
	 */
	private static function countNotNullProp($entityVars, $entity) {
		$count = 0;
		foreach ( $entityVars as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			if (! isEmpty ( $value ) && $key != 'queryBegin' && $key != 'queryCount' && $key != 'pageCount') {
				$count ++;
			}
		}
		return $count;
	}
	
	/**
	 * 获取表前缀
	 *
	 * @param unknown $entityVars        	
	 * @param unknown $entity        	
	 * @return number
	 */
	private static function getTablePrefix($entity, $r) {
		$entityVars = $r->getProperties ( ReflectionProperty::IS_PRIVATE && ReflectionProperty::IS_PRIVATE );
		foreach ( $entityVars as $prop ) {
			if ($prop->getName () == "tablePrefix") {
				$prop->setAccessible ( true );
				return $prop->getValue ( $entity ) . "_";
			}
		}
		return "sys_";
	}
}
?>