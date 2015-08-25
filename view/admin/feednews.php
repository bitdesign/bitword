<!DOCTYPE html>
<html>
    <head>
        <? include "_include.php"; ?>

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
                        $("#floatDiv").append("<a class='float_div_item' style='overflow: hidden; color:white;background:"+getRandomColor()+"' href='#"+divId+"'>"+rssFeedName+"</a>");

                        for ( i=0; i< items.length; i++){
                            var item = items[i];
                            var rssText =
                            "<div class=\"row\" style=\"padding:10px 20px;\">"+
                            "<a href=\""+item.link+"\" target=\"_blank\">"+item.title+"</a>"+
                            "<a style='color:#999;margin-left:20px;' title='save' onclick=\"markme('"+base64_encode(item.title)+"','"+base64_encode(item.author)+"','"+base64_encode(item.pubDate)+"','"+ base64_encode(item.link)+"','"+base64_encode(item.description)+"')\">"+ formatEnDate(item.pubDate)+" </a>"+
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
            <div id="wrapper">

                <? require_once('_navigation.php'); ?>

                <div id="page-wrapper" >

                    <div class="container-fluid" >

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="page-header">
                                    <h2><?=$feed_news?>
                                       
                                    </h2>
                                </div>

                            </div>
                        </div>
                        <!-- /.row -->



                        <div class="row">
                            <form id="myform" method="post" action="content!listPage#anchor">
                                <div class="panel-body" id="contentDiv">

                                </div>
                                <div class="panel-header" id="moreTip">
                                    <i class="fa fa-plus" style="font-size:1.5em;cursor:pointer;float:right;" onclick="loadNextFeed();">点击此处加载更多...</i>
                                </div>
                            </form>

                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
            
            
            <!-- 悬浮窗 -->
            <div class="float_div" id="floatDiv">
                
            </div>
        </body>
    </html>
