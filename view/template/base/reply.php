<!DOCTYPE html>
<html>
	<head>
		<?include "_include.php";?>

		<script language="javascript" type="text/javascript">

			
			
			function doSubmit(){
				if( $("#usr_name").val() == ''){
					alert("请输入昵称");
					return;
				}
				if( $("#rep_ctx").val() == ''){
					alert("请输入内容");
					return;
				}

				$.post("Reply!save",$('#toReplyForm').formSerialize(),
				function(data) {
					if(data == "true"){
						location.reload();
					}else{
						alert("false");
					}
				},"html"
				);
			}
		</script>
	</head>
	<body>
			<form id="toReplyForm">
				<input type="hidden" name="par_id"   value="<?=$par_id?>"/>
				<input type="hidden" name="usr_name" value="default"/>
				<textarea name="rep_ctx" style="width:600px;height:170px;outline:none; resize:none;border:none; "></textarea>
				<input type="button" onclick="doSubmit();" class="replybtn" style="position: absolute;right:0;bottom:0; z-index:999;" value="确认"/>
			</form>
	</body>

</html>