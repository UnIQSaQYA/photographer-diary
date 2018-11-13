<?php
require_once('../../core/init.php');
?>
<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Photographer</h4>
			</div>
			<div class="modal-body">
				<p>Are You sure you want to remove the photographer from top ten?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="<?= HTTP . 'admin/photographer/delete_top_ten.php?id=' . Input::get('id') ?>" class="btn btn-primary del">Delete</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->

</script>