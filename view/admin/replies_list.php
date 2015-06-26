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
					else{ alert("<?=$tfailed?>"); }
					}
					);
				}

				function edit(id) {
					popdiv('600','226',"Replies!editPage?id="+id,"<?=$tview?>");
					//popdiv('510','170',"Replies!editPage",'<?=$tblock?>');
					}

					//changeStatus begin
					function changeStatus(stsVal){
					var idListString = "";
					$.each($("input[name=tyChecks][type='checkbox']:checked"), function () {
					idListString += $(this).val();
					idListString += ",";
					});
					if( idListString == ""){
					alert("<?=$tnoseltips?>!");
					return false;
					}
					if(stsVal=="4"){
					if(!confirm("<?=$tconfirm?>?")){
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
									<div class="page-header">
                                        <h2><?=$treplies?>
                                            <div style="float:right;">
                                               <button type="button" class="btn btn-danger"  onclick="changeStatus('4')"><?=$tbatchdelete?></button>
                                            </div>
                                        </h2>
                                    </div>
                                    
								</div>
							</div>
					
                                
							<!-- /.row -->

							<div class="row">
								<div class="col-lg-12">
								

									<form id="myform" method="post" action="Replies!listPage#anchor">
										<div class="form-group input-group">
											<input type="text" class="form-control" placeholder="<?=$oritile?>" name="title"  id="title" value="<?=$postTile?>">
											<span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
										</div>

										<div class="table-responsive"  id="anchor">
											<table class="table table-bordered table-hover table-striped">
												<thead>
													<tr>
														<th><input type="checkbox" name="tyCheckAll" /></th>
														<th><?=$oritile?></th>
														<th><?=$tuser?></th>
														<th><?=$replyctx?></th>
														<th><?=$tinputtm?></th>
														<th><?=$toperation?></th>
													</tr>
												</thead>
												<tbody>
													<?
													foreach ($arrayList as $row){
														echo "<tr><td><input type='checkbox' name='tyChecks' value='".$row["rep_id"]."'/></td><td>".$row["title"]."</td><td>".$row["usr_name"]."</td><td>".GBsubstr($row["rep_ctx"],0,41)."</td><td>".btime($row["input_tm"])."</td><td><a onclick=del(".$row["rep_id"].")><i class='fa fa-fw fa-trash-o'></i></a>&nbsp;&nbsp;<a onclick=edit('".$row["rep_id"]."')><i class='fa fa-fw fa-eye'></i></a></td></tr>";
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
