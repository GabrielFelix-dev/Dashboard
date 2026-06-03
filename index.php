<?php 
    require 'conn.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://unpkg.com/lucide@latest"></script>


</head>

<body>

    <?php include 'pages/sms.php'?>
    <main class="login-card">
        
        <div class="login-header">
            <div class="brand-logo">
                <div class="logo-bar"></div>
                <div class="logo-bar"></div>
                <div class="logo-bar"></div>
            </div>
            <h1 class="login-title">Dashboard</h1>
            <p class="login-subtitle">Bem-vindo de volta! Insira suas credenciais para acessar o painel.</p>
        </div>

        <form action="actions.php" method="POST">

            <div class="form-group">
                <label class="form-label" for="email">E-mail</label>
                <div class="input-wrapper">
                    <i data-lucide="mail"></i>
                    <input type="email" id="email" class="form-input" placeholder="seu@email.com" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Senha</label>
                <div class="input-wrapper">
                    <i data-lucide="lock"></i>
                    <input type="password" id="password" class="form-input" placeholder="••••••••" required>
                </div>
            </div>

            <div class="form-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember">
                    Lembrar de mim
                </label>
                <a href="#" class="forgot-password">Esqueceu a senha?</a>
            </div>

            <button type="submit" class="btn-submit">
                Entrar <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
            </button>

        </form>

        <p class="register-prompt">
            Ainda não tem uma conta? <a href="pages/criarUsuario.php">Cadastre-se</a>
        </p>

    </main>

    <script>
        // Inicializar os ícones do Lucide
        lucide.createIcons();
    </script>
</body>

</html>