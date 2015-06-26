<?php

require_once('LogUtil.php');

class ZipUtil {


	function unzip($src_file, $dest_dir = false, $create_zip_name_dir = true, $overwrite = true) {

		$zip = new ZipArchive;//新建一个ZipArchive的对象
		$dest_dir = substr($src_file, 0, strrpos($src_file, "."));

		if ($zip->open($src_file) === TRUE)
		{
			$zip->extractTo($dest_dir);
			$zip->close();
			 return true;
		}
		return false;
		/*
		if ($zip = zip_open($src_file)) {
		if ($zip) {
		$splitter = ($create_zip_name_dir === true) ? "." : "/";
		if ($dest_dir === false)
		$dest_dir = substr($src_file, 0, strrpos($src_file, $splitter)) . "/";

		$this->create_dirs($dest_dir);

		while ($zip_entry = zip_read($zip)) {
		$pos_last_slash = strrpos(zip_entry_name($zip_entry), "/");
		if ($pos_last_slash !== false) {
		$this->create_dirs($dest_dir . substr(zip_entry_name($zip_entry), 0, $pos_last_slash +1));

		}
		if (zip_entry_open($zip, $zip_entry, "r")) {
		$file_name = $dest_dir . zip_entry_name($zip_entry);
		if ($overwrite === true || $overwrite === false && !is_file($file_name)) {
		$fstream = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

		if(!is_dir($file_name)){
		file_put_contents($file_name, $fstream);
		chmod($file_name, 0777);
		//								echo "save: " . $file_name . "<br />";
		}

		}
		zip_entry_close($zip_entry);
		}
		}
		zip_close($zip)
		}
		} ;
		else {
			return false;
		}

		return true;*/
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

