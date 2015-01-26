<?php

require_once('BaseModel.php');

class Slider extends BaseModel{
	
	public function save() {
		
		$arr = array (
			'img_src',
			'img_url',
			'img_order'
		);
		$this->db->postSave("slider", $arr);
	}

	public function del($img_order) {
		$this->db->del("slider", "img_order=".$img_order);
	}

}


