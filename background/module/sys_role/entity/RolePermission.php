<?php
// 实体bean属性需要全部为public
class RolePermission{
	private static $tablePrefix='sys';// 实体表前缀
	public static function getTablePrefix(){return self::$tablePrefix;}
	
	public $id;
	public $roleId;
	public $permissionId;
	public $datetimeCreate;
}
?>
