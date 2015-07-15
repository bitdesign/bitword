<!DOCTYPE html>
<html>
    <head>
        <title><?=$name?></title>
        <meta name="Keywords" content="<?=$keywords?>" />
        <meta name="Description" content="<?=$description?>" />
        
        <?include "_include.php";?>
        
        <script language="javascript" type="text/javascript">
            $(document).ready(function() {
                $("img.panel-img").lazyload();
            });
        </script>
    </head>
    <body>
        <div class="container">

            <?include "_header.php";?>


            <div class="main" >

                <div class="main-left">
                    <form  method="post" action="Home!index">
                       <? foreach ($contents as $content){ ?>
                        
                        <div class="panel margin-top20">
                                
                                <div class="panel-header">
                                    <a href="<?=$tpl_name.'_'.$content['id']?>.html" ><?=$content["title"]?></a>
                                </div>
                               
                            <? if( empty( $content["dsp_img"] )){ ?>
                                <div class="panel-body">
                                    <p class="panel-text">
                                         <?=$content["content_short"]?>
                                    </p>
                                </div>
                            <? }else{ ?>
                                <div class="panel-body">
                                    <div class="panel-left">
                                         <img src="<?=$webroot.'/upload/image/transparent.gif'?>" data-original="<?=$content["dsp_img"]?>" class="panel-img"/>
                                    </div>
                                    <div class="panel-right panel-text">
                                        <?=$content["content_short"]?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            <? } ?>
                                
                                <div class="panel-footer">
                                    <hr/>
                                     <i class="fa fa-fw fa-hand-o-right"></i><?=$content["block_name"]?>&nbsp;&nbsp;&nbsp;
                                     <i class="fa fa-fw fa-user"></i><?=$content["usr_rnm"]?>&nbsp;&nbsp;&nbsp;
                                     <i class="fa fa-fw fa-clock-o"></i><?= bitdate($content["input_tm"]) ?>
                                 </div>
                            
                        </div>
                        <?}?>
                       <? $pager->getHtml("PagerViewBS.php") ?>
                    </form>
                </div>

                <div class="main-right">
                    
                  
                    <? include "$tpl_root/static/_news.html";?>
                      <!--
                    <? //include "_news.php";?>
                    <? //include "_words.php";?>
                    -->
                    
                </div>

            </div>



            <?include "_footer.php";?>

        </div>



    </body>
</html>