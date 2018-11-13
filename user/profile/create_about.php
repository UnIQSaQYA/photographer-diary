<?php
	require_once('../../core/init.php');
	Session::isLoggedIn();
	$photographer = new Photographer();
	if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
		$photographer->createAbout();
	}
	require_once(ROOT . 'user/includes/header.php');
	require_once(ROOT . 'user/includes/navbar.php');
?>

<section id="main">
	<section class="container">
		<!-- page start-->
		<div class="row">
			<?php require_once(ROOT . 'user/includes/sidebar.php'); ?>
			<aside class="profile-info col-lg-9">
				<section class="panel">
					<header class="panel-heading">
						Create About
					</header>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-8 col-lg-offset-1">
								<form class="form-horizontal" role="form" method="post">
									<?php echo Token::inputToken(); ?>
									<div class="form-group <?php echo (hasError('number')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Contact Number: </label>
										<div class="col-lg-8">
											<input type="text" class="form-control" placeholder="Contact Number" name="number" value="<?= escape(Input::get('number')) ?>">
											<?= validationErrors('help-block', 'number'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('show')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" ></label>
										<div class="col-lg-8">
											<label class="checkbox-inline">
												<input type="checkbox" id="inlineCheckbox1" value="1" name="show"> check this to show the number
											</label>
											<?= validationErrors('help-block', 'show'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('address')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Address: </label>
										<div class="col-lg-8">
											<input type="text" class="form-control" placeholder="Address" name="address" value="<?= errorFields('address') ?>" id="autocomplete">
											<?= validationErrors('help-block', 'address'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('facebook')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Facebook: </label>
										<div class="col-lg-8">
											<input type="url" class="form-control" placeholder="Facebook Url" name="facebook" value="<?= errorFields('facebook') ?>">
											<?= validationErrors('help-block', 'facebook'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('linkedin')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Linkedin: </label>
										<div class="col-lg-8">
											<input type="url" class="form-control" placeholder="Linkedin Url" name="linkedin" value="<?= errorFields('linkedin') ?>">
											<?= validationErrors('help-block', 'linkedin'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('twitter')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Twitter: </label>
										<div class="col-lg-8">
											<input type="url" class="form-control" placeholder="Twitter Url" name="twitter" value="<?= errorFields('twitter') ?>">
											<?= validationErrors('help-block', 'twitter'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('instagram')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Instagram: </label>
										<div class="col-lg-8">
											<input type="url" class="form-control" placeholder="Instagram Url" name="instagram" value="<?= errorFields('instagram') ?>">
											<?= validationErrors('help-block', 'instagram'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('google')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Google: </label>
										<div class="col-lg-8">
											<input type="url" class="form-control" placeholder="Google Url" name="google" value="<?= errorFields('google') ?>">
											<?= validationErrors('help-block', 'google'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('about')?'has-error':''); ?>">
										<label for="about" class="col-lg-4 col-sm-4 control-label text-align-right">About: </label>
										<div class="col-lg-8">
											<textarea class="form-control ckeditor" name="about" rows="6" ><?= errorFields('about') ?></textarea>
											<?= validationErrors('help-block', 'about'); ?>
										</div>
									</div>	
									<div class="form-group">
										<div class="col-lg-offset-4 col-lg-8">
											<button type="submit" class="btn btn-danger">Save</button>
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