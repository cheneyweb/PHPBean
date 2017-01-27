<?php
include_once BASEURL . 'background/module/sys_module_manager/dao/BaseDao.php';

/**
 * Dao封装
 * @author CheneyXu
 *
 */
class RoleDao extends BaseDao{
	// 暂时未使用
	public function queryByVars($var1, $var2) {
		$obj = $this->myBatis->queryObjByVars ( __METHOD__, $var1, $var2 );
		return $obj;
	}
}
?>