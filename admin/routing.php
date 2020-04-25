<?php
$request = $_GET['pages'];

switch ($request) {
    case '' :
        require 'body.php';
        break;
    case 'add' :
        require 'add.php';
        break;
    case 'edit' :
        require 'edit.php';
        break;
    default:
        require 'body.php';
        break;
}

?>