<div class="cat margin-top20">
    <div class="cat-header"><p>推荐阅读</p></div>
    <ul>
        <? foreach ($contentsRecommend as $obj){	?>
        <li><a href="<?=$webroot.'/static/'.$tpl_name.'/'.$obj['id']?>.html" title="<?=$obj['title']?>"><?=$obj['title']?></a></li>
        <? } ?>
    </ul>


    <div class="cat-header"><p>分类目录</p></div>
    <ul>
        <? foreach ($blocks as $obj){	?>
        <li><a href="<?=$webroot.'/static/'.$tpl_name.'/b'.$obj['block_id']?>.html" title="<?=$obj['block_name']?>"><?=$obj['block_name'].' ('.$obj['content_num'].')'?></a></li>
        <? } ?>
    </ul>

    <div class="cat-header"><p>功能</p></div>
    <ul>
        <li><a href="/content!listPage" title="">登录</a></li>
        <li><a href="https://github.com/bitdesign/bitword/archive/master.zip" title="">BitWord</a>@<a href="https://github.com/bitdesign/bitword" title="">GitHub</a></li>
        <li><a href="mailto:bitword@163.com?subject=&body=" title="">MailToME</a></li>
        <li style="list-style-type:none;"><img src="<?=$webroot.'/upload/image/transparent.gif'?>" data-original="/<?=$tpl_root?>/images/qr.png" style="width:96%;" class="panel-img"/></li>
    </ul>

</div>
