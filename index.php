<?php

require_once __DIR__ . '/Core/Core.php';
require_once __DIR__ . '/router/routes.php';

spl_autoload_register(function ($file) {
    if (file_exists(__DIR__ . "/Utils/$file.php")) {
        require_once __DIR__ . "/Utils/$file.php";
    }
    if (file_exists(__DIR__ . "/Models/$file.php")) {
        require_once __DIR__ . "/Models/$file.php";
    }
});

$requestMethod = $_SERVER['REQUEST_METHOD'];
$methodRoutes = $routes[$requestMethod] ?? [];

$core = new Core;
$core->run($methodRoutes);
