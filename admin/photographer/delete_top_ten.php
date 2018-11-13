<?php
require_once('../../core/init.php');
$obj = new photographerInfo();

$obj->deleteTopTen(Input::get('id'));

?>