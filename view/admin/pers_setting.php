<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			function doUpload(filename,echoId,fileElementId)
			{
				$.ajaxFileUpload
				({
					url:'File!upload',
					data:{'name':fileElementId,'path':'upload/'},
					type:'POST',
					secureuri:false,
					fileElementId:fileElementId,
					dataType: 'json',
					success: function (data){
						if(data.code == "1"){
							$("#"+echoId).attr("src","upload/"+filename);
						}else{
							alert(data.msg);
						}
					},
					error: function (data){
						alert(data.msg);
					}
				})
				return false;
			}

			function uploadLogo(str,fileElementId){
				filename = $("#logoImage").val();
				var idx = filename.lastIndexOf('\\');
				filename = filename.substring(idx+1);
				$("#logo").val(filename);
				doUpload(filename,"echoLogo",fileElementId);
			}

			function uploadHeaderImg(str,fileElementId){
				filename = $("#headerImg").val();
				var idx = filename.lastIndexOf('\\');
				filename = filename.substring(idx+1);
				$("#headimg").val(filename);
				doUpload(filename,"echoHeadimg",fileElementId);
				saveParas();
			}

			function saveParas(){
				$.post("Setting!saveImg",$('#parasForm').formSerialize(),
				function(data) {
					if(data == "true"){
						alert("<?=$tsuccess[$lan]?>");
						location.href = location.href;
					}else{
						alert("<?=$tfailed[$lan]?>");
					}
				},"html"
				);
			}

			$(function(){
				$("[data-toggle='tooltip']").tooltip(); 
			});
		</script>
	</head>
	<body>
		<div id="wrapper">

			<? require_once('_navigation.php'); ?>

			<div id="page-wrapper">

				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header"><?=$pers_setting[$lan]?></h1>
							<ol class="breadcrumb">
								<li>
									<i class="fa fa-dashboard"></i>  <a href="Admin!dashboard">Dashboard</a>
								</li>
								<li class="active">
									<i class="fa fa-eye"></i> <?=$pers_setting[$lan]?>
								</li>
							</ol>
						</div>
					</div>
					<!-- /.row -->

					<div class="row">
						<div class="col-lg-6">
							<form method="post" id="parasForm" role="form">
								<input class="input_text" type="hidden" id="logo" name="logo" value="<?=$paras['logo']?>"/>
								<input class="input_text" type="hidden" id="headimg" name="headimg" value="<?=$paras['headimg']?>"/>
								
								<div class="panel panel-warning">
		                            <div class="panel-heading">
		                                <h3 class="panel-title">Logo</h3>
		                            </div>
		                            <div class="panel-body">
		                                <img data-toggle="tooltip" title="<?=$tuploadtips[$lan]?>" onclick="$('#logoImage').trigger('click');" style="max-width:100%;" src="upload/<?=$paras['logo']?>" id="echoLogo"/>
		                            </div>
		                        </div>
		                        
		                        <div class="panel panel-warning">
		                            <div class="panel-heading">
		                                <h3 class="panel-title"><?=$theadimg[$lan]?></h3>
		                            </div>
		                            <div class="panel-body">
		                                <img data-toggle="tooltip" title="<?=$tuploadtips[$lan]?>" onclick="$('#headerImg').trigger('click');" style="max-width:100%;" src="upload/<?=$paras['headimg']?>" id="echoHeadimg"/>
		                            </div>
		                        </div>

								<input class="input_file_hidden" type="file"   id="logoImage" name="logoImage"   onchange="uploadLogo(this.value,this.id)" accept="image/*" />
								<input class="input_file_hidden" type="file"   id="headerImg" name="headerImg" onchange="uploadHeaderImg(this.value,this.id)" accept="image/*" />

							</form>
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
