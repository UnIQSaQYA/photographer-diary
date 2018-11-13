<?php
require_once('core/init.php');


if ((isset($_POST['do']) && !empty($_POST['do'])) || (isset($_GET['do']) && !empty($_GET['do']))) {

    $ajax = new Ajax();
    if (isset($_POST['do'])) {
        $do = $_POST['do'];
    } elseif (isset($_GET['do'])) {
        $do = $_GET['do'];
    }

    switch ($do) {
        case 'insert_ajax_data':
            $ajax->saveData();
            break;

        case 'get_ajax_data':
            $ajax->getAjaxData();
            break;
        case 'delete-ajax':
            $ajax->deleteAjaxRow();
            break; 
        case 'edit-ajax':
            $ajax->editAjaxAction();
            break;
        case 'update-ajax-action':
            $ajax->updateAjax();
            break;
    }

}