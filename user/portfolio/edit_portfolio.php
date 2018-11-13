<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new Portfolio();
$gallery = $obj->getGallery();
$type = $obj->getPhotographerType();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$obj->editGallery();
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
						Create Portfolio
					</header>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-8 col-lg-offset-1">
								<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
									<?php echo Token::inputToken(); ?>
									<div class="form-group <?php echo (hasError('caption')?'has-error':''); ?>">
										<label for="caption" class="col-lg-4 col-sm-4 control-label text-align-right">Caption</label>
										<div class="col-lg-8">
											<input type="text" name="caption" placeholder="Caption" class="form-control" value="<?= $gallery->caption?>">
											<?= validationErrors('help-block', 'caption'); ?>
											<p class="help-block">Caption For Picture.</p>
										</div>		
									</div>
									<div class="form-group">
										<label for="type" class="col-lg-4 col-sm-4 control-label text-align-right">Photographer Type</label>
										<div class="col-lg-8">
											<select name="type[]" class="form-control">
												<?php foreach ($type as $key): ?>
													<option value="<?php echo $key->id ?>" <?= (($key->id == $gallery->type) ? "selected" : "") ?>><?php echo $key->subcategory_name?></option>
												<?php endforeach ?>
											</select>
										</div>	
									</div>
									<div class="form-group">
										<label for="about" class="col-lg-4 col-sm-4 control-label text-align-right">Profile Pic: </label>
										<div class="col-lg-8">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
													<?php if(empty($gallery->photo)){ ?>
													<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />

													<?php }else{ ?>
													<img src="<?= ASSET .'image/gallery/'. $gallery->photo ?>">
													<?php }?>
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
												<div>
													<span class="btn btn-white btn-file">
														<span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
														<span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
														<input type="file" name="gallery" class="default" />
													</span>
													<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
												</div>
											</div>
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
</script>
<?php 
require_once(ROOT . 'user/includes/footer.php');
?>