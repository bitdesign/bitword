<!DOCTYPE html>
<html>
	<head>
		<title>Administrator console</title>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">
			function doLogin(){
				
				//alert($('#myform').formSerialize());
				$.post("Login!login",$('#myform').formSerialize(),
				function(data) {
					if(data == "true"){
						location="admin!dashboard";
					}else{
						alert(data);
					}
				},"html"
				);
				
			}
			$(document).ready(function(){
				$(document).keydown(function(e){
					var curKey = e.which;
					if(curKey == 13){
						$("#dosub").click();
						return false;
					}
				});
			});
		</script>

		<style>

			body {
				padding-top: 40px;
				padding-bottom: 40px;
				background-color: #eee;
			}
		</style>
	</head>
	<body>
		<div class="container">

			<form class="form-signin" role="form" id="myform">
				<h2 class="form-signin-heading"><?=$tpleaselogin?></h2>
				<label for="inputEmail" class="sr-only">Email address</label>
				<input class="form-control" placeholder="" type="text"     name="usr_nm"  value="<?=$usr_nm?>"/>
				<label for="inputPassword" class="sr-only">Password</label>
				<input class="form-control" placeholder="" type="password" name="usr_pwd" value="<?=$usr_pwd?>"/>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="on" name="remember" <?=$remember?>/> <?=$tremember?>
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="button" id="dosub" onclick="doLogin();"><?=$tlogin?></button>
			</form>

		</div> <!-- /container -->


	</body>
</html>