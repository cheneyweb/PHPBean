
<?php
include_once 'SQLUtil.php';
/**
 *
 * @author 宇帅
 *         PDO工具类，用于数据库连接和基本底层查询操作
 */
class PDOUtil {
	
	private $dbms = 'mysql'; // 数据库类型
	private $host = 'localhost';
	private $port = '3306';
	private $dbName = 'phpbean'; // 使用的数据库
	private $user = 'root'; // 数据库连接用户名
	private $pass = 'root'; // 对应的密码*/
	/*
	private $dbms = 'mysql'; // 数据库类型
	private $host = '10.9.1.188';
	private $port = '3306';
	private $dbName = 'cf_9448aa5c_be6c_44a7_a6ac_06724c6c64f1'; // 使用的数据库
	private $user = 'WkWI7DEU6Fwf2lMF'; // 数据库连接用户名
	private $pass = 'l87pfC90Sg3EmbZv'; // 对应的密码
	/*
	private $dbms = 'mysql'; // 数据库类型
	private $host = 'sqld.duapp.com';
	private $port = '4050';
	private $dbName = 'EHgZAvGUSqCLTqnBjfbM'; // 使用的数据库
	private $user = 'ee26199adfea4b279e5c90425cd6f571'; // 数据库连接用户名
	private $pass = '596b4319505d46dd8a4ebb193d759d49'; // 对应的密码*/
	
	private $dbh; // 数据库连接
	
	/**
	 * 构造函数，数据库连接
	 */
	public function PDOUtil() {
		$dsn = $this->dbms . ':host=' . $this->host . ';' . 'port=' . $this->port . ';' . 'dbname=' . $this->dbName;
		try {
			$this->dbh = new PDO ( $dsn, $this->user, $this->pass );
			// 设置utf8编码
			$this->dbh->query ( 'set names utf8' );
			$this->dbh->query ( 'set character set utf8' );
		} catch ( PDOException $e ) {
			die ( 'Error!: ' . $e->getMessage () . '<br/>' );
		}
	}
	/**
	 * 获取连接
	 *
	 * @return Ambigous <NULL, PDO>
	 */
	public function getConnection() {
		return $this->dbh;
	}
	/**
	 * 关闭数据库连接
	 */
	public function close() {
		$this->dbh = null;
	}
	/**
	 * 插入数据
	 *
	 * @param 实体 $entity
	 */
	public function insert($entity) {
		// 根据实体初始化SQL
		$sql = SQLUtil::insertSQL ( $entity );
		// 绑定参数并执行
		$this->bindParam ( $sql, $entity, false );
		// 将新插入的id返回
		$entity->id = $this->dbh->lastInsertId ();
	}
	/**
	 * 删除数据
	 *
	 * @param 实体 $entity        	
	 */
	public function delete($entity) {
		$sql = SQLUtil::deleteSQL ( $entity );
		$this->bindParam ( $sql, $entity, false );
	}
	
	/**
	 * 更新数据（NULL不更新）
	 *
	 * @param 实体 $entity        	
	 * @param 条件 $query        	
	 */
	public function update($entity, $query) {
		$sql = SQLUtil::updateSQL ( $entity, $query );
		$this->bindParam ( $sql, $entity, false );
	}
	/**
	 * 更新数据（NULL也更新）
	 *
	 * @param 实体 $entity        	
	 * @param 条件 $query        	
	 */
	public function updateAll($entity, $query) {
		$sql = SQLUtil::updateAllSQL ( $entity, $query );
		$this->bindParam ( $sql, $entity, true );
	}
	/**
	 * 查询数据Obj数组
	 *
	 * @param 实体 $entity        	
	 */
	public function queryArr($entity) {
		$sql = SQLUtil::selectSQL ( $entity );
		return $this->bindParamAndExecForObjArr ( $sql, $entity, false );
	}
	
	/**
	 * 查询单个数据Obj
	 *
	 * @param 实体 $entity        	
	 */
	public function queryObj($entity) {
		$sql = SQLUtil::selectSQL ( $entity );
		return $this->bindParamAndExecForObj ( $sql, $entity, false );
	}
	
	/**
	 * 反射获取实体属性值入参
	 *
	 * @param SQL语句 $sql        	
	 * @param 实体 $entity        	
	 * @param 是否全参数 $isFullBind        	
	 */
	private function getStmtVarArr($entity, $isFullBind) {
		// 反射获取实体的属性
		$r = new ReflectionClass ( $entity );
		$varArr = array ();
		// 循环每个实体属性，绑定到SQL变量参数
		foreach ( $r->getProperties ( ReflectionProperty::IS_PUBLIC ) as $prop ) {
			$key = $prop->getName ();
			$value = $prop->getValue ( $entity );
			// 生成绑定数组
			if (! isEmpty ( $value ) && $key != 'queryBegin' && $key != 'queryCount' && $key != 'pageCount' && $key != 'queryResult' || $isFullBind) {
				$varArr += array (
						':' . $key => $value 
				);
			}
		}
		return $varArr;
	}
	
	/**
	 * 绑定SQL参数
	 *
	 * @param SQL语句 $sql        	
	 * @param 实体 $entity        	
	 * @param 是否全参数 $isFullBind        	
	 */
	private function bindParam($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->execute ( $varArr );
	}
	/**
	 * 绑定参数并查询Obj数组
	 *
	 * @param unknown $sql        	
	 * @param unknown $entity        	
	 * @param unknown $isFullBind        	
	 * @return multitype:
	 */
	public function bindParamAndExecForObjArr($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->execute ( $varArr );
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		return $stmt->fetchAll (); // 获取数据对象数组
	}
	/**
	 * 绑定参数并查询单个Obj
	 *
	 * @param unknown $sql        	
	 * @param unknown $entity        	
	 * @param unknown $isFullBind        	
	 * @return mixed
	 */
	public function bindParamAndExecForObj($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->execute ( $varArr );
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		$result = $stmt->fetch ();
		if ($result != null) {
			return ( array ) $result; // 获取数据对象
		} else {
			return null;
		}
	}
	/**
	 * 绑定参数并查询分页
	 *
	 * @param unknown $sql        	
	 * @param unknown $entity        	
	 * @param unknown $isFullBind        	
	 * @return multitype:
	 */
	public function bindParamAndExecForPage($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->execute ( $varArr );
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		return $stmt->fetchAll (); // 获取数据对象数组
	}
	/**
	 * 绑定参数并查询分页数量
	 *
	 * @param unknown $sql        	
	 * @param unknown $entity        	
	 * @param unknown $isFullBind        	
	 * @return mixed
	 */
	public function bindParamAndExecForPageCount($sql, $entity, $isFullBind) {
		// 预处理SQL
		$stmt = $this->dbh->prepare ( $sql );
		// 反射获取实体的属性
		$varArr = $this->getStmtVarArr ( $entity, $isFullBind );
		// 执行SQL语句
		$stmt->setFetchMode ( PDO::FETCH_OBJ ); // 设置获取数组的模式，关联数组
		$stmt->execute ( $varArr );
		$result = $stmt->fetch (); // 获取分页数
		if ($result != null) {
			$entity->pageCount = ( int ) $result->pageCount;
		} else {
			$entity->pageCount = 0;
		}
		return ( array ) $entity;
	}
	
	/**
	 * 事务开启
	 */
	public function beginTransaction() {
		$this->dbh->beginTransaction();
	}
	
	/**
	 * 事务提交
	 */
	public function commit() {
		$this->dbh->commit();
	}
	
	/**
	 * 事务回滚
	 */
	public function rollBack() {
		$this->dbh->rollBack();
	}
}
?>