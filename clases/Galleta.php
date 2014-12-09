<?php

class Galleta {

    //tiempo valor predeterminado 1 hora
    public static function add($nombre, $valor, $tiempo = 3600) {
        setcookie($nombre, $valor, time() + $tiempo);
    }

    public static function get($nombre) {
        if (isset($_COOKIE["$nombre"])) {
            return $_COOKIE["$nombre"];
        } else {
            return "";
        }
    }

    public static function delete($nombre) {
        setcookie($nombre, "", time() - 3600);
    }

    
}
