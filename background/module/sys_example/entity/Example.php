<?php
include_once BASEURL . 'background/module/sys_query/entity/Query.php';
/**
 * 实体对象(实体bean属性需要全部为public)
 * @author 宇帅
 *
 */
class _Example extends Query{
	private static $tablePrefix='$_tablePrefix';// 实体表前缀
	public static function getTablePrefix(){return self::$tablePrefix;}
public $_extendsFields;
}
?>
