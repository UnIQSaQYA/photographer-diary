<?php
require_once('../../core/init.php');

$id = Input::get('id');
if(isset($id)){
	$category = new Category();
	$deleteCategory = $category->deleteCategory($id);
	Redirect::to(URL . 'admin/category/view_category.php');
}
?>

