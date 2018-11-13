<?php
	/**
	 *  Please delete this file after running it
	 * */
	
	require_once('../../core/init.php');
	$db = Database::instantiate();
	$save = $db->insert('admin', array(
		'username' => 'admin',
		'passwords' => Hash::passwordEncrypt('admin'),
		'name' => 'admin',
		'joined' => date('Y-m-d H:i:s'),
		'user_group' => 1,
		'status' => 1
	));

	if($save) {
		die("Successfully inserted");
	}
?>