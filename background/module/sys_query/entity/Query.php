<?php
/**
 * @author 宇帅
 * 分页查询基类
 */
class Query {
	// 起始点
	public $queryBegin;
	// 每次查询数量
	public $queryCount;
	// 页数
	public $pageCount;
	// 查询结果
	//public $queryResult;
	/**
	 * 查询初始化
	 */
	function Query() {
		if (empty ( $this->queryBegin )) {
			$this->queryBegin = 0;
		}
		if (empty ( $this->queryBegin )) {
			$this->queryCount = 10;
		}
		if (empty ( $this->pageCount )) {
			$this->pageCount = 0;
		}
		//$queryResult = 'Y';
	}
}
?>