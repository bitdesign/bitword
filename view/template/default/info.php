<!DOCTYPE html>
<html>
  <head>
    <?include "_include.php";?>
    
    <script language="javascript" type="text/javascript">

      $(document).ready(function(){

      });

    
      function topme(rep_id){
        /*
        $.post("<?=$webroot?>/Reply!addTopCount",{"rep_id":rep_id},
        function(data) {
          if(data == "true"){
            location.reload();
          }else{
            alert("false");
          }
        },"html"
        );
       */
      }
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
  </head>


  <div class="container container-ext">

    <?include "_header.php";?>

    <div class="row" >

      <div class="col-xs-12 col-lg-9 no-right-padding">


      
          <div class="panel panel-default noradius noborder">
            <div class="panel-heading">
	          	<a href="<?=$webroot?>index.html"><i class="fa fa-fw fa-home"></i></a>
	            <a href="<?=$webroot.'/'.$tpl_name.'_b'.$obj['block_id']?>.html"><?=$obj["block_name"]?></a>&gt;
	            <a href="<?= $obj["link"] ?>" target="_blank"><?=$obj["title"]?></a>
            </div>
            <div class="panel-heading" style="background:rgb(252,252,252);">
              <h4><?=$obj["title"]?></h4>
              <h5>
                <!--<i class="fa fa-file-text-o"></i> <?=$obj["block_name"]?>&nbsp;&nbsp;-->
                <i class="fa fa-fw fa-user"></i><?=$obj["usr_rnm"]?>&nbsp;&nbsp;
                <i class="fa fa-fw fa-clock-o"></i><?=date('Y-m-d', strtotime($obj["edit_tm"]))?>&nbsp;&nbsp;
                <!--<i class="fa fa-fw fa-eye"></i><?=$obj["visits"]?>&nbsp;&nbsp;
                <i class="fa fa-fw fa-leaf"></i> keyword : <?=$obj["keyword"]?>&nbsp;&nbsp;-->
              </h5>
            </div>
            <div class="panel-body">
                
                <!--<i class="fa fa-fw fa-map-marker"></i>-->
                <?=stripslashes($obj["content"])?> 
                <br/>
              

            </div>
                  
           </div><!--panel-->
                
       
                
                <div class="panel panel-default noradius noborder">
                  <div class="panel-heading">
                      <i class="fa fa-fw fa-comment"></i> Comment
                  </div>
                  <div class="panel-body">
                    <div class="row">
                    <form id="myform" method="post" action="Home!info?id=<?=$obj["id"]?>">
                    <? foreach ($msgList as $row){ ?> <!-- start-->
                    <div class="reply">
                      <div style="width:80px;height:100%;float:left;">
                        <img width="50" height="50" style="margin:15px;" src="<?=$webroot.'/'.$tpl_root?>/images/default.png"/>
                      </div>
                      <div style="height:100%;margin-left:80px;">
                        <p style="color:red;"><?=$row["usr_name"]?></p>
                        <p><pre><?=$row["rep_ctx"]?></pre></p>
                        <p style="font-size:10px;color:#aaa;">
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
                    <div class="row" style="margin-top:10px;">
                      <? if($commentswitch==="1"){ ?>
                      <form id="msgForm" class="border:none;">

                        <input type="hidden" name="par_id" value="<?=$obj['id']?>"/>
                        <div class="row">
                          <input type="hidden"   name="usr_name" value="default"/>
                        </div>


                        <p>
                          <textarea name="rep_ctx" id="rep_ctx" class="form-control" row="3"></textarea>
                        </p>
                        <div class="text-right">
                          <img src="<?=$webroot?>/Validation!getCode" id="vldCode" onclick="getNewValCode()" class="topalign"/>
                          <input type="text" name="validationCode" id="validationCode" maxlength="4" style="width:100px;height:30px;line-height:30px;" value=""/>
                          <button type="button" onclick="doSubmit();" class="btn btn-sm btn-success topalign">Reply</button>
                        </div>

                      </form>
                    <?}?>
                    </div>
                  </div>
                 </div>
                 
                 
                 
                  
                    
                    
                    
                    
                    

              </div><!--col-xs-12-->

              <div class="col-xs-12 col-lg-3">
                <?include "$tpl_root/static/_news.html";?>
              </div>

            </div>



            <?include "_footer.php";?>


          </div>



        </body>



      </html>