<?
require_once('lib/ValidationCode.php');
class ValidationController{
	function getCode(){
		session_start();
		$validationCode=new ValidationCode(60, 28, 4);
		$_SESSION['validationCode']=$validationCode->getCheckCode();
		$validationCode->showImage();
	}

}
/*end*/