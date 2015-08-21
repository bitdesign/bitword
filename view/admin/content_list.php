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

			<div id="page-wrapper" >

				<div class="container-fluid" >

					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<div class="page-header">
							  <h2><?=$tcontents?>
  							  <div style="float:right;">
    							<button type="button" class="btn btn-success" onclick="edit('')"><?=$taddarticle?></button>
								<button type="button" class="btn btn-danger"  onclick="changeStatus('4')"><?=$tbatchdelete?></button>
    							</div>
  							</h2>
							</div>
							
						</div>
					</div>
					<!-- /.row -->
								
	
					
					<div class="row">
					    <form id="myform" method="post" action="content!listPage#anchor">
						    <div class="col-lg-6 col-xs-6 col-sm-12">
    						    <div class="form-group input-group">
    							    <input type="text" class="form-control" placeholder="<?=$ttitle?>" name="title"  id="title" value="<?=$postTile?>">
    							    <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
    							</div>
							</div>
							<div class="col-lg-3 col-xs-3 col-sm-12">
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
    						</div>
    						<div class="col-lg-3 col-xs-3 col-sm-12">
    							<div class="form-group">
    								<select name="sts" class="form-control" onchange="doGo();">
    									<option value="1,-1" <? if($sts=="1,-1") echo "selected" ?>><?=$tall?></option>
    									<option value="1" <? if($sts=="1") echo "selected" ?>><?=$tpublished?></option>
    									<option value="-1" <? if($sts=="-1") echo "selected" ?>><?=$tdraft?></option>
    								</select>
    							</div>
    						</div>	
						    
						    <div class="col-lg-12 col-xs-12 col-sm-12">	
								<div class="table-responsive"  id="anchor">
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr>
												<th><input type="checkbox" name="tyCheckAll"/></th>
												<th><?=$tcategory?></th>
												<th><?=$ttitle?></th>
												<!--<th><?=$tuser?></th>-->
												<th><?=$tstatus?></th>
												<!--<th><?=$tedittm?></th>-->
												<th><?=$tedittm?></th>
												<th><?=$visits?></th>
												<th><?=$toperation?></th>
											</tr>
										</thead>
										<tbody>
											<?
												foreach ($arrayList as $row){
													if( strlen($row["top_tm"]) == 0)
													echo "<tr><td><input type='checkbox' name='tyChecks' value='".$row["id"]."'/></td><td>".$row["block_name"]."</td><td class='ctx-title'><a target='_blank' href='Content!editPage?id=".$row["id"]."'>".$row["title"]."</a></td><td>".$content_sts[$row["sts"]]."</td><td>".btime($row["edit_tm"])."</td><td>".$row["visits"]."</td><td><a title=\"$tdelete\" onclick=del(".$row["id"].")><i class='fa fa-fw fa-trash-o'></i></a>&nbsp;&nbsp;<a title=\"$torecommend\" onclick=recommend('".$row["id"]."','1')><i class='fa fa-star'></i></a></td></tr>";
													else
													echo "<tr><td><input type='checkbox' name='tyChecks' value='".$row["id"]."'/></td><td>".$row["block_name"]."</td><td class='ctx-title'><a target='_blank' href='Content!editPage?id=".$row["id"]."'>".$row["title"]."</a></td><td>".$content_sts[$row["sts"]]."</td><td>".btime($row["edit_tm"])."</td><td>".$row["visits"]."</td><td><a title=\"$tdelete\" onclick=del(".$row["id"].")><i class='fa fa-fw fa-trash-o'></i></a>&nbsp;&nbsp;<a title=\"$derecommend\" onclick=recommend('".$row["id"]."','')><i class='fa fa-download'></i></a></td></tr>";
												}
											?>
										</tbody>
									</table>
									<? $pager->getHtml() ?>
							    </div>
							</div>
						</form>

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
