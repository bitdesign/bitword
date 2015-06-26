<?
	$controller = ucfirst($_GET['c']);
	$method     = $_GET['m'];
	if($controller == null){	$controller = "Home";}
	if($method == null){ 
		$method = "index";	
	}
	$controller_name = $controller.'Controller';
	require('controller/'.$controller_name.'.php');
	$controller = new $controller_name();
	$controller->$method();
