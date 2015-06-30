<!DOCTYPE html>
<html>
    <head>
        <? include "_include.php"; ?>

        <link href="view/public/css/summernote.css" rel="stylesheet">
        <script type="text/javascript" charset="utf-8" src="view/public/js/summernote.min.js"></script>

        <script language="javascript" type="text/javascript">


           

            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 800 ,
                    onImageUpload: function(files, editor, $editable) {
                        sendFile(files[0],editor,$editable);
                    }
                });
            });
            
            
             function sendFile(file, editor, $editable) {
                data = new FormData();
                data.append("file", file);
                data.append("path", 'upload/');
                filename = file['name']; 
                
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "File!uploadMyFile",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        $('#summernote').summernote('editor.insertImage', url);
                    },  
                    error:function(xmlHttpRequest, error){
                       alert(error);
                    }
                });
            }
            
            
            function getContent() {
                //return UE.getEditor('myEditor').getContent();
                return  $('#summernote').code();
            }
            function hasContent(){
                var text = $('#summernote').code();
                if( !text){
                    return true;
                }
                return false;
            }
            function doSubmit(sts){
                if( $("#contentTitle").val() == ''){
                    alert("<?=$ttitletips?>!");
                    return;
                }
                if(typeof ($("#block_id").val()) == 'undefined'){
                    alert("<?=$tcattips?>!");
                    return;
                }

                $("#content").val(getContent()) ;
                $("#sts").val(sts) ;

                $.post("Content!save",$('#contentEditForm').formSerialize(),
                    function(data) {
                        if(data.code == "true"){
                             $("#id").val(data.id) ;
                             alert("<?=$tsuccess?>");
                            //location.href = "Content!listPage";
                        }else{
                            //alert("<?=$tfailed?>");
                            alert(data);
                        }
                    },"json"
                 );
            } //doSubmit

            function doClose(){
                    location.href = "Content!listPage";
                }

            </script>
                </head>
                <body>
                    <div id="wrapper">

                        <? require_once('_navigation.php'); ?>

                        <div id="page-wrapper">

                            <div class="container-fluid">

                                <!-- Page Heading -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="page-header">
                                            <h2><?=$taddarticle?>
                                                <div style="float:right;">
                                                    <button type="button" class="btn btn-info" onclick="doSubmit('-1')"><?=$tsave.$tdraft?></button>
                                                    <button type="button" class="btn btn-success" onclick="doSubmit('1')"><?=$ttopublished?></button>
                                                    <button type="button" class="btn btn-danger"  onclick="doClose()"><?=$tclose?></button>
                                                </div>
                                            </h2>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">



                                    <form id="contentEditForm" >
                                        <input type="hidden" name="id" value="<?=$obj["id"]?>" id="id"/>
                                        <input type="hidden" name="input_tm" value="<?=$obj["input_tm"]?>" id="input_tm"/>

                                        <div class="col-lg-9 col-xs-9 col-sm-12">
                                            <input type="text" class="form-control edit-title" placeholder="<?=$ttitle?>" name="title"  id="contentTitle" value='<?=$obj["title"]?>'>
                                        </div>

                                        <div class="col-lg-3 col-xs-3 col-sm-12">
                                            <select name="block_id" id="block_id" class="form-control edit-title">
                                                <?
                                                foreach ($blockList as $row){
                                                    echo "<option value='".$row["block_id"]."'".($obj["block_id"]==$row["block_id"]?" selected ":"").">".$row["block_name"]."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <input type="hidden" name="sts" id="sts" />
                                        
                                        <!--
                                        <div class="col-lg-3 col-xs-3 col-sm-12">
                                            <select name="sts" class="form-control edit-title">
                                                <option value="1" <? if($obj["sts"]=="0") echo "selected" ?>><?=$ttopublished?></option>
                                                <option value="-1" <? if($obj["sts"]=="-1") echo "selected" ?>><?=$tdraft?></option>
                                            </select>
                                        </div>
                                        -->
                                        

                                        <div class="col-lg-12 col-xs-12 col-sm-12" style="padding-top:20px;">
                                            <input type="hidden" name="content" id="content" />
                                            <!--
                                            <script type="text/plain" id="myEditor" name="myEditor" style="width:100%;height:800px;margin-top:10px;">
                                            <?=$obj["content"]?>
                                            </script>
                                            -->
                                            <div id="summernote" name="myEditor"><?=$obj["content"]?></div>

                                        </div>

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

            </body>
        </html>
