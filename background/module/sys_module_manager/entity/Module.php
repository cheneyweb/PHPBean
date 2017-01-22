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

	// 拓展字段，如果开启了属性自动校验，进行数据库操作前拓展字段会被自动置空；如果没有开启属性自动校验，使用完毕需要置空才能使用实体对象进行数据库操作
	// 数据结构：arr[{name:'',type:'',comment:''}]
	public $columns;
}
?>
