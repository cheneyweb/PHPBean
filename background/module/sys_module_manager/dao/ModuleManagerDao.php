<?php
include_once BASEURL . 'background/module/sys_module_manager/dao/BaseDao.php';

class ModuleManagerDao extends BaseDao{
	public $myBatis;

	public function queryByVars($var1,$var2){
		$obj = $this->myBatis->queryObjByVars(__METHOD__,$var1,$var2);
		return $obj;
	}
}
?>