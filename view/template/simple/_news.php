<div class="panel panel-default noradius noborder">
   <div class="panel-heading">New Articles</div>
   <ul class="list-group">
		<? foreach ($contentsNewTop as $obj){	?>
		<li class="list-group-item"><a href="<?=$webroot.'/'.$tpl_name.'_'.$obj['id']?>.html" title="<?=$obj['title']?>"><?=$obj['title']?></a></li>
		<? } ?>
   </ul>
</div>

<div class="panel panel-default noradius noborder">
   <div class="panel-heading">Click Rank</div>
   <ul class="list-group">
		<? foreach ($contentsVisitsTop as $obj){	?>
		<li class="list-group-item"><a href="<?=$webroot.'/'.$tpl_name.'_'.$obj['id']?>.html" title="<?=$obj['title']?>"><?=$obj['title']?></a></li>
		<? } ?>
   </ul>
</div>

<div class="panel panel-default noradius noborder">
   <div class="panel-heading">Archives</div>
   <ul class="list-group">
		<? foreach ($blocks as $obj){	?>
		<li class="list-group-item"><a href="<?=$webroot.'/'.$tpl_name.'_b'.$obj['block_id']?>.html" title="<?=$obj['block_name']?>"><?=$obj['block_name'].' ('.$obj['content_num'].')'?></a></li>
		<? } ?>
   </ul>
</div>


