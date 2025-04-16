<?php
require_once 'classes/Sessao.php';

Sessao::iniciar();

$usuario = Sessao::get('usuario');
if (!$usuario) {
    header('Location: login.php');
    exit();
}

$emailCookie = $_COOKIE['lembrar_email'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .info { background: #f8f9fa; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
        .logout { display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Bem-vindo, <?= htmlspecialchars($usuario['nome']) ?>!</h1>
    
    <div class="info">
        <h2>Informações da Sessão</h2>
        <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></p>
        <p><strong>E-mail:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
        
        <?php if ($emailCookie): ?>
            <p><strong>E-mail lembrado (cookie):</strong> <?= htmlspecialchars($emailCookie) ?></p>
        <?php endif; ?>
    </div>
    
    <a href="logout.php" class="logout">Sair</a>
</body>
</html>