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

    /**
     * Converte um valor americano para brasileiro
     *
     * @param $usdValue
     * @return string
     */
    public static function convertToReal($usdValue): string
    {
        $cleanValue = preg_replace('/[^0-9.]/', '', $usdValue);

        $floatValue = floatval($cleanValue);

        return number_format($floatValue, 2, ',', '.');
    }

    /**
     * Converte um valor brasileiro para americano
     *
     * @param $brlValue
     * @return string
     */
    public static function convertToUsd($brlValue): string
    {
        $cleanValue = str_replace(['R$', ' ', '.'], '', $brlValue);

        $cleanValue = str_replace(',', '.', $cleanValue);

        $floatValue = floatval($cleanValue);

        return number_format($floatValue, 2, '.', '');
    }

    /**
     * Converte o status de um pedido
     *
     * @param $status
     * @return bool
     */
    public static function orderStatusExists($status): bool
    {
        $orderStatus = ['created', 'approved', 'shipped', 'delivered', 'cancelled'];

        return in_array($status, $orderStatus);
    }

    /**
     * Converte o status de um pedido
     *
     * @param $status
     * @return string|null
     */
    public static function orderStatusParser($status): string | null
    {
        switch ($status) {
            case 'created':
                return 'Criado';
            case 'approved':
                return 'Aprovado';
            case 'shipped':
                return 'Enviado';
            case 'delivered':
                return 'Entregue';
            case 'cancelled':
                return 'Cancelado';
            default:
                return null;
        }
    }
}
