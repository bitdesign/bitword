<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">
			
			function del(id){ if(!confirm("<?=$tconfirm[$lan]?>?")){ return false; } doDel(id);}
		
			function doGo(){ $("#myform").submit();}
			
			function doDel(id){
				$.post("Content!del",{"id":id},
					function(data) {
						if(data == "true"){ window.location.reload(); }
						else{ alert("<?=$tfailed[$lan]?>"); }
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
					alert("<?=$tnoseltips[$lan]?>");
					return false;
				}
				if(stsVal=="4"){
					if(!confirm("<?=$tconfirm[$lan]?>?")){
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
							alert("<?=$tsuccess[$lan]?>");
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
							alert("<?=$tsuccess[$lan]?>");
							window.location.reload();
						}else alert(data);
					},"html"
				);
			}
		</script>
	</head>
	<body>
		<div id="wrapper" >
			
			<? require_once('_navigation.php'); ?>

			<div id="page-wrapper" >

				<div class="container-fluid" >

					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header"><?=$tcontents[$lan]?></h1>
							<ol class="breadcrumb">
								<li>
									<i class="fa fa-dashboard"></i>  <a href="Admin!dashboard">Dashboard</a>
								</li>
								<li class="active">
									<i class="fa fa-table"></i> <?=$tcontentlist[$lan]?>
								</li>
							</ol>
						</div>
					</div>
					<!-- /.row -->
								
					<div class="row">
						<div class="col-lg-12">
							<h2>
								<button type="button" class="btn btn-primary" onclick="doPublic(1);"><?=$ttopublish[$lan]?></button>
								<button type="button" class="btn btn-success" onclick="edit('')"><?=$tadd[$lan]?></button>
								<button type="button" class="btn btn-danger"  onclick="changeStatus('4')"><?=$tbatchdelete[$lan]?></button>
							</h2>

							<form id="myform" method="post" action="content!listPage#anchor">
								<div class="form-group input-group">
									<input type="text" class="form-control" placeholder="<?=$ttitle[$lan]?>" name="title"  id="title" value="<?=$postTile?>">
									<span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
								</div>
								<div class="form-group">
									<select class="form-control" name="block_name" onchange="doGo();">
										<option></option>
										<?
											foreach ($blockList as $row){
												$isselected="";
												if(strcmp( $row["block_name"],$postBlockName) == 0 ) $isselected = "selected";
												echo "<option ".$isselected .">".$row["block_name"]."</option>";
											}
										?>
									</select>
								</div>
								<div class="table-responsive"  id="anchor">
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr>
												<th><input type="checkbox" name="tyCheckAll"/></th>
												<th><?=$tcategory[$lan]?></th>
												<th><?=$ttitle[$lan]?></th>
												<th><?=$tuser[$lan]?></th>
												<th><?=$tstatus[$lan]?></th>
												<th><?=$tedittm[$lan]?></th>
												<th><?=$publishtm[$lan]?></th>
												<th><?=$visits[$lan]?></th>
												<th><?=$toperation[$lan]?></th>
											</tr>
										</thead>
										<tbody>
											<?
												foreach ($arrayList as $row){
													if( strlen($row["top_tm"]) == 0)
													echo "<tr><td><input type='checkbox' name='tyChecks' value='".$row["id"]."'/></td><td>".$row["block_name"]."</td><td>".$row["title"]."</td><td>".$row["usr_nm"]."</td><td>".$content_sts[$row["sts"]]."</td><td>".btime($row["edit_tm"])."</td><td>".btime($row["pub_tm"])."</td><td>".$row["visits"]."</td><td><a onclick=del(".$row["id"].")>$tdelete[$lan]</a>&nbsp;&nbsp;<a onclick=edit('".$row["id"]."')>$tmodify[$lan]</a>&nbsp;&nbsp;<a onclick=recommend('".$row["id"]."','1')>$ttop[$lan]</a></td></tr>";
													else
													echo "<tr><td><input type='checkbox' name='tyChecks' value='".$row["id"]."'/></td><td>".$row["block_name"]."</td><td>".$row["title"]."</td><td>".$row["usr_nm"]."</td><td>".$content_sts[$row["sts"]]."</td><td>".btime($row["edit_tm"])."</td><td>".btime($row["pub_tm"])."</td><td>".$row["visits"]."</td><td><a onclick=del(".$row["id"].")>$tdelete[$lan]</a>&nbsp;&nbsp;<a onclick=edit('".$row["id"]."')>$tmodify[$lan]</a>&nbsp;&nbsp;<a onclick=recommend('".$row["id"]."','')>$tuntop[$lan]</a></td></tr>";
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
