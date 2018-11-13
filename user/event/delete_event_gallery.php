<?php
require_once('../../core/init.php');
$event = new Event();
$id = Secure::decrypt(Input::get('id'));

if(isset($id)) {
	$event->deleteEventGallery($id);
}
?>

