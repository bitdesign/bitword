<ul class="nav" >
       <? foreach ($blocks as $obj){	?>
        <li><a href="<?=$webroot.'/'.$tpl_name.'_b'.$obj['block_id']?>.html" title="<?=$obj['block_name']?>"><?=$obj['block_name']?></a></li>
        <? } ?>
    </ul>