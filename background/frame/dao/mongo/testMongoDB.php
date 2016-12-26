<?php
	include 'NoSQLDB.php';
	
	$mongodb = new NoSQLDB();
	$db = $mongodb->getDB();
	
	//选择db里面的collection集合
	$collection = $db->collection;
	$db->selectCollection("collection");
	
	//新增
	$obj = array("name" => "许宇帅","phone" => "13647561616" );
	$collection->insert($obj);
	
	//修改
	$newdata = array("name" => "打字员","phone" => "13647561616" );
	$collection->update(array("name" => "许宇帅"), $newdata);   

	
	//删除
	//$collection->remove(array('name'=>'许宇帅'));

	//查找一条   
	//$user = $collection->findOne(array('name' => '许宇帅'));   


	//查询所有的记录
	$cursor = $collection->find();

	//遍历所有集合中的文档
	foreach ($cursor as $obj)
	{
		echo $obj["name"] . "\n";
		echo $obj["phone"] . "\n\n";
	}
	
	//删除所有数据
	//$collection->remove();
	//删除集合
	//$collection->drop();
	
	//断开MongoDB连接
	$mongodb->close();
?>
