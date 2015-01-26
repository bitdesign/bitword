<?php
class ArrayUtil {

	static function getString($arr){
		$ret = 'size='.sizeof($arr).'[';
		foreach ($arr as $key => $value) 
		{
		   $ret .= $key.'->'.$value.',';
		}
		$ret = substr($ret,0,-1);
		$ret .= ']';
		return $ret;		
	}
}