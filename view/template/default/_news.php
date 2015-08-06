<div class="cat margin-top20">
    <div class="cat-header">近期文章</div>
    <ul>
        <? foreach ($contentsNewTop as $obj){	?>
        <li style="list-style-type:none!important;"><a href="<?=$webroot.'/'.$tpl_name.'_'.$obj['id']?>.html" title="<?=$obj['title']?>"><?=$obj['title']?></a></li>
        <? } ?>
    </ul>


    <div class="cat-header">分类目录</div>
    <ul>
        <? foreach ($blocks as $obj){	?>
        <li><a href="<?=$webroot.'/'.$tpl_name.'_b'.$obj['block_id']?>.html" title="<?=$obj['block_name']?>"><?=$obj['block_name'].' ('.$obj['content_num'].')'?></a></li>
        <? } ?>
    </ul>

    <div class="cat-header">下载BitWord</div>
    <ul>
        <!--
        <li><a href="https://raw.githubusercontent.com/bitdesign/BitWord/master/bitword.zip" title="">BitWord</a></li>
        -->
        <li><a href="https://github.com/bitdesign/bitword/archive/master.zip" title="">BitWord</a></li>
        <li><a href="https://github.com/bitdesign/bitword" title="">GitHub</a></li>
    </ul>


    <div class="cat-header">与我联系</div>
    <ul>
        <li><a href="http://www.bit1010.com" title="">我的网站</a></li>
        <li><a href="mailto:bitword@163.com?subject=&body=" title="">给我写邮件</a></li>
        <li><img src="<?=$tpl_root?>/images/qr.png" style="width:98%;" /></li>
    </ul>

</div>
