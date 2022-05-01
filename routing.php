<?php

//routing lama

$request = $_SERVER['REQUEST_URI'];
$subfolder = '/smallBlog';

switch ($request) {
    case $subfolder . '/' :
        require __DIR__ . '/view/body.php';
        break;
    case $subfolder . '' :
        require __DIR__ . '/view/body.php';
        break;
    case $subfolder . '/login' :
        require __DIR__ . '/log_in.php';
        break;
    default:
        require __DIR__ . '/404.html';
        break;
}

?>