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
    <script src="https://unpkg.com/lucide@latest"></script>

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
                <a href="#" target="_self">Produtos</a>
                <a href="#" target="_self">Anotações</a>
                <a href="#" target="_self">Relatórios</a>
                <a href="#" target="_self">Configurações</a>
            </nav>

            <div class="nav-actions">
                <a href="#" class="login-btn">Login</a>
                <button class="start-btn">Começar</button>
            </div>
        </header>

        <section class="dashboard-content">

            <div class="toolbar">
                <div class="search-box">
                    <i data-lucide="search"></i>
                    <input type="text" placeholder="Pesquisar produtos...">
                </div>

                <div class="action-buttons">
                    <button class="btn-primary">
                        <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Adicionar
                    </button>
                    <button class="btn-secondary">
                        <i data-lucide="filter" style="width: 14px; height: 14px;"></i> Filtros
                    </button>

                    <div class="view-toggles">
                        <button class="view-btn active"><i data-lucide="align-justify" style="width: 16px; height: 16px;"></i></button>
                        <button class="view-btn"><i data-lucide="layout-grid" style="width: 16px; height: 16px;"></i></button>
                    </div>
                </div>
            </div>

            <div class="product-list">

                <div class="product-row">
                    <div class="product-image"><i data-lucide="monitor"></i></div>
                    <div class="product-info">
                        <h3 class="product-name">Apple iMac 27"</h3>
                        <div class="label-tiny">Categoria</div>
                        <span class="product-category">PC/Desktop PC</span>
                    </div>
                    <div class="product-stats">
                        <div class="stat-block">
                            <span class="label-tiny">Preço</span>
                            <span class="stat-value">$2999</span>
                        </div>
                        <div class="stat-block">
                            <span class="label-tiny">Estoque</span>
                            <span class="stat-value">300</span>
                        </div>
                        <div class="stat-block">
                            <span class="label-tiny">Vendas</span>
                            <span class="stat-value">466</span>
                        </div>
                    </div>
                    <div class="action-menu-wrapper">
                        <button class="btn-icon action-toggle"><i data-lucide="more-horizontal"></i></button>

                        <div class="action-dropdown">
                            <button class="dropdown-item">
                                <i data-lucide="eye"></i> Visualizar
                            </button>
                            <button class="dropdown-item">
                                <i data-lucide="edit"></i> Editar
                            </button>
                            <button class="dropdown-item danger">
                                <i data-lucide="trash-2"></i> Remover
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-row">
                    <div class="product-image"><i data-lucide="gamepad-2"></i></div>
                    <div class="product-info">
                        <h3 class="product-name">Xbox Series S</h3>
                        <div class="label-tiny">Categoria</div>
                        <span class="product-category">Gaming/Console</span>
                    </div>
                    <div class="product-stats">
                        <div class="stat-block">
                            <span class="label-tiny">Preço</span>
                            <span class="stat-value">$299</span>
                        </div>
                        <div class="stat-block">
                            <span class="label-tiny">Estoque</span>
                            <span class="stat-value">56</span>
                        </div>
                        <div class="stat-block">
                            <span class="label-tiny">Vendas</span>
                            <span class="stat-value">3040</span>
                        </div>
                    </div>
                    <button class="btn-icon"><i data-lucide="more-horizontal"></i></button>
                </div>

                <div class="product-row">
                    <div class="product-image"><i data-lucide="monitor-speaker"></i></div>
                    <div class="product-info">
                        <h3 class="product-name">Monitor BenQ EX2710Q</h3>
                        <div class="label-tiny">Categoria</div>
                        <span class="product-category">TV/Monitor</span>
                    </div>
                    <div class="product-stats">
                        <div class="stat-block">
                            <span class="label-tiny">Preço</span>
                            <span class="stat-value">$499</span>
                        </div>
                        <div class="stat-block">
                            <span class="label-tiny">Estoque</span>
                            <span class="stat-value">354</span>
                        </div>
                        <div class="stat-block">
                            <span class="label-tiny">Vendas</span>
                            <span class="stat-value">76</span>
                        </div>
                    </div>
                    <button class="btn-icon"><i data-lucide="more-horizontal"></i></button>
                </div>

                <div class="product-row">
                    <div class="product-image"><i data-lucide="smartphone"></i></div>
                    <div class="product-info">
                        <h3 class="product-name">Apple iPhone 14</h3>
                        <div class="label-tiny">Categoria</div>
                        <span class="product-category">Phone</span>
                    </div>
                    <div class="product-stats">
                        <div class="stat-block">
                            <span class="label-tiny">Preço</span>
                            <span class="stat-value">$999</span>
                        </div>
                        <div class="stat-block">
                            <span class="label-tiny">Estoque</span>
                            <span class="stat-value">1237</span>
                        </div>
                        <div class="stat-block">
                            <span class="label-tiny">Vendas</span>
                            <span class="stat-value">2000</span>
                        </div>
                    </div>
                    <button class="btn-icon"><i data-lucide="more-horizontal"></i></button>
                </div>

            </div>

            <div class="pagination-area">
                <span class="pagination-text">Mostrando <strong>1</strong> a <strong>4</strong> de <strong>100</strong> registros</span>
                <div class="pagination-controls">
                    <button class="btn-secondary" style="padding: 0.5rem 1rem;">Anterior</button>
                    <button class="btn-secondary" style="padding: 0.5rem 1rem;">Próximo</button>
                </div>
            </div>

        </section>


    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const logoToggle = document.getElementById('logoToggle');
            const navMenu = document.getElementById('navMenu');

            logoToggle.addEventListener('click', () => {
                navMenu.classList.toggle('active');
            });
        });

        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', () => {
            // Pega todos os botões que abrem o menu de ações
            const toggleButtons = document.querySelectorAll('.action-toggle');

            toggleButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    // Impede que o clique se propague e ative o fechamento global imediatamente
                    event.stopPropagation();

                    const dropdown = button.nextElementSibling; // Pega a div .action-dropdown logo abaixo do botão

                    // Fecha todos os outros menus antes de abrir este (para não ficar com vários abertos)
                    document.querySelectorAll('.action-dropdown.show').forEach(menu => {
                        if (menu !== dropdown) {
                            menu.classList.remove('show');
                        }
                    });

                    // Alterna a visibilidade do menu clicado
                    dropdown.classList.toggle('show');
                });
            });

            // Fecha o menu se o usuário clicar em qualquer outro lugar da tela
            document.addEventListener('click', (event) => {
                document.querySelectorAll('.action-dropdown.show').forEach(menu => {
                    menu.classList.remove('show');
                });
            });
        });
    </script>
</body>

</html>