<?php

// Core da aplicação
require_once __DIR__ . '/app/Core/Core.php';

// Arquivo de coneção com banco de dados
require_once __DIR__ . '/app/Models/Database/Database.php';

// Rotas da aplicação
require_once __DIR__ . '/routes/web.php';

spl_autoload_register(function ($file) {
    // Arquivos de utilidades da aplicação
    if (file_exists(__DIR__ . "/app/Utils/$file.php")) {
        require_once __DIR__ . "/app/Utils/$file.php";
    }

    // Arquivos Models da aplicação
    if (file_exists(__DIR__ . "/app/Models/$file.php")) {
        require_once __DIR__ . "/app/Models/$file.php";
    }

    // Arquivos UseCase da aplicação
    if (file_exists(__DIR__ . "/app/UseCase/$file.php")) {
        require_once __DIR__ . "/app/UseCase/$file.php";
    }
});

function printDie(...$list)
{
    print '<pre>';
    foreach ($list as $l) {
        print_r($l);
        print '<br>';
    }
    die;
}
