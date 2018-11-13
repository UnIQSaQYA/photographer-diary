<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$photographer = $obj->getAbout();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {   
	$obj->editAbout();
}
require_once(ROOT . '/admin/includes/header.php');
require_once(ROOT . '/admin/includes/navbar.php');
include(ROOT . '/admin/includes/sidebar.php');
?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!--main content goes here-->
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<?php echo uploadErrors('alert alert-danger'); ?>
			<section class="panel">
				<header class="panel-heading">
					Edit About
				</header>
				<div class="panel-body">
					<form role="form" method="post" enctype="multipart/form-data">
						<?php echo Token::inputToken(); ?>
						<div class="form-group col-lg-6 <?php echo (hasError('contact')?'has-error':''); ?>" style="padding: 0px;">
							<label for="contact" class="col-lg-12 control-label">Contact Number</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="contact" value="<?= $photographer->contact_num?>" placeholder="Contact Number">
								<?= validationErrors('help-block', 'contact'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('show')?'has-error':''); ?>" style="padding: 0px;">
							<label></label>
							<div class="col-lg-12">
								<input type="hidden" id="inlineCheckbox1" value="0" name="show">
								<input type="checkbox" id="inlineCheckbox1" value="1" <?php (($photographer->show_contact ==1) ?"checked" :"")?> name="show"> check this to show the number
								<?= validationErrors('help-block', 'show'); ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-6 <?php echo (hasError('address')?'has-error':''); ?>" style="padding: 0px;">
							<label for="address" class="col-lg-12 control-label">Address</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="address" placeholder="Address" value="<?= $photographer->address?>" id="autocomplete">
								<?= validationErrors('help-block', 'address'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('facebook')?'has-error':''); ?>" style="padding: 0px;">
							<label for="facebook" class="col-lg-12 control-label">Facebook</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="facebook" value="<?= $photographer->facebook?>" placeholder="Facebook">
								<?= validationErrors('help-block', 'facebook'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('twitter')?'has-error':''); ?>" style="padding: 0px;">
							<label for="twitter" class="col-lg-12 control-label">Twitter</label>
							<div class="col-lg-12">
								<input type="text" value="<?= $photographer->twitter ?>" class="form-control" name="twitter" placeholder="Twitter">
								<?= validationErrors('help-block', 'twitter'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('instagram')?'has-error':''); ?>" style="padding: 0px;">
							<label for="instagram" class="col-lg-12 control-label">Instagram</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" value="<?= $photographer->instagram ?>" name="instagram" placeholder="instagram">
								<?= validationErrors('help-block', 'instagram'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('google')?'has-error':''); ?>" style="padding: 0px;">
							<label for="google" class="col-lg-12 control-label">Google</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="google" placeholder="google" value="<?= $photographer->google ?>">
								<?= validationErrors('help-block', 'google'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('linkedin')?'has-error':''); ?>" style="padding: 0px;">
							<label for="linkedin" class="col-lg-12 control-label">Linkedin</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" value="<?= $photographer->linkedin ?>" name="linkedin" placeholder="Linkedin">
								<?= validationErrors('help-block', 'linkedin'); ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-12 <?php echo (hasError('about')?'has-error':''); ?>" style="padding: 0px;">
							<label for="about" class="col-lg-12 control-label">Description</label>
							<div class="col-lg-12">
								<textarea class="form-control ckeditor" name="about" rows="6" ><?= errorFields('about') ?><?= $photographer->detail ?></textarea>
								<?= validationErrors('help-block', 'about'); ?>
							</div>
						</div>
						<div class="form-group col-lg-12">
							<button type="submit" class="btn btn-danger">Add</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</section>
</section>
<script type="text/javascript" src="<?= ASSET . 'js/map.js'; ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtI-X7IIioctphmbcvDYXl8aEzKg8-Fcs&libraries=places&callback=initAutocomplete" async defer></script>
<?php
require_once(ROOT . '/admin/includes/footer.php');
?>
