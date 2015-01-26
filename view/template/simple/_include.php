<title><?=$name?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?=$keywords?>" />
<meta name="Description" content="<?=$description?>" />
<?
include_once "config/site.php"; 
include_once "lib/Functions.php";
include_once "lib/StringUtil.php";
?>
<link href="<?=$webroot.'/'.$tpl_root.'/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css" media="screen" />
<link href="<?=$webroot.'/'.$tpl_root.'/css/simple.css' ?>" rel="stylesheet" type="text/css" media="screen" />
<link href="<?=$webroot.'/'.$tpl_root.'/css/font-awesome/css/font-awesome.min.css' ?>" rel="stylesheet" type="text/css" media="screen" />

<!--[if lt IE 9]>
	<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
	<script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

