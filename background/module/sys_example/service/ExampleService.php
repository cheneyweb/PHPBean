<?php
include_once BASEURL . 'background/module/sys_module_manager/service/BaseService.php';
include_once BASEURL . 'background/module/__example/entity/_Example.php';
/**
 * Service业务封装
 * @author 宇帅
 *
 */
class _ExampleService extends BaseService{
	public $_exampleDao;

	/**
	 * 分页查询(自定义SQL)
	 *
	 * @param 实体对象 $entity
	 * @return arr[objarr,query,返回结果]
	 */
	public function queryPage($entity) {
		$result = $this->_exampleDao->queryPage ( $entity );
		$query = $this->_exampleDao->queryPageCount ( $entity );

		$resp = array('result' => $result, 'query' => $query, 'respMsg' => 'Y');
		return $resp;
	}

	/**
	 * 查询数据Obj数组(自定义SQL)
	 * @param 实体对象 $entity
	 * @return arr[objarr,返回结果]
	 */
	public function query_ExampleArr($entity){
		$result = $this->_exampleDao->query_ExampleArr($entity);

		$resp = array('result' => $result, 'respMsg' => 'Y');
		return $resp;
	}

	/**
	 * 查询单个数据Obj(自定义SQL)
	 * @param 实体对象 $entity
	 * @return arr[obj,返回结果]
	 */
	public function query_Example($entity){
		$result = $this->_exampleDao->query_Example($entity);

		$resp = array('result' => $result, 'respMsg' => 'Y');
		return $resp;
	}
	/**
	 * 删除(通过ids批量删除)
	 *
	 * @param 实体对象 $entity
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