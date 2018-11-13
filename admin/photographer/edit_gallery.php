<?php
	require_once('../../core/init.php');
	Session::isLoggedIn();
	$obj = new photographerInfo();
	$gallery = $obj->getGalleryById();
	if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
		$obj->editGallery();
	}
	$type = $obj->getPhotographerType();
	require_once(ROOT . 'admin/includes/header.php');
	require_once(ROOT . '/admin/includes/navbar.php');
	include(ROOT . '/admin/includes/sidebar.php');
?>
<section id="main-content">
	<section class="wrapper">
		<!--main content goes here-->
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<section class="panel">
				<header class="panel-heading">
					Add Category
				</header>
				<div class="panel-body">
					<form role="form" method="post" enctype="multipart/form-data">
						<?php echo Token::inputToken(); ?>
						<div class="form-group col-lg-6 <?php echo (hasError('caption')?'has-error':''); ?>" style="padding: 0px;" >
							<label for="Caption" class="col-lg-12 control-label">Caption</label>
							<div class="col-lg-12">
							<input type="text" class="form-control" name="caption" placeholder="Caption" value="<?= $gallery->caption ?>">
								<?= validationErrors('help-block', 'caption'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6">
									<label for="type" class="col-lg-4 col-sm-4 control-label text-align-right">Photographer Type</label>
									<div class="col-lg-12">
										<select name="type[]" class="form-control">
												<?php foreach ($type as $key): ?>
													<option value="<?php echo $key->id ?>" <?= (($key->id == $gallery->type) ? "selected" : "") ?>><?php echo $key->subcategory_name?></option>
												<?php endforeach ?>
											</select>
									</div>
								</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-6 <?php echo (hasError('profile')?'has-error':''); ?>" style="padding: 0px;">
							<label for="profile" class="col-lg-12 control-label">Event Pic</label>
							<div class="col-lg-12">
								<?php if(empty($gallery->photo)){ ?> 
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
									</div>
								<?php }else{ ?>
								 <div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
										<img src="<?= ASSET . checkImage($gallery->photo, 'gallery');?>" alt="" />
									</div>
								<?php }?>
									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
									<div>
										<span class="btn btn-white btn-file">
											<span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
											<span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
											<input type="file" name="event_image" class="default" />
										</span>
										<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-12">
							<button type="submit" class="btn btn-danger">Edit</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</section>
</section>
</script>
 <?php 
 	require_once(ROOT . 'admin/includes/footer.php');
 ?>