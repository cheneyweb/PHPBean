<?php
define("TOKEN", "weixin");
// 实例化微信平台
$wechatObj = new WechatCallbackApi();
// 校验或者响应
if (isset($_GET['echostr'])) {
	$wechatObj->valid();
}else{
	$wechatObj->responseMsg();
}

/**
 * CheneyWeb微信公众平台-订阅号
 */
class WechatCallbackApi
{
	// 签名校验
	public function valid(){
		$echoStr = $_GET["echostr"];
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}
	// 签名校验
	private function checkSignature(){
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];

		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	// 文字消息处理
	public function responseMsg(){
		// 获取请求数据
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)){
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$keyword = trim($postObj->Content);
			$time = time();
			$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
						</xml>";
			// 消息分离

			if($keyword == "1"){
				$contentStr = '请输入的您的计划安排:';
			}else{
				$contentStr = '您的计划安排如下:';
			}
			$msgType = "text";
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
		}
	}
}
?>