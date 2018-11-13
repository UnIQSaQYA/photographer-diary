<?php
	$user = new User();
	$userDetail = $user->getUserDetail();
?>
<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Photographer's Diary</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-profile">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo Session::get('username'); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu dropdown-profile-card" role="menu" aria-labelledby="dropdownMenu1">
						<li class="p-l-20">
							<div class="media">
								<div class="pull-left media-middle">
									<a href="#">
									<img class="media-object dropdown-profile-img" src="<?= ASSET . checkImage($userDetail->profile_pic, 'profile'); ?>" alt="...">
									</a>
								</div>
								<div class="media-body">
									<span class="media-heading"><a href=""><?php echo Session::get('username'); ?></a></span>
									<p class="text-muted"><?php echo Session::get('email'); ?></p>
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li><a href=""><i class="icon-edit"></i> Edit Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?= URL . "user/profile/change_password.php"?>"><i class="icon-unlock-alt"></i> Change Password</a></li>
						<li class="divider"></li>
						<li><a href="<?= URL."user/logout.php";?>"><i class="icon-signout"></i> logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>