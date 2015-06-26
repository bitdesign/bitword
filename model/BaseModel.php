<?php

require_once "lib/MySQL.php";
require_once('lib/LogUtil.php');
class BaseModel {

	public $db;
	public $logger;
	function __construct() {
		include "config/config.php"; //no include_once, because only first new XXX() will include config.php
		$this->db = new MySQL($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);
		$this->logger = LogUtil::getLogger();
	}

	public function getArrayList($table,$option="") {
		
		return $this->db->queryForArray($table,$option);
	
	}
	
	public function getRecord($table) {
		return $this->db->readRecord($table);
	
	}
	
	public function release(){
		
		$this->db->release();
	
	}
}

