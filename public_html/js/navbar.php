<nav class="navbar navbar-default navbar-fixed-top primary-navbar" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Photographer Diary</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?= HTTP . 'photographer' ?>">Photographer</a></li>
				<li><a href="<?= HTTP . 'most_viewed.php'; ?>">Most Viewed</a></li>
				<li><a href="<?= HTTP . 'top_ten.php'; ?>">Top Ten</a></li>
				<li><a href="<?= HTTP . 'user/register'; ?>">Register</a></li>
				<li><a href="<?= HTTP . 'user/login'; ?>">Login</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->

	</div>
</nav>