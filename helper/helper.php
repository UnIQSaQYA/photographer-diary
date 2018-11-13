<?php

function gender($gender) {
	if($gender == 1) {
		return "Male";
	}elseif($gender == 2) {
		return "Female";
	}
}

function checkImage($image, $table = Null) {
	$links = array(
		'event'   => 'image/event/',
		'default' => 'image/default/',
		'profile' => 'image/portfolio/',
		'gallery' => 'image/gallery/',
	);
;
	if(!empty($image) && array_key_exists($table, $links)) {
		return $links[$table] . $image;
	}
	return $links['default'] . 'default.png';
}