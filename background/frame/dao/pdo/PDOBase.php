
<?php
include_once 'SQLUtil.php';
/**
 *
 * @author 宇帅
 *         PDO工具基类，用于数据库连接
 */
class PDOBase {

	protected $dbms = 'mysql'; // 数据库类型
	protected $host = 'localhost';
	protected $port = '3306';
	protected $dbName = 'phpbean'; // 使用的数据库
	protected $user = 'root'; // 数据库连接用户名
	protected $pass = 'root'; // 对应的密码*/
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

	protected $dbh; // 数据库连接

	/**
	 * 构造函数，数据库连接
	 */
	public function PDOBase() {
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