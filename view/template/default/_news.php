<div class="cat margin-top20">
    <div class="cat-header">Latest</div>
    <ul>
        <? foreach ($contentsNewTop as $obj){	?>
        <li style="list-style-type:none!important;"><a href="<?=$webroot.'/'.$tpl_name.'_'.$obj['id']?>.html" title="<?=$obj['title']?>"><?=$obj['title']?></a></li>
        <? } ?>
    </ul>


    <div class="cat-header">Archivement</div>
    <ul>
        <? foreach ($blocks as $obj){	?>
        <li><a href="<?=$webroot.'/'.$tpl_name.'_b'.$obj['block_id']?>.html" title="<?=$obj['block_name']?>"><?=$obj['block_name'].' ('.$obj['content_num'].')'?></a></li>
        <? } ?>
    </ul>

    <div class="cat-header">DownLoad</div>
    <ul>
        <!--
        <li><a href="https://raw.githubusercontent.com/bitdesign/BitWord/master/bitword.zip" title="">BitWord</a></li>
        -->
        <li><a href="https://github.com/bitdesign/bitword/archive/master.zip" title="">BitWord</a></li>
        <li><a href="https://github.com/bitdesign/bitword" title="">GitHub</a></li>
    </ul>


    <div class="cat-header">About</div>
    <ul>
        <li><a href="http://www.bit1010.com" title="">www.bit1010.com</a></li>
        <li><a href="mailto:bitword@163.com?subject=&body=" title="">bitword@163.com</a></li>
    </ul>

</div>
