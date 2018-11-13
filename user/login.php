<?php

	require_once('../core/init.php');
	$user = new User();
	if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
		$user->login();
	}	
	require_once(ROOT . 'user/includes/header.php');
?>

<div class="container">
	<div class="form-signin">
		 <?php echo sessionDisplayMessage(); ?>
	</div>
	<form class="form-signin" method="post">
		<?php echo Token::inputToken(); ?>
		<h2 class="form-signin-heading">sign in now</h2>
		<div class="login-wrap">
			<input type="text" class="form-control" placeholder="User ID" autofocus name="username">
			<?= validationErrors('alert alert-danger', 'username'); ?>
			<input type="password" class="form-control" placeholder="Password" name="password">
			<?= validationErrors('alert alert-danger', 'password'); ?>
			<label class="checkbox">
				<input type="checkbox" value="remember-me"> Remember me
				<span class="pull-right">
				<a href="<?= URL . 'user/password_reset.php'?>"> Forgot Password?</a>
				</span>
			</label>
			<button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
			
			<div class="registration">
				Don't have an account yet?
				<a class="" href="<?= URL . 'user/register' ?>">
					Create an account
				</a>
			</div>
		</div>
	</form>
</div>

<?php
	require_once(ROOT . 'user/includes/footer.php')
?>