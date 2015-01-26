<!DOCTYPE html>
<html>
	<head>
		<?include "_include.php";?>
		<script type="text/javascript" src="<?=$webroot?>/Count!addVisits?id=<?=$obj['id']?>"></script>
		
		<script language="javascript" type="text/javascript">
			
			$(document).ready(function(){

			});
			
	
		function topme(rep_id){
			
			$.post("<?=$webroot?>/Reply!addTopCount",{"rep_id":rep_id},
				function(data) { 
					if(data == "true"){
						location.reload();
					}else{
						alert("false");
					}
				},"html"
			);
		}
		function doSubmit(){
				if( $("#rep_ctx").val() == ''){
					alert("请输入内容");
					return;
				}
				if( $("#validationCode").val() == ''){
					alert("请输入验证码");
					return;
				}
				$.post("<?=$webroot?>/Reply!save",$('#msgForm').formSerialize(),
				function(data) { 
					if(data == "true"){
						location.reload();
					}else if(data == "0"){
						alert("请输入正确的验证码!");
					}else if(data == "-1"){
						alert("管理员已关闭回复功能!"); 
					}else{
						alert(data);
					}
				},"html"
				);
			}
			
			function getNewValCode(){
				$('#vldCode ').attr("src",'<?=$webroot?>/Validation!getCode?r='+ Math.random()); 
			}
			
		</script>
	</head>
	<body>
		<?include "_header.php";?>
		<div class="all">
			<div class="content">
						<div class="splitinfo">
								<span><a href="<?=$webroot?>index.html">网站首页</a></span><span><a style="background:#8BBF5D;"><?=$obj["block_name"]?></a></span>
						</div>
						
						<div class="content_left">
								<h2 class="infoTitle"><?=$obj["title"]?></h2>
								<p class="infoTime">
									发布时间:<?=date('Y-m-d', strtotime($obj["edit_tm"]))?>&nbsp;&nbsp;
									编辑:<?=$obj["usr_nm"]?>&nbsp;&nbsp;
									阅读(<?=$obj["visits"]?>)
								</p>
								<div class="infoCtx">
									<?=$obj["content"]?>
								</div>
								<p class="infoKey">
									<span>关键词</span>:<?=$obj["keyword"]?>&nbsp;&nbsp;
								</p>
								
								<div class="repliesDiv">
									<div class="repliesBar reply">
									评论
								  </div>
									<form id="myform" method="post" action="Home!info&id=<?=$obj["id"]?>">
										
											<? foreach ($msgList as $row){ ?> <!-- start-->
											<div class="reply">	
												
												<div style="width:80px;height:100%;float:left;">
													<img width="50" height="50" style="margin:15px;" src="<?=$webroot.'/'.$tpl_root?>/images/default.png"/></div>
												<div style="height:100%;margin-left:80px;">
													<p style="color:red;"><?=$row["usr_name"]?></p>
													<p><pre><?=$row["rep_ctx"]?></pre></p>
													<p style="font-size:10px;color:#aaa;">
														<?=date('m月d日', strtotime($row["input_tm"]))?>&nbsp;&nbsp;&nbsp;
														<!--<a onclick="topme(<?=$row["rep_id"]?>)" style="cursor:pointer;">顶(<?=$row["top_count"]?>)</a>-->
													</p>
												</div>
											
												<div class="clear"></div>
											</div>
											<?}?><!-- end-->
											 
										<? $pager->getHtml("PagerViewFront.php") ?>
										</form>
										<div class="clear"></div>
								</div>
								
							
								
								<div class="repliesDiv">	
									<form id="msgForm">
										<input type="hidden" name="par_id" value="<?=$obj['id']?>"/>
										<div style="height:100%;width:100%;">
											<input type="hidden"   name="usr_name" value="default"/>
										</div>
										<? if($commentswitch==="1"){ }?>
										<div style="width:100%;border:none;">
											<textarea name="rep_ctx" id="rep_ctx" style="width:100%;height:100px;resize:none;"></textarea>
										</div>
										<div style="float:right;height:30px;">
											<img src="<?=$webroot?>/Validation!getCode" class="replyValCode" id="vldCode" onclick="getNewValCode()"/>
											<input type="text" name="validationCode" id="validationCode" maxlength="4" class="replyValInput" value=""/>
											<input type="button" onclick="doSubmit();" class="replybtn" value="留言"/>
										</div>
									</form>
								</div>
						</div><!--content_left-->

						<div class="content_right">
							<?include "$tpl_root/static/_news.html";?>
						</div><!--content_right-->
						
						<div class="clear"></div>
						
				</div><!--content-->
			</div><!--all-->
			
			<?include "_footer.php";?>
		</body>

</html>