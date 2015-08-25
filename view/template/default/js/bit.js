//Fri, 22 May 2015 16:27:20 +0800

function formatEnDate(str){

    if( !str) return str;
    if( str.length < 20 ) return str; //2014-09-02 12:12:38
    var monthEnArr  = new Array();

    //"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Spt","Oct","Nov","Dec"
    monthEnArr["Jan"] = "01";
    monthEnArr["Feb"] = "02";
    monthEnArr["Mar"] = "03";
    monthEnArr["Apr"] = "04";
    monthEnArr["May"] = "05";
    monthEnArr["Jun"] = "06";
    monthEnArr["Jul"] = "07";
    monthEnArr["Aug"] = "08";
    monthEnArr["Spt"] = "09";
    monthEnArr["Oct"] = "10";
    monthEnArr["Nov"] = "11";
    monthEnArr["Dec"] = "12";


    var dateStr = str.substr(5,2);
    var monStr = monthEnArr[str.substr(8,3)];
    var yearStr = str.substr(12,4);
    var timeStr = str.substr(17,8);

    var dateStr = yearStr+'-'+monStr+'-'+dateStr+" "+timeStr;
    return dateStr;

}

function getRandomColor(){
    return '#'+(Math.random()*0xffffff<<0).toString(16); 
}