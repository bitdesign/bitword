<?
require_once('Controller.php');
require_once('model/Reply.php');
require_once('lib/ArrayUtil.php');

class RepliesController extends Controller{
	
	private  $reply = null;
	
	function __construct(){
		parent::__construct();
		$this->reply = new Reply(); 
	}
	
	
	function listPage(){
		
		$postTile = "";
		
		if(isset($_POST['title']))
		{
			$postTile = $_POST["title"];
		}
		
		$table = "(select a.*,b.title from replies a left join content b on a.par_id=b.id where b.title like '%".$postTile."%'  order by input_tm desc) mytable";
		$pager = parent::getPager($table,$this->reply->db);
		$arrayList = $pager->getData();
		require('view/admin/replies_list.php');
	}

	function del(){
		$this->reply->del($_POST["id"]);
		echo "true";
	}
	
	function editPage(){
		$obj = $this->reply->getRecordById($_GET['id']);
		require('view/admin/replies_edit.php');
	}
}
/*end*/