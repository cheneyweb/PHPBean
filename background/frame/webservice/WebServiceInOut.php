<?php
/**
 * @author 宇帅
 * 将表转化为实体
 */
class WebServiceInOut {
	// 接口参数
	private $signKey = 'LIFE_SELECTION@CHENEY_XU';
	private $isInBase64 = true;
	private $isOutBase64 = false;
	private $isSign = true;
	private $isCompress = false;
	private $isEncrypt = true;
	
	/**
	 * 获取入参对象
	 */
	function getInObj() {
		//以下这一句header代码需要放置为所有代码的第一句，所以移动到了webservice中
		//header ( 'Content-Type:application/json;charset=utf-8' );
		// 获取参数列表
		// $argsArr = func_get_args ();
		// if (isset ( $argsArr [0] )) {
		// $this->isBase64 = $argsArr [0];
		// }
		// 请求入参数据
		$jsonReq = file_get_contents ( 'php://input' );
// 		Log::info ( '原始入参:' . $jsonReq );
		
		// 解析json,获取json请求和签名
		$jsonReq = json_decode ( $jsonReq );
		$sign = $jsonReq->sign;
		$jsonData = $jsonReq->jsonData;
		// 重新计算签名
		$newSign = sha1 ( $this->signKey . $jsonData );
// 		Log::info ( '请求入参:' . $jsonData );
// 		Log::info ( '旧签名:' . $sign );
// 		Log::info ( '新签名:' . $newSign );
		
		// 判断签名是否一致
		if ($this->isSign && $sign != $newSign) {
			return '非法请求调用';
		}
		
		// 如果需要特殊解密，则进行特殊解密
		if ($this->isEncrypt) {
			$jsonData = strrev ( $jsonData );
// 			Log::info ( '特殊解密:' . $jsonData );
		}
		
		// 如果入参是base64加密，则进行解码
		if ($this->isInBase64) {
			// base64解密
			$jsonData = base64_decode ( $jsonData );
// 			Log::info ( 'BASE64解密:' . $jsonData );
		}
		
		// 如果入参压缩，则解压入参数据
		if ($this->isCompress) {
			$jsonData = gzuncompress ( $jsonData );
// 			Log::info ( 'gzip解压:' . $jsonData );
		}
		
		// 解析json
		$obj = json_decode ( $jsonData );
		return $obj;
	}
	
	/**
	 * 获取出参对象
	 *
	 * @param 出参对象 $obj        	
	 */
	function getOutObj($obj) {
		// json编码
		$result = json_encode ( $obj, JSON_UNESCAPED_UNICODE );
// 		Log::info ( '出参数据' . $result );
		// 压缩出参
		if ($this->isCompress) {
			$result = gzcompress ( $result, 9 );
		}
		// base64加密
		if ($this->isOutBase64) {
			$result = base64_encode ( $result );
			// 特殊加密
			if ($this->isEncrypt) {
				$result = strrev ( $result );
			}
		}
		$result = str_replace(PHP_EOL,'',$result);
		return $result;
	}
}
