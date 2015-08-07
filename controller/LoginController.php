<?
//require_once('Controller.php');
require_once('model/User.php');
require_once('lib/LogUtil.php');
//class AdminController extends Controller{
class LoginController{
	
	private $user = null;
	
	function __construct(){
		$this->user = new User();
	}
	
	function index(){
		$usr_nm = "";
		$usr_pwd = "";
		$remember = "";
		if(isset($_COOKIE['usr_nm'])&&!empty($_COOKIE['usr_nm'])){
			$usr_nm = $_COOKIE['usr_nm'];
			$usr_pwd = $_COOKIE['usr_pwd'];
			$remember = " checked ";
		}
		require('view/admin/login.php');
	}
	
	function indexWap(){
		require('view/admin/loginWap.php');
	}
	
	function logoutWap(){
		session_start();
		$_SESSION=array();
		session_destroy();
		$this->indexWap();
	}
	function logout(){
		session_start();
		$_SESSION=array();
		session_destroy();
		$this->index();
	}
	function login(){
		
		session_start();
		if(isset($_SESSION['loginuser']))
		{
			echo "true";
			return;
		}
	    
		$usr_nm = $_POST["usr_nm"];
		$usr_pwd = $_POST["usr_pwd"];
		
		if(isset($_POST['remember']) && $_POST['remember'] == 'on'){  
	        setcookie('usr_nm',$usr_nm,time()+3600*24);  
	        setcookie('usr_pwd',$usr_pwd,time()+3600*24);  
	    }else{  
	        setcookie('usr_nm','',0);  
	        setcookie('usr_pwd','',0);
	    }  
			
		$user = $this->user->db->readRecord("users", "usr_nm='".$usr_nm."' and usr_pwd='".md5($usr_pwd)."'");
		//magic_quote_gpc=on will default call addslshes() and stripslashes() but to numeric input this will be useless
		if (!empty($user)) {
			$_SESSION['loginuser'] = $user;
			echo "true";
		} 
	}
	
	
}
/*end*/