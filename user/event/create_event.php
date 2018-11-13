<?php
	require_once('../../core/init.php');
	Session::isLoggedIn();
	$event = new Event();
	if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
		$event->createEvent();
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
				<?=uploadErrors('alert alert-danger');?>
				<section class="panel">
					<header class="panel-heading">
						Create Event
					</header>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-8 col-lg-offset-1">
								<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
									<?php echo Token::inputToken(); ?>
									<div class="form-group <?php echo (hasError('name')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Name: </label>
										<div class="col-lg-8">
											<input type="text" class="form-control" placeholder="Event Name" name="name" value="<?= escape(Input::get('name')) ?>">
											<?= validationErrors('help-block', 'name'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('date')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Date: </label>
										<div class="col-lg-8">
											<input type="text" class="form-control input-medium default-date-picker" placeholder="Event Date" name="date" value="<?= escape(Input::get('date')) ?>">
											<?= validationErrors('help-block', 'date'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('venue')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Venue: </label>
										<div class="col-lg-8">
											<input type="text" class="form-control" placeholder="Event Venue" name="venue" value="<?= escape(Input::get('venue')) ?>">
											<?= validationErrors('help-block', 'venue'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('organized')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Organized by: </label>
										<div class="col-lg-8">
											<input type="text" class="form-control" placeholder="Event organized by" name="organized" value="<?= escape(Input::get('organized')) ?>">
											<?= validationErrors('help-block', 'organized'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('about')?'has-error':''); ?>">
										<label for="about" class="col-lg-4 col-sm-4 control-label text-align-right">Details: </label>
										<div class="col-lg-8">
											<textarea class="form-control ckeditor" name="about" rows="6" ><?= escape(Input::get('about')) ?></textarea>
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

<?php
	require_once(ROOT . 'user/includes/footer.php');
?>