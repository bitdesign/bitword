<?php

require_once('lib/LogUtil.php');

class MySQL {

	private $conn;
	public $logger;
	function __construct($path, $usr, $pass_wd, $db_name) {
		
		if ($this->conn == null) {
			$this->conn = mysql_connect($path, $usr, $pass_wd, true) or die("cannot connect datebase " . $path . " :" . mysql_error());
			mysql_select_db($db_name, $this->conn) or die("cannot select datebase " . $db_name . " :" . mysql_error());
			mysql_query("SET NAMES UTF8");
		}
		$this->logger = LogUtil::getLogger();
	}

	//Insert $_POST[],  POST's key must same with the database field
	public function postInsert($table, array $arr) {

		foreach ($arr as $val) {
			$fileds .= $val . ",";
			$values .= "'" . $_POST[$val] . "',";
		}
		$fileds = rtrim($fileds, ',');
		$values = rtrim($values, ',');
		$sql = "insert into " . $table . "(" . $fileds . ") values (" . $values . ")";

		$ret = mysql_query($sql);
		return mysql_insert_id();
	}

	//Insert $_POST[] or save if exists，mysql need set the $dup fields unique
	public function postSave($table, array $arr) {

		$fileds = "";
		$values = "";
		$dups = "";
		foreach ($arr as $val) {
			$fileds .= $val . ",";
			$values .= "'" . $_POST[$val] . "',";
			$dups .= $val . "=VALUES(" . $val . "),";
		}
		$fileds = rtrim($fileds, ',');
		$values = rtrim($values, ',');
		$dups = rtrim($dups, ',');
		$sql = "insert into " . $table . "(" . $fileds . ") values (" . $values . ")";
		$sql .= " ON DUPLICATE KEY UPDATE " . $dups;
		//$this->logger->info($sql);
		$ret = mysql_query($sql);
		//$this->logger->info(mysql_error());
	}

	//insert $_POST[]'s name-value pairs 
	public function postInsertPair($table, array $arr) {

		$sql = "insert into " . $table . "(name,value) values";
		foreach ($arr as $val) {
			$key = $val;
			$value = $_POST[$val];
			$sql .= "('" . $key . "','" . $value . "'),";
		}
		$sql = rtrim($sql, ',');

		$sql .= " ON DUPLICATE KEY UPDATE value =VALUES(value)";
		return mysql_query($sql);
	}

	public function postCheck($table, array $arr) {
		foreach ($arr as $val) {
			$conditons .= $val . "='" . $_POST[$val] . "' and ";
		}
		$conditons = rtrim($conditons, " and");
		$sql = "select count(*) as CNT from " . $table . " where " . $conditons;
		$rs = mysql_query($sql);
		if (!$rs->Eof) {
			$retcod = intval($rs->fields["CNT"]);
			return $retcod;
		}
	}

	public function fetchAll($table) {
		$sql = "select * from " . $table;
		$result = mysql_query($sql);
		return $result;
	}

	public function queryForArray($table, $option = "") {
		
		$arr = array ();
		
		$sql = "select * from " . $table;
		if ($option != "") {
			$sql .= " " . $option;
		}
		//require_once "lib/LogUtil.php";
		//$logger = LogUtil::getLogger();
		//$logger->info($sql);
		
		$result = mysql_query($sql);
		if( empty($result) ) return $arr;
		
		while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			if( ! empty($row)){
				array_push($arr, $row);
			}
		}
		return $arr;
	}
	
	//qeury maxNum  records
	public function queryForArrayLimit($table, $option = "",$maxNum=100) {
		$sql = "select * from " . $table;
		if ($option != "") {
			$sql .= " " . $option;
		}
		$sql .= " limit 0," . $maxNum;
		
		$result = mysql_query($sql);
		$arr = array ();
		while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			array_push($arr, $row);
		}
		return $arr;
	}

	public function readRecords($table, $option) {
		$sql = "select * from " . $table . " where " . $option;
		$result = mysql_query($sql);
		return $result;
	}

	//get the first record
	public function readRecord($table, $option="1=1") {
		
		$sql = "select * from " . $table . " where " . $option;
		$result = mysql_query($sql);
		if (!$result) {
			return;
		}
		$record = mysql_fetch_array($result,MYSQL_ASSOC);
		return $record;
	}

	//get the first record's one field
	public function readField($table, $option, $field) {
		$sql = "select * from " . $table . " where " . $option;
		$result = mysql_query($sql);
		if (!$result) {
			return;
		}
		$record = mysql_fetch_array($result,MYSQL_ASSOC);
		return $record[$field];
	}

	//select $table's 2 colums $key and $value ,use the first as  name and the second as value，convert to a row
	public function row2col($table, $key, $value) {

		$str = "SELECT ";
		$sql = "select " . $key . "," . $value . " from " . $table;
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$str .= "group_concat(if(" . $key . "='" . $row[$key] . "'," . $value . ",'') separator '') AS " . $row[$key] . ",";
		}
		$str = rtrim($str, ",");
		$str .= " FROM " . $table . " group by '1'";

		
		
		$result = mysql_query($str);
		if (!$result) {
			return null;
		}
		$record = mysql_fetch_array($result,MYSQL_ASSOC);
		
		return $record;
		/*
			group_concat(if(sname='logo',svalue,'') separator '') AS logo,
			group_concat(if(sname='keywords',svalue,'') separator '') AS keywords,
			group_concat(if(sname='name',svalue,'') separator '') AS name
			FROM siteparas
			group by '1'";
			*/
	}

	//update one record
	public function postUpdate($table, array $fields, $option) {
		foreach ($fields as $field) {
			$conditons .= $field . "='" . $_POST[$field] . "',";
		}
		$conditons = rtrim($conditons, ",");
		$sql = "update " . $table . " set " . $conditons . " where " . $option;
		mysql_query($sql);
	}
	
	public function isExists($table, $option) {
		$sql = "select * from " . $table . " where " . $option;
		$result = mysql_query($sql);
		$num = mysql_num_rows(mysql_query($sql));
		if( $num>0 ){
			return true;		
		}
		return false;
	}
	
	public function exec($sql) {
		return mysql_query($sql);
	}

	public function del($table, $option) {
	
		$sql = "delete from  " . $table . " where " . $option;
		return mysql_query($sql);
	}
	
	public function getCount($table) {
		$sql = "select count(1) cnt from  " . $table;
		$result = mysql_query($sql);
		if (!$result) {
			return 0;
		}
		$record = mysql_fetch_array($result,MYSQL_ASSOC);
		return $record["cnt"];
	}
	
	public function get_table_structure($db, $table, $crlf) {
		$drop = "";
		$schema_create = "";
//		if (!empty ($drop)) {
//			$schema_create .= "DROP TABLE IF EXISTS `$table`;$crlf";
//		}
		$schema_create .= "DROP TABLE IF EXISTS `$table`;$crlf";
		$result = mysql_db_query($db, "SHOW CREATE TABLE $table");
		$row = mysql_fetch_array($result);
		$schema_create .= $crlf . "-- " . $row[0] . $crlf;
		$schema_create .= $row[1] . $crlf;
		return $schema_create;
	}
	public function get_table_content($db, $table, $crlf) {
		$schema_create = "";
		$temp = "";
		$result = mysql_db_query($db, "SELECT * FROM $table");
		while ($row = mysql_fetch_row($result)) {
			$schema_insert = "INSERT INTO `$table` VALUES   (";
			for ($j = 0; $j < mysql_num_fields($result); $j++) {
				if (!isset ($row[$j]))
					$schema_insert .= " NULL,";
				elseif ($row[$j] != "") $schema_insert .= " '" . addslashes($row[$j]) . "',";
				else $schema_insert .= " '',";
			}
			$schema_insert = ereg_replace(",$", "", $schema_insert);
			$schema_insert .= ");$crlf";
			$temp = $temp . $schema_insert;
		}
		return $temp;
	}
	
	/*
	 * $scope = {"table","data","all"}
	 * 
	 */
	public function backup($db_name,$filename,$scope) {
		$tables = mysql_list_tables($db_name);
		$num_tables = @ mysql_numrows($tables);
		//$fp = fopen("dump.sql", w); 
		$i = 0;
		$crlf = "\r\n";
		$str = "";
		while ($i < $num_tables) {
			$table = mysql_tablename($tables, $i);
			if( strcmp($scope,"table") == 0 ){
				$str .= $this->get_table_structure($db_name, $table, $crlf).";" . $crlf;
			}else if( strcmp($scope,"data") == 0 ){
				$str .= "delete from $table;" . $crlf;
				$str .= $this->get_table_content($db_name, $table, $crlf) . $crlf;
			}else{
				$str .= $this->get_table_structure($db_name, $table, $crlf).";" . $crlf;
				$str .= $this->get_table_content($db_name, $table, $crlf) . $crlf;
			}
			
			$i++;
		}

		$fp = fopen($filename, "w");
		fwrite($fp, $str);
		fclose($fp);
		return $str;
		//fclose($fp);
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
	
	function __destruct() {
		/*	if (self::$conn != null) {
				mysql_close();
			}*/
		if ($this->conn != null) {
			mysql_close($this->conn);
			$this->conn = null;
		}

	}
	
	function release() {
		if ($this->conn != null) {
			mysql_close($this->conn);
			$this->conn = null;
		}

	}
}