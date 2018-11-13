<?php
	require_once('../core/init.php');
	$obj = new User();
	$obj->verifyEmail(Input::get('key'), Input::get('u'));
?>