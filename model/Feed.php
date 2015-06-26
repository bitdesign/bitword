<?php

require_once('BaseModel.php');
require_once('lib/StringUtil.php');

class Feed extends BaseModel{

	public function del($id) {
		$this->db->del("rssfeeds","feed_id in (".formatString($id).")");
	}

	public function save() {
		
		$arr = array (
			'feed_id',
			'feed_title',
			'url',
			'input_tm',
			'edit_tm',
			'usr_id'
		);
		$this->db->postSave("rssfeeds", $arr);
	}
	
	public function getFeeds() {
		$feeds = $this->db->queryForArray("rssfeeds");
		return $feeds;
	}
	public function getRecordById($id) {
		return $this->db->readRecord("rssfeeds","feed_id=".$id);
	}

	
}


