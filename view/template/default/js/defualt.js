function goRoll(n,time){
  var speed = time || 1000;
  var n  = n || 0;
  jQuery('html,body').animate({scrollTop:n-50},speed);
};

function goend(){
  goRoll($(document).height());
}

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