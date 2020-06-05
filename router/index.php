<?php

include_once 'Request.php';
include_once 'Router.php';
$router = new Router(new Request);

$router->get('/', function($request) {
  $searchString = !empty($request->getParam()["search"]) ? $request->getParam()["search"] : "";
  $home = include $_SERVER['DOCUMENT_ROOT'].'/body.php';
  return $home;
});

$router->get('/login', function() {
    $login = include $_SERVER['DOCUMENT_ROOT'].'/login.php';
    return $login;
  });


$router->get('/profile', function($request) {
    return json_encode($request->getParam());
//   return <<<HTML
//   <h1>Profile</h1>
// HTML;
});

$router->post('/data', function($request) {

  return json_encode($request->getBody());
});