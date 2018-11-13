<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$subcatObj = new subCategory();
$subcategorys = $subcatObj->getAllSubCategory();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {   
	$obj->createUserAccount();
}
require_once(ROOT . '/admin/includes/header.php');
require_once(ROOT . '/admin/includes/navbar.php');
include(ROOT . '/admin/includes/sidebar.php');
?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!--main content goes here-->
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<?php echo uploadErrors('alert alert-danger'); ?>
			<section class="panel">
				<header class="panel-heading">
					Create User Account
				</header>
				<div class="panel-body">
					<form role="form" method="post" enctype="multipart/form-data">
						<?php echo Token::inputToken(); ?>
						<div class="form-group col-lg-6 <?php echo (hasError('f_name')?'has-error':''); ?>" style="padding: 0px;">
							<label for="First Name" class="col-lg-12 control-label">First Name</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="f_name" placeholder="First Name">
								<?= validationErrors('help-block', 'f_name'); ?>
							</div>
						</div>

						<div class="form-group col-lg-6 <?php echo (hasError('l_name')?'has-error':''); ?>" style="padding: 0px;">
							<label for="Last Name" class="col-lg-12 control-label">Last Name</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="l_name" placeholder="Last Name">
								<?= validationErrors('help-block', 'l_name'); ?>
							</div>
						</div>

						<div class="form-group col-lg-6 <?php echo (hasError('email')?'has-error':''); ?>" style="padding: 0px;">
							<label for="email" class="col-lg-12 control-label">email</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="email" placeholder="Email">
								<?= validationErrors('help-block', 'email'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('username')?'has-error':''); ?>" style="padding: 0px;">
							<label for="username" class="col-lg-12 control-label">username</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="username" placeholder="username">
								<?= validationErrors('help-block', 'username'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('caption')?'has-error':''); ?>" style="padding: 0px;">
							<label for="caption" class="col-lg-12 control-label">Sub Category</label>
							<div class="col-lg-12">
								<select name="sub_cat" class="form-control">
									<?php foreach($subcategorys as $subcategory){ ?>
										<option value="<?= $subcategory->id; ?>"><?= $subcategory->subcategory_name ?> </option>
									<?php } ?>
								</select>
								<?= validationErrors('help-block', 'caption'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('password')?'has-error':''); ?>" style="padding: 0px;">
							<label for="password" class="col-lg-12 control-label">password</label>
							<div class="col-lg-12">
								<input type="password" class="form-control" name="password" placeholder="password">
								<?= validationErrors('help-block', 'password'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 <?php echo (hasError('confirm')?'has-error':''); ?>" style="padding: 0px;">
							<label for="confirm" class="col-lg-12 control-label">Re type password</label>
							<div class="col-lg-12">
								<input type="password" class="form-control" name="confirm" placeholder="Retype password">
								<?= validationErrors('help-block', 'username'); ?>
							</div>
						</div>
						<div class="clearfix"></div>
	
						<div class="clearfix"></div>
					
						<div class="form-group col-lg-12">
							<button type="submit" class="btn btn-danger">Add</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</section>
</section>
<?php
require_once(ROOT . '/admin/includes/footer.php');
?>
