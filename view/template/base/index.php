<!DOCTYPE html>
<html>
	<head>
		<?include "_include.php";?>
	</head>
	<body>
		<?include "_header.php";?>
		<?include "_slider.php";?>
		<div class="all">
			<div class="content">
					  <div class="splitdiv">
								<h2 class="split"><p>文章<span>推荐</span></p></h2>
						</div>
						
						<div class="content_left">
							
							<form  method="post" action="Home!indexDyn">
							<div class="ctx">
								<?foreach ($contents as $content){
								if(strlen($content['top_tm'])>0){
										echo "<h3 style='color:red!important;'>".$content["title"]."(荐)</h3>";
								}else{
									  echo "<h3>".$content["title"]."</h3>";	
								}
								?>
								<div class="ctxbody">
										<img src="<?=$content["dsp_img"]?>" class="ctximg"/>
									<div class="ctxp">
										<div style="width:100%;">
												<?=$content["content"]?>...(<?=$content["visits"]?>)
											  <a title="/" href="<?=$tpl_name.'_'.$content['id']?>.html"  target="_blank" class="readmore">阅读全文>></a>
										</div>
									</div>
								</div>
								<div class="ctxfooter"><span><?=btime($content["edit_tm"])?></span><span>作者：<?=$content["usr_nm"]?></span><span>个人博客：[<a href="<?=$webroot.'/'.$tpl_name.'_b'.$content['block_id']?>.html"><?=$content['block_name']?></a>]</span></div>
								<?}?>
							</div> <!-- ctx end -->
							<? $pager->getHtml("PagerViewFront.php") ?>
							</form>
							
							
						</div><!--content_left-->

						<div class="content_right">
							<?include "$tpl_root/static/_news.html";?>
						</div><!--content_right-->
						
						<div class="clear contentBottom"></div>
						
			
			</div><!--content-->
			</div><!--all-->
		<?include "_footer.php";?>
		</body>

</html>