<?php
	require_once('../core/init.php');
	$obj = new User();
	if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
		$obj->PasswordResetMail();
	}	
	require_once(ROOT . 'user/includes/header.php');
?>

<div class="form-signin">
	<?php echo sessionDisplayMessage(); ?>
</div>
<form class="form-signin" method="post">
	<?php echo Token::inputToken(); ?>
	<h2 class="form-signin-heading">Forgot Password</h2>
	<div class="login-wrap">
		<input type="email" class="form-control" placeholder="Email" autofocus name="email">
			<?= validationErrors('alert alert-danger', 'username'); ?>
			<p class="help-text">Please provide your valid email to reset password</p>
			<br>
		<button class="btn btn-lg btn-login btn-block" type="submit">Send</button>
	</div>
</form>
<?php
	require_once(ROOT . 'user/includes/footer.php')
?>