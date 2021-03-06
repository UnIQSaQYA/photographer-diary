<?php
require_once('../core/init.php');
if(Input::method()) {
	$user = new Admin();
	$user->login();
}
require_once(ROOT . '/admin/includes/header.php');

?>
<div class="container">
	<form class="form-signin" method="post">
		<h2 class="form-signin-heading">sign in now</h2>
		<div class="login-wrap">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="User ID" value="<?= errorFields('username'); ?>" autofocus name="username" autocomplete="off">	
				 <?= validationErrors('','username'); ?>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" name="password">
				<?= validationErrors('','password'); ?>
			</div>
			<label class="checkbox">
				<input type="checkbox" name="remember"> Remember me
				<span class="pull-right">
					<a data-toggle="modal" href="#myModal"> Forgot Password?</a>
				</span>
			</label>
			<button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
		</div>
		<!-- Modal -->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Forgot Password ?</h4>
					</div>
					<div class="modal-body">
						<p>Enter your e-mail address below to reset your password.</p>
						<input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

					</div>
					<div class="modal-footer">
						<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
						<button class="btn btn-success" type="button">Submit</button>
					</div>
				</div>
			</div>
		</div>
		<!-- modal -->
	</form>
</div>

<?php
	require_once(ROOT . '/admin/includes/footer.php')
?>