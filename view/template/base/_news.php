<div class="news">
		<h3><p>最新<span>文章</span></p></h3>
		<ul class="rank">
				<? foreach ($contentsNewTop as $obj){	?>
				<li><a href="<?=$webroot.'/'.$tpl_name.'_'.$obj['id']?>.html" title="<?=$obj['title']?>" target="_blank"><?=$obj['title']?></a></li>
				<? } ?>
		</ul>
		
		<h3 class="ph"><p>点击<span>排行</span></p></h3>
		<ul class="paih">
					<? foreach ($contentsVisitsTop as $obj){?>
					<li><a href="<?=$webroot.'/'.$tpl_name.'_'.$obj['id']?>.html" title="<?=$obj['title']?>" target="_blank"><?=$obj['title']?></a></li>
					<? } ?>
		</ul>
	
		<h3><p>文章分类</p></h3>
		<ul class="rank">
				<? foreach ($blocks as $obj){	?>
				<li><a href="<?=$webroot.'/'.$tpl_name.'_b'.$obj['block_id']?>.html" title="<?=$obj['block_name']?>" target="_blank"><?=$obj['block_name'].' (<label>'.$obj['content_num'].'</label>)'?></a></li>
				<? } ?>
		</ul>
	</div><!--news-->