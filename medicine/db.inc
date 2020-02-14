<?php

/**
 * DB関連
 */
class db {
	static $db_url	= '';
	static $db_name = '';
	static $db_host = '';
	static $db_port = '';
	static $db_user = '';
	static $db_pass = '';
	static $db_connect = null;

	public function __construct() {
		$this->init();
	}

	public function init() {
		$this->db_url = parse_url(getenv('DATABASE_URL'));
		$this->db_name = ltrim($this->db_url['path'], '/');
		$this->db_host = !empty($this->db_url['host'])? $this->db_url['host'] : '';
		$this->db_port = !empty($this->db_url['port'])? $this->db_url['port'] : '';
		$this->db_user = !empty($this->db_url['user'])? $this->db_url['user'] : '';
		$this->db_pass = !empty($this->db_url['pass'])? $this->db_url['pass'] : '';

		$this->connect();
	}

	public function connect() {
		$this->db_connect = new PDO("pgsql:host=$this->db_host;port=$this->db_port;dbname=$this->db_name;user=$this->db_user;password=$this->db_pass");
		$this->db_connect->beginTransaction();
		$this->db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function close() {
		$this->db_connect = null;
	}

	public function query($sql) {
		return $this->db_connect->query($sql);
	}

	public function commit() {
		return $this->db_connect->commit();
	}

	public function rollback() {
		return $this->db_connect->rollback();
	}

	public function getDBName() {
		return $this->db_name;
	}

	public function getDBHost() {
		return $this->db_host;
	}
	
	public function getDBPort() {
		return $this->db_port;
	}
	
	public function getDBUser() {
		return $this->db_user;
	}
	
	public function getDBPass() {
		return $this->db_pass;
	}
	
}