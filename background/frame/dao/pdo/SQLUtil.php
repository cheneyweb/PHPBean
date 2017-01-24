<?php
include_once 'EntityUtil.php';
/**
 * @descriptor:	根据传入实体动态组建SQL类
 * @author:		CheneyXu
 * @date:		2015年5月5日
 */
class SQLUtil {
	/**
	 * 动态InsertSQL语句
	 *
	 * @param 实体对象 $entity
	 * @return “insert into tablename (entity_column,...)values(:entityColumn,...)”的预处理插入SQL语句
	 */
	public static function insertSQL($entity) {
		// 反射获取实体对象信息
		$r = new ReflectionClass ( $entity );
		// 获取表名
		$tableName = EntityUtil::getTableName ( $entity, $r );
		// 反射获取实体属性键值对
		$propArr = EntityUtil::getPropArr ( $entity, $r, false );
		$i = 1;
		// 开始初始化SQL
		$sqlstr = 'insert into ' . $tableName;
		$sqlstr1 = '(';
		$sqlstr2 = '(';
		// 遍历属性，开始组合SQL
		foreach ( $propArr as $key => $value ) {
			if ($i == 1) {
				$sqlstr1 .= formatPHPStyle ( $key );
				$sqlstr2 .= ':' . $key;
			} else {
				$sqlstr1 .= ',' . formatPHPStyle ( $key );
				$sqlstr2 .= ',' . ':' . $key;
			}
			$i ++;
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
		// 反射获取实体对象信息
		$r = new ReflectionClass ( $entity );
		// 获取表名
		$tableName = EntityUtil::getTableName ( $entity, $r );
		// 反射获取实体属性键值对
		$propArr = EntityUtil::getPropArr ( $entity, $r, false );
		$i = 1;
		// 初始化SQL
		$sqlstr = 'delete from ' . $tableName . ' where ';
		$sqlstr1 = '';
		// 遍历属性，开始组合SQL
		foreach ( $propArr as $key => $value ) {
			if ($i == 1) {
				$sqlstr1 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
			} else {
				$sqlstr1 .= ' and ' . formatPHPStyle ( $key ) . '=' . ':' . $key;
			}
			$i ++;
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
		// 反射获取实体对象信息
		$r = new ReflectionClass ( $entity );
		// 获取表名
		$tableName = EntityUtil::getTableName ( $entity, $r );
		// 反射获取实体属性键值对
		$propArr = EntityUtil::getPropArr ( $entity, $r, false );
		$i = 1;
		// 初始化SQL
		$sqlstr = 'update ' . $tableName . ' set ';
		$sqlstr1 = '';
		// 遍历属性，开始组合SQL
		foreach ( $propArr as $key => $value ) {
			if ($i == 1) {
				$sqlstr1 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
			} else {
				$sqlstr1 .= ',' . formatPHPStyle ( $key ) . '=' . ':' . $key;
			}
			$i ++;
		}

		// 生成条件代码（条件为空时默认使用id索引）
		$sqlstr2 = ' where ';
		if ($query != null) {
			// 反射获取实体属性键值对
			$propArr = EntityUtil::getPropArr ( $query, false );
			$i = 1;
			foreach ( $propArr as $key => $value ) {
				if ($i == 1) {
					$sqlstr2 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
				} else {
					$sqlstr2 .= ' and ' . formatPHPStyle ( $key ) . '=' . ':' . $key;
				}
				$i ++;
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
		// 反射获取实体对象信息
		$r = new ReflectionClass ( $entity );
		// 获取表名
		$tableName = EntityUtil::getTableName ( $entity, $r );
		// 反射获取实体属性键值对
		$propArr = EntityUtil::getPropArr ( $entity, $r, true );
		$i = 1;
		// 初始化SQL
		$sqlstr = 'update ' . $tableName . ' set ';
		$sqlstr1 = '';
		// 遍历属性，开始组合SQL
		foreach ( $propArr as $key => $value ) {
			if ($i == 1) {
				$sqlstr1 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
			} else {
				$sqlstr1 .= ',' . formatPHPStyle ( $key ) . '=' . ':' . $key;
			}
			$i ++;
		}
		// 生成条件代码（条件为空时默认使用id索引）
		$sqlstr2 = ' where ';
		if ($query != null) {
			// 反射获取实体属性键值对
			$propArr = EntityUtil::getPropArr ( $query, false );
			$i = 1;
			foreach ( $propArr as $key => $value ) {
				if ($i == 1) {
					$sqlstr2 .= formatPHPStyle ( $key ) . '=' . ':' . $key;
				} else {
					$sqlstr2 .= ' and ' . formatPHPStyle ( $key ) . '=' . ':' . $key;
				}
				$i ++;
			}
		} else {
			$sqlstr2 .= 'id=:id';
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
		// 反射获取实体对象信息
		$r = new ReflectionClass ( $entity );
		// 获取表名
		$tableName = EntityUtil::getTableName ( $entity, $r );
		// 反射获取实体属性键值对
		$propArr = EntityUtil::getPropArr ( $entity, $r, false );
		// 初始化SQL
		$sqlstr = 'select * from ' . $tableName . ' where ';
		$sqlstr1 = '';
		// 遍历属性，开始组合SQL
		foreach ( $propArr as $key => $value ) {
			$sqlstr1 .= formatPHPStyle ( $key ) . '=' . '\'' . $value . '\'' . ' and ';
		}
		$sqlstr1 .= '1=1';
		$sqlstr .= $sqlstr1;
		return $sqlstr;
	}
}
?>