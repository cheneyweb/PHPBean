<?php
include_once BASEURL . 'background/module/sys_module_manager/service/BaseService.php';
include_once BASEURL . 'background/module/__example/entity/_Example.php';
/**
 * Service业务封装
 * @author 宇帅
 *
 */
class _ExampleService extends BaseService{
	public $pDOUtil;
	public $_exampleDao;

	/**
	 * 分页查询(自定义SQL)
	 *
	 * @param unknown $entity
	 * @return unknown
	 */
	public function queryPage($entity) {
		$result = $this->_exampleDao->queryPage ( $entity );
		$query = $this->_exampleDao->queryPageCount ( $entity );

		$resp = array('result' => $result, 'query' => $query);
		return $resp;
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
}
?>