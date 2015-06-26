<script language="JavaScript">
	$(function(){
		$("#navdiv a").click(function(){
			clickId = $(this).attr("id");
			if (typeof(clickId) == "undefined")  return;
			var curNo = $("#skipValue").val();
			if(clickId=="first") clickId = 1;
			else if(clickId=="pre")  clickId = parseInt(curNo)-1;
				else if(clickId=="next") clickId = parseInt(curNo)+1;
					else if(clickId=="last") clickId = <?=$this->getPageCnt()?>;
						$("#skipValue").attr("value",clickId);
						$(this).parents("form").submit();
					});
					var aa = "#OPT"+<?=$this->perPageCnt?>;
					$(aa).attr("selected",'selected');
				});
				function doGo(){ 	$("input[name='btngo']").click();	}
			</script>


			<input name='oldPerPageCnt' type='hidden' value='<?=$this->oldPerPageCnt?>'/>
			<div id="navdiv" style="float:right;">
 
                <ul class="pagination">
				    <li class='disabled'><a><?=$ttotal.' '.$this->totNo ?></a></li>
				</ul>
				
				<ul class="pagination">
				    
				    
					<?
					
					
					if( $this->pageNo == 1){ 	echo "<li class='disabled'><a>$tfirst</a></li><li class='disabled'><a>&laquo;</a></li>"; }
					else {	echo "<li><a href='#' id='first'>$tfirst</a></li><li><a href='#' id='pre'>&laquo;</a></li>"; }
					$totPageNum = $this->getPageCnt();
					$startPageNo = floor(($this->pageNo-1)/10)*10;
					if($totPageNum == 0){ echo "<li><a href='#' id='1'>1</a></li>";	}
					else{
						$c = 1+$startPageNo;
						while($c <= $totPageNum){
							if($c > (10+$startPageNo)){ break; }
							if($c == $this->pageNo){ echo "<li class='active'><a href='#' id='$c'>$c</a></li>";}
							else{	echo "<li><a href='#' id='$c'>$c</a></li>";	}
							$c += 1;
						}
					}
					if($this->pageNo == $totPageNum)	{ echo "<li class='disabled'><a>&raquo;</a></li><li class='disabled'><a>$tlast</a></li>"; }
					else { echo "<li><a href='#' id='next'>&raquo;</a></li><li><a href='#' id='last'>$tlast</a></li>";}
					?>
					
					<li>
						<input style="display:none;" name='skipValue' id='skipValue' type='text' value="<?=$this->pageNo?>" />
						<input style="display:none;" type='submit' name='btngo'/>
						<select class="form-control" style="width:70px;float:left;margin-left:5px;" name='perPageCnt' onchange="doGo();">
							<option id="OPT5">5</option>
							<option id="OPT10">10</option>
							<option id="OPT20">20</option>
							<option id="OPT50">50</option>
						</select>
					</li>
					
					
				</ul>
				
			</div>
