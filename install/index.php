<!DOCTYPE html">
<html>
	<head>
		<title>Install</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="install.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<div class="all">
				<div class="header">
					<div class="logo"></div>
					<div class="icon_install">Install guide</div>
				</div>
				<? 
				error_reporting(0); 
				if($_GET["step"]=="" ){
				?>
				<div class="main">
					<pre class="pact" readonly="readonly">
						<?
							require_once "agreement.html"; 
						?>
					</pre>
					<div class="bottom tac">
						<a class="btn" href="index.php?step=1">Accept</a>
					</div>
				</div>
				<? 
				}else if($_GET["step"]=="1" ){
				require_once "../lib/Info.php"; 
				$info = new Info();
				?>
				<div class="step">
					<ul>
						<li class="current">
							<em>1</em>
							Environment
						</li>
						<li>
							<em>2</em>
							Install database
						</li>
						<li>
							<em>3</em>
							Complete
						</li>
					</ul>
				</div>
				<div class="main">
					<table>
						<tr>
							<td class="td1">Environment check</td>
							<td class="td1" width="25%">recommend</td>
							<td class="td1" width="25%">current</td>
							<td class="td1" width="25%">minimum</td>
						</tr>
						<tr>
							<td>OS</td>
							<td>UNIX</td>
							<td><span class="correct_span">√</span><?=$info->getOS();?></td>
							<td>-</td>
						</tr>
						<tr>
							<td>PHP Version</td>
							<td>5.3.x</td>
							<td>
								<span class="<?=strnatcmp($info->getVer(),'5.1.2')>0?'correct_span':'error_span';?>">√</span>
								<?=$info->getVer();?>
							</td>
							<td>5.1.2</td>
						</tr>
						<!--
						<tr>
							<td>Mysql Version（client）</td>
							<td>>5.x.x</td>
							<td>
								<span class="<?=strnatcmp($info->getMysqlVer(),'4.2')>0?'correct_span':'error_span';?>">√</span>
								<?=$info->getMysqlVer();?>
							</td>
							<td>4.2</td>
						</tr>
						-->
						<tr>
							<td>Attachment</td>
							<td>>2M</td>
							<td>
								<span class="correct_span">√</span>
								<?=$info->getAttMaxsize();?>
							</td>
							<td>-</td>
						</tr>
						<tr>
							<td>Disk space</td>
							<td>>10M</td>
							<td>
								<span class="<?=strnatcmp($info->getDiskFreeSpace('.'),'0.01G')>0?'correct_span':'error_span';?>">√</span>
								<?=$info->getDiskFreeSpace(".");?>
							</td>
							<td>10M</td>
						</tr>
						<tr><td colspan="4"></td></tr>
						<tr><td colspan="4"></td></tr>
						<tr><td colspan="4"></td></tr>
						<tr><td colspan="4"></td></tr>
						<tr><td colspan="4"></td></tr>
						<tr><td colspan="4"></td></tr>
					</table>
					<div class="bottom tac">
						<a class="btn" href="index.php?step=1">Check Again</a>
						<a class="btn" href="index.php?step=2">Next Step</a>
					</div>
				</div>
				<? 
				}else if($_GET["step"]=="2" ){
				?>
				<div class="step">
					<ul>
						<li>
							<em>1</em>
							Environment
						</li>
						<li class="current">
							<em>2</em>
							Install database
						</li>
						<li>
							<em>3</em>
							Complete
						</li>
					</ul>
				</div>
				<div class="main">
					<form name="myform" action="index.php?step=3" method="POST">
						<div class="server">
							<table>
								<tr><td colspan="2" style="float:left;"><h3 style="color:#417B9D;float:left;">Database Server</h3></td></tr>
								<tr><th>Hostname:</th><td><input type="text" name="hostname" value="localhost"/></td></tr>
								<tr><th>UserName:</th><td><input type="text" name="username" value="root"/></td></tr>
								<tr><th>Password:</th><td><input type="password" name="password" value=""/></td></tr>
								<tr><th>Database Name:</th><td><input type="text" name="dbname" value="_bit_blog"/></td></tr>
								<tr><th></th><td><input type="checkbox"  name="ihavedb"/>Use a exist database</td></tr>
								<tr><td colspan="2" style="float:left;"><h3 style="color: #417B9D;float:left;">Administrator User</h3></td></tr>
								<tr><th>Account:</th><td><input type="text" name="adminname" value="admin"/></td></tr>
								<tr><th>Password:</th><td><input type="password" name="adminpwd" value="admin"/></td></tr>
								<tr><td colspan="2" style="float:left;"><h3 style="color: #417B9D;float:left;">Select Language</h3></td></tr>
								<tr><th>Language:</th><td>
										<select name="language"><option value="en">English</option><option value="cn">中文</option></select>
								</td></tr>
							</table>
						</div>
					</form>
				
					<div class="bottom tac">
						<a class="btn" href="index.php?step=1">Pre Step</a>
						<a class="btn" onclick="javascript:document.myform.submit()">Install Now</a>
					</div>
				</div>
				<? 
				}else if($_GET["step"]=="3" ){
					require_once "../lib/Installer.php";
					$hostname = $_POST["hostname"];
					$username = $_POST["username"];
					$password = $_POST["password"];
					$dbname = $_POST["dbname"];
					$adminname = $_POST["adminname"];
					$adminpwd = md5($_POST["adminpwd"]);
					$ihavedb = $_POST["ihavedb"];
					$ihavedb = ($ihavedb=="on"||$ihavedb==true)?true:false;
					
					$lan = $_POST["language"];
					$installer = new Installer();
					
					$SCRIPT_NAME = $_SERVER['SCRIPT_NAME'];
					$POS = strpos($SCRIPT_NAME, 'install',0);
					$webroot = substr($SCRIPT_NAME,0,$POS-1);


					$installer->install($hostname, $username, $password, $dbname, $adminname, $adminpwd,$ihavedb,"bitcms.sql",$webroot,$lan);
					$msgarr = $installer->msg;
					?>
				<div class="step">
					<ul>
						<li>
							<em>1</em>
							Environment
						</li>
						<li>
							<em>2</em>
							Install database
						</li>
						<li class="current">
							<em>3</em>
							Complete
						</li>
					</ul>
				</div>
				<div class="main">
					<div class="pact" style="padding:10px;" readonly="readonly">
						<?
						foreach ($msgarr as $msg){
							echo "<p>$msg</p>";
						}
						?>
					</div>
					<div class="bottom tac">
						<a class="btn" href="index.php?step=2">Pre Step</a>
						<a class="btn" href="<?=$webroot?>/Home!indexDyn">Complete</a>
					</div>
				</div>
				<?}?>
		</div>
	</body>
	
</html>