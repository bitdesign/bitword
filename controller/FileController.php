<?
require_once('Controller.php');
require_once('lib/LogUtil.php');
require_once('lib/ZipUtil.php');
require_once('lib/Functions.php');
require_once('config/config.php');
class FileController extends Controller{

    public $logger;

    function __construct(){
        parent::__construct();
        $this->logger = LogUtil::getLogger();
    }


    function uploadMyFile(){

        if ($_FILES['file']['name']) {

            if (!$_FILES['file']['error']) {
                $file = $_FILES['file']['tmp_name'];
                
                $filePath = $_POST["path"];
                
                $fileName = $_FILES['file']['name'];
                $ext = explode('.', $fileName);
                $filename = date("YmdHis") . rand(100,999).'.' . $ext[1];
                
                $dst_file = $filePath.$filename;

                move_uploaded_file($file,$dst_file);

                echo $webroot."/".$dst_file;
            }
            else
            {
                echo  $message = $_FILES['file']['error'];
            }
        }
    }


    function upload(){

        $fileElementName = $_POST["name"];
        $filePath = $_POST["path"];
        $file = $_FILES[$fileElementName]['tmp_name'];
        $fileType = $_FILES[$fileElementName]['type'];
        $msg = "Upload error, please try later!";
        $code = false;

        if($fileElementName === "image"){
            if( !$this->isImage($fileType)){
                $msg = "Please upload a image file!";
                $msg = $fileType;
                echo "{code: '" . $code . "',\nmsg: '" . $msg . "'\n}";
                return;
            }
        }

        $dst_file = dirname(__FILE__).'/../'.$filePath.'/'.iconv('UTF-8','gb2312',$_FILES[$fileElementName]['name']);

        if( move_uploaded_file($file,$dst_file)){
            $msg = "Upload succeed!";
            $code = true;
        }

        if($fileElementName === "tpl"){
            $msg = $fileElementName;
            if( $this->file_type($dst_file ) !== "zip"){
                $msg = "Please upload a zip file!";
                $code = false;
            }else{
                $zip = new ZipUtil();
                $code =	$zip->unzip($dst_file, false, false, true);
                if( !$code){
                    $msg = "upzip failed code=".$code;
                }else{
                    $msg = "upzip success code=".$code;
                }

            }
            unlink($dst_file);
        }
        echo "{code: '" . $code . "',\nmsg: '" . $msg . "'\n}";
    }


    function download(){
        $fileName = $_GET["filename"];

        $downFileName = substr($fileName,strpos($fileName,"/")+1);

        $this->logger->info($downFileName);
        $file = fopen($fileName,"r");
        Header("Content-type:application/octet-stream");
        Header("Accept-Ranges:bytes");
        Header("Accept-Length:".filesize($fileName));
        Header("Content-Disposition:attachment;filename=".$downFileName);
        echo fread($file,filesize($fileName));
        fclose($file);
    }

    function isImage($type){
        $ret=false;
        switch ($type){
            case 'image/pjpeg':$ret=true;
            break;
            case 'image/jpeg':$ret=true;
            break;
            case 'image/gif':$ret=true;
            break;
            case 'image/png':$ret=true;
            break;
        }
        return $ret;
    }
    function isZip($type){
        $ret=false;
        switch ($type){
            case 'application/zip':$ret=true;
            break;
        }
        return $ret;
    }

    function file_type($filename)
    {
        $file = fopen($filename, "rb");
        $bin = fread($file, 2); //Ö»¶Á2×Ö½Ú
        fclose($file);
        $strInfo = @unpack("C2chars", $bin);
        $typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
        $fileType = '';
        switch ($typeCode)
        {
            case 7790:
            $fileType = 'exe';
            break;
            case 7784:
            $fileType = 'midi';
            break;
            case 8297:
            $fileType = 'rar';
            break;
            case 8075:
            $fileType = 'zip';
            break;
            case 255216:
            $fileType = 'jpg';
            break;
            case 7173:
            $fileType = 'gif';
            break;
            case 6677:
            $fileType = 'bmp';
            break;
            case 13780:
            $fileType = 'png';
            break;
            default:
            $fileType = 'unknown: '.$typeCode;
        }

        //Fix
        if ($strInfo['chars1']=='-1' AND $strInfo['chars2']=='-40' ) return 'jpg';
        if ($strInfo['chars1']=='-119' AND $strInfo['chars2']=='80' ) return 'png';

        return $fileType;
    }
}
