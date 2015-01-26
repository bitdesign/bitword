<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<title><?=$tconsole[$lan]?></title>
		<script language="javascript" type="text/javascript">
						//-- log start --
						function doClearLog(){
							if(confirm("<?=$tconfirm[$lan] ?>?")){
							doDelLogFile("all");
							}
						}
						function doDelLogFile(f){
						$.post("Admin!delLogFile",{"filename":f},
						function(data){
						if(data=="true"){
						location.reload();
						}else{
						alert("<?=$tfailed[$lan] ?>");
						}
						},"html"
						);
						}
						//-- log end--
					</script>
				</head>
				<body>
					<div class="all">
						<? require_once('_header.php'); ?>
						<div class="main">
							<? require_once('_menu.php'); ?>
							<div class="location">
								<a id="nav"><?=$tlog[$lan]?></a>
							</div>
							<div class="right">
								<div class="content">
									<div class="pageContent">
										<!-- log start-->
										<div style="float:left;padding:10px;width:100%;">
												<input type="button" class="large_btn" value=" <?=$tclear[$lan] ?> " onclick="doClearLog();" />
										</div>
										<fieldset>
											<legend></legend>
											<div style="float:left;width:100%;">
												
												<?foreach ($logFileList as $f){?>
												<div style="float:left;padding:10px;background:#eee;margin-left:10px;">
													<a href="File!download&filename=log/<?=$f?>"><?=$f?></a>
													<a onclick=doDelLogFile("<?=$f?>")><font color="red">[<?=$tdelete[$lan]?>]</font></a>
												</div>
												<?}?>
											</div>
										</fieldset>
										<!-- log end-->

									</div>
								</div>

							</div>
						</div>
						<? require_once('_footer.php'); ?>
					</div>
				</body>
			</html>