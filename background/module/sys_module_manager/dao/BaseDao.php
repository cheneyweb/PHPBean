<?php
/**
 * Dao基类
 * @author CheneyXu
 *
 */
class BaseDao {
	public $myBatis;
	/**
	 * 查询分页
	 * @param sqlmap
	 * @param 实体对象 $obj
	 * @return arr[obj]
	 */
	public function queryPage($obj) {
		// 继承类::方法名
		$sqlMap = get_called_class() . '::' . explode ( '::', __METHOD__ )[1];
		return $this->myBatis->queryPage ( $sqlMap, $obj );
	}
	/**
	 * 查询分页数量
	 * @param sqlmap
	 * @param 实体对象 $obj
	 * @return obj
	 */
	public function queryPageCount($obj) {
		// 继承类::方法名
		$sqlMap = get_called_class() . '::' . explode ( '::', __METHOD__ )[1];
		return $this->myBatis->queryPageCount ( $sqlMap, $obj );
	}
	/**
	 * 查询对象详情单个
	 * @param sqlmap
	 * @param 实体对象 $obj
	 * @return obj
	 */
	public function queryObj($obj) {
		// 继承类::方法名
		$sqlMap = get_called_class() . '::' . explode ( '::', __METHOD__ )[1];
		return $this->myBatis->queryObjByObj ( $sqlMap, $obj );
	}
	/**
	 * 查询对象详情数组
	 * @param sqlmap
	 * @param 实体对象 $obj
	 * @return arr[obj]
	 */
	public function queryArr($obj) {
		// 继承类::方法名
		$sqlMap = get_called_class() . '::' . explode ( '::', __METHOD__ )[1];
		return $this->myBatis->queryObjArrByObj ( $sqlMap, $obj );
	}
}
?>