<?php
require_once('../../core/init.php');
require_once(ROOT . '/admin/includes/header.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$gallery = $obj->getAllGallery();
$user_id = Secure::decrypt(Input::get('id'));

require_once(ROOT . '/admin/includes/navbar.php');
require_once(ROOT . '/admin/includes/sidebar.php');
?>

<section id="main-content">
	<section class="wrapper">
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<section class="panel">
				<header class="panel-heading">
					Portfolio
					<a href="<?= URL .'admin/photographer/create_gallery.php?id=' . Secure::encrypt($user_id)?>" class="pull-right">Add Portfolio</a>
					<!-- <?php if(is_array($gallery)) {?>
						<a href="<?= URL .'admin/photographer/create_gallery.php?id=' . Secure::encrypt($gallery[0]->user_id)?>" class="pull-right">Add Portfolio</a>
					<?php }else{ ?>
						<a href="<?= URL . 'admin/photographer/create_gallery.php?id=' .Secure::encrypt($gallery)?>" class="pull-right">Portfolio</a>
					<?php }?> -->
				</header>
				<table class="table table-striped table-advance table-hover">
					<thead>
						<tr>
							<th>Id</th>
							<th>Image</th>
							<th>Caption</th>
							<th>Other</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($gallery)){ ?> 
							<?php foreach($gallery as $data) {
								?>

								<tr>
									<td><?= escape($data->id);?></td>
									<td><img src="<?= ASSET . checkImage($data->photo, 'gallery')?>" height="50px" width="50px"></td>
									<td><?= escape($data->caption);?></td>
									<td>
										<a href="<?= URL . 'admin/photographer/edit_gallery.php?id=' . Secure::encrypt($data->id)?>" class="btn btn-primary btn-xs" ><i class="icon-pencil"></i></a>
										<a href="<?= URL . 'admin/photographer/delete_gallery_modal.php?id=' . Secure::encrypt($data->id)?>" class="btn btn-danger btn-xs delete" data-target=".modal" data-url="" data-toggle="modal"><i class="icon-trash "></i></a>
									</td>
								</tr>
								<?php	
							}
							?>
						
						<?php }else{ ?> 
							<tr  colspan="8"><td>Nothing to display</td></tr>
						<?php }?>
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

