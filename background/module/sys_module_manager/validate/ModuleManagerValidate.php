<?php
/**
 * 校验封装
 * @author 宇帅
 *
 */
class ModuleManagerValidate {
	public $validate;
	public $pDOUtil;

	public function checkQuery($query){
		$checkResult = array('respMsg' => 'Y');
		if (empty ( $query )) {
			$checkResult['respMsg'] = '查询对象不能为空';
		}
		return $checkResult;
	}

	public function checkEntity($entity){
		$checkResult = array('respMsg' => 'Y');
		$columns = $entity->columns;
		$entity->columns = null;
		if (empty ( $entity )) {
			$checkResult['respMsg'] = '入参对象不能为空';
			return $checkResult;
		}
		if(empty( $entity->code ) || empty( $entity->name )){
			$checkResult['respMsg'] = '模块前缀和名称不能为空';
			return $checkResult;
		}
		// 检查模块是否已经存在
		$obj = $this->pDOUtil->queryObj($entity);
		if($obj != null){
			$checkResult['respMsg'] = '该模块已经存在';
			return $checkResult;
		}
		// 检查数据库是否已经存在表，不存在则创建
		if(!$this->checkTableExist($entity)){
			$entity->columns = $columns;
			// $checkResult['respMsg'] = '数据库中不存在表' . $entity->code . '_' . $entity->name .',系统已经默认创建该表';
			$this->createTable($entity);
			// return $checkResult;
		}
		$entity->columns = null;
		return $checkResult;
	}

	public function checkEmpty($parm){
		$checkResult = array('respMsg' => 'Y');
		if (empty ( $parm )) {
			$checkResult['respMsg'] = '入参数据不能为空';
		}
		return $checkResult;
	}

	// 判断数据库表是否存在
	public function checkTableExist($entity){
		$tableName = $entity->code . '_' . $entity->name;
		//判断表是否存在
		$pdo = $this->pDOUtil->getConnection();
		$result = $pdo->query("SHOW TABLES LIKE '". $tableName."'");
		$result = $result->fetch();
		if($result != null){
		    return true;
		} else {
		    return false;
		}
	}

	// 创建数据库表
	public function createTable($entity){
		$tableName = $entity->code . '_' . $entity->name;
		$columnSql = "";
		// 组装新增的列SQL
		if(!empty($entity->columns)){
			foreach ($entity->columns as $column) {
				$columnName = $column['name'];
				$columnType = $column['type'];
				$columnComment = $column['comment'];
				$default = "";
				$encode = "COLLATE utf8_bin";
				if(empty($columnName) || empty($columnType)){
					continue;
				}
				switch ($columnType) {
					case 'int':
						$columnType = 'int(10)';
						break;
					case 'varchar':
						$columnType = 'varchar(10)';
						break;
					case 'timestamp':
						$columnType = 'timestamp';
						$default = "DEFAULT '0000-00-00 00:00:00'";
						break;
					case 'decimal':
						$columnType = 'decimal(10,2)';
						break;
					case 'blob':
						$columnType = 'blob';
						$encode = "";
						break;
					default:
						break;
				}
				$columnSql .= "`$columnName` $columnType $encode NOT NULL $default COMMENT '$columnComment',";
			}
		}
		// 默认新增列SQL
		if(empty($columnSql)){
			$columnSql = "`code` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '编码',`name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '名称',";
		}
		// 创建表SQL
		$sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
		  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
		  $columnSql
		  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
		  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
		  `operator_modify` varchar(10) COLLATE utf8_bin NULL DEFAULT NULL COMMENT '修改者',
		  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改时间',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='基础表';";
		// 执行创建表
		$pdo = $this->pDOUtil->getConnection();
		$pdo->exec($sql);
	}
}
?>