<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">


</head>

<body>

    <main class="main-app">
        <header class="navbar">
            <div class="logo-group" id="logoToggle">
                <div class="logo-bar"></div>
                <div class="logo-bar"></div>
                <div class="logo-bar"></div>
            </div>

            <nav class="nav-links" id="navMenu">
                <a href="#">Soluções</a>
                <a href="#">Sobre</a>
                <a href="#">Docs</a>
                <a href="#">Preços</a>
            </nav>

            <div class="nav-actions">
                <a href="#" class="login-btn">Login</a>
                <button class="start-btn">Começar</button>
            </div>
        </header>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const logoToggle = document.getElementById('logoToggle');
                const navMenu = document.getElementById('navMenu');

                logoToggle.addEventListener('click', () => {
                    navMenu.classList.toggle('active');
                });
            });
        </script>

    </main>

</body>

</html>