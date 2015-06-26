<?php
//$rssfeed = array("http://36kr.com/feed","http://feed43.com/1726484643045386.xml","http://feed43.com/1726484643045386.xml","http://feed.appinn.com/","http://www.csdn.net/article/rss_lastnews");
$rssfeed = array("http://feed43.com/1726484643045386.xml");

header('Content-Type:text/html;charset= UTF-8');

for($i=0;$i<sizeof($rssfeed);$i++){
    $buff = "";
    $rss_str="";
    //打开rss地址，并读取，读取失败则中止
    $fp = fopen($rssfeed[$i],"r") or die("can not open $rssfeed");
    while ( !feof($fp) ) {
        $buff .= fgets($fp,4096);
    }
    //关闭文件打开
    fclose($fp);
    //建立一个 XML 解析器
    $parser = xml_parser_create();
    //xml_parser_set_option -- 为指定 XML 解析进行选项设置
    xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
    //xml_parse_into_struct -- 将 XML 数据解析到数组$values中
    xml_parse_into_struct($parser,$buff,$values,$idx);
    //xml_parser_free -- 释放指定的 XML 解析器
    xml_parser_free($parser);
    foreach ($values as $val) {
        $tag = $val["tag"];
        $type = $val["type"];
        $value = $val["value"];
        //标签统一转为小写
        $tag = strtolower($tag);
        if ($tag == "item" && $type == "open"){
            $is_item = 1;
        }else if ($tag == "item" && $type == "close") {
            //构造输出字符串
            $rss_str .= "<a href='".$link."' target=_blank>".$title."</a><br />";
            $is_item = 0;
        }
        //仅读取item标签中的内容
        if($is_item==1){
            if ($tag == "title") {$title = $value;}
            if ($tag == "link") {$link = $value;}
        }
    }
    //输出结果
    echo $rss_str."<br />";
}
?>