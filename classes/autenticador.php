<?php
require_once 'Usuario.php';

class Autenticador {
    private static $usuarios = [];

    public static function registrar(Usuario $usuario) {
        self::$usuarios[$usuario->getEmail()] = $usuario;
        return true;
    }

    public static function login($email, $senha) {
        if (isset(self::$usuarios[$email])) {
            $usuario = self::$usuarios[$email];
            if ($usuario->autenticar($senha)) {
                return $usuario;
            }
        }
        return false;
    }

    public static function usuarioExiste($email) {
        return isset(self::$usuarios[$email]);
    }
}
?>