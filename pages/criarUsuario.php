<?php 
session_start();
require '../conn.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="../assets/css/criarUsuario.css">
</head>

<body>

    <main class="auth-card">

        <div class="auth-header">
            <div class="brand-logo">
                <div class="logo-bar"></div>
                <div class="logo-bar"></div>
                <div class="logo-bar"></div>
            </div>
            <h1 class="auth-title">Criar Conta</h1>
            <p class="auth-subtitle">Faça seu cadastro para ter acesso ao painel.</p>
        </div>

        <form action="../actions.php" method="POST">

            <div class="form-group">
                <label class="form-label" for="name">Nome Completo</label>
                <div class="input-wrapper">
                    <i data-lucide="user"></i>
                    <input type="text" id="name" name="nome" class="form-input" placeholder="Ex: Eric Martins" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">E-mail Universitário ou Pessoal</label>
                <div class="input-wrapper">
                    <i data-lucide="mail"></i>
                    <input type="email" id="email" name="email" class="form-input" placeholder="seu@email.com" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Crie uma Senha</label>
                <div class="input-wrapper">
                    <i data-lucide="lock"></i>
                    <input type="password" id="password" name="senha" class="form-input" placeholder="********" required>
                </div>
            </div>

            <div class="form-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="terms" required>
                    Li e concordo com os <a href="#" class="link-text">Termos de Uso</a>
                </label>
            </div>

            <button type="submit" name="criar_usuario" class="btn-submit">
                Cadastrar <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
            </button>

        </form>

        <p class="switch-prompt">
            Já tem uma conta? <a href="../index.php">Entrar</a>
        </p>

    </main>

    <script>
        // Inicializar os ícones do Lucide
        lucide.createIcons();
    </script>
</body>

</html>