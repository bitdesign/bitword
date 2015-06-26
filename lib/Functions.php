<?php
function btime($str){
	return date('Y-m-d H:i:s',strtotime($str));
}
function bitdate($str){
	return date('Y-m-d',strtotime($str));
}
/* 20131024143623 ===> December 27th, 2010 */
function title_time($str){
	return date('F jS, Y',strtotime($str));
}
function title_time_month($str){
	return substr(date('F',strtotime($str)),0,3);
}
function title_time_date($str){
	return substr($str,6,2);
}



function tarray($arr){
	return empty($arr)?array():$arr;
}


function formatjs($str){
	$str = str_replace('"','\"',$str);
	$str = str_replace('script','scr"+"ipt',$str);
	$str = '"'.$str.'"';
	return $str;
}

