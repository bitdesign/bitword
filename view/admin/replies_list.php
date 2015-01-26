<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			function del(id){
				doDel(id);
			}

			function doDel(id){
				$.post("Replies!del",{"id":id},
				function(data) {
					if(data == "true"){ window.location.reload(); }
					else{ alert("<?=$tfailed[$lan]?>"); }
					}
					);
				}

				function edit(id) {
					popdiv('600','226',"Replies!editPage?id="+id,"<?=$tview[$lan]?>");
					//popdiv('510','170',"Replies!editPage",'<?=$tblock[$lan]?>');
					}

					//changeStatus begin
					function changeStatus(stsVal){
					var idListString = "";
					$.each($("input[name=tyChecks][type='checkbox']:checked"), function () {
					idListString += $(this).val();
					idListString += ",";
					});
					if( idListString == ""){
					alert("<?=$tnoseltips[$lan]?>!");
					return false;
					}
					if(stsVal=="4"){
					if(!confirm("<?=$tconfirm[$lan]?>?")){
					return false;
					}
					}
					doDel(idListString);
					}//changeStatus end

					function doClose()
					{
					location.reload();
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
									<h1 class="page-header"><?=$treplies[$lan]?></h1>
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-dashboard"></i>  <a href="Admin!dashboard">Dashboard</a>
										</li>
										<li class="active">
											<i class="fa fa-comment"></i> <?=$treplies[$lan]?>
										</li>
									</ol>
								</div>
							</div>
							<!-- /.row -->

							<div class="row">
								<div class="col-lg-12">
									<h2>
										<button type="button" class="btn btn-danger"  onclick="changeStatus('4')"><?=$tbatchdelete[$lan]?></button>
									</h2>

									<form id="myform" method="post" action="Replies!listPage#anchor">
										<div class="form-group input-group">
											<input type="text" class="form-control" placeholder="<?=$oritile[$lan]?>" name="title"  id="title" value="<?=$postTile?>">
											<span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
										</div>

										<div class="table-responsive"  id="anchor">
											<table class="table table-bordered table-hover table-striped">
												<thead>
													<tr>
														<th><input type="checkbox" name="tyCheckAll" /></th>
														<th><?=$replyid[$lan]?></th>
														<th><?=$oriid[$lan]?></th>
														<th><?=$oritile[$lan]?></th>
														<th><?=$tuser[$lan]?></th>
														<th><?=$replyctx[$lan]?></th>
														<th><?=$tinputtm[$lan]?></th>
														<th><?=$topnum[$lan]?></th>
														<th><?=$tstatus[$lan]?></th>
														<th><?=$toperation[$lan]?></th>
													</tr>
												</thead>
												<tbody>
													<?
													foreach ($arrayList as $row){
														echo "<tr><td><input type='checkbox' name='tyChecks' value='".$row["rep_id"]."'/></td><td>".$row["rep_id"]."</td><td>".$row["par_id"]."</td><td>".$row["title"]."</td><td>".$row["usr_name"]."</td><td>".GBsubstr($row["rep_ctx"],0,41)."</td><td>".btime($row["input_tm"])."</td><td>".$row["top_count"]."</td><td>".$row["sts"]."</td><td><a onclick=del(".$row["rep_id"].")>$tdelete[$lan]</a>&nbsp;&nbsp;<a onclick=edit('".$row["rep_id"]."')>$tview[$lan]</a></td></tr>";
													}
													?>
												</tbody>
											</table>
											<? $pager->getHtml() ?>
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
