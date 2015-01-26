<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<title><?=$tconsole[$lan]?></title>
		<style>
			a img{ padding:1px;}
			a.slider img{ border:3px solid #efefef;height:120px;width:348px; }
			a.slider:hover img{border:3px solid #999;}
		</style>
		<script language="javascript" type="text/javascript">
			
			function doSave(){
				
				$("#sliderForm").submit();
			}
			
			function doUpload()
			{
				var localFilename = $("#image").val();
				var idx = localFilename.lastIndexOf('\\');
				filename = localFilename.substring(idx+1);
				$("#img_src").val(filename);
				$.ajaxFileUpload
				({
					url:'File!upload',
					data:{'name':'image','path':'images/upload'},
					type:'POST',
					secureuri:false,
					fileElementId:'image',
					dataType: 'json',
					success: function (data, status){
						if(data.msg == "true"){
							
						}else{
							alert("<?=$tfailed[$lan]?>!");
						}
					},
					error: function (data, status, e){
						alert(e);
					}
				})

			}

			function setInfo(img_src,img_url,img_order,id){

				$("#img_src").val(img_src);
				$("#img_url").val(img_url);
				$("#img_order").val(img_order);
				$("#img_order").css("border","2px solid #f00");
			}

			function doDelete(){

				var img_order = $("#img_order").val();

				$.post("Slider!del",{"img_order":img_order},
				function(data) {
					if(data=="true"){
						location.reload();
					}else{
						alert("<?=$tfailed[$lan]?>");
					}
				},"html"
				);
			}



		</script>


	</head>

	<body>
		<div class="all">
			<? require_once('_header.php'); ?>
			<div class="main">
				<? require_once('_menu.php'); ?>
				<div class="location">
					<a id="nav"><?=$tcontents[$lan].">".$tslider[$lan]?></a>
				</div>

				<div class="right">
					<div class="content">
						<div class="pageContent">
							<form action="Slider!save" method="POST" id="sliderForm">
								<div style="width:100%;">
									<span><?=$torder[$lan]?></span><input type="text" name="img_order" id="img_order" value="1"/>
									<span><?=$tlink[$lan]?></span><input type="text" name="img_url" id="img_url" value="#"/></div>
									<input  type="hidden" name="img_src" id="img_src" value="1"/><!--[696*240]-->
									<input type="button" class="small_btn" onclick="doSave()" value="<?=$tsave[$lan]?>"/>
									<input type="button" class="small_btn" onclick="doDelete()" value="<?=$tdelete[$lan]?>"/>
									<div>
										<input class="input_btn"  type="button" value="<?=$tupload[$lan]?>" />
										<input class="input_file" type="file" id="image" name="image" onchange="doUpload()"/>
									</div>
								</div>
							</form>
							
							<div style="float:left;display:block;width:100%;">
								<?foreach ($sliderList as $row){?>
								<a class="slider" id="<?=$row["img_order"]?>" onclick="setInfo('<?=$row["img_src"]?>','<?=$row["img_url"]?>','<?=$row["img_order"]?>','<?=$row["img_order"]?>')"><img src="images/upload/<?=$row["img_src"]?>"/></a>
									<?}?>
								</div>
							</div>
						</div>
					</div>

				</div>
				<? require_once('_footer.php'); ?>
			</div>

		</body>

	</html>