/**
	BitClock
	by: sunjinzhe
	
	<div class="tips" id="timebar"></div>
	
	
	$(document).ready(function(){	
				$("#timebar").colck({
					lan:"cn"
				});
			});
**/

(function($) {

	$.fn.colck = function(options){
	  	
	  	
		var defaults = {
			lan : "cn"
		}; 
		
		var options = $.extend(defaults, options);
		
		this.each(function() {  
			var lan = options.lan;
			var clock = $(this);
			setInterval(function(){	
				if( lan == "cn" ){
					$(clock)[0].innerHTML = new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());
				}else{
					$(clock)[0].innerHTML = new Date();
				}
			}, 500);
		});
	};

})(jQuery);		
