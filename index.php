<?php

require_once __DIR__ . '/autoload.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$methodRoutesWeb = $routesWeb[$requestMethod] ?? [];

$core = new Core;
$core->run($methodRoutesWeb);
