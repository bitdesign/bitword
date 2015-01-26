<?php

require_once('BaseModel.php');

class MessageBook extends BaseModel{
	
	
	public function save() {
		$arr = array (
			'usr_name',
			'msg_ctx',
			'input_tm'
		);
		include "config/site.php";
		$curTm = date("YmdHis",time());
		if(empty($_POST["input_tm"])){
			$_POST["input_tm"] = $curTm;
		}
		$this->db->postSave("msgbook", $arr);
	}
	
	

}


