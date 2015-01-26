<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			//-- data backup begin--
			function dataImgClick(o){
				var a = $(o).find('input').attr("checked",true);
				var f = $("input[name='selbkfile']:checked").val();
				$("img[name='dataSpan']").css('border','none');
				$(o).css('border','1px solid #aaa');
			}
			function doBackup(){
				$.post("Admin!backup",
				function(data){
					location.reload();
				},"html"
			);}
			function doDelFile(fileName){
				//if(!confirm("<?=$tconfirm[$lan] ?>?")) return;
				var f = $("input[name='selbkfile']:checked").val();
				if( fileName == 'all' ) f = 'all';
				if(!confirm("<?=$tconfirm[$lan]?>?")){ return false; }
				$.post("Admin!delBackupFile",{"filename":f},
				function(data){
				if(data=="true"){ 	location.reload();	}
				else{	alert("<?=$tfailed[$lan] ?>");	}
				},"html"
				);
				}

				function restoreData(){
				var f = $("input[name='selbkfile']:checked").val();
				if (typeof(f) == "undefined") {
				alert("<?=$noteSelFile[$lan] ?>");
				return;
				}
				if(!confirm("<?=$tconfirm[$lan] ?>?")) return;

				$.post("Admin!restore",{"selbkfile":f},
				function(data){
				if(data=="true"){
				alert("<?=$tsuccess[$lan] ?>");
				location.reload();
				}else{
				alert("<?=$trestoretips[$lan]?>");
				}
				},"html"
				);
				}

				function doUpload()
				{
				var localFilename = $("#bkfile").val();
				var idx = localFilename.lastIndexOf('\\');
				if(idx<0){
					idx = localFilename.lastIndexOf('/');
					}
					filename = localFilename.substring(idx+1);
					$.ajaxFileUpload({
					url:'File!upload',
					data:{'name':'bkfile','path':'backup'},
					type:'POST',
					secureuri:false,
					fileElementId:'bkfile',
					dataType: 'json',
					success: function (data, status){
					if(data.msg == "true"){
					location.reload();
					}
					else{
					alert(data.msg);
					return;
					}
					},
					error: function (data, status, e){
					alert(e);
					}
					});
					}
					//-- data restore end--
				</script>
			</head>
			<body>
				<div id="wrapper">

					<? require_once('_navigation.php'); ?>

					<div id="page-wrapper">

						<div class="container-fluid"  >

							<!-- Page Heading -->
							<div class="row">
								<div class="col-lg-12">
									<h1 class="page-header"><?=$tdatamng[$lan]?></h1>
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-dashboard"></i>  <a href="Admin!dashboard">Dashboard</a>
										</li>
										<li class="active">
											<i class="fa fa-database"></i> <?=$tdatamng[$lan]?>
										</li>
									</ol>
								</div>
							</div>
							<!-- /.row -->

							<div class="row">
								<div class="col-lg-12">
									<h2>
										<button type="button" class="btn btn-success" onclick="doBackup();"><?=$tbackup[$lan]?></button>
										<button type="button" class="btn btn-danger" onclick="doDelFile('all');" ><?=$tclear[$lan]?></button>
										<button type="button" class="btn btn-danger" onclick="doDelFile('');" ><?=$tdelete[$lan]?></button>
										<button type="button" class="btn btn-danger" onclick="restoreData();" ><?=$trestore[$lan]?></button>
									</h2>
									<!-- data backup begin-->
									<?foreach ($fileList as $f){?>
									
									<div style="width:120px;float:left;margin-top:20px;">
										<img src="images/data.png" onclick="dataImgClick(this);" name="dataSpan"/>
										<input type="radio" name="selbkfile" value="<?=$f?>" style="visibility:hidden;"/>
										<div  style="width:100%;text-align:left;" ><a href="File!download?filename=backup/<?=$f?>"><?=substr($f,10,-6)?></a></div>
									</div>
								
									
									<?}?>
									<!-- data backup end-->

								</div>
							</div>
							<!-- /.row -->

						</div>
						<!-- /.container-fluid -->

					</div>
					<!-- /#page-wrapper -->

				</div>
				<!-- /#wrapper -->

				<!-- jQuery -->

			</body>
		</html>
