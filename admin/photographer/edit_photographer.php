<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$photographer = $obj->getPhotographer();
$subcatObj = new subCategory();
$subcategorys = $subcatObj->getAllSubCategory();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {   
	$obj->editPhotographer();
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
					Edit Photographer
				</header>
				<div class="panel-body">
					<form role="form" method="post" enctype="multipart/form-data">
						<?php echo Token::inputToken(); ?>
						<div class="form-group col-lg-6 <?php echo (hasError('f_name')?'has-error':''); ?>" style="padding: 0px;">
							<label for="First Name" class="col-lg-12 control-label">First Name</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="f_name" placeholder="First Name" value="<?= escape($photographer->first_name); ?>">
								<?= validationErrors('help-block', 'f_name'); ?>
							</div>
						</div>

						<div class="form-group col-lg-6 <?php echo (hasError('l_name')?'has-error':''); ?>" style="padding: 0px;">
							<label for="Last Name" class="col-lg-12 control-label">Last Name</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="l_name" placeholder="Last Name" value="<?= escape($photographer->last_name); ?>">
								<?= validationErrors('help-block', 'l_name'); ?>
							</div>
						</div>

						<div class="form-group col-lg-6 <?php echo (hasError('slug')?'has-error':''); ?>" style="padding: 0px;">
							<label for="Slug" class="col-lg-12 control-label">Slug</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="slug" placeholder="Slug" value="<?= escape($photographer->slug); ?>">
								<?= validationErrors('help-block', 'slug'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('gender')?'has-error':''); ?>" style="padding: 0px;">
							<label for="Slug" class="col-lg-12 control-label">Gender</label>
							<div class="col-lg-12">
								<label class="checkbox-inline">
									<input type="checkbox" id="inlineCheckbox1" value="1" <?= (($photographer->gender = 1 ) ? "checked":'' )?> name="gender"> Male
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="inlineCheckbox2" value="0" <?= (($photographer->gender = 0) ? "checked":'') ?> name="gender"> Female
								</label>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-6 <?php echo (hasError('sub cat')?'has-error':''); ?>" style="padding: 0px;">
							<label for="sub cat" class="col-lg-12 control-label">Sub Category</label>
							<div class="col-lg-12">
								<select name="sub_cat" class="form-control">
									<?php foreach($subcategorys as $subcategory){ ?>
										<option value="<?= $subcategory->id; ?>" <?= (($photographer->subcategory_id =  $subcategory->id) ? "selected":'' )?>><?= $subcategory->subcategory_name ?> </option>
									<?php } ?>
								</select>
								<?= validationErrors('help-block', 'sub cat'); ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-6 <?php echo (hasError('profile')?'has-error':''); ?>" style="padding: 0px;">
							<label for="profile" class="col-lg-12 control-label">Profile Pic</label>
							<div class="col-lg-12">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<?php if(empty($photographer->profile_pic)){?> 
									<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
									</div>
									<?php }else{?>
										<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
										<img src="<?= ASSET . checkImage($photographer->profile_pic, 'profile') ?>" alt="" />
									</div>
									<?php }?>
									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
									<div>
										<span class="btn btn-white btn-file">
											<span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
											<span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
											<input type="file" name="profile" class="default" />
										</span>
										<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('cover')?'has-error':''); ?>" style="padding: 0px;">
							<label for="cover" class="col-lg-12 control-label">Cover Pic</label>
							<div class="col-lg-12">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<?php if(empty($photographer->cover_pic)){?> 
									<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
									</div>
									<?php }else{?>
									<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
										<img src="<?= ASSET . checkImage($photographer->cover_pic, 'profile') ?>" alt="" />
									</div>
									<?php }?>
									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
									<div>
										<span class="btn btn-white btn-file">
											<span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
											<span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
											<input type="file" name="cover" class="default" />
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
<?php
require_once(ROOT . '/admin/includes/footer.php');
?>
