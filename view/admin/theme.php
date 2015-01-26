<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			// template -- begin--
			function dataImgClick(o){
				var a = $(o).find('input').attr("checked",true);
				$("div[name='dataSpan']").css('background','#fff');
				$(o).css('background','#ccc');
			}

			$(function(){
				$("#<?=$tpl_name?>").parent().css('background','#ccc');
			});

			function activeTpl(){
				var tplNm = $("input[name='tplNm']:checked").val();
				$.post("Setting!saveTpl",{"tpl_name":tplNm},
				function(data) {
					if(data == "true"){
						alert("<?=$tsuccess[$lan]?>");
					}else{
						alert(data);
					}
				},"html"
				);
			}

			function doUploadTpl()
			{
				var localFilename = $("#tpl").val();
				var idx = localFilename.lastIndexOf('\\');
				if(idx<0){
					idx = localFilename.lastIndexOf('/');
				}
				filename = localFilename.substring(idx+1);

				$("#zipfile").val(filename);
				$.ajaxFileUpload({
					url:'File!upload',
					data:{'name':'tpl','path':'view/template'},
					type:'POST',
					secureuri:false,
					fileElementId:'tpl',
					dataType: 'json',
					success: function (data){
						if(data.code == "1"){
							alert("<?=$tuploadsuc[$lan]?>");
							location.href = location.href;
						}else{
							alert(data.msg);
						}
					},
					error: function (data){
						alert(data.msg);
					}
				});
			}
			// template -- end--

			function delTheme(){
				var fileName = $("input[name='tplNm']:checked").val();
				if(fileName=="base"){ 	alert("<?=$tbasedelerror[$lan] ?>"); return;}
				if(!confirm("<?=$tconfirm[$lan]?>?")){ return false; }
				$.post("Admin!delTheme",{"filename":fileName},
				function(data){
					if(data=="true"){ 	alert("<?=$tsuccess[$lan] ?>"); location.href = location.href;	}
					else{	alert("<?=$tfailed[$lan] ?>");	}
					},"html"
					);
				}
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
								<h1 class="page-header"><?=$ttheme[$lan]?></h1>
								<ol class="breadcrumb">
									<li>
										<i class="fa fa-dashboard"></i>  <a href="Admin!dashboard">Dashboard</a>
									</li>
									<li class="active">
										<i class="fa fa-desktop"></i> <?=$ttheme[$lan]?>
									</li>
								</ol>
							</div>
						</div>
						<!-- /.row -->


						<!-- Page Heading -->
						<div class="row">
							<div class="col-lg-12">
								<form action="Admin!unzip" method="POST" id="myform">
									<button type="button" class="btn btn-danger file_btn_float"  onclick="delTheme()" ><?=$tdelete[$lan]?></button>
									<button type="button" class="btn btn-success file_btn_float" onclick="activeTpl();"><?=$tactive[$lan]?></button>

									<button type="button" class="btn btn-primary file_btn" ><?=$tupload[$lan]?></button>
									<input  type="file"   class="btn btn-primary file_file" id="tpl" name="tpl" onchange="doUploadTpl()"  accept=".zip" />

									<input type="hidden" id="zipfile" name="zipfile" value=""/>
								</form>
							</div>
						</div>
						<!-- /.row -->

						<div class="row">
							<form id="tplform">
								<?foreach ($tplList as $tpl){?>
								<div class="col-lg-3" style="width:200px;">
									<div style="float:left;width:180px; padding:10px;margin-top:20px;" onclick="dataImgClick(this);" name="dataSpan">
										<img src="view/template/<?=$tpl?>/preview.png"  style="width:100%;"/>
										<input type="radio" name="tplNm" id="<?=$tpl?>" value="<?=$tpl?>" style="visibility:hidden;"/>
									</div>
									<div style="width:100%;text-align:center;float:left;" ><?=$tpl?> </div>
								</div>
								<?}?>
							</form>
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
