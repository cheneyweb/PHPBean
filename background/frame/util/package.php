<?php
/**
 * 导入Action并执行
 * @param 模块全称 $moduleName
 * @param 控制器实例名称 $actionName
 */
function import($moduleName, $actionName) {
	// 是否自动开启session
	// ini_set('session.auto_start', 1);
	// LOG级别设定
	error_reporting ( E_ALL );// 所有错误
	ini_set ( 'log_errors', 1 );// 打开日志文件
	$logfilename = date ( 'y_m_d', time () ) . '_runtime.txt';// 日志文件名
	ini_set ( 'error_log', BASEURL .'log/'. $logfilename );// 日志文件路径
	ini_set ( 'display_errors', 'On' );// 前端显示错误

	// Log::info($moduleName . ':' . $actionName);
	// header('Content-Type:application/json;charset=utf-8');
	// $baseUrl = $_SERVER['DOCUMENT_ROOT'].'/phpbean/';
	// 载入Spring工厂文件
	include_once BASEURL . 'background/frame/spring/BeanFactory.php';
	// 载入spring.xml配置文件
	BeanFactory::init ( BASEURL, "background/module/" . $moduleName . "/config/spring.xml" );

	// IOC依赖注入生成Action的Bean
	$action = BeanFactory::getNewBeanByName ( $actionName );
	$action->execute ();
}

/**
 * 判断变量是否为空
 *
 * @param 变量 $var
 * @return boolean
 */
function isEmpty($var) {
	if ($var === null || $var === '') {
		return true;
	}
	return false;
}

/**
 * 将驼峰命名转化为下划线命名
 *
 * @param 驼峰法命名字符串 $name
 * @return 下划线间隔字符串
 */
function formatPHPStyle($name) {
	$temp_array = array ();
	for($i = 0; $i < strlen ( $name ); $i ++) {
		$ascii_code = ord ( $name [$i] );
		if ($ascii_code >= 65 && $ascii_code <= 90) {
			if ($i == 0) {
				$temp_array [] = chr ( $ascii_code + 32 );
			} else {
				$temp_array [] = '_' . chr ( $ascii_code + 32 );
			}
		} else {
			$temp_array [] = $name [$i];
		}
	}
	return implode ( '', $temp_array );
}

/**
 * 格式化字符串为Java驼峰命名法
 *
 * @param 下划线间隔字符串 $str
 * @param 是否首字母大写
 * @return 驼峰法命名字符串
 */
function formatJavaStyle($str, $isUcfirst) {
	$str = explode ( '_', $str );
	foreach ( $str as $key => $val ) {
		$str [$key] = ucfirst ( $val );
	}
	if ($isUcfirst) {
		$str [0] = ucfirst ( $str [0] );
	} else {
		$str [0] = lcfirst ( $str [0] );
	}
	return implode ( '', $str );
}

/**
 * 转换普通对象成JavaBean风格的对象
 *
 * @param  $obj
 * @return entity
 */
function parseToEntity($obj) {
  if (is_object($obj)) {
  	$entity = new StdClass();
    foreach ($obj as $key => $value) {
    	$newKey = formatJavaStyle($key,false);
    	$entity->$newKey = $value;
    }
  }else {
    $entity = $obj;
  }
  return $entity;
}

/**
 * 转换数组成JavaBean风格对象
 *
 * @param  $arr
 * @return obj
 */
function arrToObj($arr) {
  if (is_array($arr)) {
  	$obj = new StdClass();
  	foreach ($arr as $key => $val){
  		$newKey = formatJavaStyle($key,false);
  		$obj->$newKey = $val;
  	}
  }else {
  	$obj = $arr;
  }
  return $obj;
}

/**
 * 日志操作类
 *
 * @author CheneyXu
 *
 */
class Log {
	const INFO = '【INFO】';
	const ERRO = '【ERRO】';
	public static function info($msg) {
		$filename = date ( 'y_m_d', time () ) . '_info.txt';
		$logContent = date ( 'y-m-d h:i:s', time () );
		$logContent .= Log::INFO;
		$logContent .= $msg;
		file_put_contents ( $_SERVER ['DOCUMENT_ROOT'] . '/log/' . $filename, $logContent . PHP_EOL, FILE_APPEND );
	}
	public static function error($msg) {
		$filename = date ( 'y_m_d', time () ) . '_error.txt';
		;
		$logContent = date ( 'y-m-d h:i:s', time () );
		$logContent .= Log::ERRO;
		$logContent .= $msg;
		file_put_contents ( $_SERVER ['DOCUMENT_ROOT'] . '/log/' . $filename, $logContent . PHP_EOL, FILE_APPEND );
	}
}

/**
 * 获取以时间为基础生成的编码(前缀+时间+流水号)
 *
 * @param 前缀名称 $prefix
 * @return 编码
 */
function getTimeCode($prefix) {
	// 保存流水号的文件名，只要将这个文件删去流水号就重新开始
	// $serialFile = $_SERVER ['DOCUMENT_ROOT'] . '/log/' . $prefix.'_serial.txt';
	// $fp = fopen($serialFile , 'w+');
	// flock($fp, LOCK_EX );
	// $serialNum = fread($fp,filesize($serialFile)+1);
	// if($serialNum < 999){
	// fwrite($fp, $serialNum = sprintf("%03d", ++$serialNum));
	// }else{
	// unlink($serialFile);
	// $serialNum = sprintf("%03d", ++$serialNum);
	// }
	// flock($fp, LOCK_UN);
	// fclose($fp);
	$serialFile = $_SERVER ['DOCUMENT_ROOT'] . '/log/' . $prefix . '_serial.txt';
	$serialNum = @file_get_contents ( $serialFile ) or $serialNum = 0;
	if ($serialNum < 998) {
		file_put_contents ( $serialFile, $serialNum = sprintf ( "%03d", ++ $serialNum, LOCK_EX ) );
	} else {
		unlink ( $serialFile );
		$serialNum = sprintf ( "%03d", ++ $serialNum );
	}
	return $prefix . date ( 'ymd', time () ) . $serialNum;
}
?>