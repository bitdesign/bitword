<!DOCTYPE html>
<html>
  <head>
    <title><?=$name?></title>
    <meta name="Keywords" content="<?=$keywords?>" />
    <meta name="Description" content="<?=$description?>" />

    <?include "_include.php";?>


  </head>
  <body>
    <div class="container">

      <? include "_header.php";?>


      <div class="main" >

        <div class="main-left">
          <form  method="post" action="Home!index">
            <? foreach ($contents as $content){ ?>

            <div class="panel margin-top20">

              <div class="panel-header">
                <a href="<?=$webroot.'/static/'.$tpl_name.'/'.$content['id']?>.html" >
                  <?=$content["title"]?>
                  <? if(isset($content["top_tm"]) ){ ?>
                  <img src="<?=$webroot.'/'.$tpl_root?>/images/reco.gif" width="17" height="19"/>
                  <? } ?>
                </a>
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


          <? include "static/".$tpl_name."/_news.html";?>
          <!--
          <? //include "_news.php";?>
          <? //include "_words.php";?>
          -->

        </div>

      </div>



      <?include "_footer.php";?>

    </div>


    <script type="text/javascript" src="<?=$webroot?>/Count!addIPVisits"></script>
  </body>
</html>
<script language="javascript" type="text/javascript">
  $(document).ready(function() {
    $("img.panel-img").lazyload();


    var hasMoved = 0;
    $(window).scroll(function () {

      offset = $(window).scrollTop();
      if (offset >0) {
        if( hasMoved == 0){
          $("#float").animate( {bottom:'100px'});
          hasMoved = 1;
        }

      }else{
        if( hasMoved == 1){
          $("#float").animate( {bottom:'-300px'});
          hasMoved = 0;
        }
      }
    });
  });
</script>