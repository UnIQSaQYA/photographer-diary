<?php
	require_once('../core/init.php');
	$obj = new User();
	if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
		$obj->changePassword();
	}
	require_once(ROOT . 'user/includes/header.php');
?>

<form class="form-signin" method="post">
	<?php echo Token::inputToken(); ?>
	<h2 class="form-signin-heading">Change Password</h2>
	<div class="login-wrap">
			<input type="password" class="form-control" placeholder="Password" name="password">
			<?= validationErrors('help-block', 'password'); ?>
			<input type="password" class="form-control" placeholder="Re-type Password" name="confirm">
			<?= validationErrors('help-block', 'confirm'); ?>
		<button class="btn btn-lg btn-login btn-block" type="submit">Change Password</button>
	</div>
</form>
<?php
	require_once(ROOT . 'user/includes/footer.php')
?>