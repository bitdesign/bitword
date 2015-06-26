<?php

require_once('BaseModel.php');

class User extends BaseModel{
	
	
	public function login($usr_nm,$usr_pwd) {
		return $this->db->isExists("users", "usr_nm='".$usr_nm."' and usr_pwd='".$usr_pwd."'");
	}

}


