<?
class Installer {
	
	public $msg = array ();
	public $lan = "en";
	
	
	
	public $connfail = array(
	    "en" => "Database connect failed.",
	    "cn" => "数据库连接失败了,请确认您的数据库主机地址，用户名以及密码是否正确。"
	    );
	    
	public $dbnone = array(
	    "en" => "The database name you input is not exist.",
	    "cn" => "您输入的数据库名不存在。"
	    );
	    
	function __construct( $lan ){
	    $this->lan = $lan;
	}
	
	function add($msg) {
		array_push($this->msg, "<font color=green>$msg</font>");
	}
	
	function addError($msg) {
		array_push($this->msg, "<font color=red>$msg</font>");
	}
	
	function connect_to_db($hostname, $username, $password) {
		$conn = mysql_connect($hostname, $username, $password);
		if($conn){
			mysql_query("SET NAMES UTF8");
			//$this->add("Database connect success");
		}else{
			$this->addError($this->connfail[$this->lan]);
			return false;
		}
		return $conn;
	}
	
	function create_db($conn , $dbname){
		
		$sql = "CREATE DATABASE  if not exists  `$dbname`  DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci";
		if (mysql_query($sql, $conn)) {
			//$this->add("Create database $dbname success");
		} else {
			//$this->addError("Create database $dbname failed[$sql]" . mysql_error());
			return false;
		}
		
		return true;
	}
	
	function exec_sql_script($dbname, $dbprefix, $sqlfile){
		global $errors;
		@ mysql_select_db($dbname);
		$mqr = @ get_magic_quotes_runtime();
		@ set_magic_quotes_runtime(0);
		$query = fread(fopen($sqlfile, "r"), filesize($sqlfile));
		@ set_magic_quotes_runtime($mqr);
		$pieces = $this->split_sql($query);
		for ($i = 0; $i < count($pieces); $i++) {
			$pieces[$i] = trim($pieces[$i]);
			if (!empty ($pieces[$i]) && $pieces[$i] != "#") {
				$pieces[$i] = str_replace("#__", $dbprefix, $pieces[$i]);
				if (!$result = @ mysql_query($pieces[$i])) {
					$errors[] = array (
						mysql_error(),
						$pieces[$i]
					);
					return false;
				}
			}
		}
		return true;
	}

	function split_sql($sql){
		$sql = trim($sql);
		$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);
		$buffer = array ();
		$ret = array ();
		$in_string = false;
		for ($i = 0; $i < strlen($sql) - 1; $i++) {
			if ($sql[$i] == ";" && !$in_string) {
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i +1);
				$i = 0;
			}
			if ($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
				$in_string = false;
			}
			elseif (!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset ($buffer[0]) || $buffer[0] != "\\")) {
				$in_string = $sql[$i];
			}
			if (isset ($buffer[1])) {
				$buffer[0] = $buffer[1];
			}
			$buffer[1] = $sql[$i];
		}
		if (!empty ($sql)) {
			$ret[] = $sql;
		}
		return ($ret);
	}

	function install($hostname, $user, $pwd, $dbname, $admname, $admpwd,$ihavedb,$sqlfile,$webroot) {
		
		//connect MySQL
		$conn = $this->connect_to_db($hostname, $user, $pwd);
		if(!$conn){
			return false;
		}
		
		//Create database
		if(!$ihavedb){
			//$this->add("Create a new database");
			if(!$this->create_db($conn,$dbname)){
				return false;
			}
		}else{
			//$this->add("Use current database $dbname");
		}
		
		//choose database
		$info = mysql_select_db($dbname, $conn);
		if(!$info){
			$this->addError($this->dbnone[$this->lan]." [$dbname]");
			return false;
		}else{
			//$this->add("Choose database success");
		}
		
		//create system tables
		if ($this->exec_sql_script($dbname, '',$sqlfile)) {
			//$this->add("Create database OK");
		} else {
			//$this->addError("Create database failed");
			return false;
		}
		
		//Write the connection information to the  file
		$this->write2cfg($hostname, $user, $pwd, $dbname,$webroot,$this->lan);
		
		//Create administrator account
		$insert = "insert into users(usr_nm,usr_pwd,usr_rnm,usr_sts) values('".$admname."','".$admpwd."','Administrator',1)";
		if(mysql_query($insert)){
			//$this->add("Create administrator account OK");
		}else{
			//$this->addError("Create administrator account failed");
		}
		
		//$this->add("Install completely!");
		
		return true;
	}

	function write2cfg($hostname, $user, $pwd, $dbname,$webroot,$lan) {
		$file = dirname(__FILE__) . '/../config/config.php';
		$fp = fopen($file, "w");
		$content = '<?' . "\n";
		$content .= '$mysql_host="' . $hostname . "\";\n";
		$content .= '$mysql_user="' . $user . "\";\n";
		$content .= '$mysql_pass="' . $pwd . "\";\n";
		$content .= '$mysql_dbname="' . $dbname . "\";\n";
		$content .= '$webroot="' . $webroot . "\";\n";
		$content .= '$lan="' . $lan . "\";\n";
		$content .= '?>';
		$flag = fwrite($fp, $content);
		if ($flag) {
			$this->add("Database configuration file is written successfully");
		} else {
			$this->addError("Database configuration file write failed");
		}
		fclose($fp);
	}
}