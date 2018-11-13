<?php
require_once('../../core/init.php');
require_once(ROOT . 'user/includes/header.php');
require_once(ROOT . 'user/includes/navbar.php');
$photographer = new Photographer();
$detail = $photographer->getPhotographerDetail();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$photographer = $photographer->createPhotographerDescription();
}
?>

<section id="main">
	<section class="container">
		<!-- page start-->
		<div class="row">
			<?php require_once(ROOT . 'user/includes/sidebar.php'); ?>
			<aside class="profile-info col-lg-9">
				<section class="panel">
					<header class="panel-heading">
						Edit Profile
					</header>
					<div class="panel-body">
						<div class="form">
							<form method="post" class="form-horizontal">
								<?php echo Token::inputToken(); ?>
								<div class="form-group <?php echo (hasError('description')?'has-error':''); ?>">
									<div class="col-sm-offset-1 col-sm-10">
										<textarea class="form-control ckeditor" name="description" rows="6"><?php echo $detail->description;?></textarea>
										<?= validationErrors('help-block', 'description'); ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										<button class="btn btn-success">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
			</aside>
		</div>
	</section>
</section>	

<?php
require_once(ROOT . 'user/includes/footer.php');
?>