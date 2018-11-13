<?php
require_once('../../core/init.php');
?>
<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Portfolio</h4>
			</div>
			<div class="modal-body">
				<p>Are You sure you want to delete the Event Image?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="<?= URL . 'admin/photographer/delete_event_gallery.php?id=' . Input::get('id') ?>" class="btn btn-primary del">Delete</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->

</script>