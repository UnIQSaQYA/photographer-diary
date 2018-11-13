<?php
	require_once('../../core/init.php');
	require_once(ROOT . 'user/includes/header.php');
	require_once(ROOT . 'user/includes/navbar.php');
	$photographer = new Photographer();
	$detail = $photographer->getPhotographerDetail();
	if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
		$photographer = $photographer->createSocialLink();
	}
?>

<section id="main">
	<section class="container">
		<!-- page start-->
		<div class="row">
			<?php require_once(ROOT . 'user/includes/sidebar.php'); ?>
			<aside class="profile-info col-lg-9">
				<section class="panel">
					<header class="panel-heading">
					Edit Profile
					</header>
					<div class="panel-body">
						<div class="form">
								<form class="form-horizontal" role="form" method="post">
								<?php echo Token::inputToken(); ?>
								<div class="form-group <?php echo (hasError('facebook')?'has-error':''); ?>">
									<label for="Facebook" class="col-lg-4 col-sm-4 control-label text-align-right" >Facebook</label>
									<div class="col-lg-8">
										<input type="url" class="form-control" placeholder="Facebook" name="facebook" value="<?php echo $detail->facebook; ?>">
										<?= validationErrors('help-block', 'facebook'); ?>
									</div>
								</div>
								<div class="form-group <?php echo (hasError('twitter')?'has-error':''); ?>">
									<label for="Twitter" class="col-lg-4 col-sm-4 control-label text-align-right">Twitter</label>
									<div class="col-lg-8">
										<input type="url" class="form-control" placeholder="twitter" name="twitter" value="<?php echo $detail->twitter; ?>">
										<?= validationErrors('help-block', 'twitter'); ?>
									</div>
								</div>
								<div class="form-group <?php echo (hasError('instagram')?'has-error':''); ?>">
									<label for="instagram" class="col-lg-4 col-sm-4 control-label text-align-right">Instagram</label>
									<div class="col-lg-8">
										<input type="url" id="autocomplete" name="instagram" placeholder="Instagram" class="form-control" value="<?php echo $detail->instagram; ?>">
										<?= validationErrors('help-block', 'instagram'); ?>
									</div>		
								</div>
								<div class="form-group <?php echo (hasError('google')?'has-error':''); ?>">
									<label for="google" class="col-lg-4 col-sm-4 control-label text-align-right">Google Plus</label>
									<div class="col-lg-8">
										<input type="url" id="autocomplete" name="google" placeholder="Google +" class="form-control" value="<?php echo $detail->googleplus; ?>">
										<?= validationErrors('help-block', 'google'); ?>
									</div>		
								</div>
								<div class="form-group <?php echo (hasError('linkedin')?'has-error':''); ?>">
									<label for="linkedin" class="col-lg-4 col-sm-4 control-label text-align-right">Linkedin</label>
									<div class="col-lg-8">
										<input type="url" id="autocomplete" name="linkedin" placeholder="Linkedin" class="form-control" value="<?php echo $detail->linkedin; ?>">
										<?= validationErrors('help-block', 'linkedin'); ?>
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
				</section>
			</aside>
		</div>
	</section>
</section>	

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <form method="post" id="ajax_form" enctype="multipart/form-data">
      	<div class="modal-body">
      		<?php echo Token::inputToken(); ?>
      		<div class="form-group">
      			<label for="exampleInputFile">Portfolio</label>
      			<input type="file" name="portfolio" class="form-control">
      		</div>

      		<div class="row">
      			<div class="col-md-6">
      				<img src="img/gallery/2.jpg" id="demo3" alt="Jcrop Example" width="100%" />
      			</div>
      			<div class="col-md-6">
      				<div id="preview-pane">
      					<div class="preview-container">
      						<img src="img/gallery/2.jpg" class="jcrop-preview" alt="Preview"/>
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>
      	<div class="modal-footer">
      		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		<button type="submit" class="btn btn-primary" id="submit">Save changes</button>
      	</div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
	$('form#ajax_form').submit(function(e) {
		e.preventDefault();
		var baseUrl = window.location.origin;
	
		var sendData = {
            'do': 'insert_image',
            'test': 'img',
        }

		$.ajax({
			url: baseUrl + '/user/ajax.php',
			data: sendData,
			type: 'post',
			dataType: 'json',
			success: function(data) {
				alert(data);
			} 
		});
	});
</script>
<?php
	require_once(ROOT . 'user/includes/footer.php');
?>