function goRoll(n,time){
    var speed = time || 1000;
    var n  = n || 0;
    jQuery('html,body').animate({scrollTop:n-50},speed);
};

function goend(){
    goRoll($(document).height());
}