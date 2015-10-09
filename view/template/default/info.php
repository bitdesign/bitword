<!DOCTYPE html>
<html>
  <head>

    <title><?=$obj["title"]?></title>
    <meta name="Keywords" content="<?=$obj["keyword"]?>" />
    <meta name="Description" content="<?=$obj["keyword"]?>" />

    <?include "_include.php";?>


  </head>


  <div class="container">

    <?include "_header.php";?>
    
    <script>
        var fix_url = "http://"+document.domain+"/static/<?=$tpl_name?>/<?=$obj['id']?>.html";
    </script>
        
    <?
    //$site_url = "http://".$_SERVER['SERVER_NAME'];
    //$fix_url = $site_url.$webroot."/static/".$tpl_name.'/'.$obj['id'].".html";
    ?>

    <div class="main" >

      <div class="main-left">

        <div class="row margin-top20">
          <div class="info-nav">
            <a href="<?=$webroot?>/index.html"><i class="fa fa-fw fa-home"></i>首页</a>&gt;
            <a href="<?=$webroot.'/static/'.$tpl_name.'/b'.$obj['block_id']?>.html"><?=$obj["block_name"]?></a>&gt;
            <script>document.write("<a href='"+fix_url+"'>");</script><?=$obj["title"]?></a>
          </div>
          <div class="info-title">
            <h4><?=$obj["title"]?></h4>
            <h5>
              <i class="fa fa-fw fa-user"></i><?=$obj["usr_rnm"]?>&nbsp;&nbsp;
              <i class="fa fa-fw fa-clock-o"></i><?=btime($obj["input_tm"])?>&nbsp;&nbsp;
            </h5>
          </div>
          <div class="info-text">

            <!--<i class="fa fa-fw fa-map-marker"></i>-->
            <?=$obj["content"]?>
            <br/>

            <ul>
              <li>本文固定链接: 
              <script>document.write("<a href='"+fix_url+"'>"+fix_url);</script>
               
               </a></li>
              
              
                <li>转载请注明: <?=$obj["usr_rnm"]?> <?=btime($obj["input_tm"])?> 于 
                    
                    <script>document.write("<a href='http://"+document.domain+"'>");</script><?=$name?></a> 发表</li>

                </ul>

                <br/>
              </div>

            </div><!--panel-->


             <? if($commentswitch==="1"){ ?>
            <div class="row margin-top20">
              <div class="info-nav">
                <i class="fa fa-fw fa-comments"></i> Comment
              </div>

              <div class="row">
                <form id="myform" method="post" action="Home!info?id=<?=$obj["id"]?>">
                  <? foreach ($msgList as $row){ ?> <!-- start-->
                  <div class="row">
                    <div style="width:80px;height:100%;float:left;">
                      <img width="50" height="50" style="margin:15px;" src="<?=$webroot.'/'.$tpl_root?>/images/default.png"/>
                    </div>
                    <div style="height:100%;margin-left:80px; padding:20px;">
                      <p style="color:red;"><?=$row["usr_name"]?></p>
                      <p><pre style="margin:5px 0;"><?=$row["rep_ctx"]?></pre></p>
                      <p style="font-size:0.8em;color:#aaa;">
                        <?=btime($row["input_tm"])?>&nbsp;&nbsp;&nbsp;
                        <!--<a onclick="topme(<?=$row["rep_id"]?>)" style="cursor:pointer;">Top(<?=$row["top_count"]?>)</a>-->
                      </p>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <?}?><!-- end-->
                  <? $pager->getHtml("PagerViewBS.php") ?>
                </form>
              </div>

              <div class="row">
               
                <form id="msgForm">

                  <input type="hidden" name="par_id" value="<?=$obj['id']?>"/>
                  <input type="hidden"   name="usr_name" value="default"/>
                  <div class="row align-center">
                    <textarea name="rep_ctx" id="rep_ctx" class="textarea" row="5"></textarea>
                  </div>

                  <div class="align-right padding20">
                    <img src="<?=$webroot?>/Validation!getCode" id="vldCode" onclick="getNewValCode()" class="topalign"/>
                    <input type="text" name="validationCode" id="validationCode" maxlength="4" class="vldcode topalign" value=""/>
                    <button type="button" onclick="doSubmit();" class="btn topalign">Reply</button>
                  </div>

                </form>
                
              </div>
            </div>
            <?}?>









          </div><!--main-left-->

          <div class="main-right">
            <?include "static/".$tpl_name."/_news.html";?>
          </div>

        </div><!--main-->



        <?include "_footer.php";?>


      </div><!--container-->


      <script type="text/javascript" src="<?=$webroot?>/Count!addVisits?id=<?=$obj['id']?>"></script>
     <!--
      <script language="javascript" type="text/javascript">
        document.oncontextmenu=new Function('event.returnValue=false;');
        document.onselectstart=new Function('event.returnValue=false;');
      </script>
      -->
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


    function doSubmit(){
      if( $("#rep_ctx").val() == ''){
        alert("Please enter you words");
        return;
      }
      if( $("#validationCode").val() == ''){
        alert("Validation code error");
        return;
      }
      $.post("<?=$webroot?>/Reply!save",$('#msgForm').formSerialize(),
      function(data) {
        if(data == "true"){
          location.reload();
        }else if(data == "0"){
          alert("Validation code error");
        }else if(data == "-1"){
          alert("Function closed");
        }else{
          alert(data);
        }
      },"html"
      );
    }

    function getNewValCode(){
      $('#vldCode ').attr("src",'<?=$webroot?>/Validation!getCode?r='+ Math.random());
    }

  </script>