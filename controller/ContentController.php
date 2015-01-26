<?
require_once('Controller.php');
require_once('HomeController.php');
require_once('AdminController.php');
require_once('model/Content.php');
require_once('model/BaseModel.php');
require_once('model/Block.php');
require_once('lib/ArrayUtil.php');
require_once('lib/StringUtil.php');
require_once('lib/LogUtil.php');

class ContentController extends Controller{

	private  $content = null;
	private  $block = null;

	function __construct(){
		parent::__construct();
		$this->content = new Content();
		$this->block = new Block();
	}


	function listPage(){

		$postTile = "";
		$postBlockName = "";

		if(isset($_POST['title']))
		{
			$postTile = $_POST["title"];
		}
		if(isset($_POST['block_name']))
		{
			$postBlockName = $_POST["block_name"];
		}

		$table = "(select a.*,b.block_name,c.usr_nm from content a left join block b on a.block_id=b.block_id left join users c on a.usr_id=c.usr_id where a.title like '%".$postTile."%' and b.block_name like '%".$postBlockName."%' order by edit_tm desc) mytable";
		$pager = parent::getPager($table,$this->content->db);
		$arrayList = $pager->getData();
		$blockList = $this->block->getBlocks();
		require('view/admin/content_list.php');
	}

	function del(){
		$this->content->del($_POST["id"]);
		$adminController = new AdminController();
		$adminController->publishStaticIndex("1");
	}

	function recommend(){
		$this->content->recommend($_POST["id"],$_POST["opr"]);
		echo "true";
	}

	function save(){
		//include "config/site.php";
		$curTm = date("YmdHis",time());
		if(empty($_POST["id"])){
			$_POST["input_tm"] = $curTm;
		}
		$_POST["edit_tm"] = $curTm;
		$dsp_img = $this->getFirstImg($_POST["content"],$_POST["block_id"]);
		$_POST["dsp_img"] = $dsp_img;
		$_POST['usr_id'] = $_SESSION['loginuser']['usr_id'];
		
		if(!isset($_POST["keyword"])){
			$_POST["keyword"] = $_POST["title"];
		}
		
		$_POST["content_short"] = plainSubText($_POST["content"],200);

		$this->content->save();
		
		$adminController = new AdminController();
		$adminController->publishStaticIndex();
	}
	
	function editPage(){
		$blockList = $this->block->getArrayList("block");
		$obj = $this->content->getRecordById($_GET['id']);
		require('view/admin/content_edit.php');
	}

	function listWapPage(){
		$postTile = "";
		$postBlockId = "";
		$condition = "";
		if(isset($_POST['title'])){
			$postTile = $_POST["title"];
		}
		$postBlockId = $_POST["block_id"];
		if( isset($_POST["block_id"]) && $postBlockId !=='0'){
			$condition   = "and a.block_id='".$postBlockId."'";
		}
		$table = "(select a.*,b.block_name,c.usr_nm from content a left join block b on a.block_id=b.block_id left join users c on a.usr_id=c.usr_id where a.title like '%".$postTile."%'  $condition  order by edit_tm desc) mytable";
		$pager = parent::getPager($table,$this->content->db);
		$arrayList = $pager->getData();
		$blockList = $this->block->getBlocks();
		require('view/admin/content_list_wap.php');
	}

	function editWapPage(){
		$blockList = $this->block->getArrayList("block");
		$obj = $this->content->getRecordById($_GET['id']);
		require('view/admin/content_edit_wap.php');
	}

	public function getFirstImg($str,$blockId) { //if user hadn
		$flag = "/upload/image/";
		$flagLen = strlen($flag);
		
		$fromIndex = strpos($str,$flag);
		if( !$fromIndex ) {
			$blockObj = $this->block->getRecordById($blockId);
			return $blockObj['dsp_img'];
		}
		
		
		$toIndex = strpos($str, '"', $fromIndex);
		if( !$toIndex ){
			 $blockObj = $this->block->getRecordById($blockId);
			 return $blockObj['dsp_img'];
		}
		
		$ret = substr($str,$fromIndex,$toIndex-$fromIndex);

		$lastChar = substr($ret,-1,1);

		if( $lastChar === '\\'){
			$ret = substr($ret,0,strlen($ret)-1);
		}
		return $ret;
	}
}
/*end*/