<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$user = new User();
$userDetail = $user->getUserDetail();
$subcategories = $user->getAllSubCategory();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$user->editProfile();
}	
require_once(ROOT . 'user/includes/header.php');
require_once(ROOT . 'user/includes/navbar.php');
?>
<section id="main">
	<section class="container">
		<!-- page start-->
		<div class="row">
			<?php include_once(ROOT . 'user/includes/sidebar.php'); ?>
			<aside class="profile-info col-lg-9">
				<!-- start of panel -->
				<section class="panel">
					<header class="panel-heading">
						Edit Profile
					</header>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-8 col-lg-offset-1">
								<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
									<?php echo Token::inputToken(); ?>
									<div class="form-group <?php echo (hasError('f_name')?'has-error':''); ?>">
										<label for="First Name" class="col-lg-4 col-sm-4 control-label text-align-right" >First Name</label>
										<div class="col-lg-8">
											<input type="text" class="form-control" placeholder="First Name" name="f_name" value="<?= escape($userDetail->first_name);?>">
											<?= validationErrors('help-block', 'f_name'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('l_name')?'has-error':''); ?>">
										<label for="Last Name" class="col-lg-4 col-sm-4 control-label text-align-right">Last Name</label>
										<div class="col-lg-8">
											<input type="text" class="form-control" placeholder="Last Name" name="l_name" value="<?= escape($userDetail->last_name);?>">
											<?= validationErrors('help-block', 'l_name'); ?>
										</div>
									</div>
									<div class="form-group <?php echo (hasError('subcategory')?'has-error':''); ?>">
										<label for="Category" class="col-lg-4 col-sm-4 control-label text-align-right">Select Category</label>
										<div class="col-lg-8">
											<select class="form-control" name="subcategory">
												<option value="">Choose a Subcategory</option>
												<?php foreach($subcategories as $subcategory){
												?>
													<option <?= ($subcategory->id == $userDetail->subcategory_id) ?'selected': '' ?> value="<?php echo $subcategory->id; ?>"><?php echo $subcategory->subcategory_name; ?></option>
												<?php
												}?>
											</select>
											<?= validationErrors('help-block', 'subcategory'); ?>
										</div>		
									</div>
									<div class="form-group <?php echo (hasError('slug')?'has-error':''); ?>">
										<label for="address" class="col-lg-4 col-sm-4 control-label text-align-right">Slug</label>
										<div class="col-lg-8">
											<input type="text" name="slug" placeholder="Slug" class="form-control" value="<?= escape($userDetail->slug);?>">
											<?= validationErrors('help-block', 'slug'); ?>
										</div>		
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label text-align-right col-lg-4" for="inputSuccess">Gender</label>
										<div class="col-lg-8">
											<label class="checkbox-inline">
												<input type="checkbox" id="inlineCheckbox1" value="1" <?php echo (($userDetail->gender == 1) ? "checked" : ""); ?> name="gender"> Male
											</label>
											<label class="checkbox-inline">
												<input type="checkbox" id="inlineCheckbox2" value="2" <?php echo (($userDetail->gender == 2) ? "checked" : ""); ?> name="gender"> Female
											</label>
										</div>
									</div>
									<div class="form-group">
										<label for="about" class="col-lg-4 col-sm-4 control-label text-align-right">Profile Pic: </label>
										<div class="col-lg-8">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
													<?php if(empty($userDetail->profile_pic)){ ?>
														<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />

													<?php }else{ ?>
														<img src="<?= ASSET .'image/portfolio/'. $userDetail->profile_pic ?>">
													<?php }?>
												</div>
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
									<div class="form-group">
										<label for="about" class="col-lg-4 col-sm-4 control-label text-align-right">Cover Pic: </label>
										<div class="col-lg-8">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
													<?php if(empty($userDetail->cover_pic)){ ?>
														<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />

													<?php }else{ ?>
														<img src="<?= ASSET .'image/portfolio/'. $userDetail->cover_pic ?>">
													<?php }?>
												</div>
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
				<!-- end of panel -->
			</aside>			
		</div>
	</section>
</section>
<div class="modal fade">
 
</div><!-- /.modal -->       
 
<script class="text/javascript">
 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#img").change(function(){
        readURL(this);
    });
</script>
<script type="text/javascript">
	function PreviewImage(no) {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("uploadImage" + no).files[0]);
		oFReader.onload = function(oFREvent) {
			document.getElementById("uploadPreview" + no).src = oFREvent.target.result;
		};
	}
 //Image crop
//Plugin: https://github.com/fengyuanchen/cropper/blob/master/README.md
$('#uploadPreview1').on('click', function() {
	$(".img-container > img").cropper({
		aspectRatio: 1 / 1,
		crop: function(data) {
			$("#dataX").val(Math.round(data.x));
			$("#dataY").val(Math.round(data.y));
			$("#dataHeight").val(Math.round(data.height));
			$("#dataWidth").val(Math.round(data.width));
			$("#dataRotate").val(Math.round(data.rotate));
		}
	});
});
</script>
<script type="text/javascript" src="<?= ASSET . 'js/map.js' ?>"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvAP2jDlEH_Eo-DJMht3n_pRR-2Nkj3-I&libraries=places"></script>
<?php
require_once(ROOT . 'user/includes/footer.php');
?>