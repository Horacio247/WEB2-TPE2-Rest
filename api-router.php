<?php
require_once './libs/router.php';
require_once './app/controllers/trip-apiController.php';

$router = new Router();


$router->addRoute('viajes', 'GET', 'ViajesApiController', 'getViajes');
$router->addRoute('viaje/:ID', 'GET', 'ViajesApiController', 'getViaje');
$router->addRoute('viajes', 'POST', 'ViajesApiController', 'insertViaje'); 
$router->addRoute('viaje/:ID', 'DELETE', 'ViajesApiController', 'deleteViaje');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
