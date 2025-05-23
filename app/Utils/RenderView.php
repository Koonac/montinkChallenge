<?php

class RenderView
{
    public function loadView($view, $args)
    {
        extract($args);

        $viewFile = __DIR__ . "/../../views/$view.php";

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            $msgError = "A View ($view) definida no controller não foi encontrada.";
            require_once __DIR__ . "/../../404.php";
        };
    }
}
