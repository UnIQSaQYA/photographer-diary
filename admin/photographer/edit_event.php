<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$event = $obj->getEventById();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$obj->editEvent();
}
require_once(ROOT . '/admin/includes/header.php');
require_once(ROOT . '/admin/includes/navbar.php');
include(ROOT . '/admin/includes/sidebar.php');
?>
<section id="main-content">
	<section class="wrapper">
		<!--main content goes here-->
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<?php echo uploadErrors('alert alert-danger'); ?>
			<section class="panel">
				<header class="panel-heading">
					Add Event
				</header>
				<div class="panel-body">
					<form role="form" method="post" enctype="multipart/form-data">
						<?php echo Token::inputToken(); ?>
						<div class="form-group col-lg-6 <?php echo (hasError('name')?'has-error':''); ?>" style="padding: 0px;">
							<label for="Name" class="col-lg-12 control-label">Name</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="name" placeholder="Event Name" value="<?= $event->name ?>">
								<?= validationErrors('help-block', 'name'); ?>
							</div>
						</div>

						<div class="form-group col-lg-6 <?php echo (hasError('date')?'has-error':''); ?>" style="padding: 0px;">
							<label for="Event Date" class="col-lg-12 control-label">Date</label>
							<div class="col-lg-12">
								<input type="text" class="form-control input-medium default-date-picker" placeholder="Event Date" name="date" value="<?= $event->date ?>" >
								<?= validationErrors('help-block', 'date'); ?>
							</div>
						</div>

						<div class="form-group col-lg-6 <?php echo (hasError('venue')?'has-error':''); ?>" style="padding: 0px;">
							<label for="Event venue" class="col-lg-12 control-label">Venue</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="venue" placeholder="Event Venue" value="<?= $event->venue ?>">
								<?= validationErrors('help-block', 'venue'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('organize')?'has-error':''); ?>" style="padding: 0px;">
							<label for="organize by" class="col-lg-12 control-label">Organize By</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="organize" placeholder="Organize By" value="<?= $event->organize_by ?>">
								<?= validationErrors('help-block', 'organize'); ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-12 <?php echo (hasError('about')?'has-error':''); ?>" style="padding: 0px;">
							<label for="caption" class="col-lg-12 control-label">Description</label>
							<div class="col-lg-12">
								<textarea class="form-control ckeditor" name="about" rows="6" ><?= $event->description?></textarea>
								<?= validationErrors('help-block', 'about'); ?>
							</div>
						</div>
						<div class="form-group col-lg-12">
							<button type="submit" class="btn btn-danger">Edit</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</section>
</section>
<?php
require_once(ROOT . '/admin/includes/footer.php');

?>