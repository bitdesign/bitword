<?
require_once('model/Reply.php');
require_once('controller/HomeController.php');

class ReplyController{
	
	private  $reply = null;
	
	function __construct(){
		
	}


	function save(){
		include "config/site.php";
		if($commentswitch==="0"){
			echo "-1";
			return;
		}
		session_start();
		if(strcasecmp($_POST['validationCode'],$_SESSION['validationCode']) != 0 ){
			 echo "0";
			 return;
		}
		$this->reply = new Reply(); 
		
		$this->reply->save();
		
		include "config/site.php";
		$model = new BaseModel(); //reconnect to the msyql
		$fname = $tpl_root."/static/".$_POST['par_id'].".html";
		ob_start();
		$_GET["id"] = $_POST['par_id'];
		$home = new HomeController(); 
		$home->info();
		$content = ob_get_contents();
		ob_end_clean();
		$fp = fopen($fname, "w");
		fwrite($fp, $content);
		fclose($fp);
		
		
		echo "true";
	}
	
	/*
	function del(){
		$this->reply->del($_POST["rep_id"]);
		echo "true";
	}
	
	function add(){
		include "config/site.php";
		$par_id = $_GET["id"];
		require("$tpl_root/reply.php");
	}
	*/
	function addTopCount(){
		//$this->reply = new Reply(); 
	  //$this->reply->addTopCount($_POST['rep_id']);
	  echo "true";
	}
	
}
/*end*/