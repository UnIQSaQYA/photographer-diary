<?php

require_once('core/init.php');
$obj = new Home();
$photographerObj = $obj->getPhotographer();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?= ((count($photographerObj)) ? $photographerObj->first_name .' '.$photographerObj->last_name . "-Photographer's Diary" : "Photographer's Diary")?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="<?= ((count($photographerObj)) ? $photographerObj->first_name.'$photographerObj->last_name ' . ' , '. $photographerObj->subcategory_name .'photographer': "photographersdiary, about photographer, photographer")?> " />
	<meta name="description" content='<?= ((count($photographerObj)) ?substr(strip_tags($photographerObj->detail), 0, 500):"" ) ?>' />

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="assets/images/favicon.ico">

	<!-- Page Title -->

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,600,700,900,200' rel='stylesheet' type='text/css'>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?= ASSET ."css/bootstrap.css" ?>">

	<!-- Custom css file -->
	<link rel="stylesheet" href="<?= ASSET ."css/main.css" ?>">

	<!-- Plugins -->
	<link rel="stylesheet" href="<?= ASSET ."css/jquery.fullPage.css" ?>">
	<link rel="stylesheet" href="<?= ASSET ."css/font-awesome.min.css" ?>">
	<link rel="stylesheet" href="<?= ASSET ."css/photoswipe.css"?>">
	<link rel="stylesheet" href="<?= ASSET ."css/default-skin/default-skin.css"?>">
	    <link rel="stylesheet" type="text/css" href="<?= ASSET . 'css/datepicker.css'; ?>">
	<link rel="stylesheet" href="<?= ASSET ."css/animate.css"?>">
	<link rel="stylesheet" type="text/css" href="<?= ASSET . 'css/jquery.fancybox.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= ASSET . 'css/gallery.css' ?>">
     <link href="<?=ASSET . 'css/style.css'; ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
	<!-- jquery-1.11.3.min js -->
	<script type="text/javascript" src="<?= ASSET."js/jquery-1.11.3.min.js"?>"></script>

	<!-- Main js -->
	<script src="<?= ASSET ."js/bootstrap.js"?>"></script>
	<script class="include" type="text/javascript" src="<?= ASSET . 'js/jquery.dcjqaccordion.2.7.js' ?>"></script>
	<script src="<?= ASSET ."js/main.js"?>"></script>
	<script src="<?= ASSET . 'js/modernizr.custom.js'?>"></script>
    <script type="text/javascript" src="<?= ASSET . 'js/jquery-scrolltofixed.js' ?>"></script>
    <script type="text/javascript" src="<?= ASSET . 'js/jquery.fancybox.js' ?>"></script>
    <script type="text/javascript" src="<?= ASSET . 'js/common-scripts.js' ?>"></script>
</head>
<body>
