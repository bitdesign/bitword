<!DOCTYPE html>
<html>
    <head>
        <? include "_include.php"; ?>
        <script language="javascript" type="text/javascript">

            function editBlock(id) {
                popdiv('510','170',"Block!editPage?id="+id,'<?=$tblock?>');
            }
            function addBlock() {
                popdiv('510','170',"Block!addPage",'<?=$tblock?>');
            }
            function delBlock(id)
            {
                if(!confirm("<?=$tconfirm?>?")){ return false; }
                $.post("Block!del",{"id":id},
                function(data) {
                    if(data == "true"){
                        location.reload();
                    }else{
                        alert("<?=$tfailed?>");
                    }
                },"html"
                );
            }

            function doDel(id){
                if(!confirm("<?=$tconfirm?>?")){ return false; }
                $.post("Block!del",{"id":id},
                function(data) {
                    if(data == "true"){ window.location.reload(); }
                    else{ alert("<?=$tfailed?>"); }
                    });
                }

                //changeStatus begin
                function changeStatus(stsVal){
                    var idListString = "";
                    $.each($("input[name=tyChecks][type='checkbox']:checked"), function () {
                        idListString += $(this).val();
                        idListString += ",";
                    });
                    if( idListString == ""){
                        alert("<?=$tnoseltips?>");
                        return false;
                    }
                    if(stsVal=="4"){
                        if(!confirm("<?=$tconfirm?>?")){ return false;}
                    }
                    doDel(idListString);
                }//changeStatus end


                // block edit start
                function add(){
                    $.post("Block!save",{'block_id':$('#block_id').val(),'block_name':$('#block_name').val(),'input_tm':$('#input_tm').val()},
                    function(data) {
                        if(data=="true"){
                            location.reload();
                        }else{
                            alert(data);
                        }
                    },"html"
                    );
                }

                function doUpload()
                {
                    filename = $("#image").val();
                    var idx = filename.lastIndexOf('\\');
                    filename = filename.substring(idx+1);
                    $("#dsp_img").val('upload/'+filename);

                    $.ajaxFileUpload({
                        url:'File!upload',
                        data:{'name':'image','path':'upload/'},
                        type:'POST',
                        secureuri:false,
                        fileElementId:'image',
                        dataType: 'json',
                        success: function (data){
                            alert(data.msg);
                            $("#echoimg").attr("src","upload/"+filename);
                        },
                        error: function (data){
                            alert(data.msg);
                        }
                    })
                    return false;
                }

                function setFileName(str){
                    $("#txt").val(str);
                    doUpload();
                }
                function doClose()
                {
                    location.reload();
                }

                // block edit end
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
                                    <h2><?=$tblock?>
                                        <div style="float:right;">
                                            <button type="button" class="btn btn-success" onclick="addBlock()"><?=$tadd?></button>
                                            <button type="button" class="btn btn-danger"  onclick="changeStatus('4')"><?=$tbatchdelete?></button>
                                        </div>
                                    </h2>
                                </div>

                            </div>
                        </div>
                        <!-- /.row -->






                        <div class="row">
                            <div class="col-lg-12">


                                <form method="post" action="Block!listPage">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="tyCheckAll"/></th>
                                                    <th><?=$tname?></th>
                                                    <th><?=$tinputtm?></th>
                                                    <th><?=$tedittm?></th>
                                                    <th><?=$tuser?></th>
                                                    <th><?=$toperation?></th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <? foreach ($arrayList as $row){ ?>
                                                <tr>
                                                    <td><input type='checkbox' name='tyChecks' value='<?=$row["block_id"]?>'/></td>
                                                    <td><?=$row["block_name"]?></td>
                                                    <td><?=btime($row["input_tm"])?></td>
                                                    <td><?=btime($row["edit_tm"])?></td>
                                                    <td><?=$row["usr_nm"]?></td>
                                                    <td>
                                                        <a onclick='delBlock(<?=$row["block_id"]?>)' ><i class='fa fa-fw fa-trash-o'></i></a>
                                                        <a onclick='editBlock(<?=$row["block_id"]?>)' ><i class='fa fa-pencil-square-o'></i></a>
                                                    </td>
                                                </tr>
                                                <?}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>

                            </div>
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
