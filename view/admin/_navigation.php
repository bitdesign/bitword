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
	<ul class="nav navbar-right top-nav" >
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['loginuser']['usr_nm']?> <b class="caret"></b></a>
			<ul class="dropdown-menu">
				
				<li>
					<a href="Content!editPage"><i class="fa fa-fw fa-pencil"></i> <?=$taddarticle[$lan]?></a>
				</li>
				<li>
					<a href="index.html" target="_blank"><i class="fa fa-fw fa-home"></i> <?=$thomepage[$lan]?></a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="admin!changePassWordPage"><i class="fa fa-fw fa-lock"></i> <?=$tpassword[$lan]?></a>
				</li>
				<li>
					<a href="Login!logout" target="_self"><i class="fa fa-fw fa-power-off"></i> <?=$tlogout[$lan]?></a>
				</li>
				
			</ul>
		</li>
	</ul>

	<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
	
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav side-nav" id="side-menu-nav">
			<li>
				<a href="admin!dashboard"><i class="fa fa-fw fa-dashboard"></i> <?=$statistics[$lan]?></a>
			</li>
			<li>
				<a href="block!listPage"><i class="fa fa-fw fa-th-large"></i> <?=$tblock[$lan]?></a>
			</li>
			<li>
				<a href="content!listPage"><i class="fa fa-fw fa-list"></i> <?=$tcontents[$lan]?></a>
			</li>
			<li>
				<a href="replies!listPage"><i class="fa fa-fw fa-comment"></i> <?=$treplies[$lan]?></a>
			</li>
			<li>
				<a href="admin!theme"><i class="fa fa-fw fa-desktop"></i> <?=$ttheme[$lan]?></a>
			</li>
			<li>
				<a href="setting!settingPage"><i class="fa fa-fw fa-wrench"></i> <?=$tsetting[$lan]?></a>
			</li>
			
			<li>
				<a href="admin!data"><i class="fa fa-fw fa-database"></i> <?=$tdatamng[$lan]?></a>
			</li>
		</ul>
	</div>
	<!-- /.navbar-collapse -->
	
</nav>