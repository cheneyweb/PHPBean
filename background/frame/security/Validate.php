<?php
	/**
	 * @descriptor:	数据校验类
	 * @author:		CheneyXu
	 * @date:		2014年8月4日
	 */
	class Validate
	{
		//验证是否为指定长度的字母/数字组合
		public function isSpecifiedMixLength($num1,$num2,$str)
		{
			return(preg_match("/^[a-zA-Z0-9]{".$num1.",".$num2."}$/",$str))?true:false;
		}
		//验证是否为指定长度数字
		public function isSpecifiedNumberLength()
		{
			return (preg_match("/^[0-9]{".$num1.",".$num2."}$/i",$str))?true:false;
		}
		//验证是否为指定长度汉字
		public function isSpecifiedWordLength($num1,$num2,$str)
		{
			// preg_match("/^[\xa0-\xff]{1,4}$/", $string);
			return (preg_match("/^([\x81-\xfe][\x40-\xfe]){".$num1.",".$num2."}$/",$str))?true:false;
		}
		//验证身份证号码
		public function isIDNO($str)
		{
			return (preg_match("/(^([\d]{15}|[\d]{18}|[\d]{17}x)$)/",$str))?true:false;
		}
		//验证邮件地址
		public function isEmail($str)
		{
			return (preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$/",$str))?true:false;
		}
		//验证电话号码
		public function isPhone($str)
		{
		  return (preg_match("/1[3458]{1}\d{9}$/",$str))?true:false;
		}
		//验证邮编
		public function isZip($str)
		{
		  return (preg_match("/^[1-9]\d{5}$/",$str))?true:false;
		}
		//验证url地址
		public function isURL($str)
		{
		  return (preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/",$str))?true:false;
		}
		//验证银行账号
		public function isBankAccount($str){
			return (preg_match("/^\d{16,20}$/",$str))?true:false;
		}
	}
?>