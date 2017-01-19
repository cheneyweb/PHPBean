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
		if (empty ( $entity )) {
			$checkResult['respMsg'] = '入参对象不能为空';
			return $checkResult;
		}
		if(empty( $entity->code ) || empty( $entity->name )){
			$checkResult['respMsg'] = '模块前缀和名称不能为空';
			return $checkResult;
		}
		$obj = $this->pDOUtil->queryObj($entity);
		if($obj != null){
			$checkResult['respMsg'] = '该模块已经存在';
			return $checkResult;
		}
		if(!$this->checkTableExist($entity)){
			$checkResult['respMsg'] = '数据库中不存在表' . $entity->code . '_' . $entity->name .',请先创建该表再创建模块';
			return $checkResult;
		}
		return $checkResult;
	}

	public function checkEmpty($parm){
		$checkResult = array('respMsg' => 'Y');
		if (empty ( $parm )) {
			$checkResult['respMsg'] = '入参数据不能为空';
		}
		return $checkResult;
	}

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
}
?>