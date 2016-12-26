<?php
/**
 * @author 宇帅
 * MyBatis实现
 */
class MyBatis {
	
	public $pDOUtil;
	private $baseUrl;
	
	/**
	 * 构造函数
	 */
	public function MyBatis(){
		$this->baseUrl = BASEURL;
		//$this->baseUrl = $_SERVER ['DOCUMENT_ROOT'].'/';
	}
	
	/**
	 * 通过Obj入参查询单个Obj对象
	 */
	public function queryObjByObj() {
		// 获取参数列表
		$argsArr = func_get_args ();
		$sqlMap = explode ( '::', $argsArr [0] )[0] . '_SQL'; // sqlMap名称
		$sqlId = explode ( '::', $argsArr [0] )[1]; // sqlMap中对应的sql语句
		$obj = $argsArr [1]; // 传入对象入参
		$module = self::getModuleName($sqlMap,$obj);// 模块名称
		
		$preSql = '';
		$doc = new DOMDocument ();
		// 载入SQL的XML文件
		$doc->load ( $this->baseUrl . 'background/module/' . $module . '/dao/' . $sqlMap . '.xml' );
		
		$selects = $doc->getElementsByTagName ( 'select' );
		$includes = $doc->getElementsByTagName ( 'include' );
		
		$parameterType = '';
		$resultType = '';
		
		// 循环所有select
		foreach ( $selects as $select ) {
			// 匹配sqlId
			if ($select->getAttribute ( 'id' ) == $sqlId) {
				// 组装include
				$oldIncludes = $select->getElementsByTagName ( 'include' );
				foreach ( $oldIncludes as $oldInclude ) {
					foreach ( $includes as $include ) {
						if ($oldInclude->getAttribute ( 'refid' ) == $include->getAttribute ( 'id' )) {
							// 属性控制
							self::propertyControl ( $select, $include, $oldInclude, $obj );
							break;
						}
					}
				}
				$parameterType = $select->getAttribute ( 'parameterType' );
				$resultType = $select->getAttribute ( 'resultType' );
				$preSql = $select->nodeValue;
				break;
			}
		}
		// 绑定参数并执行
		return $this->pDOUtil->bindParamAndExecForObj ( $preSql, $obj, false );
	}
	/**
	 * 通过Obj入参查询单个Obj对象数组
	 */
	public function queryObjArrByObj() {
		// 获取参数列表
		$argsArr = func_get_args ();
		$sqlMap = explode ( '::', $argsArr [0] )[0] . '_SQL'; // sqlMap名称
		$sqlId = explode ( '::', $argsArr [0] )[1]; // sqlMap中对应的sql语句
		$obj = $argsArr [1]; // 传入对象入参
		$module = self::getModuleName($sqlMap,$obj);// 模块名称
		
		$preSql = '';
		$doc = new DOMDocument ();
		// 载入SQL的XML文件
		$doc->load ( $this->baseUrl . 'background/module/' . $module . '/dao/' . $sqlMap . '.xml' );
		
		$selects = $doc->getElementsByTagName ( 'select' );
		$includes = $doc->getElementsByTagName ( 'include' );
		
		$parameterType = '';
		$resultType = '';
		
		// 循环所有select
		foreach ( $selects as $select ) {
			// 匹配sqlId
			if ($select->getAttribute ( 'id' ) == $sqlId) {
				// 组装include
				$oldIncludes = $select->getElementsByTagName ( 'include' );
				foreach ( $oldIncludes as $oldInclude ) {
					foreach ( $includes as $include ) {
						if ($oldInclude->getAttribute ( 'refid' ) == $include->getAttribute ( 'id' )) {
							// 属性控制
							self::propertyControl ( $select, $include, $oldInclude, $obj );
							break;
						}
					}
				}
				$parameterType = $select->getAttribute ( 'parameterType' );
				$resultType = $select->getAttribute ( 'resultType' );
				$preSql = $select->nodeValue;
				break;
			}
		}
		// 绑定参数并执行
		return $this->pDOUtil->bindParamAndExecForObjArr ( $preSql, $obj, false );
	}
	/**
	 * 分页查询
	 */
	public function queryPage() {
		// 获取参数列表
		$argsArr = func_get_args ();
		$sqlMap = explode ( '::', $argsArr [0] )[0] . '_SQL'; // sqlMap名称
		$sqlId = explode ( '::', $argsArr [0] )[1]; // sqlMap中对应的sql语句
		$obj = $argsArr [1]; // 传入对象入参
		$module = self::getModuleName($sqlMap,$obj);// 模块名称
	
		$preSql = '';
		$doc = new DOMDocument ();
		// 载入SQL的XML文件
		$doc->load ( $this->baseUrl . 'background/module/' . $module . '/dao/' . $sqlMap . '.xml' );
	
		$selects = $doc->getElementsByTagName ( 'select' );
		$includes = $doc->getElementsByTagName ( 'include' );
	
		$parameterType = '';
		$resultType = '';
		// 循环所有select
		foreach ( $selects as $select ) {
			// 匹配sqlId
			if ($select->getAttribute ( 'id' ) == $sqlId) {
				// 组装include
				$oldIncludes = $select->getElementsByTagName ( 'include' );
				foreach ( $oldIncludes as $oldInclude ) {
					foreach ( $includes as $include ) {
						if ($oldInclude->getAttribute ( 'refid' ) == $include->getAttribute ( 'id' )) {
							// 属性控制
							self::propertyControl ( $select, $include, $oldInclude, $obj );
							break;
						}
					}
				}
				$parameterType = $select->getAttribute ( 'parameterType' );
				$resultType = $select->getAttribute ( 'resultType' );
				$preSql = $select->nodeValue;
				break;
			}
		}
		// 处理分页参数
		$preSql = self::processQueryParam($preSql,$obj);
		// 绑定参数并执行
		return $this->pDOUtil->bindParamAndExecForPage ( $preSql, $obj, false );
	}
	/**
	 * 分页数量查询
	 */
	public function queryPageCount(){
		// 获取参数列表
		$argsArr = func_get_args ();
		$sqlMap = explode ( '::', $argsArr [0] )[0] . '_SQL'; // sqlMap名称
		$sqlId = explode ( '::', $argsArr [0] )[1]; // sqlMap中对应的sql语句
		$obj = $argsArr [1]; // 传入对象入参
		$module = self::getModuleName($sqlMap,$obj);// 模块名称
		
		$preSql = '';
		$doc = new DOMDocument ();
		// 载入SQL的XML文件
		$doc->load ( $this->baseUrl . 'background/module/' . $module . '/dao/' . $sqlMap . '.xml' );
		
		$selects = $doc->getElementsByTagName ( 'select' );
		$includes = $doc->getElementsByTagName ( 'include' );
		
		$parameterType = '';
		$resultType = '';
		
		// 循环所有select
		foreach ( $selects as $select ) {
			// 匹配sqlId
			if ($select->getAttribute ( 'id' ) == $sqlId) {
				// 组装include
				$oldIncludes = $select->getElementsByTagName ( 'include' );
				foreach ( $oldIncludes as $oldInclude ) {
					foreach ( $includes as $include ) {
						if ($oldInclude->getAttribute ( 'refid' ) == $include->getAttribute ( 'id' )) {
							// 属性控制
							self::propertyControl ( $select, $include, $oldInclude, $obj );
							break;
						}
					}
				}
				$parameterType = $select->getAttribute ( 'parameterType' );
				$resultType = $select->getAttribute ( 'resultType' );
				$preSql = $select->nodeValue;
				break;
			}
		}
		// 处理分页参数
		$preSql = self::processQueryParam($preSql,$obj);
		// 绑定参数并执行
		return $this->pDOUtil->bindParamAndExecForPageCount ( $preSql, $obj, false );
	}

	/**
	 * 获取对象属性值
	 * @param unknown $obj 对象
	 * @param unknown $propertyName 属性名
	 */
	function getObjValue($obj, $propertyName) {
		// 反射获取实体的属性
		$r = new ReflectionClass ( $obj );
		// 循环每个实体属性，绑定到SQL变量参数
		$varArr = array ();
		foreach ( $r->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
			$key = $prop->getName ();
			// 判断是否是该变量
			if ($key == $propertyName) {
				return $prop->getValue ( $obj );
			}
		}
	}
	/**
	 * 属性控制（判断是否为空）
	 * @param unknown $select
	 * @param unknown $include
	 * @param unknown $oldInclude
	 * @param unknown $obj
	 */
	function propertyControl($select, $include, $oldInclude, $obj) {
		$tempAttr = array ();
		$isNotEmptys = $include->getElementsByTagName ( 'isNotEmpty' );
		foreach ( $isNotEmptys as $isNotEmpty ) {
			$propertyValue = self::getObjValue ( $obj, $isNotEmpty->getAttribute ( 'property' ) );
			if ($propertyValue == null || $propertyValue == '') {
				$tempAttr [] = $isNotEmpty;
			}
		}
		$isEmptys = $include->getElementsByTagName ( 'isEmpty' );
		foreach ( $isEmptys as $isEmpty ) {
			$propertyValue = self::getObjValue ( $obj, $isEmpty->getAttribute ( 'property' ) );
			if ($propertyValue != null && $propertyValue != '') {
				$tempAttr [] = $isEmpty;
			}
		}
		foreach ( $tempAttr as $temp ) {
			$include->removeChild ( $temp );
		}
		$select->replaceChild ( $include, $oldInclude );
	}
	
	/**
	 * 处理分页参数
	 * @param unknown $preSql
	 * @param unknown $obj
	 * @return mixed
	 */
	function processQueryParam($preSql,$obj){
		$preSql = str_replace('queryBegin=:queryBegin', $obj->queryBegin, $preSql);
		$preSql = str_replace('queryCount=:queryCount', $obj->queryCount, $preSql);
		return $preSql;
	}
	
	/**
	 * 获取模块前缀
	 * @param unknown $preSql
	 * @param unknown $obj
	 * @return mixed
	 */
	function getModuleName($sqlMap,$obj){
// 		$prefix='';
		$prefix = $obj->getTablePrefix() . '_';// 模块前缀
		$module = formatPHPStyle( substr ( $sqlMap, 0, strpos ( $sqlMap, 'Dao' ) ) ); // 模块名称
		return $prefix . $module;
	}
}
?>