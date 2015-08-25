<?
require_once('Controller.php');
require_once('model/Block.php');


class BlockController extends Controller{
	
	private  $block = null;
	
	function __construct(){
		parent::__construct();
		$this->block = new Block();
	}
	
	function listPage(){
		$arrayList = $this->block->getBlocks();
		require('view/admin/block.php');
	}
	
	function del(){
		$this->block->del($_POST["id"]);
		echo "true";
	}
	
	function save(){
		if(!isset($_POST['dsp_img'])){
	  	$_POST['dsp_img'] = "upload/default.png";
	  }
	  $curTm = date("YmdHis",time());
		$_POST["edit_tm"] = $curTm;
		if(empty($_POST["block_id"])){
			$_POST["input_tm"] = $curTm;
		}
		
		$_POST['block_id'] = $this->block->getNextID();
		$_POST['usr_id'] = $_SESSION['loginuser']['usr_id'];
		
		$this->block->save();
		echo "true";
	}
	function editPage(){
		$obj = $this->block->getRecordById($_GET['id']);
		require('view/admin/block_edit.php');
	}
	function addPage(){
		$obj['dsp_img']="upload/default.png";
		require('view/admin/block_edit.php');
	}
}
/*end*/