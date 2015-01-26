<!DOCTYPE html>
<html>
  <head>
    <?include "_include.php";?>
  </head>
  <body>
    <div class="container container-ext">

      <?include "_header.php";?>
	
	
      <div class="row" >

        <div class="col-xs-12 col-sm-9 no-right-padding">
          <form  method="post" action="Home!indexDyn">
            <div class="panel panel-default noradius noborder">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-fw fa-hand-o-right"></i> New Post</h3>
                </div>
                <div class="list-group">
                  <? foreach ($contents as $content){ ?>
                  <div class="row list-group-item  row-ext zero noradius coverline">
                    <div class="col-xs-12 col-sm-3">
                      <img src="<?=$content["dsp_img"]?>" class="ctx-item-img"/>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <h4>
                        <span><?=$content['block_name']?><font><i class="fa fa-fw fa-caret-right red "></i></font></span>
                        <a href="<?=$tpl_name.'_'.$content['id']?>.html" ><?=$content["title"]?></a>
                      </h4>
                      <h5>
                        <i class="fa fa-fw fa-user"></i>&nbsp;<font color="#00a"><?=$content["usr_nm"]?></font>&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-fw fa-clock-o"></i>&nbsp;<?=bitdate($content["edit_tm"])?>&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-fw fa-eye"></i>&nbsp;<?=$content["visits"]?> view&nbsp;&nbsp;&nbsp;&nbsp;
                      </h5>
                      <p class="list-group-item-text">
                        <?=$content["content"]?>
                      </p>
                    </div>
                  </div>
                  <?}?>



                </div>
              </div>
            </form>
          </div>

          <div class="col-xs-12 col-sm-3" style="padding-left:10px;">
            <?include "$tpl_root/static/_news.html";?>
          </div>

        </div>



        <?include "_footer.php";?>


      </div>



    </body>
  </html>