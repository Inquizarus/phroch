<?php
require __DIR__ . "/vendor/autoload.php";

use \Symfony\Component\HttpFoundation\Request;
use \Botty\Controller\IndexController;

$request = Request::createFromGlobals();
$controller = new IndexController();

$response = $controller->getIndex($request);

echo $response->getContent();

