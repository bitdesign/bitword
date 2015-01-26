<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script language="javascript" type="text/javascript">
		</script>
	</head>

	<body>

		<div class="all">
			<form id="myform" method="post" action="Message!listPage">

								<div class="pageContent">
									<table class="myTable">
										<?
										foreach ($msgList as $row){
											echo "<tr<td>".$row["msg_ctx"]."</td><td>".$row["usr_name"]."</td><td>".$row["input_tm"]."</td></tr>";
										}
										?>
									</table>
									<? $pager->getHtml("PagerViewFront.php") ?>
								</div>

							</form>
	</div>
	</body>

</html>