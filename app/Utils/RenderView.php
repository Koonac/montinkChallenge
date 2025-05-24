<?php

class RenderView
{
    /**
     * Carrega a view
     * 
     * @param string @view
     * @param array @args
     * @return void
     */
    public function loadView($view, $args = [])
    {
        extract($args);

        $viewFile = __DIR__ . "/../../resources/views/$view.php";

        if (file_exists($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
            require_once __DIR__ . "/../../resources/views/layout.php";
        } else {
            $msgError = "A View ($view) definida no controller não foi encontrada.";
            require_once __DIR__ . "/../../404.php";
        };
    }
}
