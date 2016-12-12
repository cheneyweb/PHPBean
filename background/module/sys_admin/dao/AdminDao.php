<?php
class AdminDao{
	public $myBatis;
	
	public function queryPage($obj){
		return $this->myBatis->queryPage(__METHOD__,$obj);
	}
	
	public function queryPageCount($obj){
		return $this->myBatis->queryPageCount(__METHOD__,$obj);
	}
	
	public function queryAdmin($obj){
		return $this->myBatis->queryObjByObj(__METHOD__,$obj);
	}
	
	public function queryAdminByNameAndPassword($name,$password){
		$obj = $this->myBatis->queryObjByVars(__METHOD__,$name,$password);
		return $obj;
	}
	
	public function queryAdminArr($obj){
		$obj = $this->myBatis->queryObjArrByObj(__METHOD__,$obj);
		return $obj;
	}
	
	public function queryAdminArrByName($name){
		$obj = $this->myBatis->queryObjArrByVars(__METHOD__,$name);
		return $obj;
	}
}
?>