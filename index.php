<!DOCTYPE html">
<html>
    <head>
        <title>install</title>
        <script type="text/javascript" src="view/public/js/jquery.js"></script>

        <script>

            $(function(){
				var type=navigator.appName;
				if (type=="Netscape"){
					var lang = navigator.language;
				}
				else{
					var lang = navigator.userLanguage;
				}
				
				var lang = lang.substr(0,2);
				
				
				if (lang == "zh"){
					window.location.href="install/install.php?lan=cn"
				}else{
				    window.location.href="install/install.php?lan=en"
				}
			});
			
        </script>

    </head>
    <body>
    </body>
</html>