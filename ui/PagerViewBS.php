<!-- script 和 style 分别移到主题的 defualt.js 和 simple.css
			<script language="JavaScript">
				$(function(){
						$("#navdiv a").click(function(){
								clickId = $(this).attr("id");
								var curNo = $("#skipValue").val();
								if (typeof(clickId) == "undefined")  return;
								else if(clickId=="pre")  clickId = parseInt(curNo)-1;
								else if(clickId=="next") clickId = parseInt(curNo)+1;
								$("#skipValue").attr("value",clickId);
								$(this).parents("form").submit();
						});
					});
			</script>

			<style>
			    
			    #navdiv{
			        float:right; margin:30px 30px 0 0;
			    }
			    
				#navdiv a{
					text-decoration:none; border:none; 
					height:20px; line-height:20px; float:left;padding:0 7px; margin:0 1px;display:block;
				}
			</style>
-->			
			<input name='oldPerPageCnt' type='hidden' value='<?=$this->oldPerPageCnt?>'/>
			<input name='skipValue' id='skipValue' type='hidden' value="<?=$this->pageNo?>"/>
			
			<div id="navdiv">
				<?
				$totPageNum = $this->getPageCnt();
				$startPageNo = floor(($this->pageNo-1)/10)*10;
				if($totPageNum <= 1){}
				else{
					$c = 1+$startPageNo;
					
					if( $this->pageNo == 1){ 	echo "<a>&nbsp;<&nbsp;</a>"; }
					else{ echo "<a href='#' id='pre'>&nbsp;<&nbsp;</a>";}
					
					while($c <= $totPageNum){
						if($c > (10+$startPageNo)){ break; }
						if($c == $this->pageNo){ echo "<a href='#' id='$c' style='border:1px solid #cce;'>$c</a>";}
						else{	echo "<a href='#' id='$c'>$c</a>";	}
						$c += 1;
					}
					
					if($this->pageNo == $totPageNum)	{ echo "<a>&nbsp;>&nbsp;</a>"; }
			   	else { echo "<a href='#' id='next'>&nbsp;>&nbsp;</a>";}
				}
				?>
				
			</div>
