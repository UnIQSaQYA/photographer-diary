<?php

require_once('../core/init.php');
$user = new User();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$user->register();
}

$subCategoryDetails = $user->getAllSubCategory();
$categorys = $user->getAllCategory();
require_once(ROOT . 'user/includes/header.php');
?>

<div class="container">
	<form class="form-signin" method="post">
		<?php echo Token::inputToken(); ?>
		<h2 class="form-signin-heading">registration now</h2>
		<div class="login-wrap">
			<p class="par">Enter your personal details below</p>
			<input type="text" class="form-control" required placeholder="First Name" autofocus name="f_name" value="<?= escape(Input::get('f_name'));?>">
			<?= validationErrors('help-block', 'f_name'); ?>
			<input type="text" class="form-control" required placeholder="Last Name" autofocus name="l_name" value="<?= escape(Input::get('l_name')); ?>">
			<?= validationErrors('help-block', 'l_name'); ?>
			<select name="sub_cat_id" class="form-control m-bot15" required>
				<option value="">subcategory</option>
				<?php foreach ($subCategoryDetails as $subCategorydetail) { ?>
				<option value="<?= escape($subCategorydetail->id);?>"> <?= escape($subCategorydetail->subcategory_name);?> </option>
				<?php } ?>
			</select>
			<?= validationErrors('help-block', 'sub_cat_id'); ?>
			<p class="par"> Enter your account details below</p>
			<input type="text" class="form-control" placeholder="User Name" autofocus name="username" value="<?= escape(Input::get('username'));?>">
			<?= validationErrors('help-block', 'username'); ?>
			<input type="text" class="form-control" placeholder="Email" autofocus name="email" value="<?= Input::get('email')?>">
			<?= validationErrors('help-block', 'email'); ?>
			<input type="password" class="form-control" placeholder="Password" name="password">
			<?= validationErrors('help-block', 'password'); ?>
			<input type="password" class="form-control" placeholder="Re-type Password" name="confirm">
			<?= validationErrors('help-block', 'confirm'); ?>
			<button class="btn btn-lg btn-login btn-block" type="submit">Submit</button>

			<div class="registration">
				Already Registered.
				<a class="" href="login.html">
					Login
				</a>
			</div>
		</div>
	</form>
</div>
<script src="<?= ASSET .'js/jquery.validate.min.js' ?>" type="text/javascript"></script>
<script src="<?= ASSET .'js/form-validation-script.js' ?>" type="text/javascript"></script>