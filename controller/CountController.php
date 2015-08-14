<?
require_once('model/Content.php');

require_once('lib/LogUtil.php');

class CountController{
	
	private  $content = null;
	public $logger = null;
	
	function __construct(){
		//$this->content = new Content(); 
		//$this->logger = LogUtil::getLogger();
	}
	
	function addVisits(){
	    
	    $file_name = date("Ymd");
	    
	    //日期发生切换
	    if( !file_exists ( $file_name ) ){
	        
	        $yes_str = date("Ymd",time()-24*60*60); 
	        $yes_file_name = "count/".$yes_str; 
	        
	        if( file_exists ( $yes_file_name ) ){
	                    
	           $yes_fp = fopen($yes_file_name,"r"); 
	           
	           $tot_fp = fopen("count/history","a");
	           
	           //备份昨天
	           fputs($tot_fp,$yes_str."=".fgets ($yes_fp)."\r\n" );
	           fclose($tot_fp);
	           
	           fclose($yes_fp);
	           
	           rename ( $yes_file_name,"count/yesterday");
	           
	        }
	    }
	    
	    $ip = "4445";
	    
	    $fp = fopen("count/$file_name","a+");
	    $ori_str = fgets ($fp);
	    
	    if( ! preg_match( "/$ip/i", $ori_str,$out)){
	        fputs($fp,"$ip,");
	    }
		fclose($fp);
		
		
	    
	    $this->content->addVisits($_GET['id']);
	}
	
	
	
}
/*end*/