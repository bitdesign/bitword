<?
/*
require_once('model/MessageBook.php');
require_once('lib/ArrayUtil.php');
require_once('lib/LogUtil.php');
require_once('ui/Pager.php');

class MessageController{
	
	private  $messageBook = null;
	public $logger = null;
	
	function __construct(){
		$this->messageBook = new MessageBook(); 
	//	$this->logger = LogUtil::getLogger();
	}
	function getPager($table,$db){
		$pageNo = trim($_POST['skipValue']);
		$perPageCnt = trim($_POST['perPageCnt']);
		if(empty($pageNo)){
			$pageNo = 1;
		}
		if(empty($perPageCnt)){
			$perPageCnt = Pager::$defaultPerPageCnt;
		}
		$pager = new Pager($table,$db,$pageNo,$perPageCnt);
		return $pager;
	}
	function listPage(){
		include "config/site.php";
		$table = "(select a.*  from msgbook a order by input_tm desc) mytable";
		$pager = $this->getPager($table,$this->messageBook->db);
		$msgList = $pager->getData();
		require("$tpl_root/msgbook_list.php");
	}

	function del(){
		$this->messageBook->del($_POST["id"]);
		echo "true";
	}

	function save(){
		$this->messageBook->save();
		echo "true";
	}
	

}*/
/*end*/