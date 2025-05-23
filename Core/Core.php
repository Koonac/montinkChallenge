<?php

class Core
{
    /**
     * Inicia o core da aplicação
     * 
     */
    public function run($routes)
    {
        $url = '/';

        isset($_GET['url']) ? $url .= $_GET['url'] : '';

        $routeFound = false;

        foreach ($routes as $route => $handler) {
            $pattern = preg_replace('#\{[\w]+\}#', '([\w-]+)', $route); // transforma o parâmetro EX: {id} em regex
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); //remove o primeiro item que é a url completa 

                list($controllerName, $methodName) = explode('@', $handler);

                $controllerFile = __DIR__ . "/../Controllers/{$controllerName}.php";
                if (!file_exists($controllerFile)) {
                    http_response_code(404);
                    $msgError = "O controller ($controllerName) não foi encontrado.";
                    require_once __DIR__ . '/../404.php';
                    return;
                }

                require_once $controllerFile;
                $controller = new $controllerName();

                if (!method_exists($controller, $methodName)) {
                    http_response_code(404);
                    $msgError = "O método ($methodName) do controller ($controllerName) não foi encontrado.";
                    require_once __DIR__ . '/../404.php';
                    return;
                }

                call_user_func_array([$controller, $methodName], $matches);
                $routeFound = true;
                return;
            }
        }

        if (!$routeFound) {
            http_response_code(404);
            require_once __DIR__ . '/../404.php';
            exit;
        }
    }
}
