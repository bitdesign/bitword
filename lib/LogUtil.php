<?php
class LogUtil {

	private  $fp;
	public static $logger;
	public static $log_file_name;
	
	function __construct($file_name, $mode="a") {
		if($this->fp != null ){
			 fclose($this->fp);
		}
		$this->fp = fopen($file_name, $mode);
	}
	
	static function getLogger($dir="log/"){
		if (LogUtil::$logger == null ||  LogUtil::$log_file_name != "sys_".date('Y_m_d').".log") {
			LogUtil::$log_file_name = "sys_".date('Y_m_d').".log";
			LogUtil::$logger = new LogUtil($dir.LogUtil::$log_file_name);;
		}
		return LogUtil::$logger;		
	}
	
	function info( $str ){
		$curTm = date("Y-m-d H:i:s",time());
		fwrite($this->fp, "[$curTm] $str \r\n");
	}
	function release() {
		if ($this->fp != null) {
			fclose($this->fp);
			LogUtil::$logger = null;
		}
	}
	function __destruct() {
		if ($this->fp != null) {
			fclose($this->fp);
			LogUtil::$logger = null;
		}
	}
}