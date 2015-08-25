<?php

require_once('BaseModel.php');
require_once('lib/StringUtil.php');

class Block extends BaseModel{

	public function del($id) {
		$this->db->del("content","block_id in (".formatString($id).")");
		$this->db->del("block","block_id in (".formatString($id).")");
	}
    
    
    public function getNextID() {
		$sql = "select max(block_id)+1 next_id from  block";
		$result = mysql_query($sql);
		if (!$result) {
			return 0;
		}
		$record = mysql_fetch_array($result,MYSQL_ASSOC);
		return $record["next_id"];
	}
	
	public function save() {
		
		$arr = array (
			'block_id',
			'block_name',
			'block_order',
			'block_pos',
			'input_tm',
			'edit_tm',
			'usr_id'
		);
		$this->db->postSave("block", $arr);
	}
	
	public function getBlocks() {
		$blocks = $this->db->queryForArray("(select a.*, b.usr_nm from block a left join users b on a.usr_id=b.usr_id order by edit_tm desc) tmp");
		return $blocks;
	}
	public function getRecordById($id) {
		return $this->db->readRecord("block","block_id=".$id);
	}

	public function getBlocksWithContentNum() {
		$arr = $this->db->queryForArray("(select a.block_id,b.block_name, count(1) content_num from content a left join block b on a.block_id=b.block_id where a.sts != '-1' group by a.block_id,b.block_name) tmp");
		return $arr;
	}
	public function getBlocksWithContent($maxNum) {
		$block_poss = $this->db->queryForArray("(select distinct block_pos as block_pos from block) tmp");
		
		$arr = array();
		foreach ($block_poss as $block_pos){
			$pos = $block_pos["block_pos"];
			$bloks = $this->getBlocksWithContentByBlockPos($pos,$maxNum);
			$arr[$pos] = $bloks;
		}
		return $arr;
	}
	public function getBlocksWithContentByBlockPos($block_pos=0,$maxNum=50) {
		
		$blocks = $this->db->queryForArray("block","where block_pos=$block_pos order by block_order");
		$arr = array();
		foreach ($blocks as $key=>$block){
			$contents = $this->db->queryForArrayLimit("(select id,block_id,title,dsp_img,edit_tm,usr_nm,visits,left(content,300) as content from content,users where content.usr_id=users.usr_id and sts='1' order by pub_tm desc  limit 0,$maxNum) tmp"," where block_id=".$block["block_id"]);
			$blocks[$key]["contents"] = $contents;
		}
		return $blocks;
	}
}


