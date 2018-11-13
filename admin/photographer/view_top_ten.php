<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
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
							<th>Photographer </th>
							<th>Order</th>
							<th>Created_at</th>
							<th>Order By</th>
						</tr>
					</thead>
					<tbody>
						<?php if(count($tops) > 0){ ?> 
							<?php foreach($tops as $data) {
								?>

								<tr>
									<td><?= escape($data->id);?></td>
									<td><?= escape($data->first_name .' '. $data->last_name);?></td>
									<td><?= escape($data->order_by);?></td>
									<td><?= escape($data->created_at);?></td>
									<td>
										<a href="<?= URL . 'admin/photographer/edit_top_ten.php?id=' . Secure::encrypt($data->id)?>" class="btn btn-primary btn-xs" ><i class="icon-pencil"></i></a>
										<a href="<?= URL . 'admin/photographer/delete_top_modal.php?id=' . Secure::encrypt($data->id)?>" class="btn btn-danger btn-xs delete" data-target=".modal" data-url="" data-toggle="modal"><i class="icon-trash "></i></a>
									</td>
								</tr>
								<?php	
							}
							?>
						<?php }else{ ?> 
							<tr><td>Nothing to display</td></tr>
						<?php }?>
					</tbody>
				</table>
			</section>
		</div>	
	</section>
</section>

<div class="modal fade">
	
</div><!-- /.modal -->
<?php
require_once(ROOT . 'admin/includes/footer.php');
?>

