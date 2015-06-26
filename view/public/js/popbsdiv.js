function popdiv(w,h,page,title) {
		var thepopdivtext = 
		"<div id='popwindow1' style='position: absolute;left:20%;top:20%; z-index:999;  '>"+
			"<div class='modal-dialog'>"+
				"<div class='modal-content' id='popdiv'>"+
				"</div>"+
			"</div>"+
		"</div>";
		$(window.document.body).append(thepopdivtext);
		$("#popdiv").load(page,function(){ 
		});
}
