<?php
/**
 * 校验封装
 * @author CheneyXu
 *
 */
class RoleValidate {
	public $validate;

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
}
?>