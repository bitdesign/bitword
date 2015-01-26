<?
require_once 'model/User.php';
class UserController{

	public  $user = null;
	
	function __construct(){
		parent::__construct();
		$this->user = new User();	
	}
	
	function login() {
		
		session_start();
		
		$usr_nm = $_POST["usr_nm"];
		$usr_pwd = $_POST["usr_pwd"];

		if ($this->user->login($usr_nm, $usr_pwd)) {
			$_SESSION['loginuser'] = $usr_nm;
			require ('view/admin/index.php');
		} else {
			require ('view/admin/login.php');
		}
		
		/*
		$myjson = json_encode($myarr);
		echo $myjson;
		*/
	}

}
/*end*/