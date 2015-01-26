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

			<style>
				#navdiv a{
					text-decoration:none; border:1px solid rgb(217,217,217); background:rgb(252,252,252);
					height:25px; line-height:25px; float:left;padding:0 10px; margin:0 5px;display:block; color:black;
				}
			
				#navdiv span{	display:block; float:left;height:29px; line-height:29px; font-size:14px;}
			/*	#navdiv input{ display:block; float:left;height:25px; line-height:25px; font-size:14px;} */
			  #navdiv input[type=submit]:hover{ background: rgb( 0,160,212); color:rgb( 255,255,255);}
			  #navdiv input[type=submit]{	width:50px;	 height:30px!important; line-height:30px!important;  background: rgb( 240,240,240); float:left;border:none;}

				#navdiv select{ display:block; float:left;height:25px; line-height:25px; font-size:14px;}
			</style>

			<input name='oldPerPageCnt' type='hidden' value='<?=$this->oldPerPageCnt?>'/>
			<div id="navdiv" style="float:right; margin-top:10px;">
				<span><?=$ttotal[$lan]?><?=$this->totNo;?></span>
				<?
				if( $this->pageNo == 1){ 	echo "<a>$tfirst[$lan]</a><a>$tpre[$lan]</a>"; }
				else {	echo "<a href='#' id='first'>&nbsp;$tfirst[$lan]&nbsp;</a><a href='#' id='pre'>&nbsp;$tpre[$lan]&nbsp;</a>"; }
				$totPageNum = $this->getPageCnt();
				$startPageNo = floor(($this->pageNo-1)/10)*10;
				if($totPageNum == 0){ echo "<a href='#' id='1'>&nbsp1&nbsp</a>";	}
				else{
					$c = 1+$startPageNo;
					while($c <= $totPageNum){
						if($c > (10+$startPageNo)){ break; }
						if($c == $this->pageNo){ echo "<a href='#' id='$c' style='border:1px solid rgb(100,100,100);'>$c</a>";}
						else{	echo "<a href='#' id='$c'>$c</a>";	}
						$c += 1;
					}
				}
				if($this->pageNo == $totPageNum)	{ echo "<a>$tnext[$lan]</a><a>$tlast[$lan]</a>"; }
				else { echo "<a href='#' id='next'>&nbsp;$tnext[$lan]&nbsp;</a><a href='#' id='last'>&nbsp;$tlast[$lan]&nbsp;</a>";}
				?>
				<input style="margin-left:20px;text-align:center;" name='skipValue' id='skipValue' type='text' value="<?=$this->pageNo?>" onkeyup="this.value=this.value.replace(/\D/g,'1')" onafterpaste="this.value=this.value.replace(/\D/g,'1')" size="2"/>
				<input style="padding:0 2px;margin-left:2px;" type='submit' name='btngo' value="<?=$tskip[$lan]?>"/>
				<span style="padding:0 5px;margin-left:10px;"><?=$tperpage[$lan]?></span>
				<select style="width:45px;" name='perPageCnt' onchange="doGo();">
					<option id="OPT5">5</option>
					<option id="OPT10">10</option>
					<option id="OPT20">20</option>
					<option id="OPT50">50</option>
				</select>
			</div>
