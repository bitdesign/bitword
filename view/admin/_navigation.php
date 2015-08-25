 <script language="javascript" type="text/javascript">

    function doPublic(m){
        $.post("Admin!publishStaticIndex",{"method":m},
        function(data){
            if(data=="true"){
                alert("<?=$tsuccess?>");
               // alert("<?=$publishok?>");
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
        <a class="navbar-brand" href="index.html" target="_blank">BIT Console</a>
    </div>
    <!-- Top Menu Items -->


    <ul class="nav navbar-nav navbar-right navbar-user">
        <!--
        <li class="dropdown">
            <a href="admin!dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        -->
        <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			    <i class="fa fa-user"></i> <?=$_SESSION['loginuser']['usr_rnm']?> <b class="caret"></b>&nbsp;&nbsp;</a>
			<ul class="dropdown-menu">
				<li>
					<a href="admin!changePassWordPage"><i class="fa fa-fw fa-lock"></i>&nbsp;<?=$tpassword?></a>
				</li>
				<li>
					<a href="Login!logout" target="_self"><i class="fa fa-power-off"></i>&nbsp; <?=$tlogout?></a>
				</li>
				<li class="divider"></li>
				<li>
    				<a href="admin!theme"><i class="fa fa-fw fa-desktop"></i> <?=$ttheme?></a>
    			</li>
    			<li>
                    <a href="replies!listPage"><i class="fa fa-fw fa-comment"></i> <?=$treplies?></a>
                </li>
			</ul>
		</li>
		
   
    </ul>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav" id="side-menu-nav">
            
            
            <li>
                 <a href="admin!dashboard"><i class="fa fa-fw fa-dashboard"></i> <?=$stat_info?></a>
            </li>
            
            <li>
                <a href="Content!editPage"><i class="fa fa-fw fa-pencil"></i> <?=$taddarticle?> </a>
            </li>

            <li>
                <a href="content!listPage"><i class="fa fa-fw fa-list"></i> <?=$tcontents?></a>
            </li>

            <li>
				<a href="feed!listnews"><i class="fa fa-fw fa-rss"></i> <?=$feed_news?></a>
			</li>
            <li>
                <a href="block!listPage"><i class="fa fa-fw fa-th-large"></i> <?=$tblock?></a>
            </li>
           
            
            <li>
				<a href="setting!settingPage"><i class="fa fa-fw fa-wrench"></i> <?=$tsetting?></a>
			</li>
			
			<li>
				<a href="admin!data"><i class="fa fa-fw fa-database"></i> <?=$tdatamng?></a>
			</li>
			<li>
				<a href="feed!listPage"><i class="fa fa-fw fa-rss"></i> <?=$feed_list?></a>
			</li>
			
			
        </ul>
    </div>
    <!-- /.navbar-collapse -->

</nav>