<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			function editFeed(id) {
				popdiv('510','170',"Feed!editPage?id="+id,'<?=$tfeed?>');
			}
			function addFeed() {
				popdiv('510','170',"Feed!addPage",'<?=$tfeed?>');
			}
			function delFeed(id)
			{
				$.post("Feed!del",{"id":id},
				function(data) {
					if(data == "true"){
						location.reload();
					}else{
						alert("<?=$tfailed?>");
					}
				},"html"
				);
			}

			function doDel(id){
				if(!confirm("<?=$tconfirm?>?")){ return false; }
				$.post("Feed!del",{"id":id},
				function(data) {
					if(data == "true"){ window.location.reload(); }
					else{ alert("<?=$tfailed?>"); }
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
						alert("<?=$tnoseltips?>");
						return false;
					}
					
					doDel(idListString);
				}//changeStatus end

				
				// feed edit start
				function add(){
					$.post("Feed!save",{'feed_id':$('#feed_id').val(),'input_tm':$('#input_tm').val(),'url':$('#url').val()},
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
				
				// feed edit end
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
							  <h2><?=$channel_list?>
  							  <div style="float:right;">
    							<button type="button" class="btn btn-success" onclick="addFeed()"><?=$new_feed?></button>
								<button type="button" class="btn btn-danger"  onclick="changeStatus('4')"><?=$tbatchdelete?></button>
    							</div>
  							</h2>
							</div>
							
						</div>
					</div>
					<!-- /.row -->

						<div class="row">
							<div class="col-lg-12">
							
								<form method="post" action="Feed!listPage">

									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped">
											<thead>
												<tr>
													<th><input type="checkbox" name="tyCheckAll"/></th>
													<th><?=$channel_title?></th>
													<th><?=$channel_url?></th>
													<th><?=$toperation?></th>
												</tr>
			
											</thead>
											<tbody>
												<? foreach ($arrayList as $row){ ?>
												<tr>
													<td><input type='checkbox' name='tyChecks' value='<?=$row["feed_id"]?>'/></td>
													<td><?=$row["feed_title"]?></td>
													<td><?=$row["url"]?></td>
													<td>
														<a onclick='delFeed(<?=$row["feed_id"]?>)'><i class="fa fa-trash-o"></i></a>
														<a onclick='editFeed(<?=$row["feed_id"]?>)'><i class="fa fa-pencil"></i></a>
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
