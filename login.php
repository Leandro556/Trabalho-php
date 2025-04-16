<?php
require_once 'classes/Sessao.php';

Sessao::iniciar();
if (Sessao::get('usuario')) {
    header('Location: dashboard.php');
    exit();
}

$emailCookie = $_COOKIE['lembrar_email'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Login</h1>
    
    <?php if (Sessao::get('erro')): ?>
        <div class="error"><?= Sessao::get('erro') ?></div>
        <?php Sessao::set('erro', null); ?>
    <?php endif; ?>
    
    <?php if (Sessao::get('sucesso')): ?>
        <div class="success"><?= Sessao::get('sucesso') ?></div>
        <?php Sessao::set('sucesso', null); ?>
    <?php endif; ?>
    
    <form action="processa_login.php" method="post">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($emailCookie) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        
        <div class="form-group">
            <input type="checkbox" id="lembrar" name="lembrar">
            <label for="lembrar" style="display: inline;">Lembrar e-mail</label>
        </div>
        
        <button type="submit">Entrar</button>
    </form>
    
    <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
</body>
</html>