<?php

class Helpers
{

    /**
     * Converte uma string de snake_case para camelCase.
     *
     * @param string $string
     * @return string
     */
    public static function snakeToCamel(string $string): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }

    /**
     * Converte todas as chaves de um array para camelCase.
     *
     * @param array $array
     * @return array
     */
    public static function keysToCamelCase(array $array): array
    {
        $converted = [];

        foreach ($array as $key => $value) {
            $converted[self::snakeToCamel($key)] = $value;
        }

        return $converted;
    }

    /**
     * Converte uma lista de arrays (registros) com chaves snake_case para camelCase.
     *
     * @param array $list
     * @return array
     */
    public static function listToCamelCase(array $list): array
    {
        return array_map([self::class, 'keysToCamelCase'], $list);
    }
}
