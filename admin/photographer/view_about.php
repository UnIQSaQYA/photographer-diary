<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$photographer = $obj->getAboutById();
$events = $obj->getAllEvent();
$portfolio = $obj->getAllGallery();
$tops = $obj->getAllTopTen();
$sn = (Pagination::$_current_page*Pagination::$_limit)-Pagination::$_limit;
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
					Photographers
					<?php if(is_object($photographer)): ?>
						<a href="<?= URL . 'admin/photographer/edit_about.php?id='. Secure::encrypt($photographer->id); ?>" class="pull-right">Edit</a>	
					<?php else: ?>
						<a href="<?= URL . 'admin/photographer/create_about.php?id='. Secure::encrypt($photographer); ?>" class="pull-right">Create</a>
					<?php endif ?>
					<a href="#" class="pull-right" data-target=".modal" data-toggle="modal">Delete</a>
				</header>
				<div class="panel-body">
					<?php if(is_object($photographer)): ?>
						<div class="panel">
							<p>Contact Number: <?php echo $photographer->contact_num ?></p>
							<p>Address: <?php echo $photographer->address ?></p>
							<p>Faceabook: 
							<?php if(!empty($photographer->facebook)) { ?>
								<a href="<?php echo $photographer->facebook ?>"><?php echo $photographer->facebook ?></a>
							<?php }else{ ?>
								Add Facebook Link
							<?php } ?></p>

							<p>Twitter: 
							<?php if(!empty($photographer->twitter)) { ?>
								<a href="<?php echo $photographer->twitter ?>"><?php echo $photographer->twitter ?></a>
							<?php }else{ ?>
								Add Twitter Link
							<?php } ?></p>

							<p>Google: 
							<?php if(!empty($photographer->google)) { ?>
								<a href="<?php echo $photographer->google ?>"><?php echo $photographer->google ?></a>
							<?php }else{ ?>
								Add Google Link
							<?php } ?></p>

							<p>Instagram: 
							<?php if(!empty($photographer->Instagram)) { ?>
								<a href="<?php echo $photographer->instagram ?>"><?php echo $photographer->instagram ?></a>
							<?php }else{ ?>
								Add instagram Link
							<?php } ?></p>

							<p>Linkedin: 
							<?php if(!empty($photographer->linkdein)) { ?>
								<a href="<?php echo $photographer->linkdein ?>"><?php echo $photographer->linkdein ?></a>
							<?php }else{ ?>
								Add Linkdein Link
							<?php } ?></p>
							<hr>
							Description
							<?php echo $photographer->detail ?>
						</div>
					<?php else: ?> 
						<tr>
							<td>Nothing to display</td>
						</tr>
					<?php endif ?>
				</div>
			</section>
			<div class="text-center">
				<?= $obj->pagination; ?>
    		</div>

		</div>
	</section>
</section>

<div class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Photographer</h4>
			</div>
			<div class="modal-body">
				<p>Are You sure you want to delete the photographer?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="<?= URL . 'admin/photographer/delete_about.php?id=' . Secure::encrypt($photographer->id) ?>" class="btn btn-primary del">Delete</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
require_once(ROOT . 'admin/includes/footer.php');
?>

