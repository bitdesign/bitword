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
			}

			function saveParas(str){
			    
			   
			    
				$.post("Setting!save",$('#parasForm').formSerialize(),
				
    				function(data) {
    					if(data == "true"){
    					    doPublic(1);
    					    //alert("<?=$tsuccess?>"); 
    					    //location.href = location.href;
    						
    					}else{
    						alert(data);
    						//alert("<?=$tfailed?>");
    					}
    				},"html"
				);
			}

			$(function(){
				$("input[type=radio][name='commentswitch'][value=<?=$commentswitch?>]").attr("checked",'checked');
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
							<h1 class="page-header"><?=$tdoset?></h1>
						</div>
					</div>
					<!-- /.row -->

					<div class="row">
						<div class="col-lg-6">
							<form method="post" id="parasForm" role="form">
								<input class="input_text" type="hidden" id="logo" name="logo" value="<?=$paras['logo']?>"/>
								<input class="input_text" type="hidden" id="headimg" name="headimg" value="<?=$paras['headimg']?>"/>
								
								
								<div class="form-group">
									<img data-toggle="tooltip" title="<?=$tuploadtips?>" onclick="$('#logoImage').trigger('click');" style="max-width:100%;" src="upload/<?=$paras['logo']?>" id="echoLogo"/>
								</div>
								<!--
								<div class="form-group">
									<img data-toggle="tooltip" title="<?=$tuploadtips?>" onclick="$('#headerImg').trigger('click');" style="max-width:100%;" src="upload/<?=$paras['headimg']?>" id="echoHeadimg"/>
								</div>
								-->
								
								<div class="form-group">
									<label><?=$tsitename?></label>
									<input class="form-control" placeholder="Enter text" type="text" name="name" value="<?=$paras['name']?>"/>
								</div>
								
								
								
								<div class="form-group">
									<label><?=$tkeyword?></label>
									<input class="form-control" placeholder="Enter text" type="text" name="keywords" value="<?=$paras['keywords']?>"/>
								</div>
								<div class="form-group">
									<label><?=$tdescription?></label>
									<input class="form-control" placeholder="Enter text" type="text" name="description" value="<?=$paras['description']?>"/>
								</div>
								<div class="form-group">
									<label><?=$thomemaxnum?></label>
									<input class="form-control" placeholder="Enter text" type="text" name="homemaxnum" value="<?=$paras['homemaxnum']?>"/>
								</div>

								<div class="form-group">
									<label><?=$tnewmaxnum?></label>
									<input class="form-control" placeholder="Enter text" type="text" name="newmaxnum" value="<?=$paras['newmaxnum']?>"/>
								</div>
								<!--
								<div class="form-group">
									<label><?=$ttopmaxnum?></label>
									<input class="form-control" placeholder="Enter text" type="text" name="topmaxnum" value="<?=$paras['topmaxnum']?>"/>
								</div>
								-->
								<div class="form-group">
									<label><?=$tcommentswitch?></label>
									<label class="radio-inline">
										<input type="radio" name="commentswitch" value="1"/><?=$ton?>
									</label>
									<label class="radio-inline">
										<input type="radio" name="commentswitch" value="0" /><?=$toff?>
									</label>
								</div>
								
								<div class="form-group">
									<label><?=$tcommentdspnum?></label>
									<input class="form-control" placeholder="Enter text" type="text" name="commentdspnum" value="<?=$paras['commentdspnum']?>"/>
								</div>
								<!--
								<div class="form-group">
									<label><?=$tnotice?></label>
									<textarea class="form-control" rows="3" placeholder="" name="notice"><?=$paras['notice']?></textarea>
								</div>
								-->
								<div class="form-group">
									<label><?=$taccstat?></label>
									<textarea class="form-control" rows="3" placeholder="" name="accstat"><?=stripslashes(base64_decode($paras['accstat']))?></textarea>
								</div>
								
								
								
								<button type="button" onclick="saveParas()" class="btn btn-success"><?=$tsave?></button>

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
