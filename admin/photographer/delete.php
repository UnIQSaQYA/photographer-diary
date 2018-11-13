<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
$obj->deletePhotographer(Input::get('id'));

?>