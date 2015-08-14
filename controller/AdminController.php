<?
require_once('Controller.php');
require_once('model/Block.php');
require_once 'model/BaseModel.php';
require_once 'model/Content.php';
require_once 'controller/HomeController.php';
require_once('lib/DirUtil.php');
require_once('lib/Info.php');

class AdminController extends Controller{
	
	public  $block = null;
	function __construct(){
		parent::__construct();
	}
	
	
	//今天的IP数
	function getIPs(){
	    
	    $file_name = date("Ymd");
	    
	    $file_name = "count/$file_name";
	    
	    return $this->getIPCount($file_name);
	}
	
	//昨天的IP数
	function getYIPs(){
	    
	    
	    $file_name = "count/yesterday";
	    
	    return $this->getIPCount($file_name);
	}
	
	//全部IP
	function getTotIPs(){
	    
	    $file_name = date("Ymd");
	    
	    $file_name = "count/history";
	    
	    return $this->getIPCount($file_name);
	}
	
	
	function getIPCount($file_name){
	    
	     if( !file_exists ( $file_name ) || filesize($file_name)==0 ){
	        
	        return 0;
	     }
	    
	    $fp = fopen($file_name,"r");
	    $ori_str = fread ($fp, filesize($file_name));
	    
	    preg_match_all( "/,/", $ori_str,$out);
	    
		fclose($fp);
		
		return sizeof($out[0]); 
	    
	}
	
	
	function dashboard(){
		// content_count   visits_count   block_count   replies_count  os_ver server_ip webserver domain_name
		$table = "(select (SELECT COUNT(1) FROM content) content_count,(SELECT sum(visits) FROM content) visits_count,(SELECT COUNT(1) FROM block) block_count,(SELECT COUNT(1) FROM replies) replies_count  from dual) tmp";
		$model = new BaseModel();
		$sys_info = $model->getRecord($table);
		$info = new Info();
		$serv_info = $info->get_server_info();
		$obj = array_merge($sys_info,$serv_info);
		
		$obj['yips'] = $this->getYIPs();
		$obj['ips'] = $this->getIPs();
		$obj['tips'] = $this->getTotIPs();
		
		require('view/admin/dashboard.php');
	}
	
	function theme(){
		$dir = new DirUtil();
		$tplList = $dir->listdir("view/template");
		require('view/admin/theme.php');
	}
	
	function data(){
		$dir = new DirUtil();
		$fileList = $dir->traverse("backup");
		require('view/admin/data.php');
	}
	function log(){
		$dir = new DirUtil();
		$logFileList = $dir->traverse("log");
		require('view/admin/log.php');
	}
	function restorePage(){
		$dir = new DirUtil();
		$fileList = $dir->traverse("backup");
		require('view/admin/restore.php');
	}
	
	function backup(){
		include "config/config.php";
		include "config/site.php";
		$curTm = date("Y-m-d",time());
		$model = new BaseModel();
		$model->db->backup($mysql_dbname,"backup/".$mysql_dbname."_".$curTm.".sql","data");
		echo "true";
	}
	
	function restore(){
		$model = new BaseModel();
		$sqlfile = "backup/".$_POST["selbkfile"];
		$sqls = fread(fopen($sqlfile, "r"), filesize($sqlfile));
		$pieces = $model->db->split_sql($sqls);
		$result=mysql_query("show variables like 'have_innodb'");
    $record = mysql_fetch_array($result);
		$have_innodb = $record["Value"];
				
		mysql_query("BEGIN");
		mysql_query("SET AUTOCOMMIT=0");
		
		foreach ($pieces as $sql){
			$ret = $model->db->exec($sql);
			if( $ret != 1){
				$result=mysql_query("show variables like 'have_innodb'");
     		$record = mysql_fetch_array($result);
				$have_innodb = $record["Value"];
				if(strcasecmp($have_innodb,"DISABLED") == 0){
				}else{
					mysql_query("ROLLBACK");
				}
				echo "false";
				exit();
			}
		}
		mysql_query("COMMIT");
		echo "true";
		
	}
	
	function delFile($dir,$fileName){
		
		if( $fileName == "all"){
			$dirUtil = new DirUtil();
			$fileList = $dirUtil->traverse($dir);
			foreach ($fileList as $f){
				if(!unlink("$dir/$f")){
					echo "false";
					exit;
				}
			}
			echo "true";
		}else{
			
			$ret = unlink("$dir/$fileName");
			
			if($ret){
				echo "true";
			}else{
				echo "false";
			}
		}
	}
	
	function delBackupFile(){
		$fileName = $_POST["filename"];
		$this->delFile("backup",$fileName);
	}
	
	function delLogFile(){
		$fileName = $_POST["filename"];
		$this->delFile("log",$fileName);
	}
	
	function publishStaticIndex($m = "1"){
		
		include "config/site.php";
		$model = new BaseModel(); 
		$home = new HomeController(); 
		
		if(isset($_POST["method"])){
			$m = $_POST["method"];
		}
		$condition = "";
		
		/*
		if( $m == "1"){
			$condition="where sts='1'  order by input_tm desc";
		}else{
			$condition="where sts !='-1'  order by input_tm desc";
		}
		*/
		$condition="where sts='1'  order by input_tm desc";
		
		$contents = $model->getArrayList("content",$condition); 
		$contestIdListStr="";
		
		//first create news.html
		$news_file_name = "static/".$tpl_name."/_news.html";
		ob_start();
		$home->news();
		$news_contents = ob_get_contents();
		ob_end_clean();
		$fp = fopen($news_file_name, "w");
		fwrite($fp, $news_contents);
		fclose($fp);
		
		
		//first create _header_nav.html
		$news_file_name = "static/".$tpl_name."/_header_nav.html";
		ob_start();
		$home->headerNav();
		$news_contents = ob_get_contents();
		ob_end_clean();
		$fp = fopen($news_file_name, "w");
		fwrite($fp, $news_contents);
		fclose($fp);
		
		
		//create a static html for each article
		foreach ($contents as $content){
			$fname = "static/".$tpl_name."/".$content['id'].".html";
			ob_start();
			$_GET["id"] = $content['id'];
			$contestIdListStr .= $content['id'].",";
			$home->info();
			$content = ob_get_contents();
			ob_end_clean();
			$fp = fopen($fname, "w");
			fwrite($fp, $content);
			fclose($fp);
		}
		
		//create a static html for each block
		$block = new Block(); 
		$blocks = $block->getBlocksWithContentNum();
		foreach ($blocks as $blockObj){ 
			$fname = "static/".$tpl_name."/b".$blockObj['block_id'].".html";
			$_GET['block_id'] = $blockObj['block_id'];
			ob_start();
			$home->index();  //php after render ,all mysql connections will be reset
			$indexContent = ob_get_contents();
			ob_end_clean();
			$fp = fopen($fname, "w");
			fwrite($fp, $indexContent);
			fclose($fp);
		}
		//$contentObj = new Content(); 
		//$contentObj->updatePublishSts($contestIdListStr);
		
		//create index.html
		unset($_GET['block_id']);
		ob_start();
		$home->index();  //php after render all mysql connections will be reset
		$indexContent = ob_get_contents();
		ob_end_clean();
		$fp = fopen("index.html", "w");
		fwrite($fp, $indexContent);
		fclose($fp);
		echo "true";
	}
	    
	function publishOne( $contentId, $blockId){
		
		include "config/site.php";
		$model = new BaseModel(); 
		$home = new HomeController(); 
		
		//first create news.html
		$news_file_name = "static/".$tpl_name."_news.html";
		ob_start();
		$home->news();
		$news_contents = ob_get_contents();
		ob_end_clean();
		$fp = fopen($news_file_name, "w");
		fwrite($fp, $news_contents);
		fclose($fp);
		
		
		//$logger = LogUtil::getLogger();
		
		
		//create a static html for this article
		$fname = "static/".$tpl_name."/".$contentId.".html";
		
		//$logger->info($fname);
		
		ob_start();
		$_GET["id"] = $contentId;
		$contestIdListStr .= $contentId.",";
		$home->info();
		$content = ob_get_contents();
		ob_end_clean();
		$fp = fopen($fname, "w");
		fwrite($fp, $content);
		fclose($fp);
		
		//$logger->info("finished");
		
		//create a static html for this article's block
			
		$fname = "static/".$tpl_name."/b".$blockId.".html";
		$_GET['block_id'] = $blockId;
		ob_start();
		$home->index();  //php after render ,all mysql connections will be reset
		$indexContent = ob_get_contents();
		ob_end_clean();
		$fp = fopen($fname, "w");
		fwrite($fp, $indexContent);
		fclose($fp);
		
		//$contentObj = new Content(); 
		//$contentObj->updatePublishSts($contestIdListStr);
		
		//create index.html
		unset($_GET['block_id']);
		ob_start();
		$home->index();  //php after render all mysql connections will be reset
		$indexContent = ob_get_contents();
		ob_end_clean();
		$fp = fopen("index.html", "w");
		fwrite($fp, $indexContent);
		fclose($fp);
		//echo "true";
	}
	
	function changePassWordPage(){
		require('view/admin/password.php');
	}
	
	function checkOriPassWord(){
		
		$model = new BaseModel();
		$cur_usr_nm = $_SESSION['loginuser']['usr_nm'];
		$ret = $model->db->isExists("users","usr_nm='".$cur_usr_nm."' and usr_pwd='".md5($_POST["ori_usr_pwd"])."'");
		if($ret){
			echo "true";
		}else{
			echo "false";
		}
	}
	
	function changePassWord(){
		
		$model = new BaseModel();
		$arr = array (
			'usr_pwd'
		);
		$_POST['usr_pwd'] = md5($_POST['usr_pwd']);
		$cur_usr_nm = $_SESSION['loginuser']['usr_nm'];
		$model->db->postUpdate("users",$arr,"usr_nm='".$cur_usr_nm."'");
		echo "true";
	}
	
	function delTheme(){
		$fileName = $_POST["filename"];
		if($fileName === "default") {
			echo "false"; 
			return;
		}
		$fileName = dirname(__FILE__).'/../view/template/'.iconv('UTF-8','gb2312',$fileName);
		deldir($fileName);
		echo "true";
	}
	
}
/*end*/