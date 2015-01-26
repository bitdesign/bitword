<?
require_once('ui/Pager.php');

class Controller{

	function __construct(){
		session_start();
		if(!isset($_SESSION['loginuser']))
		{
			Header("Location: Login!index");
		}
		
	}
	
	function getPager($table,$db){
		
		$pageNo = 1;
		$perPageCnt = Pager::$defaultPerPageCnt;
		
		if(isset($_POST['skipValue']))
		{
			$pageNo = trim($_POST['skipValue']);
		}
		if(isset($_POST['perPageCnt']))
		{
			$perPageCnt = trim($_POST['perPageCnt']);
		}
		
		$pager = new Pager($table,$db,$pageNo,$perPageCnt);
		return $pager;
	}
}
/*end*/