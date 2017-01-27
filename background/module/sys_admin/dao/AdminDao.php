<?php
include_once BASEURL . 'background/module/sys_module_manager/dao/BaseDao.php';

class AdminDao extends BaseDao{
	public function queryAdminByNameAndPassword($name,$password){
		$obj = $this->myBatis->queryObjByVars(__METHOD__,$name,$password);
		return $obj;
	}
	public function queryAdminArrByName($name){
		$obj = $this->myBatis->queryObjArrByVars(__METHOD__,$name);
		return $obj;
	}
}
?>