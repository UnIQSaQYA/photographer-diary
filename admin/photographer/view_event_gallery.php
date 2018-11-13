<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$events = $obj->viewEventGallery();
//var_dump($events[0]->event_id);
$eventId = Secure::decrypt(Input::get('id'));
var_dump($eventId);
require_once(ROOT . '/admin/includes/header.php');
require_once(ROOT . '/admin/includes/navbar.php');
require_once(ROOT . '/admin/includes/sidebar.php');
?>

<section id="main-content">
	<section class="wrapper">
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<section class="panel">
				<header class="panel-heading">
					Events
					<a href="<?= URL . 'admin/photographer/create_event_gallery.php?id=' .Secure::encrypt($eventId)?>" class="pull-right">Add Event</a>
					<!-- <?php if(is_array($events)){ ?> 
						<a href="<?= URL . 'admin/photographer/create_event_gallery.php?id=' .Secure::encrypt($events[0]->event_id)?>" class="pull-right">Add Event</a>
					<?php }else {?>
						<a href="<?= URL . 'admin/photographer/create_event_gallery.php?id=' .Secure::encrypt($events)?>" class="pull-right">Add Event</a>
					<?php } ?> -->
				</header>
				<table class="table table-striped table-advance table-hover">
					<thead>
						<tr>
							<th>Id</th>
							<th>Image</th>
							<th>caption</th>
							<th>Other</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($events)){ ?>
							<?php foreach($events as $event) {
								?>

								<tr>
									<td><?= escape($event->id);?></td>
									<td><img src="<?= ASSET . checkImage($event->image, 'event');?>" height="80px" width="80px"></td>
									<td><?= escape($event->caption);?></td>
									<td>
										<a href="<?= URL . 'admin/photographer/edit_event_gallery.php?id=' . Secure::encrypt($event->id)?>" class="btn btn-primary btn-xs" ><i class="icon-pencil"></i></a>
										<a href="<?= URL . 'admin/photographer/delete_event_gallery_modal.php?id=' . Secure::encrypt($event->id)?>" class="btn btn-danger btn-xs delete" data-target=".modal" data-url="" data-toggle="modal"><i class="icon-trash "></i></a>
									</td>
								</tr>
								<?php	
							}
							?>

						<?php }else{ ?> 
							<tr><td>Nothing to display</td></tr>
						<?php } ?>
					</tbody>
				</table>
			</section>
			<div class="text-center">
				<?= $obj->pagination; ?>
    		</div>

		</div>
	</section>
</section>

<div class="modal fade">
	
</div><!-- /.modal -->
<?php
require_once(ROOT . 'admin/includes/footer.php');
?>

