<div class="panel noradius noborder">
   
   <div class="panel-heading panel-heading-ext">Latest</div>
  
   <ul class="list-group list-group-ext">
		<? foreach ($contentsNewTop as $obj){	?>
		<li><a href="<?=$webroot.'/'.$tpl_name.'_'.$obj['id']?>.html" title="<?=$obj['title']?>"><?=$obj['title']?></a></li>
		<? } ?>
   </ul>
   <div class="blank20"></div>

  <div class="panel-heading panel-heading-ext">Archivement</div>
   <ul class="list-group list-group-ext">
		<? foreach ($blocks as $obj){	?>
		<li><a href="<?=$webroot.'/'.$tpl_name.'_b'.$obj['block_id']?>.html" title="<?=$obj['block_name']?>"><?=$obj['block_name'].' ('.$obj['content_num'].')'?></a></li>
		<? } ?>
   </ul>
    <div class="blank20"></div>
   
   
   <div class="panel-heading panel-heading-ext">Link</div>
   <ul class="list-group list-group-ext">
		<li><a href="http://www.bit1010.com" title="">www.bit1010.com</a></li>
		<li><a href="https://github.com/bitdesign/bitcms" title="">GitHub</a></li>
   </ul>
    <div class="blank20"></div>
    
</div>
