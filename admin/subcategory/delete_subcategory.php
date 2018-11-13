<?php
require_once('../../core/init.php');

$id = Input::get('id');
if(isset($id)){
	$category = new subCategory();
	$deleteCategory = $category->deleteSubCategory($id);
}
?>

