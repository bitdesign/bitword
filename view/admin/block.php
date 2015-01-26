<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			function editBlock(id) {
				popdiv('510','170',"Block!editPage?id="+id,'<?=$tblock[$lan]?>');
			}
			function addBlock() {
				popdiv('510','170',"Block!addPage",'<?=$tblock[$lan]?>');
			}
			function delBlock(id)
			{
				if(!confirm("<?=$tconfirm[$lan]?>?")){ return false; }
				$.post("Block!del",{"id":id},
				function(data) {
					if(data == "true"){
						location.reload();
					}else{
						alert("<?=$tfailed[$lan]?>");
					}
				},"html"
				);
			}

			function doDel(id){
				if(!confirm("<?=$tconfirm[$lan]?>?")){ return false; }
				$.post("Block!del",{"id":id},
				function(data) {
					if(data == "true"){ window.location.reload(); }
					else{ alert("<?=$tfailed[$lan]?>"); }
					});
				}

				//changeStatus begin
				function changeStatus(stsVal){
					var idListString = "";
					$.each($("input[name=tyChecks][type='checkbox']:checked"), function () {
						idListString += $(this).val();
						idListString += ",";
					});
					if( idListString == ""){
						alert("<?=$tnoseltips[$lan]?>");
						return false;
					}
					if(stsVal=="4"){
						if(!confirm("<?=$tconfirm[$lan]?>?")){ return false;}
					}
					doDel(idListString);
				}//changeStatus end

				
				// block edit start
				function add(){
					$.post("Block!save",{'block_id':$('#block_id').val(),'block_name':$('#block_name').val(),'dsp_img':$('#dsp_img').val(),'input_tm':$('#input_tm').val()},
					function(data) {
						if(data=="true"){
							location.reload();
						}else{
							alert(data);
						}
					},"html"
					);
				}
	
				function doUpload()
				{
					filename = $("#image").val();
					var idx = filename.lastIndexOf('\\');
					filename = filename.substring(idx+1);
					$("#dsp_img").val('upload/'+filename);
	
					$.ajaxFileUpload({
						url:'File!upload',
						data:{'name':'image','path':'upload/'},
						type:'POST',
						secureuri:false,
						fileElementId:'image',
						dataType: 'json',
						success: function (data){
							alert(data.msg);
							$("#echoimg").attr("src","upload/"+filename);
						},
						error: function (data){
							alert(data.msg);
						}
					})
					return false;
				}
	
				function setFileName(str){
					$("#txt").val(str);
					doUpload();
				}
				function doClose()
				{
					location.reload();
				}
				
				// block edit end
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
								<h1 class="page-header"><?=$tblock[$lan]?></h1>
								<ol class="breadcrumb">
									<li>
										<i class="fa fa-dashboard"></i>  <a href="Admin!dashboard">Dashboard</a>
									</li>
									<li class="active">
										<i class="fa fa-th-large"></i> <?=$tblock[$lan]?>
									</li>
								</ol>
							</div>
						</div>
						<!-- /.row -->

						<div class="row">
							<div class="col-lg-12">
								<h2>
									<button type="button" class="btn btn-success" onclick="addBlock()"><?=$tadd[$lan]?></button>
									<button type="button" class="btn btn-danger"  onclick="changeStatus('4')"><?=$tbatchdelete[$lan]?></button>
								</h2>

								<form method="post" action="Block!listPage">

									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped">
											<thead>
												<tr>
													<th><input type="checkbox" name="tyCheckAll"/></th>
													<th><?=$tname[$lan]?></th>
													<th><?=$timage[$lan]?></th>
													<th><?=$tinputtm[$lan]?></th>
													<th><?=$tedittm[$lan]?></th>
													<th><?=$tuser[$lan]?></th>
													<th><?=$toperation[$lan]?></th>
												</tr>

											</thead>
											<tbody>
												<? foreach ($arrayList as $row){ ?>
												<tr>
													<td><input type='checkbox' name='tyChecks' value='<?=$row["block_id"]?>'/></td>
													<td><?=$row["block_name"]?></td>
													<td><img src="<?=$row["dsp_img"]?>" style="height:40px;margin:0px; padding:0px;float:left;"/></td>
													<td><?=btime($row["input_tm"])?></td>
													<td><?=btime($row["edit_tm"])?></td>
													<td><?=$row["usr_nm"]?></td>
													<td>
														<a class="btn btn-danger" onclick='delBlock(<?=$row["block_id"]?>)'><i class="fa fa-trash-o fa-lg"></i> Delete</a>
														<a class="btn btn-success" onclick='editBlock(<?=$row["block_id"]?>)'><i class="fa fa-pencil fa-lg"></i> Edit</a>
													</td>
												</tr>
												<?}?>
											</tbody>
										</table>
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
