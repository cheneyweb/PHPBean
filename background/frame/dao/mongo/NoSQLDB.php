<?php
	//MongoDB的数据库连接
	class NoSQLDB
	{
		var $conn;
		var $database;
		var $db;
		
		function NoSQLDB()
		{
			$this->database = 'test';
			$this->conn = new Mongo('127.0.0.1:27017');
			$this->db = $this->conn->selectDB($this->database);
		}
		
		function getDB()
		{
			return $this->db;
		}
		
		//该函数用来关闭数据库连接
		function close() 
		{
			//断开MongoDB连接
			$this->conn->close(); 
		}
	}
?>