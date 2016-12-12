<?php
include_once BASEURL . 'background/module/__example/entity/_Example.php';
/**
 * Service业务封装
 * @author 宇帅
 *
 */
class _ExampleService {
	public $pDOUtil;
	public $_exampleDao;
	
	/**
	 * 分页查询(自定义SQL)
	 * @param unknown $entity
	 * @return unknown
	 */
	public function queryPage($entity) {
		$result = $this->_exampleDao->queryPage ( $entity );
		return $result;
	}
	public function queryPageCount($entity) {
		$result = $this->_exampleDao->queryPageCount ( $entity );
		return $result;
	}
	
	/**
	 * 查询数据Obj数组(自定义SQL)
	 * @param unknown $entity
	 * @return unknown(查询不到时返回null)
	 */
	public function query_ExampleArr($entity){
		$result = $this->_exampleDao->query_ExampleArr($entity);
		return $result;
	}
	
	/**
	 * 查询单个数据Obj(自定义SQL)
	 * @param 实体 $entity
	 * @return unknown(查询不到时返回null)
	 */
	public function query_Example($entity){
		$result = $this->_exampleDao->query_Example($entity);
		return $result;
	}
	
	/**
	 * 查询数据Obj数组
	 * @param unknown $entity
	 * @return unknown(查询不到时返回null)
	 */
	public function queryArr($entity) {
		$result = $this->pDOUtil->queryArr ( $entity );
		return $result;
	}
	
	/**
	 * 查询单个数据Obj
	 * @param 实体 $entity
	 * @return unknown(查询不到时返回null)
	 */
	public function queryObj($entity) {
		$result = $this->pDOUtil->queryObj ( $entity );
		return $result;
	}
	
	/**
	 * 插入单个数据对象
	 * @param unknown $entity
	 * @return boolean
	 */
	public function insert($entity) {
		$this->pDOUtil->insert ( $entity );
		// 结果判断
		if (empty ( $entity->id )) {
			return false;
		}
		return true;
	}
	
	/**
	 * 删除单个数据对象
	 *
	 * @param unknown $entity
	 * @return boolean
	 */
	public function delete($entity) {
		$this->pDOUtil->delete ( $entity );
		return true;
	}
	
	/**
	 * 删除(通过ids批量删除)
	 *
	 * @param unknown $entity
	 * @return boolean
	 */
	public function deleteByIds($ids) {
		// 循环删除记录
		foreach ($ids as $id){
			$entity = new _Example();
			$entity->id = $id;
			$this->pDOUtil->delete ( $entity );
		}
		return true;
	}
	
	/**
	 * 更新
	 *
	 * @param unknown $entity
	 * @return boolean
	 */
	public function update($entity) {
		$this->pDOUtil->update ( $entity, null );
		return true;
	}
}
?>