<?php
	require_once('../../core/init.php');
	Session::isLoggedIn();
	$event = new Event();
	$obj = $event->getEventGalleryById();
	if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
		$event->editEventImage();
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
				<?= sessionDisplayMessage(); ?>
				<?= uploadErrors('alert alert-danger');?>
				<section class="panel">
					<header class="panel-heading">
						Create Event
					</header>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-8 col-lg-offset-1">
								<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
									<?php echo Token::inputToken(); ?>
									<div class="form-group">
										<label for="about" class="col-lg-4 col-sm-4 control-label text-align-right">Event Image: </label>
										<div class="col-lg-8">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
													<?php if(!empty($obj->image)) { ?>
														<img src="<?= ASSET . checkImage($obj->image, 'event'); ?>" alt="" />
													<?php }else{ ?>
														<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
													<?php }?>

												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
												<div>
													<span class="btn btn-white btn-file">
														<span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
														<span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
														<input type="file" name="image" class="default" />
													</span>
													<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
												</div>
											</div>
										</div>
									</div>		
									<div class="form-group <?php echo (hasError('caption')?'has-error':''); ?>">
										<label for="" class="col-lg-4 col-sm-4 control-label text-align-right" >Caption: </label>
										<div class="col-lg-8">
											<input type="text" class="form-control" placeholder="caption" name="caption" value="<?= escape($obj->caption); ?>">
											<?= validationErrors('help-block', 'caption'); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label text-align-right col-lg-4" for="inputSuccess"></label>
										<div class="col-lg-8">
											<label class="checkbox-inline">
												<input type="checkbox" id="inlineCheckbox1" value="1" name="cover" <?= (($obj->is_cover == 1) ? "checked": "")?>> Set as Cover
											</label>
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