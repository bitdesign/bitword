<ul class="nav" >
       <? foreach ($blocks as $obj){	?>
        <li><a href="<?=$webroot.'/static/'.$tpl_name.'/b'.$obj['block_id']?>.html" title="<?=$obj['block_name']?>"><?=$obj['block_name']?></a></li>
        <? } ?>
    </ul>