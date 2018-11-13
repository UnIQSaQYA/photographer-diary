<?php
require_once('../../core/init.php');
require_once(ROOT . 'user/includes/header.php');
require_once(ROOT . 'user/includes/navbar.php');

$photographer = new Photographer();
$detail = $photographer->getPhotographerDetail();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$photographer = $photographer->createSocialLink();
}
Session::isLoggedIn();
?>
<section id="main">
	<section class="container">
		<!-- page start-->
		<div class="row">
			<?php require_once(ROOT . 'user/includes/sidebar.php');?>
			<aside class="profile-info col-lg-9">
				<section class="panel">
					<header class="panel-heading">
						Profile Detail

						<?php 
						if(isset($detail->facebook) && isset($detail->twitter) && isset($detail->instagram)&& isset($detail->googleplus)) {
							?>
							<a href="<?= HTTP . 'user/detail/edit_social.php' ?>" class="btn btn-success btn-sm pull-right">Edit</a>
							<?
						}
						?>
						<?php	
					}?>
				</header>
				<div class="panel-body bio-graph-info">
					<?php 
					if(!isset($detail->facebook) && !isset($detail->twitter) && !isset($detail->instagram)&& !isset($detail->googleplus)) {
						?>
						<div class="col-lg-8 col-lg-offset-1">
							<form class="form-horizontal" role="form" method="post">
								<?php echo Token::inputToken(); ?>
								<div class="form-group <?php echo (hasError('facebook')?'has-error':''); ?>">
									<label for="Facebook" class="col-lg-4 col-sm-4 control-label text-align-right" >Facebook</label>
									<div class="col-lg-8">
										<input type="url" class="form-control" placeholder="Facebook" name="facebook" value="">
										<?= validationErrors('help-block', 'facebook'); ?>
									</div>
								</div>
								<div class="form-group <?php echo (hasError('twitter')?'has-error':''); ?>">
									<label for="Twitter" class="col-lg-4 col-sm-4 control-label text-align-right">Twitter</label>
									<div class="col-lg-8">
										<input type="url" class="form-control" placeholder="twitter" name="twitter" value="">
										<?= validationErrors('help-block', 'twitter'); ?>
									</div>
								</div>
								<div class="form-group <?php echo (hasError('instagram')?'has-error':''); ?>">
									<label for="instagram" class="col-lg-4 col-sm-4 control-label text-align-right">Instagram</label>
									<div class="col-lg-8">
										<input type="url" id="autocomplete" name="instagram" placeholder="Instagram" class="form-control" value="">
										<?= validationErrors('help-block', 'instagram'); ?>
									</div>		
								</div>
								<div class="form-group <?php echo (hasError('google')?'has-error':''); ?>">
									<label for="google" class="col-lg-4 col-sm-4 control-label text-align-right">Google Plus</label>
									<div class="col-lg-8">
										<input type="url" id="autocomplete" name="google" placeholder="Google +" class="form-control" value="">
										<?= validationErrors('help-block', 'google'); ?>
									</div>		
								</div>
								<div class="form-group <?php echo (hasError('linkedin')?'has-error':''); ?>">
									<label for="linkedin" class="col-lg-4 col-sm-4 control-label text-align-right">Linkedin</label>
									<div class="col-lg-8">
										<input type="url" id="autocomplete" name="linkedin" placeholder="Linkedin" class="form-control" value="">
										<?= validationErrors('help-block', 'linkedin'); ?>
									</div>		
								</div>
								<div class="form-group">
									<div class="col-lg-offset-4 col-lg-8">
										<button type="submit" class="btn btn-danger">Save</button>
									</div>
								</div>
							</form>
						</div>
						<?php		
					} else {
						?>
						<div class="panel-body bio-graph-info">
							<div class="row">
								<div class="bio-row">
									<p><span>Facebook </span>: <a href="<?= escape($detail->facebook);?>"><?= escape($detail->facebook);?></a></p>
								</div>
								<div class="bio-row">
									<p><span>Instagram </span>: <a href="<?= escape($detail->instagram);?>"><?= escape($detail->instagram);?></a></p>
								</div>
								<div class="bio-row">
									<p><span>Twitter </span>: <a href="<?= escape($detail->twitter);?>"><?= escape($detail->twitter);?></a></p>
								</div>
								<div class="bio-row">
									<p><span>Linkedin </span>: <a href="<?= escape($detail->linkedin);?>"><?= escape($detail->linkedin);?></a></p>
								</div>
								<div class="bio-row">
									<p><span>Google plus </span>: <a href="<?= escape($detail->googleplus);?>"><?= escape($detail->googleplus);?></a></p>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</section>
		</aside>
	</div>
</section>
</section>
<?php
require_once(ROOT . 'user/includes/footer.php')
?>