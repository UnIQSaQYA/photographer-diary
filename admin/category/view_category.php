<?php
require_once('../../core/init.php');
require_once(ROOT . '/admin/includes/header.php');
require_once(ROOT . '/admin/includes/navbar.php');
require_once(ROOT . '/admin/includes/sidebar.php');

$category = new Category();
$categoryDetails = $category->getAllCategory();
?>

<section id="main-content">
	<section class="wrapper">
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<section class="panel">
				<header class="panel-heading">
					Category
				</header>
				<table class="table table-striped table-advance table-hover">
					<thead>
						<tr>
							<th><i class="icon-bullhorn"></i> Catategory Id</th>
							<th class="hidden-phone"><i class="icon-question-sign"></i> Category Name</th>
							<th><i class="icon-bookmark"></i> Created BY</th>
							<th><i class="icon-bookmark"></i> Created At</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($categoryDetails as $categoryDetail) {
							?>

							<tr>
								<td><?= escape($categoryDetail->id);?></td>
								<td><?= escape($categoryDetail->category_name);?></td>
								<td><?= escape($categoryDetail->username);?></td>
								<td><?= escape($categoryDetail->created_at);?></td>
								<td>
									<a href="<?php echo URL . 'admin/category/edit_category.php?id='.$categoryDetail->id; ?>" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
									<a href="" class="btn btn-danger btn-xs delete" data-target=".modal" data-url="<?php echo URL . 'admin/category/delete_category.php?id='.Secure::encrypt($categoryDetail->id); ?>" data-toggle="modal"><i class="icon-trash "></i></a>
								</td>
							</tr>
							<?php	
						}
						?>
					</tbody>
				</table>
			</section>
		</div>
	</section>
</section>

<div class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Category</h4>
			</div>
			<div class="modal-body">
				<p>Are You sure you want to delete the category?</p>
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
require_once(ROOT . 'admin/includes/footer.php');
?>

