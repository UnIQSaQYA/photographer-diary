<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$top = $obj->getTopTenById();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$obj->editTopTenPhotographer();
}
require_once(ROOT . '/admin/includes/header.php');
require_once(ROOT . '/admin/includes/navbar.php');
include(ROOT . '/admin/includes/sidebar.php');
?>
<section id="main-content">
	<section class="wrapper">
		<!--main content goes here-->
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<?php echo uploadErrors('alert alert-danger'); ?>
			<section class="panel">
				<header class="panel-heading">
					Add Event
				</header>
				<div class="panel-body">
					<form role="form" method="post" enctype="multipart/form-data">
						<?php echo Token::inputToken(); ?>
						<div class="form-group col-lg-6 <?php echo (hasError('name')?'has-error':''); ?>" style="padding: 0px;">
							<label for="Name" class="col-lg-12 control-label">Order By</label>
							<div class="col-lg-12">
								<select class="form-control" name="top">
									<option value="1" <?= (($top->order_by == 1) ? "selected" : '')?>>1</option>
									<option <?= (($top->order_by == 2) ? "selected" : '')?> value="2">2</option>
									<option <?= (($top->order_by == 3) ? "selected" : '')?> value="3" >3</option>
									<option <?= (($top->order_by == 4) ? "selected" : '')?> value="4" >4</option>
									<option <?= (($top->order_by == 5) ? "selected" : '')?> value="5" >5</option>
									<option <?= (($top->order_by == 6) ? "selected" : '')?> value="6" >6</option>
									<option <?= (($top->order_by == 7) ? "selected" : '')?> value="7" >7</option>
									<option <?= (($top->order_by == 8) ? "selected" : '')?> value="8" >8</option>
									<option <?= (($top->order_by == 9) ? "selected" : '')?> value="9" >9</option>
									<option <?= (($top->order_by == 10) ? "selected" : '')?> value="10 ">10</option>	
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-12">
							<button type="submit" class="btn btn-danger">Edit</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</section>
</section>