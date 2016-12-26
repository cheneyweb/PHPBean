<?php
include_once BASEURL . 'background/module/sys_query/entity/Query.php';
/**
 * 实体对象(实体bean属性需要全部为public)
 * @author 宇帅
 *
 */
class Role extends Query{
	private static $tablePrefix='sys';// 实体表前缀
	public static function getTablePrefix(){return self::$tablePrefix;}
	
	public $id;
	public $code;
	public $name;
	public $operatorCreate;
	public $datetimeCreate;
	public $operatorModify;
	public $datetimeModify;

	// 拓展：权限ID逗号间隔
	public $permissionIds;
}
?>
