<?php
class Sessao {
    public static function iniciar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($chave, $valor) {
        self::iniciar();
        $_SESSION[$chave] = $valor;
    }

    public static function get($chave) {
        self::iniciar();
        return $_SESSION[$chave] ?? null;
    }

    public static function destruir() {
        self::iniciar();
        session_unset();
        session_destroy();
    }
}
?>