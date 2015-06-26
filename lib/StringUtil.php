<?php
function GBsubstr($string, $start, $length) {
	if(strlen($string)>$length){
		$str=null;
		$len=$start+$length;
		for($i=$start;$i<$len;$i++){
			if(ord(substr($string,$i,1))>0xa0){
				$str.=substr($string,$i,2);
				$i++;
			}else{
				$str.=substr($string,$i,1);
			}
		}
		return $str;
	}else{
		return $string;
	}
}


/*  111,222, => '111','222' */
function formatString($str){
	$str = str_replace(" ", "",$str);
	$arr = explode(",",$str);
	$count = sizeof($arr);
	$output="";
	for( $i=0; $i< $count; $i++){
		if( strlen($arr[$i]) <1 ) continue;
		$output.="'";
		$output.=$arr[$i];
		$output.="',";
	}
	return substr($output,0,-1);
}

function removeElement($str,$startflag,$endflag) {
	$endflagLen = strlen($endflag);
	$fromIndex = strpos($str,$startflag);
	if($fromIndex<0) {
		return $str;
	}
	$toIndex = strpos($str, $endflag, $fromIndex);
	if(!$toIndex) {
		return substr($str,0,$fromIndex);
	}
	$frontPart = substr($str,0,$fromIndex);
	$backPart = substr($str,$toIndex+$endflagLen);
	return substr($str,0,$fromIndex).substr($str,$toIndex+$endflagLen);
}
function removeAllElement($str,$startflag,$endflag) {
	while(strpos($str,$startflag,0)>-1){
		$str = removeElement($str,$startflag,$endflag);
	}
	return $str;
}
/*
$str = '<img src=http://www.mayi1917.com/tools/umeditor-1.2.2/php/upload/20141214/14185008258783.jpg _src=http://www.mayi1917.com/tools/umeditor-1.2.2/php/upload/20141214/14185008258783.jpg/>原来不是手机的问题，换chrome就好了。umeditor是支持安卓上传图片的。									';
$startflag = '<img';
$endflag = '/>';
echo removeElement($str,$startflag,$endflag);
*/

/* remove html css js space */
function plainSubText($string, $sublen)
{
	$string = strip_tags($string);
	$string = preg_replace ('/\n/is', '', $string);
	//$string = preg_replace ('/ |　/is', '', $string);
	$string = preg_replace ('/&nbsp;/is', '', $string);

	preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $t_string);
	if(count($t_string[0]) - 0 > $sublen) $string = join('', array_slice($t_string[0], 0, $sublen))."…";
	else $string = join('', array_slice($t_string[0], 0, $sublen));
	return trim($string);
}