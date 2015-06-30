<!DOCTYPE html>
<html>
    <head>
        <?include "_include.php";?>
        
        <script language="javascript" type="text/javascript">
            $(document).ready(function() {
                $("img.ctx-item-img").lazyload();
            });
        </script>
    </head>
    <body>
        <div class="container container-ext">

            <?include "_header.php";?>


            <div class="row" >

                <div class="col-xs-12 col-sm-9 double-right-padding">
                    <form  method="post" action="Home!index">
                       <? foreach ($contents as $content){ ?>
                        
                        <div class="panel panel-default noradius noborder">


                            <div class="row list-group-item  row-ext zero noradius coverline"  style="padding:6px 10px;">
                                
                                <div class="panel-heading">
                                    <h2 class="panel-title"><a href="<?=$tpl_name.'_'.$content['id']?>.html" ><?=$content["title"]?></a></h2>
                                </div>
                            <? if( empty( $content["dsp_img"] )){ ?>
                                <div class="col-xs-12 col-sm-12">
                                    <p class="list-group-item-text">
                                         <?=$content["content"]?>
                                    </p>
                                </div>
                            <? }else{ ?>    
                                <div class="col-xs-12 col-sm-4">
                                  <img src="<?=$webroot.'/upload/image/transparent.gif'?>" data-original="<?=$content["dsp_img"]?>" class="ctx-item-img"/>
                                </div>
                                <div class="col-xs-12 col-sm-8 no-left-padding">
                                    <p class="list-group-item-text">
                                        <?=$content["content"]?>
                                    </p>
                                </div>
                                
                            <? } ?>     
                                <div class="col-xs-12 col-sm-12">
                                    <hr/>
                                    <h5>
                                        <i class="fa fa-fw fa-hand-o-right"></i><?=$content["block_name"]?>&nbsp;&nbsp;&nbsp;
                                        <i class="fa fa-fw fa-user"></i><?=$content["usr_rnm"]?>&nbsp;&nbsp;&nbsp;
                                        <!--<i class="fa fa-fw fa-pencil-square-o"></i><?=bitdate($content["input_tm"])?>&nbsp;&nbsp;&nbsp;-->
                                        <i class="fa fa-fw fa-clock-o"></i><?= bitdate($content["input_tm"]) ?>
                                     </h5>
                                 </div>

                            </div>

                            
                        </div>
                        <?}?>
                       <? $pager->getHtml("PagerViewBS.php") ?>
                    </form>
                </div>

                <div class="col-xs-12 col-sm-3 no-left-padding">
                   <?include "$tpl_root/static/_news.html";?>
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