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

	public function __construct() {
		$this->db_url = parse_url(getenv('DATABASE_URL'));
		$this->db_name = ltrim($this->db_url['path'], '/');
		$this->db_host = !empty($this->db_url['host'])? $this->db_url['host'] : '';
		$this->db_port = !empty($this->db_url['port'])? $this->db_url['port'] : '';
		$this->db_user = !empty($this->db_url['user'])? $this->db_url['user'] : '';
		$this->db_pass = !empty($this->db_url['pass'])? $this->db_url['pass'] : '';
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