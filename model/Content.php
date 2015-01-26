<?php
require_once('BaseModel.php');
require_once('lib/LogUtil.php');
require_once('lib/StringUtil.php');
class Content extends BaseModel{
	public function del($id) {
		return $this->db->del("content","id in (".formatString($id).")");
	}
	public function updatePublishSts($id) {
		$pubTm = date("YmdHis",time());
		$this->db->exec("update `content`  set pub_tm='".$pubTm."',sts = 1 WHERE id in (".formatString($id).")");
	}
	public function getRecordById($id) {
		return $this->db->readRecord("(select a.*,b.usr_nm,c.block_name from content a left join users b on a.usr_id=b.usr_id left join block c on a.block_id=c.block_id) tmp","id=".$id);
	}
	
	public function addVisits($id) {
		return $this->db->exec("update `content`  set visits = visits+1 WHERE id=".$id);
	}
	
	public function recommend($id,$opr) {
		$pubTm = date("YmdHis",time());
		if( $opr ==1 ){
			$this->db->exec("update `content`  set top_tm = '".$pubTm."' WHERE id=".$id);
		}else{
			$this->db->exec("update `content`  set top_tm = '' WHERE id=".$id);
		}
	}
	
	public function getContents($maxNum){
		$sql = "(select id,block_name,title,a.dsp_img,edit_tm,usr_nm,visits,top_tm,left(content,300) as content from content a left join users b on a.usr_id=b.usr_id left join block c on a.block_id = c.block_id where sts='1' order by top_tm desc ,pub_tm desc   limit 0,".$maxNum.") tmp";
		return $this->db->queryForArrayLimit($sql);
	}	
	public function save() {
		$arr = array (
			'id',
			'block_id',
			'title',
			'keyword',
			'content',
			'content_short',
			'sts',
			'dsp_img',
			'input_tm',
			'edit_tm',
			'usr_id'
		);
		$this->db->postSave("content", $arr);
	
	}
	
	
	public function getFirstBatchByTime($maxNum=10) {
		$contents = $this->db->queryForArrayLimit("(select id,title from content where sts='1' order by pub_tm desc limit 0,$maxNum) tmp","");
		return $contents;
	}
	
	public function getFirstBatchByVisits($maxNum=5) {
		$contents = $this->db->queryForArrayLimit("(select id,title from content where sts='1' order by visits desc limit 0,$maxNum) tmp","");
		return $contents;
	}

}

