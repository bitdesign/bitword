<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			function del(id){ if(!confirm("<?=$tconfirm?>?")){ return false; } doDel(id);}

			function doGo(){ $("#myform").submit();}

			function doDel(id){
				$.post("Content!del",{"id":id},
				function(data) {
					if(data == "true"){ window.location.reload(); }
					else{ alert("<?=$tfailed?>"); }
					}
					);
				}

				function edit(id) {
					location.href="Content!editPage?id="+id;
				}

				//changeStatus begin
				function changeStatus(stsVal){
					var idListString = "";
					$.each($("input[name=tyChecks][type='checkbox']:checked"), function () {
						idListString += $(this).val();
						idListString += ",";
					});
					if( idListString == ""){
						alert("<?=$tnoseltips?>");
						return false;
					}
					if(stsVal=="4"){
						if(!confirm("<?=$tconfirm?>?")){
							return false;
						}
					}
					doDel(idListString);
				}//changeStatus end

				// publish --start--
				function doPublic(m){
					$.post("Admin!publishStaticIndex",{"method":m},
					function(data){
						if(data=="true"){
							alert("<?=$tsuccess?>");
							window.location.reload();
						}else alert(data);
						},"html"
						);
					}
					// publish -- end--

					function recommend(id,opr){
						$.post("Content!recommend",{"id":id, "opr":opr},
						function(data){
							if(data=="true"){
								alert("<?=$tsuccess?>");
								window.location.reload();
							}else alert(data);
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
										<h1 class="page-header">
											Dashboard <small></small>
										</h1>
										<ol class="breadcrumb">
											<li class="active">
												<i class="fa fa-dashboard"></i> Dashboard
											</li>
										</ol>
									</div>
								</div>
								<!-- /.row -->
							
								<!--  content_count   visits_count   block_count   replies_count  os_ver server_ip webserver domain_name -->
								<!-- /.row -->
								<div class="row">

									<div class="col-lg-12">
										<table class="table table-bordered table-striped" id="statistics">
											<tbody>
												<tr><th><?=$content_count?></th><td><?=$obj['content_count']?></td><th><?=$visits_count?></th><td><?=$obj['visits_count'].'/'.$obj['tips']?></td></tr>
												<tr><th><?=$block_count?></th><td><?=$obj['block_count']?></td><th><?=$ips?></th><td><?=$obj['ips'].'/'.$obj['yips']?></td></tr>
												<tr><th><?=$os_ver?></th><td><?=$obj['os_ver']?></td><th><?=$domain_name?></th><td><?=$obj['domain_name']?></td></tr>
												<tr><th><?=$webserver?></th><td><?=$obj['webserver']?></td><th></th><td></td></tr>
											</tbody>
										</table>
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
