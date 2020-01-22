<?php

/**
 * DB関連
 */
class db {
	public $db_URL = '';
	public $db_name = '';
	// public $db_host;
	// public $db_port;
	// public $db_user;
	// public $db_pass;

	public function __construct() {
		$this->db_url = parse_url(getenv('DATABASE_URL'));
		$this->db_name = ltrim($this->db_url['path'], '/');
		// $this->db_host = !empty($this->db_url['host'])? $this->db_url['host'] : '';
		// $this->db_port = !empty($this->db_url['port'])? $this->db_url['port'] : '';
		// $this->db_user = !empty($this->db_url['user'])? $this->db_url['user'] : '';
		// $this->db_pass = !empty($this->db_url['pass'])? $this->db_url['pass'] : '';
	}

	public function getDBURL() {
		return $this->db_url;
	}

	
}