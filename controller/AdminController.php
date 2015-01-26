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
	
	function dashboard(){
		// content_count   visits_count   block_count   replies_count  os_ver server_ip webserver domain_name
		$table = "(select (SELECT COUNT(1) FROM content) content_count,(SELECT sum(visits) FROM content) visits_count,(SELECT COUNT(1) FROM block) block_count,(SELECT COUNT(1) FROM replies) replies_count  from dual) tmp";
		$model = new BaseModel();
		$sys_info = $model->getRecord($table);
		$info = new Info();
		$serv_info = $info->get_server_info();
		$obj = array_merge($sys_info,$serv_info);
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
		$curTm = date("YmdHis",time());
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
	
	
	function publishStaticIndex($m = "0"){
		
		include "config/site.php";
		$model = new BaseModel(); 
		$home = new HomeController(); 
		
		if(isset($_POST["method"])){
			$m = $_POST["method"];
		}
		$condition = "";
		if( $m == "0"){
			$condition="where sts='0'";
		}else{
			$condition="where sts !='-1'";
		}
		$contents = $model->getArrayList("content",$condition); 
		$contestIdListStr="";
		
		//first create news.html
		$news_file_name = $tpl_root."/static/_news.html";
		ob_start();
		$home->news();
		$news_contents = ob_get_contents();
		ob_end_clean();
		$fp = fopen($news_file_name, "w");
		fwrite($fp, $news_contents);
		fclose($fp);
		
		//create a static html for each article
		foreach ($contents as $content){
			$fname = $tpl_root."/static/".$content['id'].".html";
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
			$fname = $tpl_root."/static/b".$blockObj['block_id'].".html";
			$_GET['block_id'] = $blockObj['block_id'];
			ob_start();
			$home->indexDyn();  //php after render ,all mysql connections will be reset
			$indexContent = ob_get_contents();
			ob_end_clean();
			$fp = fopen($fname, "w");
			fwrite($fp, $indexContent);
			fclose($fp);
		}
		$contentObj = new Content(); 
		$contentObj->updatePublishSts($contestIdListStr);
		
		//create index.html
		unset($_GET['block_id']);
		ob_start();
		$home->indexDyn();  //php after render all mysql connections will be reset
		$indexContent = ob_get_contents();
		ob_end_clean();
		$fp = fopen("index.html", "w");
		fwrite($fp, $indexContent);
		fclose($fp);
		echo "true";
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
		if($fileName === "base") {
			echo "false"; 
			return;
		}
		$fileName = dirname(__FILE__).'/../view/template/'.iconv('UTF-8','gb2312',$fileName);
		deldir($fileName);
		echo "true";
	}
	
}
/*end*/