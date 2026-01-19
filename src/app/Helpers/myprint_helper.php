<?php

namespace App\Helpers;

if (!function_exists('myPrint')) {
    /**
     * Retorna código PHP formatado com print_r
     * 
     * @param string $nomeVariavel Nome da variável para o print_r
     * @return string Código PHP formatado
     */
    function myPrint(mixed $getValue, bool $return = false, bool $addServer = false): mixed
    {
        echo "<pre>";
        print_r($getValue);
        echo "</pre>";

        echo "<pre>";
        echo "==================== SERVER ====================";
        echo "</pre>";
        
        echo "<pre>";
        if ($addServer) {
            print_r($_SERVER);
        } else {
            echo "Server info not added.";
        }
        echo "</pre>";
        
        if ($return) {
            return null;
        }

        return null;
    }
}