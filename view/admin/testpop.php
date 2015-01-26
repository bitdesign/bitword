<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			function editBlock(id) {
				popdiv('510','170',"Block!editPage?id="+id,'<?=$tblock[$lan]?>');
			}
			function addBlock() {
				popdiv('510','170',"Block!addPage",'<?=$tblock[$lan]?>');
			}
			function delBlock(id)
			{
				if(!confirm("<?=$tconfirm[$lan]?>?")){ return false; }
				$.post("Block!del",{"id":id},
				function(data) {
					if(data == "true"){
						location.reload();
					}else{
						alert("<?=$tfailed[$lan]?>");
					}
				},"html"
				);
			}

			function doDel(id){
				if(!confirm("<?=$tconfirm[$lan]?>?")){ return false; }
				$.post("Block!del",{"id":id},
				function(data) {
					if(data == "true"){ window.location.reload(); }
					else{ alert("<?=$tfailed[$lan]?>"); }
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
						alert("<?=$tnoseltips[$lan]?>");
						return false;
					}
					if(stsVal=="4"){
						if(!confirm("<?=$tconfirm[$lan]?>?")){ return false;}
					}
					doDel(idListString);
				}//changeStatus end
			</script>
		</head>
		<body>
			<h2>创建模态框（Modal）</h2>
<!-- 按钮触发模态框 -->
<button class="btn btn-primary btn-lg" data-toggle="modal" 
   data-target="#myModal">
   开始演示模态框
</button>

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               模态框（Modal）标题
            </h4>
         </div>
         <div class="modal-body">
            在这里添加一些文本
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">关闭
            </button>
            <button type="button" class="btn btn-primary">
               提交更改
            </button>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
		</body>
	</html>
