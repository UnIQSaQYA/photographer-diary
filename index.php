<?php
require_once('core/init.php');
$image = new Home();
$background = $image->getBackgroundImage();
require_once(ROOT . 'includes/header.php');
?>

<style type="text/css">
	body{
		padding-top: 0px !important;
	}
</style>
<!-- Mobile Menu -->		
<div class="mobile-menu-overlay transition">
	<div class="mobile-menu">
		<i class="fa fa-times fa-2x"></i>
	</div>

</div>
<!-- /Mobile Menu -->

<!-- Content -->
<section class="content fullpage">

	<!-- Section One -->
	<section class="section" id="section1" style="background-image: url(<?= isset($background->image) ? ASSET. "image/background/".$background->image : "public_html/image/img.jpg"?>);">
		<div class="darker"></div>
		<div class="cover-titles">
			<div class="align-left">	
				<p>beautiful</p>		
				<h1 class="font-32" style="color: #ffffff;">Photographer's Diary</h1>
				<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary</p>	
				<a href="<?= URL . 'featured.php'?>" class="btn btn-primary">
					<i class="icon-eye-open"></i><span> Take a look</span>
					<i class="icon-right"></i>
				</a>
				<a href="<?= URL . 'user/login' ?>" class="btn btn-info"><i class="icon-lock"></i> Login</a>
				<a href="<?= URL . 'user/register' ?>" class="btn btn-warning"><i class="icon-user"></i> Register</a>							
			</div>
		</div>
	</section>
	<!-- /Section One -->
</section>