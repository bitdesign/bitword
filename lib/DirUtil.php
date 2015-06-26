<?php
class DirUtil {
	function traverse($path = '.') {
		$arr = array ();
		$current_dir = opendir($path);
		while (($file = readdir($current_dir)) !== false) {
			$sub_dir = $path . DIRECTORY_SEPARATOR . $file;
			if ($file == '.' || $file == '..') {
				continue;
			} else
				if (is_dir($sub_dir)) {
					$this->traverse($sub_dir);
				} else {
					array_push($arr, $file);
				}
		}
		return $arr;
	}
	
	function traversedir($path = '.') {
		$current_dir = opendir($path);
		while (($file = readdir($current_dir)) !== false) {
			$sub_dir = $path . DIRECTORY_SEPARATOR . $file;
			if ($file == '.' || $file == '..') {
				continue;
			} else
				if (is_dir($sub_dir)) {
					echo $file . '<br>';
					//$this->create_dirs("./tmp/".$file);
					$this->traversedir($sub_dir);
				} 
		}
	}
	
	function listdir($path = '.') {
		$arr = array ();
		$current_dir = opendir($path);
		while (($file = readdir($current_dir)) !== false) {
			$sub_dir = $path . DIRECTORY_SEPARATOR . $file;
			if ($file == '.' || $file == '..') {
				continue;
			} else
				if (is_dir($sub_dir)) {
					array_push($arr, $file);
				}
		}
		return $arr;
	}
	
	function create_dirs($path) {
		if (!is_dir($path)) {
			$directory_path = "";
			$directories = explode("/", $path);
			array_pop($directories);
			foreach ($directories as $directory) {
				$directory_path .= $directory . "/";
				if (!is_dir($directory_path)) {
					mkdir($directory_path);
					chmod($directory_path, 0777);
				}
			}
		}
	}
}



