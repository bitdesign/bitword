<?php

require_once('BaseModel.php');
//require_once('lib/LogUtil.php');
class Siteparas extends BaseModel{
	public $logger = null;
	public function save() {

		$arr = array (
			'logo',
			'headimg',
			'name',
			'keywords',
			'description',
			'homemaxnum',
			'newmaxnum',
			'topmaxnum',
			'commentswitch',
			'commentdspnum',
			'accstat',
			'notice'
		);
		
		$_POST["accstat"] = base64_encode($_POST["accstat"]);
		return $this->db->postInsertPair("siteparas", $arr);
	}
	
	public function saveImg() {

		$arr = array (
			'logo',
			'headimg'
		);
		return $this->db->postInsertPair("siteparas", $arr);
	}
	
	public function saveTpl() {
		$arr = array (
			'tpl_name',
			'tpl_root'
		);
		$_POST['tpl_root']="view/template/".$_POST['tpl_name'];
		
		require_once "lib/LogUtil.php";
		$logger = LogUtil::getLogger();
		//$logger->info($_POST['tpl_name']);
		//$logger->info($_POST['tpl_root']);
		return $this->db->postInsertPair("siteparas", $arr);
	}
	
	public function saveLan() {

		$arr = array (
			'lan'
		);
		return $this->db->postInsertPair("siteparas", $arr);
	}
	
	public function getParas() {

		return $this->db->row2col("siteparas","name","value");
	}
	
	public function writeParas2File() {

		$arr = $this->getParas();
		$output = "<?\r\n";
		$output .= "date_default_timezone_set('PRC');\r\n";
		$output .= "include \"config.php\";\r\n";
		foreach ($arr as $key => $value) {
		   $output .= '$'.$key."='".$value."';\r\n";
		}
		$fp = fopen("config/site.php", "w");
		fwrite($fp, $output);
		fclose($fp);
	}

}

