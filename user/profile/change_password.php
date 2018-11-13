<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$photographer = new Photographer();

if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$photographer->changePassword();
}	
require_once(ROOT . 'user/includes/header.php');
require_once(ROOT . 'user/includes/navbar.php');
?>
<section id="main">
	<section class="container">
		<!-- page start-->
		<div class="row">
			<?php require_once(ROOT . 'user/includes/sidebar.php') ?>
			<aside class="profile-info col-lg-9">
				<section class="panel">
					<header class="panel-heading">
						Change Password
					</header>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-8 col-lg-offset-1">
								<form class="form-horizontal" role="form" method="post">
									<?php echo Token::inputToken(); ?>
									<div class="form-group <?php echo (hasError('password')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Old Password: </label>
										<div class="col-lg-8">
											<input type="password" class="form-control" placeholder="Old Password" name="password">
											<?= validationErrors('help-block', 'password'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('newpassword')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >New Password: </label>
										<div class="col-lg-8">
											<input type="password" class="form-control" placeholder="New Password" name="newpassword">
											<?= validationErrors('help-block', 'newpassword'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('confirmpassword')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Confirm Password: </label>
										<div class="col-lg-8">
											<input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword">
											<?= validationErrors('help-block', 'confirmpassword'); ?>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-lg-offset-4 col-lg-8">
											<button type="submit" class="btn btn-danger">Change</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</section>
			</aside>
		</div>
	</section>
</section>

<script type="text/javascript" src="<?= ASSET . 'js/map.js'; ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtI-X7IIioctphmbcvDYXl8aEzKg8-Fcs&libraries=places&callback=initAutocomplete" async defer></script>
<?php 
require_once(ROOT . 'user/includes/footer.php');
?>