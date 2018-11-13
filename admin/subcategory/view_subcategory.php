<?php
require_once('../../core/init.php');
require_once(ROOT . '/admin/includes/header.php');
require_once(ROOT . '/admin/includes/navbar.php');
require_once(ROOT . '/admin/includes/sidebar.php');

$subCategory = new subCategory();
$subCategoryDetails = $subCategory->getAllSubCategory();
$category = new Category();
$categoryDetail = $category->getALLCategory();
?>

<section id="main-content">
	<section class="wrapper">
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<section class="panel">
				<header class="panel-heading">
					Sub Category
				</header>
				<table class="table table-striped table-advance table-hover">
					<thead>
						<tr>
							<th><i class="icon-bullhorn"></i> Sub Catategory Id</th>
							<th><i class="icon-bullhorn"></i> Category Name</th>
							<th class="hidden-phone"><i class="icon-question-sign"></i> Sub Category Name</th>
							<th><i class="icon-bookmark"></i> Created At</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($subCategoryDetails as $subCategoryDetail) {
							?>

							<tr>
								<td><?= escape($subCategoryDetail->id);?></td>
								<td><?= escape($subCategoryDetail->category_name);?></td>
								<td><?= escape($subCategoryDetail->subcategory_name);?></td>
								<td><?= escape($subCategoryDetail->created_at);?></td>
								<td>
									<a href="<?php echo URL . 'admin/subcategory/edit_subcategory.php?id='.Secure::encrypt($subCategoryDetail->id); ?>" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
									<a href="" class="btn btn-danger btn-xs delete" data-url="<?php echo URL . 'admin/subcategory/delete_subcategory.php?id='.Secure::encrypt($subCategoryDetail->id); ?>" data-target=".modal" data-toggle="modal"><i class="icon-trash "></i></a>
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
				<h4 class="modal-title">Delete subcategory</h4>
			</div>
			<div class="modal-body">
				<p>Are You sure you want to delete the subcategory?</p>
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
require_once(ROOT . '/admin/includes/footer.php');
?>

