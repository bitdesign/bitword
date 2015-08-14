<?

class Pager {
	public static $defaultPerPageCnt=20;
	public static $maxPerPageCnt=100;
	
	public $pageNo=0;
	public $skipValue;
	public $totNo=0;
	public $perPageCnt=5;
	public $oldPerPageCnt=5; 
	
	public $table = "";
	public $db = "";    
	
	function getPageCnt() {
		$this->totNo = $this->db->getCount($this->table);
		return ceil($this->totNo*1.0/$this->perPageCnt);
	}
	
	function __construct($table,$db,$pageNo,$perPageCnt){
		$this->pageNo = $pageNo;
		if(empty($this->pageNo) || $this->pageNo<1){
			$this->pageNo = 1;
		}
		if($perPageCnt <0 || $perPageCnt>Pager::$maxPerPageCnt){
			$perPageCnt = Pager::defaultPerPageCnt;
		}
		$this->perPageCnt = $perPageCnt;
		$this->table = $table;
		$this->oldPerPageCnt = $perPageCnt;
		$this->db = $db;
	}
	
	function  getHtml($viewPage="PagerView.php"){
		
		 require("translate/translate.php");
		 require($viewPage);
	}
	
	function  getData(){
		$sql = $this->getSQL();
		
		return $this->db->queryForArray("($sql) tmp");
	}
	
	function  getSQL(){
		$opr = $this->skipValue;
		if( !empty($opr)){
			if(strcmp($opr,"first") == 0){
				$this->pageNo = 1;
			}else if(strcmp($opr,"pre") == 0){
				$this->pageNo -= 1;
			}else if(strcmp($opr,"next") == 0){
				$this->pageNo += 1;
			}else if(strcmp($opr,"last") == 0){
				$this->pageNo = $this->totNo;
			}else{
				$this->pageNo = $opr;
			}
		}
		if( $this->pageNo < 1) $this->pageNo = 1;
		
		$totPage = $this->getPageCnt();
		if( $this->pageNo > $totPage) $this->pageNo = $totPage;
		$beginIdx = $this->perPageCnt*($this->pageNo-1);
		$sql = "SELECT * FROM  $this->table limit $beginIdx,$this->perPageCnt";
		return $sql;
	}
}
