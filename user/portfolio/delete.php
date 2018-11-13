<?php
require_once('../../core/init.php');
$event = new Portfolio();
$id = Secure::decrypt(Input::get('id'));

if(isset($id)) {
	$event->deleteGallery($id);
}
?>

