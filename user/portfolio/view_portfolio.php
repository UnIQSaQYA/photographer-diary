<?php
	require_once('../../core/init.php');
	Session::isLoggedIn();

	$obj = new Portfolio();
	$gallerys = $obj->getAllGallery();
	require_once(ROOT . 'user/includes/header.php');
	require_once(ROOT . 'user/includes/navbar.php');
?>
<!--main content start-->
<section id="main">
	<section class="container">
		<!-- page start-->
		<div class="row">
			<?php require_once(ROOT . 'user/includes/sidebar.php');?>
			<aside class="profile-info col-lg-9">
				<section class="panel">
					<header class="panel-heading">
						Portfolio
					</header>
					<div class="panel-body bio-graph-info">
						<?php if(count($obj) > 0) { ?>
							<h4><a href="<?= URL .'user/portfolio/create_portfolio.php' ?>"><i class="icon-plus-sign"></i> Add Image</a></h4>
							<hr>
							<div class="grid cs-style-3">
							<?php foreach($gallerys as $data) { ?>
							<div class="col-md-4" style="padding-bottom: 10px">
								<div class="gallery">
									<img src="<?= ASSET . checkImage($data->photo, 'gallery'); ?>" alt="portfolio" class="image">
									<div class="overlay">
										<div class="text-center text">
											<p><?= $data->caption ?></p>
											<a href="<?= URL . 'user/portfolio/edit_portfolio.php?id=' .Secure::encrypt($data->id); ?>"><i class="icon-edit"></i> Edit</a>
											<a href="" class="delete" data-id="<?php echo Secure::encrypt($event->id)?>" data-target=".modal" data-toggle="modal" data-url="<?= URL . 'user/portfolio/delete.php?id='. Secure::encrypt($data->id) ?>" style="padding-left: 10px;"><i class="icon-trash"></i> Delete</a>
										</div>
									</div>
								</div>
							</div>
							<?php }?>
							</div>
							</div>
						<?php }else {?>
						<div class="form-signin" align="center">
							<i class="icon-bullhorn icon-5x icon"></i><p> Start Creating Events.. </p>
							<a href="<?= URL . 'user/event/create_portfolio.php'?>" class="btn btn-primary text-white">Create Event</a>
						</div>
						<?php }?>
					</div>
				</section>
			</aside>
		</div>
	</section>
</section>
<div class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Image</h4>
			</div>
			<div class="modal-body">
				<p>Are You sure you want to delete the Image?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="" class="btn btn-primary del">Delete</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$('.delete').click(function(){
		var id = $(this).data('id');
		var url = $(this).data('url');
		$('.modal').on('show.bs.modal', function (e) {
  			$('.del').attr('href', url);
  		});
	});
</script>
 <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
<?php
	require_once(ROOT . 'user/includes/footer.php');
?>