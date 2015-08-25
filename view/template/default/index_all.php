<!DOCTYPE html>
<html>
  <head>
    <title><?=$name?></title>
    <meta name="Keywords" content="<?=$keywords?>" />
    <meta name="Description" content="<?=$description?>" />

    <?include "_include.php";?>
    
     <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery.form/3.51/jquery.form.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
    <script type="text/javascript" src="<?=$webroot.'/'.$tpl_root.'/js/defualt.js' ?>"></script>
    
    <script type="text/javascript" src="<?=$webroot.'/'.$tpl_root.'/js/base64.js' ?>"></script>
    <script type="text/javascript" src="<?=$webroot.'/'.$tpl_root.'/js/bit.js' ?>"></script>
    <script type="text/javascript" src="<?=$webroot.'/'.$tpl_root.'/js/jquery.mousewheel.min.js' ?>"></script>



    <script language="javascript" type="text/javascript">
            
            var feedURLArray = [];
            var feedNameArray = [];
            var feedIndex = 0;
            
            <? foreach ($feeds as $feed){ ?>
            feedURLArray.push("<?=$feed['url']?>");
            feedNameArray.push("<?=$feed['feed_title']?>");
            <?}?>
            
           
            function loadMore(rssFeedUrl,rssFeedName){
                
                var divId = "div"+new Date().getTime();
                var spinId = "p"+new Date().getTime();
                var loadingText = 
                        "<div class=\"panel panel-default noradius noborder\" id='"+divId+"'>"+
    						"<div class=\"row list-group-item  row-ext zero noradius coverline\" style=\"padding:6px 10px;\">"+
    							"<div class=\"col-xs-12 col-sm-12\"><p class=\"list-group-item-text\"><i id='"+spinId+"' class=\"fa fa-spinner fa-spin\"></i>&nbsp;&nbsp;"+rssFeedName+" (<a href='Home!rssOne?url="+rssFeedUrl+"'>"+rssFeedUrl+"</a>)</p></div>"+
    						"</div>"+
					    "</div>"
				$("#contentDiv").append(loadingText);
				
				$.ajax({
                  url:"Feed!fetchFeed",
                  type:"POST",
                  data:{url:rssFeedUrl},
                  timeout:30000,
                  dataType:"html",
                  success:function(data){
                  // alert(data);
                   if(!data){
                        $("#"+spinId).removeClass().toggleClass("fa fa-star-half-o");
                        return;
                    }
                    
                   var jsonObj = eval("("+data+")");  
                    
                    if(!jsonObj){
                        $("#"+spinId).removeClass().toggleClass("fa fa-star-half-o");
                        return;
                    }
                    
                    var channelTitle = jsonObj.channel.title;
                    var items = jsonObj.channel.item;
                   
                    if( items.length <= 0 ){
                        $("#"+spinId).removeClass().toggleClass("fa fa-star-half-o");
                        return;
                    }
                      
                    $("#"+divId).remove();
                    
                    $("#contentDiv").append("<a name='"+divId+"'/>");
                    $("#floatDiv").append("<a class='float_div_item' style='background:"+getRandomColor()+"' href='#"+divId+"'/>");
                    
                    for ( i=0; i< items.length; i++){
                        var item = items[i];
                        var rssText = 
                        "<div class=\"panel panel-default noradius noborder\">"+
						"<div class=\"row list-group-item  row-ext zero noradius coverline\" style=\"padding:6px 10px;\">"+
							"<div class=\"panel-heading\">"+
								"<a class=\"list-title\" href=\""+item.link+"\" target=\"_blank\">"+item.title+"<a style='color:#999;'>("+formatEnDate(item.pubDate)+")</a></a>"+
								"<button class='bookmark' onclick=\"markme('"+base64_encode(item.title)+"','"+base64_encode(item.author)+"','"+base64_encode(item.pubDate)+"','"+ base64_encode(item.link)+"','"+base64_encode(item.description)+"')\"><i class=\"fa fa-bookmark-o\"></i></button>"+ 
							"</div>"+
						"</div>"+
					    "</div>";
					    
					    $("#contentDiv").append(rssText);
                    }
                  },
                  error:function(xmlHttpRequest, error){
                    $("#"+spinId).removeClass().toggleClass("fa fa-times-circle");
                  }
                });
                
               

            }
            
            
            function loadNextFeed(){
                if(!feedURLArray[feedIndex]){
                    $("#moreTip").html("");
        		}else{
        		    loadMore(feedURLArray[feedIndex],feedNameArray[feedIndex++]);
        		}
        	}	
        	    
            function markme(title,author,pubdate,link,summary){
                $.post("Content!saveRss",{sts:"1",block_id:"1",title:title,link:link,content:summary,pub_tm:pubdate},
                    function(data) {
                        if(data == "true"){alert("添加成功");}
                        else{alert(data);}
                    },"html"
                );
            }
            

			
			$(document).ready(function () {
				
				loadNextFeed();
				
				
				$(document).on('mousewheel', function(event) {
				    
                    if($(document).scrollTop()>=$(document).height()-$(window).height()){
                       loadNextFeed();
                    }
                });
                
                
		        $(document).dblclick(function(event) {
				    
                    loadNextFeed();
                });
			})
			
			
             
        </script>

  </head>
  <body>
    <div class="container">

      <? include "_header.php";?>


      <div class="main" >

        <div class="main-left">
          <form  method="post" action="Home!index">

            <div class="panel margin-top20">

              <div class="panel-body" id="contentDiv">
               
              </div>
              <div class="panel-header" id="moreTip">
                    <i class="fa fa-plus" style="font-size:1.5em;cursor:pointer;float:right;" onclick="loadNextFeed();">点击此处加载更多...</i>
                </div>
              <div class="panel-body">
                
              </div>
              

              <div class="panel-footer">
               
              </div>

            </div>
          </form>
        </div>

        <div class="main-right">


          <? //include "static/".$tpl_name."/_news.html";?>
          <!--
          <? //include "_news.php";?>
          <? //include "_words.php";?>
          -->

        </div>

      </div>



      <div class="footer">
        <span id="TimeShow"></span>
        &copy; BIT1010 2014 All Rights Reserved .  Powered by <a href="http://www.bit1010.com">BITWORD v1.0</a>
        
    </div>
    
    <script language="javascript" type="text/javascript">
        window.onload = function(){ 
            document.getElementById("TimeShow").innerHTML = "加载耗时"+ (new Date().getTime()-reqTime)/1000 +"s"; 
        } 
    </script>
    

    <?=stripslashes(base64_decode($accstat))?>


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