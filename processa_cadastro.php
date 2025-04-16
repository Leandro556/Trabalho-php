<?php
require_once 'classes/Usuario.php';
require_once 'classes/Autenticador.php';
require_once 'classes/Sessao.php';

Sessao::iniciar();

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';

// Validações
if (empty($nome) || empty($email) || empty($senha) || empty($confirmarSenha)) {
    Sessao::set('erro', 'Todos os campos são obrigatórios.');
    header('Location: cadastro.php');
    exit();
}

if ($senha !== $confirmarSenha) {
    Sessao::set('erro', 'As senhas não coincidem.');
    header('Location: cadastro.php');
    exit();
}

if (strlen($senha) < 6) {
    Sessao::set('erro', 'A senha deve ter pelo menos 6 caracteres.');
    header('Location: cadastro.php');
    exit();
}

if (Autenticador::usuarioExiste($email)) {
    Sessao::set('erro', 'E-mail já cadastrado.');
    header('Location: cadastro.php');
    exit();
}

// Criar e registrar usuário
$usuario = new Usuario($nome, $email, $senha);
Autenticador::registrar($usuario);

Sessao::set('sucesso', 'Cadastro realizado com sucesso!');
header('Location: login.php');
exit();
?>