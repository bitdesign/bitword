<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<title><?=$tconsole?></title>
		<script language="javascript" type="text/javascript">

			// template -- begin--
			function dataImgClick(o){
				var a = $(o).find('input').attr("checked",true);
				var f = $("input[name='selbkfile']:checked").val();
				$("span[name='dataSpan']").css('border','none');
				$(o).css('border','#ccc solid 1px');
			}

			$(function(){
				$("#<?=$tpl_name?>").parent().css('border','#eee solid 1px');
			});

			function activeTpl(){
				var tplNm = $("input[name='tplNm']:checked").val();
				$.post("Setting!saveTpl",{"tpl_name":tplNm},
				function(data) {
					if(data == "true"){
						alert("<?=$tsuccess?>");
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
					success: function (data, status){
						if(data.msg == "true"){
							$.post("Admin!unzip",{"zipfile":filename},
							function(data) {
								if(data == "true"){
									location.href = location.href;
									alert("<?=$tsuccess?>");
								}else{
									alert(data);
								}
							},"html"
							);
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
			// template -- end--

				function showPasswordDig(){
					popdiv('265','187',"Admin!changePassWordPage",'<?=$tdoset?>');
				}
				function showDosetDig(){
					popdiv('750','310',"Setting!settingPage",'<?=$tdoset?>');
				}

			</script>
		</head>
		<body>
			<div class="all">
				<? require_once('_header.php'); ?>
				<div class="main">
					<? require_once('_menu.php'); ?>
					<div class="location">
						<a id="nav"><?=$tcontents.">".$tsetting?></a>
					</div>
					<div class="right">
						<div class="content">
							<div class="pageContent">
								<!-- Setting start-->
								<fieldset>
									<legend><?=$tdoset?></legend>
									<div style="float:left;width:100%;">
										<input type="button" class="large_btn" value="<?=$tpassword ?>" onclick="showPasswordDig();" />
										<input type="button" class="large_btn" value="<?=$tdoset ?>" onclick="showDosetDig();" />
									</div>
								</fieldset>
								<!-- Setting end-->
								<!--template start-->
								<fieldset>
									<legend><?=$ttheme?></legend>
									<div style="float:left;width:100%;height:300px;">
										<form action="Admin!unzip" method="POST" id="myform">
											<div style="float:left;width:100%;margin-bottom:10px;">
												<input type="hidden" id="zipfile" name="zipfile" value=""/>
												<input type="button" class="mid_btn" onclick="activeTpl();" value="<?=$tactive?>"/>
												<input class="input_btn"  name="fileNameBrowse" type="button" value="<?=$tupload?>" />
												<input class="input_file" type="file" id="tpl" name="tpl" onchange=doUploadTpl()" />
											</div>
										</form>

										<form  id="tplform">
											<?foreach ($tplList as $tpl){?>
											<div style="float:left;">
												<div style="float:left;">
													<span  onclick="dataImgClick(this);" style="width:100%;" name="dataSpan">
														<img src="<?=$tpl_root?>/preview.jpg"  style="width:250px;height:250px;"/>
														<input type="radio" name="tplNm" id="<?=$tpl?>" value="<?=$tpl?>" style="visibility:hidden;"/>
													</span>
													<div  style="width:100%;text-align:center" ><?=$tpl?> </div>
												</div>
											</div>
											<?}?>
										</form>
									</div>
								</fieldset>
								<!--template end-->

							</div>
						</div>

					</div>
				</div>
				<? require_once('_footer.php'); ?>
			</div>
		</body>
	</html>