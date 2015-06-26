function iFrameHeight() {
    var winHeight = document.body.scrollHeight;
    //var headerHeigh = $(".header").height();
    //var footerHeigh = $(".footer").height();
    //alert(winHeight);
    var headerHeigh = 50;
    var footerHeigh = 0;
    var menuHeight = winHeight-headerHeigh-footerHeigh;
    $("#page-wrapper").css("height",menuHeight+"px");
}

    function updateMemcache(){

    $.post("Setting!startMemCache",{},function(data) {
        if(data == "true"){ alert("Update success"); location.href = location.href;}
        else{ alert(data);} },"html");
    }


    $(document).ready(function(){
        //control the menu active
        $('#side-menu-nav li a').each(function () {
            loc = location.href;
            loc_a = $(this).attr('href');
            if(loc.indexOf(loc_a) > -1 ){
                $(this).parent().addClass('active');
            }
        });

        $('input[type=checkbox][name=tyCheckAll]').click(function(){
            if($(this).is(':checked') == true){
                $('input[type=checkbox][name=tyChecks]').prop('checked',true);
            }else {
                $('input[type=checkbox][name=tyChecks]').prop('checked',false);
            }
        });
        //iFrameHeight();
    });
