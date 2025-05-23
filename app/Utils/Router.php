<?php

class Router
{
    /**
     * Retorna a url base
     * 
     * @param @path
     */
    public static function baseUrl($path = '')
    {
        $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $script = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        return $scheme . '://' . $host . $script . '/' . ltrim($path, '/');
    }

    public static function getPath()
    {
        return $_GET['url'] ?? '/';
    }
}
