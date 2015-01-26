<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script type="text/javascript" charset="utf-8" src="tools/ueditor-1.4.3/ueditor.config.js"></script>
		<script type="text/javascript" charset="utf-8" src="tools/ueditor-1.4.3/ueditor.all.min.js"> </script>
		<script type="text/javascript" charset="utf-8" src="tools/ueditor-1.4.3/lang/<?=$lan?>/<?=$lan?>.js"></script>

		<script language="javascript" type="text/javascript">

			$(document).ready(function () {
				var ue = UE.getEditor('myEditor', {saveInterval: 600000,toolbars: [[
		            'fullscreen', 'source', '|', 'undo', 'redo', '|',
		            'bold', 'italic', 'autotypeset', '|', 'forecolor', 'backcolor', 'selectall', 'cleardoc', '|',
		            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 
		            'simpleupload', 'emotion', '|',
		            'searchreplace', 'drafts'
		        ]]});
		        
		     
			})
			function getContent() {
				return UE.getEditor('myEditor').getContent();
			}
			function hasContent(){
				return UE.getEditor('myEditor').hasContents();
			}
			function doSubmit(){
				if( $("#contentTitle").val() == ''){
					alert("<?=$ttitletips[$lan]?>!");
					return;
				}
				if(typeof ($("#block_id").val()) == 'undefined'){
					alert("<?=$tcattips[$lan]?>!");
					return;
				}

				$("#content").val(getContent()) ;
				
				$.post("Content!save",$('#contentEditForm').formSerialize(),
				function(data) {
					if(data == "true"){
						alert("<?=$tsuccess[$lan]?>");
						location.href = "Content!listPage";
					}else{
						//alert("<?=$tfailed[$lan]?>");
						alert(data);
					}
				},"html"
				);
			}

			function doClose()
			{
				location.href = "Content!listPage";
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
							<h1 class="page-header"><?=$tcontents[$lan]?></h1>
							<ol class="breadcrumb">
								<li>
									<i class="fa fa-dashboard"></i><a href="Admin!dashboard">Dashboard</a>
								</li>
								<li class="active">
									<i class="fa fa-table"></i> <?=$tcontentedit[$lan]?>
								</li>
							</ol>
						</div>
					</div>
					<!-- /.row -->

					<div class="row">
						<div class="col-lg-12">
							<h2>
								<button type="button" class="btn btn-success" onclick="doSubmit()"><?=$tsave[$lan]?></button>
								<button type="button" class="btn btn-danger"  onclick="doClose()"><?=$tclose[$lan]?></button>
							</h2>
							
							<form id="contentEditForm" >
								<input type="hidden" name="id" value="<?=$obj["id"]?>" id="id"/>
								<input type="hidden" name="input_tm" value="<?=$obj["input_tm"]?>" id="input_tm"/>
								<select name="block_id" id="block_id" class="form-control">
									<?
									foreach ($blockList as $row){
										echo "<option value='".$row["block_id"]."'".($obj["block_id"]==$row["block_id"]?" selected ":"").">".$row["block_name"]."</option>";
									}
									?>
								</select>

								<select name="sts" class="form-control">
									<option value="0" <? if($obj["sts"]=="0") echo "selected" ?>><?=$ttopublished[$lan]?></option>
									<option value="-1" <? if($obj["sts"]=="-1") echo "selected" ?>><?=$tdraft[$lan]?></option>
								</select>
								<input type="text" class="form-control" placeholder="<?=$ttitle[$lan]?>" name="title"  id="contentTitle" value='<?=$obj["title"]?>'>
								<input type="hidden" name="content" id="content" />
								<script type="text/plain" id="myEditor" name="myEditor" style="width:100%;height:400px;margin-top:10px;">
									<?=$obj["content"]?>
								</script>
							</div>
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
