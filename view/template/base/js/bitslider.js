/**	BitSlider	by: sunjinzhe **/
/*
How to use it
step 1. Include the jquery lib (jquery-1.7.2.min.js or later version) and bitslider.js

step 2. Define your divs to slide

<body>  
    <div class="main" id="main">
        <div><span>Simple</span></div>
        <div><span>Art</span></div>
        <div><span>Product</span></div>
    </div>
</body>
step 3. Init your divs like this:

$(document).ready(function(){   
    $("#main").bitSlider({
        delay: 500,
        space: 25,
        showNum: true,
        prenext: false
    });
});

Then the divs in main div will slide one each time.


*/
(function($) {

	$.fn.bitSlider = function(options){
	  	
	  	var curVal = 0;
	  	var divNum = 0;
	  	var totWidth = 0;
	  	var divWidth = 0;
		var defaults = {
			auto: true,	
			auto_time: 3000,
			delay: 300,
			space: 25,
			right: 0,
			font_size: 12,
			showNum: true
		}; 
		
		var options = $.extend(defaults, options);
		
		this.each(function() {  
			
			var interval;
			var slider = $(this);
			divWidth = $(slider).width();
			
			var space = options.space;
			var right = options.right;
			var prenext = options.prenext;
			var auto = options.auto;
			var auto_time = options.auto_time;
			var font_size = options.font_size;
			
			var divArr = $("div",slider);
			divNum = divArr.length;
			totWidth = divNum * divWidth;
			
			var num = divNum;
			var adjust = 0;
			var leftOffset = 0;
			
			if( right > 0){
					leftOffset = divWidth - num * space - right; //align to light
			}else{
					leftOffset = (divWidth - num * space)/2; //align center
			}
			
			$(slider).css({"overflow":"hidden","position":"relative"});
			
			$("div",slider).each(function(i) {
				$(this).css({"position":"absolute","left":i*divWidth+"px","width":"100%", "height":"100%"});
				$(this).attr("id","itm"+i);
				var divNo = ""; if(options.showNum) divNo = i+1;
				$(slider).append("<em id='emclick"+i+"' style='border:none; cursor:pointer;text-align:center;color:#fff; font-style: normal;background:rgb(48,157,13);position:absolute;left:"+(leftOffset+space*1.5*(i+adjust))+"px;bottom:"+space/3+"px;width:"+space+"px;height:"+space+"px;border-radius:"+space/2+"px;-webkit-border-radius:"+space/2+"px;-moz-border-radius:"+space/2+"px;font-size:"+font_size+"px;'>"+divNo+"</em>"); 
				$("#emclick"+i).click(function(){ clickOne(i) });
			});
			
			$("#emclick0").css("background", "rgb(58,227,23)");
			
			
			function leftMove(d){
				
				var delay = options.delay;
				for( i = 0; i < divNum; i++){
					var lpx = $(divArr[i]).css("left");
					var idx = lpx.indexOf("px");
					var newl = (lpx.substring(0,idx) - d*divWidth);
					if( newl >= 0 && newl < totWidth ){
						$(divArr[i]).animate({left:newl+"px"},delay);
					}else if( newl < 0 ){
						newlmod = newl + totWidth;
						$(divArr[i]).animate({left:newl+"px"},delay).animate({left:newlmod+"px"},0);
					}else if( newl >= totWidth){
						newlmod = newl - totWidth;
						$(divArr[i]).animate({left:newlmod+d*divWidth+"px"},0).animate({left:newlmod+"px"},delay);
					}
				}
				curVal = (curVal+d)%divNum;
				$("em[id^='emclick']").css("background", "rgb(48,157,13)");
				$("#emclick"+curVal).css("background", "rgb(58,227,23)");
			}
			
			function clickOne(id){
				newVal = (id - curVal)%divNum;
				if( newVal ==0 ) return;
				leftMove(newVal);
				curVal = id;
				if(auto){
					clearTimeout(interval);
				}
			}
			
			if(auto){
				interval = setInterval(function(){
					leftMove(1);
			    }, auto_time);
			}
			
		});
	};

})(jQuery);		
