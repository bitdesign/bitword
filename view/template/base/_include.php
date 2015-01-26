<title><?=$name?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?=$keywords?>" />
<meta name="Description" content="<?=$description?>" />
<?
include_once "config/site.php"; 
include_once "lib/Functions.php";
include_once "lib/StringUtil.php";
?>
<link href="<?=$webroot.'/'.$tpl_root.'/css/show.css' ?>" rel="stylesheet" type="text/css" media="screen" />
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>-->
<script type="text/javascript" src="<?=$webroot.'/'.$tpl_root?>/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?=$webroot.'/'.$tpl_root?>/js/bitslider.js"></script>
<script type="text/javascript" src="<?=$webroot.'/'.$tpl_root?>/js/jquery.form.js"></script>
<script type="text/javascript" src="<?=$webroot.'/'.$tpl_root?>/js/jquery.validate.js"></script>
