<?
require_once('Controller.php');
require_once('model/Feed.php');
require_once('lib/RssReader.php');
require_once('lib/BitMemCache.php');
require_once('lib/LogUtil.php');

class FeedController extends Controller{

    private  $feed = null;

    function __construct(){
        parent::__construct();
        $this->feed = new Feed();
    }
    
    function listnews(){

		include "config/site.php";
		require_once('model/Feed.php');
		$feed = new Feed();
		$feeds = $feed->getFeeds();
		require("view/admin/feednews.php");
	}
	
    function listPage(){
        $arrayList = $this->feed->getFeeds();
        require('view/admin/feed.php');
    }

    function del(){
        $this->feed->del($_POST["id"]);
        echo "true";
    }

    function save(){
        $curTm = date("YmdHis",time());
        $_POST["edit_tm"] = $curTm;
        if(empty($_POST["feed_id"])){
            $_POST["input_tm"] = $curTm;
        }
        $_POST['usr_id'] = $_SESSION['loginuser']['usr_id'];

        $url =$_POST["url"];


        $reader = new RssReader();
        $rss = $reader ->fetch($url);
        $title = $rss->channel->title;

        if(isset($title)){
            $_POST['feed_title'] = $title;
            $this->feed->save();
            echo "true";
        }else{
            echo "Not found";
        }

    }

    function fetchFeed(){

        $url =$_POST["url"];
        $rss = "";


        require_once('config/site.php');

        if($memcache){

            $logger = LogUtil::getLogger();

            $mem = new BitMemCache();

            if($mem->init()){
                $logger = LogUtil::getLogger();
                $rss = $mem->get($url);
                $logger->info("Read $url from memcache [$rss]");
            }

        }else{
            $reader = new RssReader();
            $rss = $reader ->fetch_json($url);
        }

        echo $rss;
    }


    //feed!fetchFeedDirect?
    function fetchFeedDirect(){

        $url =$_GET["url"];
        if(isset($_POST["url"])){
            $url =$_POST["url"];
        }


        $reader = new RssReader();
        $rss = $reader ->fetch_json($url);


    /*  require_once('config/site.php');
    
    
        if($memcache){

            $logger = LogUtil::getLogger();

            $mem = new BitMemCache();

            if($mem->init()){
                $logger->info("init 1");
                $logger = LogUtil::getLogger();
                $ret = $mem->set($url,$rss );
                    $logger->info("single update memcache $url ------------[ $ret ]");
                    $logger->info($mem->get($url));
            }

        }*/
        echo $rss;


    }

    function flushMem(){
        $mem = new BitMemCache();

        if($mem->init()){
            $logger->info("init 2");
            $logger = LogUtil::getLogger();
            $ret = $mem->flush();
            $logger->info("flush memcache ------------[ $ret ]");
        }
        echo "flushMem 2";

    }


    function editPage(){
        $obj = $this->feed->getRecordById($_GET['id']);
        require('view/admin/feed_edit.php');
    }
    function addPage(){
        $obj['dsp_img']="upload/default.png";
        require('view/admin/feed_edit.php');
    }
}
/*end*/
