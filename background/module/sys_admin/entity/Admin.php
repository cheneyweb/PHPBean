<?php
include_once BASEURL . 'background/module/sys_query/entity/Query.php';
// 实体bean属性需要全部为public
class Admin extends Query{
	private static $tablePrefix='sys';// 实体表前缀
	public static function getTablePrefix(){return self::$tablePrefix;}
	
	public $id;
	public $account;
	public $password;
	public $operatorCreate;
	public $operatorModify;
	public $datetimeCreate;
	public $datetimeModify;
	
	// 拓展字段
	public $roleIds;// 角色ID，逗号间隔
	// 验证码
	public $captcha;
}
?>
