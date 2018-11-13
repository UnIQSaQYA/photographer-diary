<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$event = $obj->viewEventGalleryById();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$obj->editEventImage();
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
					Edit Event Image
				</header>
				<div class="panel-body">
					<form role="form" method="post" enctype="multipart/form-data">
						<?php echo Token::inputToken(); ?>
						<div id="sections">
							<div class="section">
								<div class="form-clone">
									<div class="form-group col-lg-6 <?php echo (hasError('profile')?'has-error':''); ?>" style="padding: 0px;">
										<label for="profile" class="col-lg-12 control-label">Event Pic</label>
										<div class="col-lg-12">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
													<?php if(!empty($event->image)) { ?>
											
														<img src="<?= ASSET . checkImage($event->image, 'event'); ?>" alt="" />
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
									<div class="form-group col-lg-6 <?php echo (hasError('cover')?'has-error':''); ?>" style="padding: 0px;">
										<label for="Event cover" class="col-lg-12 control-label">cover</label>
										<div class="col-lg-12">
											<input type="checkbox" class="check" <?= (($event->is_cover == 1) ? "checked": "")?> name="cover"> Set as Cover
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-group col-lg-6 <?php echo (hasError('caption')?'has-error':''); ?>" style="padding: 0px;">
										<label for="Event Caption" class="col-lg-12 control-label">Caption</label>
										<div class="col-lg-12">
											<input type="text" class="form-control" value="<?= $event->caption ?>" name="caption" placeholder="Event caption">
											<?= validationErrors('help-block', 'caption'); ?>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="form-group col-lg-12">
							<button type="submit" class="btn btn-danger">Save</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</section>
</section>
<script type="text/javascript">
$('form').submit(function () {
    $(this).find('input[type="checkbox"]').each( function () {
        var checkbox = $(this);
        if( checkbox.is(':checked')) {
            checkbox.attr('value','1');
        } else {
            checkbox.after().append(checkbox.clone().attr({type:'hidden', value:0}));
            checkbox.prop('disabled', true);
        }
    })
});
</script>
<?php
require_once(ROOT . '/admin/includes/footer.php');

?>