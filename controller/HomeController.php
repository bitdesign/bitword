<?
class HomeController{
	
	function myAll(){
	    session_start();
		if(!isset($_SESSION['loginuser']))
		{
			Header("Location: Login!index");
		}
		include "config/site.php";
		
		require_once('model/Feed.php');

		$logo = "$webroot/upload/$logo";
		$headimg = "$webroot/upload/$headimg";
		$feed = new Feed();
		$feeds = $feed->getFeeds();
		
		$viewPage = "index_all.php";
		require("$tpl_root/$viewPage");
	}
	
	function rssOne(){
	    session_start();
		if(!isset($_SESSION['loginuser']))
		{
			Header("Location: Login!index");
		}
		
		
		$url = $_GET['url'];
        
        
        require_once('lib/BitMemCache.php');
        
		include "config/site.php";
		
		$logo = "$webroot/upload/$logo";
		$headimg = "$webroot/upload/$headimg";
		
		require_once('model/Feed.php');
        require("$tpl_root/index_rss_one.php");
          
	}
	
	function index($viewPage="index.php",$pubMod=true){
		
		require_once('model/Content.php');
		require_once('ui/Pager.php');
		include "config/site.php";
		
		//require_once('model/Feed.php');

		
		//$headimg = "$webroot/upload/$headimg";
		$content = new Content();
		//$feed = new Feed();
		
		$condition = "";
		
		if( isset ( $_GET['block_id'])){
			$condition .= "and a.block_id=".$_GET['block_id'];
		}
		
		$indexMaxNum = $homemaxnum;
		$table = "(select id,a.block_id,block_name,title,a.dsp_img,a.edit_tm,a.pub_tm,a.input_tm,usr_rnm,visits,top_tm,content_short  from content a left join users b on a.usr_id=b.usr_id left join block c on a.block_id = c.block_id where sts='1' ".$condition." order by  top_tm desc,edit_tm desc ) tmp";
		$pager = $this->getPager($table,$content->db,$indexMaxNum);
		$contents = $pager->getData();
		
		//$feeds = $feed->getFeeds();
		//$logo = "$webroot/upload/$logo";
        
        include_once "config/translate.php"; 
        include_once "lib/Functions.php";
        include_once "lib/StringUtil.php";
        
        
		require("$tpl_root/$viewPage");
		
		
	}
	
	function info(){
		
		require_once('model/Content.php');
		require_once('ui/Pager.php');
		require_once('model/Reply.php');
		include "config/site.php";
		require_once "lib/Functions.php";
        require_once "lib/StringUtil.php";

		$content = new Content();	
		$contentId = $_GET['id'];
		$obj = $content->getRecordById($contentId);
		$obj["link"] = "http://".$_SERVER['HTTP_HOST']."/".$tpl_name."_".$contentId.".html";
			
		$table = "(select a.*  from replies a where par_id=".$contentId." order by input_tm desc ) mytable";
		$reply = new Reply(); 
		$replyPegeNum = $commentdspnum;
		$pager = $this->getPager($table,$reply->db,$replyPegeNum);
		$msgList = $pager->getData();
		
		require("$tpl_root/info.php");
	}
	
	function news(){
		include "config/site.php";
		require_once('model/Content.php');
		require_once('model/Block.php');
		$content = new Content();	
		$block = new Block();	
		
		$contentsNewTop = $content->getFirstBatchByTime($newmaxnum);
		//$contentsVisitsTop = $content->getFirstBatchByVisits($topmaxnum);
		$blocks = $block->getBlocksWithContentNum();
		require("$tpl_root/_news.php");
	}
	
	
	function headerNav(){
		include "config/site.php";
		require_once('model/Block.php');
		$block = new Block();	
		
		$blocks = $block->getBlocksWithContentNum();
		require("$tpl_root/_header_nav.php");
	}
	
	
	function getPager($table,$db,$perPageCnt=50){
		$pageNo = trim($_POST['skipValue']);
		$pager = new Pager($table,$db,$pageNo,$perPageCnt);
		return $pager;
	}
	function indexStatic(){
		require("index.html");
	}
	
	function blank(){
	    include "config/site.php";
		require("$tpl_root/_blank.php");
	}
	
	
}
/*end*/