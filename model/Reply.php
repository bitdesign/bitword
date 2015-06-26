<?php

require_once('BaseModel.php');
require_once('lib/StringUtil.php');

class Reply extends BaseModel{
	
	
	public function del($id) {
		return $this->db->del("replies","rep_id in (".formatString($id).")");
	}
	
	public function getRecordById($id) {
		
		return $this->db->readRecord("(select a.*,b.title from replies a left join content b on a.par_id=b.id ) tmp","rep_id=".$id);
	}
	
	public function save() {
		$arr = array (
			'par_id',
			'usr_name',
			'rep_ctx',
			'input_tm'
		);
		include "config/site.php";
		$curTm = date("YmdHis",time());
		$_POST["input_tm"] = $curTm;
		
	    $_POST["usr_name"] = $_SERVER['REMOTE_ADDR'];
	 // $_POST["rep_ctx"] = mysql_real_escape_string($_POST["rep_ctx"]);
		
		$this->db->postSave("replies", $arr);
	}
	
	public function addTopCount($rep_id) {
		
		return $this->db->exec("update `replies`  set top_count = top_count+1 WHERE rep_id=".$rep_id);
	}

}


