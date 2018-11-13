<?php
	require_once '../core/init.php';
if((isset($_POST['do']) && !empty($_POST['do'])) || (isset($_GET['do']) && !empty($_GET['do']))) {
	$ajax = new Photographer();
	if(isset($_POST['do'])) {
		$do = $_POST['do'];
	} elseif(isset($_GET['do'])) {
		$do = $_GET['do'];
	}

	switch ($do) {
		case 'insert_image':
			$ajax->uploadEventLogo();
			break;
	}
}