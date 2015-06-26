<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			//-- data backup begin--
			function dataImgClick(o){
			   
			    alert( $(o).attr("name"));
			   
				var a = $(o).find("input").attr("checked",true);
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
				//if(!confirm("<?=$tconfirm ?>?")) return;
				var f = $("input[name='selbkfile']:checked").val();
				if( fileName == 'all' ) f = 'all';
				if(!confirm("<?=$tconfirm?>?")){ return false; }
				$.post("Admin!delBackupFile",{"filename":f},
				function(data){
				if(data=="true"){ 	location.reload();	}
				else{	alert("<?=$tfailed ?>");	}
				},"html"
				);
				}

		    function restoreData(){
				var f = $("input[name='selbkfile']:checked").val();
				if (typeof(f) == "undefined") {
				alert("<?=$noteSelFile ?>");
				return;
				}
				if(!confirm("<?=$tconfirm ?>?")) return;

				$.post("Admin!restore",{"selbkfile":f},
				function(data){
				if(data=="true"){
				alert("<?=$tsuccess ?>");
				location.reload();
				}else{
				alert("<?=$trestoretips?>");
				}
				},"html"
				);
				}

			function doUpload(){
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
									<h1 class="page-header"><?=$tdatamng?></h1>
								</div>
							</div>
							<!-- /.row -->

							<div class="row">
								<div class="col-lg-12">
									<h2>
										<button type="button" class="btn btn-success" onclick="doBackup();"><?=$tbackup?></button>
										<button type="button" class="btn btn-danger" onclick="doDelFile('all');" ><?=$tclear?></button>
										<button type="button" class="btn btn-danger" onclick="doDelFile('');" ><?=$tdelete?></button>
										<button type="button" class="btn btn-danger" onclick="restoreData();" ><?=$trestore?></button>
									</h2>
								</div>	
								<div class="col-lg-12">
									<!-- data backup begin-->
									<? foreach ($fileList as $f){?>
										
										<div style="display:inline; line-height:50px;padding-right:30px;"><a href="File!download?filename=backup/<?=$f?>"><?=$f ?></a>&nbsp;<input type="radio" name="selbkfile" value="<?=$f?>" /></div>
									
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
