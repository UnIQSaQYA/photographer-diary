<?php
	require_once('../../core/init.php');
	Session::isLoggedIn();
	$obj = new Portfolio();
	$type = $obj->getPhotographerType();
	$userType = $obj->getPhotographerUserType();
	if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
		$obj->createGallery();
	}

	require_once(ROOT . 'user/includes/header.php');
	require_once(ROOT . 'user/includes/navbar.php');
?>
<section id="main">
	<section class="container">
		<!-- page start-->
		<div class="row">
			<?php require_once(ROOT . 'user/includes/sidebar.php'); ?>
			   <div class="col-md-8">
                    <?php echo sessionDisplayMessage(); ?>
                    
                  </div>
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
									<div id="sections">
										<div class="section">
											<div class="form-clone">
												<div class="form-group <?php echo (hasError('caption')?'has-error':''); ?>">
													<label for="caption" class="col-lg-4 col-sm-4 control-label text-align-right">Caption</label>
													<div class="col-lg-8">
														<input type="text" name="caption[]" placeholder="Caption" class="form-control" value="">
														<?= validationErrors('help-block', 'caption'); ?>
														<p class="help-block">Caption For Picture.</p>
													</div>		
												</div>
												<div class="form-group">
													<label for="type" class="col-lg-4 col-sm-4 control-label text-align-right">Photographer Type</label>
													<div class="col-lg-8">
														<select name="type[]" class="form-control">
														<?php foreach ($type as $key): ?>
															<option value="<?php echo $key->id ?>"><?php echo $key->subcategory_name?></option>
													<?php endforeach ?>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label for="about" class="col-lg-4 col-sm-4 control-label text-align-right">Profile Pic: </label>
													<div class="col-lg-8">
														<div class="fileupload fileupload-new" data-provides="fileupload">
															<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
																	<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
															</div>
															<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
															<div>
																<span class="btn btn-white btn-file">
																	<span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
																	<span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
																	<input type="file" name="gallery[]" class="default" />
																</span>
																<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
															</div>
														</div>
													</div>
												</div>	
												<p><a href="#" class='remove'>Remove Section</a></p>	
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-4 col-lg-8">
											<a href="#" class='btn btn-success addsection'>Add Image</a>
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
<script type="text/javascript">
//define template
var template = $('#sections .section:first').clone();
var userType = '<?php echo($userType[0]->user_type) ?>';
//define counter
var sectionsCount = 1;

//add new section
$('body').on('click', '.addsection', function() {

	//increment
	sectionsCount++;
	//loop through each input
	var section = template.clone().find(':input').each(function(){
	
	//set id to store the updated section number
	var newId = this.id + sectionsCount;

	//update for label
	$(this).prev().attr('for', newId);
		//update id
		this.id = newId;
	}).end()

	//inject new section
	.appendTo('#sections');
		return false;
	});

	//remove section
	$('#sections').on('click', '.remove', function() {
	//fade out section
		$(this).parent().fadeOut(300, function(){
		//remove parent element (main section)
		$(this).parent().parent().empty();
		return false;
	});
return false;
});


</script>
 <?php 
 	require_once(ROOT . 'user/includes/footer.php');
 ?>