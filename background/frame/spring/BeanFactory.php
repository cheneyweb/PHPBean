<?php
/**
  * @descriptor:	Spring的Bean工厂类
  * @author:		CheneyXu
  * @date:			2014年8月4日
  */
class BeanFactory {
	private static $app; // application.xml文件解析对象
	private static $includeFile = false;
	private static $hostPath;
	private static $filePath;
	/**
	 *
	 * @param String $filePath
	 *        	配置文件路径
	 */
	public static function init($hostPath, $filePath) {
		if (! $hostPath) {
			$hostPath = "/";
		}
		/* 获取application.xml解析后的对象 */
		self::$app = new applicationXMLforObject ( $hostPath . $filePath );

		self::$hostPath = $hostPath;
		self::$filePath = $filePath;
	}

	/**
	 * 获取想要的对象通过 指定 类的名字
	 * 想要从application.xml文件描述的类中获得想要的对象
	 *
	 * @package String $className 类的名字（bean的id值）
	 */
	public static function getNewBeanByName($className) {
		// 将类名首字母小写
		$className = lcfirst ( $className );

		// 增加过滤开始,仅加载需要的类文件
		foreach ( self::$app->getBeanConfigList ( "bean" ) as $o ) {
			if ($o->getId () == $className) {
				$classPath = $o->getClass ();
				include_once self::$hostPath . $classPath;
			}
		}
		self::$includeFile = true;
		// 增加过滤结束
		if (! self::$includeFile) {
			return;
		}
		// 遍历spring.xml配置文件，查看是否存在与$className匹配的id的值
		if (! self::$app->getBeanById ( $className )) {
			return;
		}
		// 获取反射类
		$refle = new ReflectionClass ( $className );
		// 实例化反射类
		$beanObj = self::newObj ( $refle );
		// 遍历反射类内部所有动态变量，注入对象
		foreach ( $refle->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
			// 递归注入
			$prop->setValue ( $beanObj, self::getNewBeanByName ( $prop->getName () ) );
		}
		return $beanObj;
	}
	/**
	 * 创建对象 指定id 所对应的类的对象
	 *
	 * @param $refle $refle
	 *        	= new ReflectionClass ($className);
	 * @return BeanObj / false;
	 */
	private static function newObj($refle) {
		try {
			if ($refle->isInstantiable ()) {
				return $refle->newInstance ();
			} else {
				return false;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e . "  没有引入类文件！" );
		}
	}
}

/**
 * 执行指定类的指定方法
 */
class ClassOneDelegator {
	private $targets;
	function __construct($obj) {
		$this->target [] = $obj;
	}
	function __call($name, $args) {
		foreach ( $this->target as $obj ) {
			$r = new ReflectionClass ( $obj );
			if ($method = $r->getMethod ( $name )) {
				if ($method->isPublic () && ! $method->isAbstract ()) {
					return $method->invoke ( $obj, $args );
				}
			}
		}
	}
}
/**
 * bean标签对应的实体
 */
class BeanConfig {
	private $id;
	private $class;
	/**
	 *
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}
	/**
	 *
	 * @return the $class
	 */
	public function getClass() {
		return $this->class;
	}
	/**
	 *
	 * @param $id the
	 *        	$id to set
	 */
	public function setId($id) {
		$this->id = $id;
	}
	/**
	 *
	 * @param $class the
	 *        	$class to set
	 */
	public function setClass($class) {
		$this->class = $class;
	}
}

/**
 * 解析指定的XML配置文件
 */
class applicationXMLforObject {
	private $filePath;
	private $xml;
	private $beanConfig;
	private static $beanArr = null;
	/**
	 * 构造函数
	 *
	 * @param $filePath 指定XML配置文件路径
	 */
	function __construct($filePath) {
		if (file_exists ( $filePath )) {
			// 加载xml文件
			$this->filePath = $filePath;
			$this->xml = new DOMDocument ();
			$this->xml->load ( $filePath );
			// 实例化所有bean对象
			self::$beanArr = $this->getBeanConfigList ( "bean" );
		} else {
			$o = new ReflectionClass ( "applicationXMLforObject" );
			throw new Exception ( " [ " . $o->getName () . " 找不到要解析XML文件  ] " );
		}
	}
	/**
	 * 通过配置文件中标签bean的属性id获得一个对应的实体bean
	 *
	 * @return the $beanId
	 */
	public function getBeanById($beanId) {
		if (self::$beanArr) {
			return self::$beanArr [$beanId];
		} else {
			throw new Exception ( " [bean列表为空!] " );
		}
	}
	/**
	 * 获得所有bean标签的实体对象
	 *
	 * @param unknown_type $tag
	 */
	public function getBeanConfigList($tag) {
		// 获取所有的$tag标签
		$tagDom = $this->xml->getElementsByTagName ( $tag );
		$beanArr = array ();
		foreach ( $tagDom as $node ) {
			$this->beanConfig = new BeanConfig ();
			if ($node->attributes->item ( 0 )->nodeName == "id" && $node->attributes->item ( 1 )->nodeName == "class") {
				$this->beanConfig->setId ( $node->attributes->item ( 0 )->nodeValue );
				$this->beanConfig->setClass ( $node->attributes->item ( 1 )->nodeValue );
				$beanArr [$node->attributes->item ( 0 )->nodeValue] = $this->beanConfig;
			}
		}
		return $beanArr;
	}
}
?>
