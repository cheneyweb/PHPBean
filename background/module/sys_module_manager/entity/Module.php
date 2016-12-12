<?php
include_once BASEURL . 'background/module/sys_query/entity/Query.php';
// 实体bean属性需要全部为public
class Module extends Query{
	private static $tablePrefix='sys';// 实体表前缀
	public static function getTablePrefix(){return self::$tablePrefix;}
	
	public $id;
	public $code;
	public $name;
	public $datetimeCreate;
}
?>
