<?php
/**
	 * @descriptor:	Struts类,用于映射表单对象和实体
	 * @author:		许宇帅
	 * @date:		2014年8月4日
	 */
class Struts {

	/**
	 * 动态POST组建Bean
	 * @return object
	 */
	public function genEntity() {
		// 获得实体名和实体文件名
		if (isset ( $_POST ['bean'] )) {
			$entityName = $_POST ['bean'];
			$entityFileName = '../entity/' . $entityName . '.php';
			
			// 根据实体名，动态载入和实例化相应实体类
			include_once $entityFileName;
			// 反射类
			$reflectionEntity = new ReflectionClass ( $entityName );
			// 实例化类
			$entity = $reflectionEntity->newInstance ();
			// 对实体进行数据填充
			foreach ( $_POST as $key => &$value ) {
				if ($key == 'bean') {
					continue;
				}
				if (! isEmpty ( $value )) {
					// 遍历类里面所有变量，赋值
					foreach ( $reflectionEntity->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
						if ($key == $prop->getName ()) {
							$prop->setValue ( $entity, $value );
						}
					}
				}
			}
			return $entity;
		}
	}
	// 
	/**
	 * 动态GET组建Bean
	 * @return object
	 */
	public function genEntityByGet() {
		// 获得实体名和实体文件名
		$entityName = $_GET ['bean'];
		$entityFileName = '../entity/' . $entityName . '.php';
		
		// 根据实体名，动态载入和实例化相应实体类
		include_once $entityFileName;
		// 反射类
		$reflectionEntity = new ReflectionClass ( $entityName );
		// 实例化类
		$entity = $reflectionEntity->newInstance ();
		// 对实体进行数据填充
		foreach ( $_GET as $key => &$value ) {
			if ($key == 'bean') {
				continue;
			}
			if (! empty ( $value )) {
			// 遍历类里面所有变量，赋值
				foreach ( $reflectionEntity->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
					if ($key == $prop->getName ()) {
						$prop->setValue ( $entity, $value );
					}
				}
			}
		}
		return $entity;
	}
}
?>