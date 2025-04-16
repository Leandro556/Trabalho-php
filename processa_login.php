<?php
require_once 'classes/Autenticador.php';
require_once 'classes/Sessao.php';

Sessao::iniciar();

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$lembrar = isset($_POST['lembrar']);

// Validações
if (empty($email) || empty($senha)) {
    Sessao::set('erro', 'E-mail e senha são obrigatórios.');
    header('Location: login.php');
    exit();
}

// Autenticação
$usuario = Autenticador::login($email, $senha);

if (!$usuario) {
    Sessao::set('erro', 'E-mail ou senha inválidos.');
    header('Location: login.php');
    exit();
}

// Configurar sessão
Sessao::set('usuario', [
    'nome' => $usuario->getNome(),
    'email' => $usuario->getEmail()
]);

// Configurar cookie se "Lembrar e-mail" estiver marcado
if ($lembrar) {
    setcookie('lembrar_email', $email, time() + (30 * 24 * 60 * 60), '/'); // 30 dias
} else {
    setcookie('lembrar_email', '', time() - 3600, '/'); // Remove cookie
}

header('Location: dashboard.php');
exit();
?>