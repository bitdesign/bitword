<?php
class Info{
	function getOS(){
		global $_SERVER;
		$agent=$_SERVER["HTTP_USER_AGENT"];
		$os=false;
		if(eregi("win",$agent)&&strpos($agent,"95"))
		{
			$os="Windows 95";
		}else if(eregi("win 9x",$agent)&&strpos($agent,"4.90"))
		{
			$os="Windows ME";
		}else if(eregi("win",$agent)&&eregi('98',$agent))
		{
			$os="Windows 98";
		}else if(eregi("win",$agent)&&eregi('nt 5.1',$agent))
		{
			$os="Windows XP";
		}else if(eregi("win",$agent)&&eregi('nt 5',$agent))
		{
			$os="Windows 2000";
		}else if(eregi("win",$agent)&&eregi('nt',$agent))
		{
			$os="Windows NT";
		}else if(eregi("win",$agent)&&eregi('32',$agent))
		{
			$os="Windows 32";
		}else if(eregi("linux",$agent))
		{
			$os="Linux";
		}else if(eregi("unix",$agent))
		{
			$os="Unix";
		}else if(eregi("sun",$agent)&&eregi("os",$agent))
		{
			$os="SunOS";
		}else if(eregi("ibm",$agent)&&eregi("os",$agent))
		{
			$os="IBM OS/2";
		}else if(eregi("mac",$agent)&&eregi("pc",$agent))
		{
			$os="Macintosh";
		}else if(eregi("powerpc",$agent))
		{
			$os="PowerPC";
		}else if(eregi("aix",$agent))
		{
			$os="AIX";
		}else if(eregi("HPUX",$agent))
		{
			$os="HPUX";
		}else if(eregi("netbsd",$agent))
		{
			$os="NetBSD";
		}else if(eregi("bsd",$agent))
		{
			$os="BSD";
		}else if(eregi("OSF1",$agent))
		{
			$os="OSF1";
		}else if(eregi("IRIX",$agent))
		{
			$os="IRIX";
		}else if(eregi("FreeBSD",$agent))
		{
			$os="FreeBSD";
		}else if(eregi("teleport",$agent))
		{
			$os="teleport";
		}else if(eregi("flashget",$agent))
		{
			$os="flashget";
		}else if(eregi("webzip",$agent))
		{
			$os="webzip";
		}else if(eregi("offline",$agent))
		{
			$os="offline";
		}else{
			$os="Unknown";
		}
		return $os;
	}

	function getVer(){
		$php_version = explode('-', phpversion());
		$php_version = $php_version[0];
		return $php_version;
		//$php_version_ge529 = strnatcasecmp($php_version, '5.2.9') >= 0 ? true : false; //=0表示版本为5.2.9  ＝1表示大于5.2.9 =-1表示小于5.2.9
	}
	function getMysqlVer(){
		$mysql_version = explode('-', mysql_get_server_info());
		$mysql_version = $mysql_version[0];
		return $mysql_version;

	}
	function getAttMaxsize(){
		return  ini_get('upload_max_filesize');
	}

	function getDiskTotalSpace($disk)
	{
		$totalsize = disk_total_space($disk);
		$ret = $this->getRealSize($totalsize);
		return $ret;
	}

	function getDiskFreeSpace($disk)
	{
		$freesize = disk_free_space($disk);
		$ret = $this->getRealSize($freesize);
		return $ret;
	}

	function getDiskUsedSpace($disk)
	{
		$usedsize = disk_total_space($disk) - disk_free_space($disk);
		$ret = $this->getRealSize($usedsize);
		return $ret;
	}

	function getRealSize($size)
	{
		$kb = 1024;         // Kilobyte
		$mb = 1024 * $kb;   // Megabyte
		$gb = 1024 * $mb;   // Gigabyte
		$tb = 1024 * $gb;   // Terabyte

		if($size < $kb)
		{
			return $size." B";
		}
		else if($size < $mb)
		{
			return round($size/$kb,1)." KB";
		}
		else if($size < $gb)
		{
			return round($size/$mb,2)." MB";
		}
		else if($size < $tb)
		{
			return round($size/$gb,1)." GB";
		}
		else
		{
			return round($size/$tb,1)." TB";
		}
	}

	function getWinFolderSize($folder)
	{
		$obj = new COM ('scripting.filesystemobject');
		if ( is_object ( $obj ) )
		{
			$ref = $obj->getfolder ( $folder );
			echo 'Directory: ' . $folder . ' => Size: ' . getRealSize($ref->size);
			$obj = null;
		}
		else
		{
			echo 'can not create object';
		}
	}

	function getFolderSize($path)
	{
		$size = directory_size($path);
		$ret = getRealSize($size);
		return $ret;
	}

	function directory_size($dir)
	{
		$byte_size = 0;
		$dir_array = scandir($dir);
		foreach($dir_array as $key=>$filename)
		{
			if($filename!=".." && $filename!=".")
			{
				if(is_dir($dir."/".$filename))
				{
					$new_foldersize = directory_size($dir."/".$filename);
					$byte_size = $byte_size + $new_foldersize;
				}
				else if(is_file($dir."/".$filename))
				{
					$byte_size = $byte_size + filesize($dir."/".$filename);
				}
			}
		}
		return $byte_size;
	}
	
	
	function get_server_ip(){
	    
	    
		if (isset($_ENV["HOSTNAME"]))
		$MachineName = $_ENV["HOSTNAME"];
		else if  (isset($_ENV["COMPUTERNAME"]))
		$MachineName = $_ENV["COMPUTERNAME"];
		else $MachineName = $_SERVER["SERVER_NAME"];
		return  GetHostByName($MachineName); //该函数特别慢 1到5秒 和网络有关
	}
	
	function get_server_info(){
		return array('os_ver'=>php_uname(),'server_ip'=>"",'webserver'=>$_SERVER['SERVER_SOFTWARE'],'domain_name'=>$_SERVER['SERVER_NAME']);
	}
}

?>