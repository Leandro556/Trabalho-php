<?php
class Usuario {
    private $nome;
    private $email;
    private $senha;

    public function __construct($nome, $email, $senha) {
        $this->nome = $this->sanitizar($nome);
        $this->email = $this->sanitizar($email);
        $this->senha = $this->criptografarSenha($senha);
    }

    private function sanitizar($dado) {
        return htmlspecialchars(trim($dado), ENT_QUOTES, 'UTF-8');
    }

    private function criptografarSenha($senha) {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public function autenticar($senha) {
        return password_verify($senha, $this->senha);
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }
}
?>