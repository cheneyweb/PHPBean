<?php
	include 'NoSQLDB.php';
	
	class NoSQLDBUtil
	{
		//根据实体信息执行数据插入操作
		public function add($entity)
		{
			//创建数据库对象
			$mongodb = new NoSQLDB();
		
			//获取数据库
			$db = $mongodb->getDB();
			
			//反射获取实体信息
			$r = new ReflectionClass($entity);
			$entityName = get_class($entity);
			$entityVars = get_class_vars($entityName);
			$entityMethods = get_class_methods($entity);
			
			//选择db里面的$entity集合,即一个表对象对应一个集合
			$collection = $db->selectCollection($entityName);

			//循环生成插入对象
			$i = 1;
			$obj = array();
			foreach($entityVars as $key=>$value)
			{
				$ec = $r->getmethod($entityMethods[$i-1]);
				$value = $ec->invoke($entity);

				$obj = $obj + array($key => $value);

				$i++;
			}
			//插入数据对象
			$collection->insert($obj);
			//关闭数据库连接
			$mongodb->close();
		}
		
		//执行数据删除操作
		public function delete($entity)
		{
			//创建数据库对象
			$mongodb = new NoSQLDB();
		
			//获取数据库
			$db = $mongodb->getDB();
			
			//反射获取实体信息
			$r = new ReflectionClass($entity);
			$entityName = get_class($entity);
			$entityVars = get_class_vars($entityName);
			$entityMethods = get_class_methods($entity);
			
			//选择db里面的$entity集合,即一个表对象对应一个集合
			$collection = $db->selectCollection($entityName);

			//循环生成删除对象
			$i = 1;
			$obj = array();
			foreach($entityVars as $key=>$value)
			{
				$ec = $r->getmethod($entityMethods[$i-1]);
				$value = $ec->invoke($entity);
				
				if(!empty($value))
				{
					$obj = $obj + array($key => $value);
				}
				$i++;
			}
			//删除数据对象
			$collection->remove($obj);
			//关闭数据库连接
			$mongodb->close();
		}
		//执行数据更新操作
		public function update($entity)
		{
			//创建数据库对象
			$mongodb = new NoSQLDB();
		
			//获取数据库
			$db = $mongodb->getDB();
			
			//反射获取实体信息
			$r = new ReflectionClass($entity);
			$entityName = get_class($entity);
			$entityVars = get_class_vars($entityName);
			$entityMethods = get_class_methods($entity);
			
			//选择db里面的$entity集合,即一个表对象对应一个集合
			$collection = $db->selectCollection($entityName);

			//循环生成更新对象
			$i = 1;
			$obj = array();
			foreach($entityVars as $key=>$value)
			{
				$ec = $r->getmethod($entityMethods[$i-1]);
				$value = $ec->invoke($entity);
				
				if($i != 1)
				{
					$ec = $r->getmethod($entityMethods[$i-1]);
					$value = $ec->invoke($entity);
					
					$obj = $obj + array($key => $value);
				}
				$i++;
			}
			//更新数据对象
			$collection->update(array("u_name" => "admin"),$obj);//这里需要设置具体条件
			//关闭数据库连接
			$mongodb->close();
		}
		//执行数据查询操作
		public function query($entity)
		{
			//创建数据库对象
			$mongodb = new NoSQLDB();
		
			//获取数据库
			$db = $mongodb->getDB();
			
			//反射获取实体信息
			$r = new ReflectionClass($entity);
			$entityName = get_class($entity);
			$entityVars = get_class_vars($entityName);
			$entityMethods = get_class_methods($entity);
			
			//选择db里面的$entity集合,即一个表对象对应一个集合
			$collection = $db->selectCollection($entityName);
			
			//查询所有的记录
			$cursor = $collection->find();

			//遍历所有集合中的文档
			/*foreach ($cursor as $obj)
			{
				echo $obj["name"] . "\n";
				echo $obj["phone"] . "\n\n";
			}*/
			
			return $cursor;
			
			//关闭数据库连接
			$mongodb->close();
		}
	}
?>