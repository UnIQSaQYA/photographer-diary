<?php
	require_once('../../core/init.php');
	Session::isLoggedIn();
	$event = new Event();
	$events = $event->getEvent();
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
				<?php echo sessionDisplayMessage(); ?>
				<section class="panel">
					<header class="panel-heading">
						Event Detail
					</header>
					<div class="panel-body bio-graph-info">
						<?php if(count($events) > 0) { ?>
							<h4><a href="<?= URL .'user/event/create_event.php' ?>"><i class="icon-plus-sign"></i> Create Event</a></h4>
							<hr>
							<?php foreach($events as $event) { ?>
								<div class="media">
									<div class="pull-left">
										<a href="">
											<img src="<?= ASSET . checkImage($event->image, 'event'); ?>" class="meddia-object" width="100px;" height="100px;">
										</a>
									</div>
									<div class="media-body">
										<ul>
											<li>Name: <a href="<?= URL . 'user/event/event_detail.php?id='. Secure::encrypt($event->id) ?>"><?php echo $event->name; ?></a>
											<span class="pull-right">
											<a href="<?= URL . 'user/event/add_event_image.php?id='. Secure::encrypt($event->id) ?>"  class="p-r-10"><i class="icon-picture"></i> Add Image</a>
											<a href="<?= URL . 'user/event/edit_event.php?id='. Secure::encrypt($event->id) ?>" class="p-r-10"><i class="icon-pencil"></i> Edit</a>
											 <a href="" class="delete" data-id="<?php echo Secure::encrypt($event->id)?>" data-target=".modal" data-toggle="modal" data-url="<?= URL . 'user/event/delete.php?id='. Secure::encrypt($event->id) ?>"><i class="icon-trash"></i> Delete</a></span>
											</li>
											<?php if(!empty($event->venue)){ ?>
												<li>Venue: <?php echo $event->venue; ?></li>
											<?php } ?>
											<?php if(!empty($event->organize_by)){ ?>
												<li>Organized by: <?php echo $event->organize_by; ?></li>
											<?php } ?>
											<?php if(!empty($event->date)){ ?>
												<li>Date: <?php echo $event->date; ?></li>
											<?php } ?>
											<li><a href="" class="btn btn-primary btn-xs">View Image</a></li>
										</ul>
									</div>
								</div>
							<?php }?>
							</div>
						<?php }else {?>
						<div class="form-signin" align="center">
							<i class="icon-bullhorn icon-5x icon"></i><p> Start Creating Events.. </p>
							<a href="<?= URL . 'user/event/create_event.php'?>" class="btn btn-primary text-white">Create Event</a>
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
				<h4 class="modal-title">Delete Event</h4>
			</div>
			<div class="modal-body">
				<p>Are You sure you want to delete the event?</p>
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
<?php
	require_once(ROOT . 'user/includes/footer.php');
?>