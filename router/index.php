<?php

include_once 'Request.php';
include_once 'Router.php';
$router = new Router(new Request);

$router->get('/', function($request) {
  $searchString = !empty($request->getParam()["search"]) ? $request->getParam()["search"] : "";
  $pageString = !empty($request->getParam()["page"]) ? $request->getParam()["page"] : "";
  include $_SERVER['DOCUMENT_ROOT'].'/body.php';
  
});

$router->get('/login', function() {
    include $_SERVER['DOCUMENT_ROOT'].'/login.php';
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