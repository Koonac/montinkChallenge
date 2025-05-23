<?php

class Core
{

    /**
     * Página 404 de arquivo não encontrado 
     * 
     * @var $page404File
     */
    private $page404File = __DIR__ . '/../../404.php';

    /**
     * Inicia o core da aplicação
     * 
     * @param $routes 
     */
    public function run($routes)
    {
        $url = '/';

        isset($_GET['url']) ? $url .= rtrim($_GET['url'], '/') : '';

        foreach ($routes as $route => $handler) {
            // Extrai os nomes dos parâmetros
            preg_match_all('/\{([\w]+)\}/', $route, $paramNames);
            $paramNames = $paramNames[1];

            // Converte a rota em uma expressão regular
            $pattern = preg_replace('/\{[\w]+\}/', '([\w-]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); //remove o primeiro item que é a url completa 

                // Combina os valores com os nomes dos parâmetros
                $params = array_combine($paramNames, $matches);

                list($controllerName, $methodName) = explode('@', $handler);

                $controllerFile = __DIR__ . "/../Controllers/{$controllerName}.php";
                if (!file_exists($controllerFile)) {
                    http_response_code(404);
                    $msgError = "O controller ($controllerName) não foi encontrado.";
                    require_once $this->page404File;
                    return;
                }

                require_once $controllerFile;
                $controller = new $controllerName();

                if (!method_exists($controller, $methodName)) {
                    http_response_code(404);
                    $msgError = "O método ($methodName) do controller ($controllerName) não foi encontrado.";
                    require_once $this->page404File;
                    return;
                }

                call_user_func_array([$controller, $methodName], [$params]);
                return;
            }
        }

        http_response_code(404);
        require_once $this->page404File;
        exit;
    }
}
