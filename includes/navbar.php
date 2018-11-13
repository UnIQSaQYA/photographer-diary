<div class="" style="background-color: #ffffff">
	<div class="container">
		<ul class="secondary-nav pull-left list-inline">
			<li role="presentation"><a href=""><i class=" icon-facebook-sign icon-2x"></i></a></li>
			<li role="presentation"><a href=""><i class=" icon-linkedin-sign icon-2x"></i></a></li>
			<li role="presentation"><a href=""><i class=" icon-twitter-sign icon-2x"></i></a></li>
		</ul>
		<div class="pull-right p-h-10">
			<a href="<?= URL . 'user/register'; ?>">Register </a><span>|</span>
			<a href="<?= URL . 'user/login'; ?>">Login</a>
		</div>
	</div>
	<nav class="navbar navbar-default primary-navbar" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?= URL . 'home' ?>"><img src="<?= ASSET . "image/pglogo.png" ?>" alt=""></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li <?php if (basename($_SERVER['PHP_SELF']) == 'featured.php') echo 'class="active"' ?>><a href="<?= URL . 'featured' ?>">Featured</a></li>
					<li <?php if (basename($_SERVER['PHP_SELF']) == 'photographer.php') echo 'class="active"' ?>><a href="<?= URL . 'photographer' ?>">Photographer</a></li>
					<li <?php if (basename($_SERVER['PHP_SELF']) == 'most_viewed.php') echo 'class="active"' ?>><a href="<?= URL . 'most_viewed.php'; ?>">Most Viewed</a></li>
					<li <?php if (basename($_SERVER['PHP_SELF']) == 'top_ten.php') echo 'class="active"' ?>><a href="<?= URL . 'top_ten.php'; ?>">Top Ten</a></li>
					
				</ul>
			</div><!-- /.navbar-collapse -->

		</div>
	</nav>
</div>