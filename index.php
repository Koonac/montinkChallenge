<?php

require_once __DIR__ . '/app/Core/Core.php';
require_once __DIR__ . '/routes/web.php';

spl_autoload_register(function ($file) {
    if (file_exists(__DIR__ . "/app/Utils/$file.php")) {
        require_once __DIR__ . "/app/Utils/$file.php";
    }
    if (file_exists(__DIR__ . "/app/Models/$file.php")) {
        require_once __DIR__ . "/app/Models/$file.php";
    }
});

$requestMethod = $_SERVER['REQUEST_METHOD'];
$methodRoutesWeb = $routesWeb[$requestMethod] ?? [];

$core = new Core;
$core->run($methodRoutesWeb);
