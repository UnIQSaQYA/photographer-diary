<?php
require_once('../../core/init.php');
$obj = new Background();

$obj->deleteImage(Input::get('id'));

?>