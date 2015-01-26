<?
require_once('model/Content.php');

require_once('lib/LogUtil.php');

class CountController{
	
	private  $content = null;
	public $logger = null;
	
	function __construct(){
		$this->content = new Content(); 
		$this->logger = LogUtil::getLogger();
	}
	
	function addVisits(){
	  $this->content->addVisits($_GET['id']);
	}
	
}
/*end*/