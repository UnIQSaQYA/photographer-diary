<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$photographers = $obj->getAllPhotographer();
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
				</header>
				<table class="table table-striped table-advance table-hover">
					<thead>
						<tr>
							<th>Id</th>
							<th class="hidden-phone"></i> Name</th>
							<th>Gender </th>
							<th>Profile Pic</th>
							<th>Cover Pic</th>
							<th>Other</th>
						</tr>
					</thead>
					<tbody>
						<?php if(count($photographers) > 0){ ?>
							<?php foreach($photographers as $photographer) {
								?>

								<tr>
									<td><?= escape($photographer->id);?></td>
									<td><?= escape($photographer->first_name .' '. $photographer->last_name)?></td>
									<td><?php if(isset($photographer->gender)){?>
										<?= gender($photographer->gender);?></td>
									<?php }else{?>
										Not set
									<?php }?>
									<td><img src="<?= ASSET . checkImage($photographer->profile_pic, 'profile'); ?>" width="50px" height="50px"></td>
									<td><img src="<?= ASSET . checkImage($photographer->cover_pic, 'profile'); ?>" width="50px" height="50px"></td>
									<td>
										<a href="<?= URL . 'admin/photographer/view_about.php?id='. Secure::encrypt($photographer->id); ?>" class="btn btn-success btn-xs btnModal"><i class="icon-user" title="Add Event"></i></a>
										<a href="<?= URL . 'admin/photographer/view_event.php?id='. Secure::encrypt($photographer->id); ?>" class="btn btn-success btn-xs btnModal"><i class="icon-calendar" title="Add Event"></i></a>
										<a href="<?= URL . 'admin/photographer/view_portfolio.php?id=' . Secure::encrypt($photographer->id)?>" class="btn btn-danger btn-xs delete" class="btn btn-warning btn-xs" title="Add Portfolio"><i class="icon-picture"></i></a>
										<?php if($photographer->top_ten){?> 
										<a href="<?= URL . 'admin/photographer/edit_top_ten.php?id='. Secure::encrypt($photographer->top_ten); ?>" class="btn btn-default btn-xs" title="Top Ten"><i class="icon-star" style="color: yellow"></i></a>
										<?php }else{?>
										<a href="<?= URL . 'admin/photographer/create_top_ten.php?id='. Secure::encrypt($photographer->id); ?>" class="btn btn-default btn-xs" title="Top Ten"><i class="icon-star"></i></a>

										<?php }?>
										<a href="<?= URL . 'admin/photographer/edit_photographer.php?id=' . Secure::encrypt($photographer->id)?>" class="btn btn-primary btn-xs" title="Edit"><i class="icon-pencil"></i></a>
										<a href="<?= URL . 'admin/photographer/delete_modal.php?id=' . Secure::encrypt($photographer->id)?>" class="btn btn-danger btn-xs delete" data-target=".modal" data-url="" data-toggle="modal" title="delete"><i class="icon-trash "></i></a>
									</td>
								</tr>
								<?php	
							}
							?>
						<?php }else{ ?> 
							<tr>
								<td>Nothing to display</td>
							</tr>
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

