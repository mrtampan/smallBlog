<?php

if(!isset($_GET['pages'])){
    $request = '';    
}else{
    $request = $_GET['pages'];
}


switch ($request) {
    case '' :
        require 'body.php';
        break;
    case 'kategori' :
        require 'kategori/body.php';
        break;
    case 'add-kat' :
        require 'kategori/add.php';
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