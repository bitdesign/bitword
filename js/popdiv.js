function popdiv(w,h,page,title) {
		var thepopdivtext = 
		"<div id='popwindow' style='border:solid 1px; background:#fff;position: absolute;visibility:hidden; left:50%;top:50%; z-index:999;  margin:"+(-h/2)+"px 0px 0px "+(-w/2)+"px;width:"+w+"px; height:"+h+"px;'>"+
				"<div id='popwindowbar' style='background:rgb(0,160,212); width:100%; height:27px; float:left;'><span style='display:block;float:left; padding-left:10px;line-height:27px;color:#fff;'>"+title+"</span><input id='popwindowclose' type='image'style='float:right;' src='js/close.png'/></div>"+
				"<div style='background:rgb(255,255,255); width:100%;' id='popdiv'></div>"+
		"</div>";

		$(window.document.body).append(thepopdivtext);
		$("#popwindowclose").click(function(){ 	$("#popwindow").remove();	});
	//	$(document).bind('keydown', 'esc',function (evt){ $("#popwindow").remove(); });
		$("#popdiv").load(page,function(){ $("#popwindow").css("visibility","visible");	});
		
		//drag control
		var _move = false;
		var _x, _y; //The mouse postion(_x,_y) in popwindow . When mouse down, _x and _y is constant value. When mouse move ,we always can get e.pageX and pageY, so can calculate left and top 
		$("#popwindowbar").mousedown(function(e) {
			_move = true;
			_x = e.pageX - parseInt($("#popwindow").css("left"));
			_y = e.pageY - parseInt($("#popwindow").css("top"));
			$("#popwindowbar").css("cursor","move");
		});
		$(document).mousemove(function(e) {
			if (_move) {
				var x = e.pageX - _x;
				var y = e.pageY - _y;
				$("#popwindow").css({ top: y, left: x });
			}
		}).mouseup(function() {
			_move = false;
			$("#popwindowbar").css("cursor","default");
		});
	}
