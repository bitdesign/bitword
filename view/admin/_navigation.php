 <script language="javascript" type="text/javascript">

    function doPublic(m){
        $.post("Admin!publishStaticIndex",{"method":m},
        function(data){
            if(data=="true"){
                alert("<?=$publishok?>");
                window.location.reload();
            }else alert(data);
            },"html"
        );
    }
</script>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">BIT Console</a>
    </div>
    <!-- Top Menu Items -->


    <ul class="nav navbar-nav navbar-right navbar-user">
        
       
        <li class="dropdown">
            <a onclick="doPublic(1);"><i class="fa fa-fw fa-share-square-o"></i> <?=$ttopublish?> </a>
        </li>
      
        <li class="dropdown">
            <a href="index.html" target="_blank"><i class="fa fa-fw fa-home"></i> <?=$thomepage?> </a>
        </li>
        <li class="dropdown">
            <a href="Login!logout" target="_self"><i class="fa fa-power-off"></i> <?=$tlogout?>&nbsp;&nbsp;</a>
            
        </li>
    </ul>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav" id="side-menu-nav">

            <li class="dropdown">
                <a href="Content!editPage"><i class="fa fa-fw fa-pencil"></i> <?=$taddarticle?> </a>
            </li>

            <li>
                <a href="content!listPage"><i class="fa fa-fw fa-list"></i> <?=$tcontents?></a>
            </li>


            <li>
                <a href="block!listPage"><i class="fa fa-fw fa-th-large"></i> <?=$tblock?></a>
            </li>
            <li>
                <a href="replies!listPage"><i class="fa fa-fw fa-comment"></i> <?=$treplies?></a>
            </li>
            
            <li>
				<a href="setting!settingPage"><i class="fa fa-fw fa-wrench"></i> <?=$tsetting?></a>
			</li>
			
			<li>
				<a href="admin!theme"><i class="fa fa-fw fa-desktop"></i> <?=$ttheme?></a>
			</li>
			
			<li>
				<a href="admin!data"><i class="fa fa-fw fa-database"></i> <?=$tdatamng?></a>
			</li>
			
			
			<li>
				<a href="admin!changePassWordPage"><i class="fa fa-fw fa-lock"></i> <?=$tpassword?></a>
			</li>
			

        </ul>
    </div>
    <!-- /.navbar-collapse -->

</nav>