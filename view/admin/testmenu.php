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
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav side-nav" >
							<li>
								<a href="admin!dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
							</li>
							<li>
								<a href="block!listPage"><i class="fa fa-fw fa-th-large"></i> <?=$tblock[$lan]?></a>
							</li>
							<li class="active">
								<a href="content!listPage"><i class="fa fa-fw fa-list"></i> <?=$tcontents[$lan]?></a>
							</li>
							<li>
								<a href="replies!listPage"><i class="fa fa-fw fa-comment"></i> <?=$treplies[$lan]?></a>
							</li>
							<li>
								<a href="admin!theme"><i class="fa fa-fw fa-desktop"></i> <?=$ttheme[$lan]?></a>
							</li>
							<li>
								<a href="setting!settingPage"><i class="fa fa-fw fa-wrench"></i> <?=$tsetting[$lan]?></a>
							</li>

							<li>
								<a href="admin!data"><i class="fa fa-fw fa-database"></i> <?=$tdatamng[$lan]?></a>
							</li>
							<li>
								<a href="admin!changePassWordPage"><i class="fa fa-fw fa-lock"></i> <?=$tpassword[$lan]?></a>
							</li>
						</ul>
					</div>
				</body>
			</html>
