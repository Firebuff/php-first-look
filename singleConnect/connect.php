<?php 

	class MySQL {
		private $host;
		private $port;
		private $user;
		private $pwd;
		private $charset;
		private $dbname;
		private $link;
		private static $instance;

		private function initParam($config) {
			$this->host = isset($config['host'])? $config['host'] : '';
			$this->port = isset($config['port'])? $config['port'] : '';
			$this->user = isset($config['user'])? $config['user'] : '';
			$this->pwd = isset($config['pwd'])? $config['pwd'] : '';
			$this->charset = isset($config['charset'])? $config['charset'] : '';
			$this->dbname = isset($config['dbname'])? $config['dbname'] : '';
		}

		private function connect () {
			$this->link = @mysqli_connect("{$this->host}:{$this->port}",$this->user,$this->pwd) or die('connectiing failed');
		}

		private function setCharset () {
			$sql = "set names `{$this->charset}`";
			$this->query($sql);
		}

		private function selectDB () {
			$sql = "use '{$this->dbname}'";
			$this->query($sql);
		}

		public function query($sql) {
			if(!$result = mysqli_query($this->link,$sql)) {
				echo 'sql语句失败';
				// echo '编号'.mysqli_errno(),'<br>';
				// echo '错误信息',mysqli_error(),'<br>';
				echo '错误语句',$sql,'<br>';
				exit;
			}
			return $result;
		}	

		private function __clone() {

		}

		private function __construct ($config) {
			$this->initParam($config);
			$this->connect();
			$this->setCharset();
			$this->selectDB();
		}

		public static function getInstance ($config=array()) {
			if(!self::$instance instanceof self) {
				self::$instance = new self($config);
			}
			return self::$instance;
		}

		public function fetchAll ($sql,$fetch_type='assoc') {
			$rs = $this -> query($sql);
			$fetch_types = array('assoc','row','array');
			if(!in_array($fetch_type, $fetch_types)) {
				$fetch_type = 'assoc';
			}

			$fetch_fun = 'mysql_fetch_'.$fetch_type;

			while ($row = $fetch_fun($rs)) {
				$array[] = $row;
			}
			return $array;
		}

		public function fetchColunm ($sql) {
			$rs = $this->fetchRow($sql,$row);
			return empty($rs)?null:$rs[0];
		}
		public function fetchRow ($sql,$fetch_type='assoc') {
			$rs = $this->fetchAll($sql,$fetch_type);
			return emprty($rs)? null : $rs;
		}
	}

	$db = MySQL::getInstance(array(
		'host' => 'localhost',
		'port' => '3306',
		'user' => 'root',
		'pwd' => '123456',
		'dbname' => 'test',
		'charset' => 'utf8'
	));

	$rs = $db->fetchAll("select * from student");
	var_dump($rs);

 ?>