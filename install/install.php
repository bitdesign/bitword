<?
session_start();
if( !isset( $_SESSION['lan']  )){

    $_SESSION['lan'] = $_GET['lan'];
}
require "translate/".$_SESSION['lan'].".php";

error_reporting(0);
?>

<!DOCTYPE html">
<html>
    <head>
        <title>bitcms-<?=$_SESSION['lan']?></title>


        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="install.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="../view/public/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="../view/public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen" />

        <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript" src="../view/public/js/jquery.js"></script>
        <script type="text/javascript" src="../view/public/js/jquery.form.js"></script>
        <script type="text/javascript" src="../view/public/js/jquery.validate.js"></script>
        <script type="text/javascript" src="../view/public/js/jquery.ext.js"></script>

        <script>

            function doSubmit(sts){

                location.href = "<?=$_SERVER['PHP_SELF']?>?step="+sts;
            }

            $(function(){

                $("#myform").validate({
                    rules: {
                        'hostname': {
                            required: true
                        },
                        'dbname': {
                            required: true
                        },
                        'username': {
                            required: true
                        },
                        'password': {
                            required: true
                        },

                        'adminname': {
                            required: true
                        },
                        'adminpwd': {
                            required: true,
                            minlength: 6
                        }
                    },
                    messages: {
                        'adminname': {
                            required : "<?=$plsuname?>"
                        },'adminpwd': {
                            required : "<?=$plsupwd?>",
                            minlength: jQuery.format("<?=$plsupwdlen?>")
                        },'hostname': {
                            required : "<?=$plshost?>"
                        },'dbname': {
                            required : "<?=$plsdbname?>"
                        },'username': {
                            required : "<?=$plsdbuname?>"
                        },'password': {
                            required : "<?=$plsdbupwd?>"
                        }
                    }


                });

            });//function end
        </script>

    </head>
    <body>

        <div class="all">

            <div class="header">
                <img src="../upload/logo.png" />
            </div>



            <?
            if($_GET["step"]=="" ){
                ?>
                <div class="main">
                    <pre class="pact" readonly="readonly">
                        <?
                        require_once "../lib/Info.php";
                        $info = new Info();
                        $attSize = $info->getAttMaxsize();
                        $phpVersion = $info->getVer();
                        $space = $info->getDiskFreeSpace('.');//,'0.01G')>0

                        if( strnatcmp($phpVersion,'5.1.2')<0 ){
                            echo "<br/>".$phpversion1.$phpVersion.$phpversion2;
                            return;
                        }

                        if( strnatcmp($attSize,'1M')<0 ){
                            echo "<br/>".$phpatt1.$attSize.$phpatt2;
                            return;
                        }

                        if( strnatcmp($space,'10M')<0 ){
                            echo "<br/>".$spacechk1.$space.$spacechk2;
                            return;
                        }
                        $lan = $_SESSION['lan'];
                        require_once "note_$lan.html";
                        ?>
                    </pre>

                    <button type="button" class="btn btn-info button" onclick="doSubmit(1)"><?=$begininst?></button>
                </div>
                <?
            }else if($_GET["step"]=="1" ){
                ?>

                <div class="main">
                    <form name="myform" id="myform" action="<?=$_SERVER['PHP_SELF']?>?step=3" method="POST">

                        <div class="col-lg-12"><label><?=$formdb?></label></div>
                        <div class="col-lg-12">
                            <div class="col-lg-2"><span><?=$formhost?></span></div><div class="col-lg-5"><input type="text" class="form-control" name="hostname" value="localhost"/></div><div class="col-lg-5"><?=$hosttip?></div>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-2"><span><?=$formdbname?></span></div><div class="col-lg-5"><input type="text"class="form-control"  name="dbname" value=""/></div><div class="col-lg-5"><?=$dbtip?></div>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-2"><span><?=$formuname?></span></div><div class="col-lg-5"><input type="text" class="form-control" name="username" value="root"/></div><div class="col-lg-5"> <?=$dbnametip?></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-2"><span><?=$formupwd?></span></div><div class="col-lg-5"><input type="text" class="form-control" name="password" value=""/></div><div class="col-lg-5"><?=$dbpwdtip?></div>
                        </div>


                        <div class="col-lg-12"><label><?=$formacctip?></label></div>

                        <div class="col-lg-12">
                            <div class="col-lg-2"><span><?=$formacc?></span></div><div class="col-lg-5"><input type="text" class="form-control" name="adminname" value="admin"/></div><div class="col-lg-5"></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-2"><span><?=$formaccpwd?></span></div><div class="col-lg-5"><input type="text" class="form-control" name="adminpwd" value=""/></div><div class="col-lg-5"><?=$accpwdtip?></div>
                        </div>
                        <input type="hidden" name="language" value="cn"/>

                        <input type="submit" class="btn btn-info button" value="<?=$inst?>"/>

                    </form>




                </div>
                <?
            }else if($_GET["step"]=="3" ){
                require_once "Installer.php";
                $hostname = $_POST["hostname"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                $dbname = $_POST["dbname"];
                $adminname = $_POST["adminname"];
                $adminpwd = md5($_POST["adminpwd"]);
                //$ihavedb = $_POST["ihavedb"];
                //$ihavedb = ($ihavedb=="on"||$ihavedb==true)?true:false;
                $ihavedb = true;

                //$lan = $_POST["language"];
                $lan = $_SESSION['lan'];
                $installer = new Installer($lan);

                $SCRIPT_NAME = $_SERVER['SCRIPT_NAME'];
                $POS = strpos($SCRIPT_NAME, 'install',0);
                $webroot = substr($SCRIPT_NAME,0,$POS-1);


                $ret = $installer->install($hostname, $username, $password, $dbname, $adminname, $adminpwd,$ihavedb,"bitword.sql",$webroot);

                $msgarr = $installer->msg;


                ?>

                <div class="main">
                    <div class="pact" readonly="readonly">
                        <?
                        if( !$ret ){
                            echo "<p> $errtip <br/></p>";
                            foreach ($msgarr as $msg){
                                echo "<p>$msg</p>";
                            }
                        }else{
                            echo $suctip;
                        }
                        ?>

                    </div>
                    <?
                    if( !$ret ){
                        ?>
                        <button type="button" class="btn btn-info button" onclick="window.history.back()"><?=$prestep?></button>
                        <?
                    }else{
                        ?>
                        <button type="button" class="btn btn-success button" onclick="doSubmit(4)"><?=$loginnow?></button>
                        <?
                    }
                    ?>





                </div>
                <?

            }else if($_GET["step"]=="4" ){
                
                
                $SCRIPT_NAME = $_SERVER['SCRIPT_NAME'];
                $POS = strpos($SCRIPT_NAME, 'install',0);
                $webroot = substr($SCRIPT_NAME,0,$POS-1);
                
                rename("../index.php","index.php");
                
                echo "<script language='javascript'>location.href=\"$webroot/Login!index\"</script>";
            }

            ?>


        </div>
    </body>

</html>