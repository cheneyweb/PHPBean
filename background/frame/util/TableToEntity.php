<?php
/**
 * @author CheneyXu
 * 将表转化为实体
 */
class TableToEntity {
	public $pDOUtil;
	/**
	 * 获取表所有字段名
	 *
	 * @param unknown $tableName
	 */
	function getFieldNames($tableName) {
		$dbh = $this->pDOUtil->getConnection ();
		$result = $dbh->query ( 'select * from ' . $tableName . ' limit 0' );
		for($i = 0; $i < $result->columnCount (); $i ++) {
			$col = $result->getColumnMeta ( $i );
			$columns [] = $col ['name'];
		}
		return $columns;
	}

	/**
	 * 获取表所有字段信息
	 *
	 * @param unknown $tableName
	 */
	function getColumnsInfo($tableName) {
		$dbh = $this->pDOUtil->getConnection ();
		$result = $dbh->query ( 'show full columns from ' . $tableName );
		// $result->setFetchMode ( PDO::FETCH_OBJ );
		return $result->fetchAll ();
	}
}
?>
