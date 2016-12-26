<?php
class ModuleManagerDao{
	public $myBatis;
	
	public function queryPage($obj){
		return $this->myBatis->queryPage(__METHOD__,$obj);
	}
	
	public function queryPageCount($obj){
		return $this->myBatis->queryPageCount(__METHOD__,$obj);
	}
	
	public function query_Example($obj){
		return $this->myBatis->queryObjByObj(__METHOD__,$obj);
	}
	
	public function query_ExampleByVars($var1,$var2){
		$obj = $this->myBatis->queryObjByVars(__METHOD__,$var1,$var2);
		return $obj;
	}

	public function query_ExampleArr($obj){
		$obj = $this->myBatis->queryObjArrByObj(__METHOD__,$obj);
		return $obj;
	}
}
?>