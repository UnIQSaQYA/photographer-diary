<?php
	require_once('../../core/init.php');
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
					<div class="panel-heading">
						Portfolio
					</div>
					<div class="panel-body">
						<h5><a href="" data-toggle="modal" data-target="#myModal"><i class=" icon-plus-sign-alt"></i> Add Picture for Portfolio</a></h5>
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