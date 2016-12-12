<?php
/**
 * Dao封装
 * @author 宇帅
 *
 */
class _ExampleDao {
	public $myBatis;
	/**
	 * 查询分页
	 * @param unknown $obj
	 */
	public function queryPage($obj) {
		return $this->myBatis->queryPage ( __METHOD__, $obj );
	}
	/**
	 * 查询分页数量
	 * @param unknown $obj
	 */
	public function queryPageCount($obj) {
		return $this->myBatis->queryPageCount ( __METHOD__, $obj );
	}
	/**
	 * 查询对象详情单个
	 * @param unknown $obj
	 */
	public function query_Example($obj) {
		return $this->myBatis->queryObjByObj ( __METHOD__, $obj );
	}
	/**
	 * 查询对象详情数组
	 * @param unknown $obj
	 * @return unknown
	 */
	public function query_ExampleArr($obj) {
		$obj = $this->myBatis->queryObjArrByObj ( __METHOD__, $obj );
		return $obj;
	}
	
	// 暂时未使用
	public function query_ExampleByVars($var1, $var2) {
		$obj = $this->myBatis->queryObjByVars ( __METHOD__, $var1, $var2 );
		return $obj;
	}
}
?>