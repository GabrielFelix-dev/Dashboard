<?php
require '../conn.php';
include '../auth.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/painel.css">
    <link rel="stylesheet" href="../assets/css/sms.css">

    <script src="https://unpkg.com/lucide@latest"></script>

</head>

<body>


    <?php include 'sms.php' ?>
    <main class="main-app">
        <!-- COMEÇO HEADER -->
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
                <a href="#" class="login-btn"><i data-lucide="circle-user-round"></i> </a>
                <a href="logout.php" class="start-btn">Sair</a>
            </div>
        </header>
        <!-- FIM HEADER -->

        <!-- COMEÇO SECTION -->
        <section class="dashboard-content">
            <!-- toobar -->
            <div class="toolbar">
                <!-- barra de pesquisa -->
                <div class="search-box">
                    <i data-lucide="search"></i>
                    <input type="text" placeholder="Pesquisar produtos...">
                </div>
                <!-- botões adicionar e filtar -->
                <div class="action-buttons">
                    <a href="add.php" class="btn-primary">
                        <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Adicionar
                    </a>
                    <button class="btn-secondary">
                        <i data-lucide="filter" style="width: 14px; height: 14px;"></i> Filtros
                    </button>
                </div>
            </div>

            <!-- LISTAGEM DE PRODUTOS -->
            <div class="product-list">
                <?php
                $usuario_id = $_SESSION['usuario_id'];

                $sql = "SELECT * FROM produto WHERE id_usuario_fk = $usuario_id";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($produtos) > 0) {
                    foreach ($produtos as $produtos):

                ?>
                        <!-- teste <pre style="background: #fff; color: red; padding: 10px;">
                            Caminho no banco: <?php var_dump($produtos['imagem_url']); ?>
                        </pre> -->

                        <div class="product-row">
                            <!-- IMAGEM -->
                            <div class="product-image">
                                <?php
                                $caminho_corrigido = '../' . $produtos['imagem_url'];
                                // Verifica se o campo de imagem não está vazio e se o arquivo existe no caminho corrigido
                                if (!empty($produtos['imagem_url']) && file_exists($caminho_corrigido)):
                                ?>
                                    <img src="<?php echo htmlspecialchars($caminho_corrigido); ?>" alt="Imagem do Produto" style="max-width: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <i class="fa-solid fa-image fa-3x" style="color: #cccccc;"></i>
                                <?php endif; ?>
                            </div>

                            <!-- NOME E CATEGORIA -->
                            <div class="product-info">
                                <h3 class="product-name"><?php echo $produtos['nome_produto']; ?></h3>
                                <div class="label-tiny">Categoria</div>
                                <span class="product-category"><?php echo $produtos['categoria']; ?></span>
                            </div>

                            <!-- PREÇO, ESTOQUE E DESCRIÇÃO -->
                            <div class="product-stats">
                                <div class="stat-block">
                                    <span class="label-tiny">Preço</span>
                                    <span class="stat-value"><?php echo $produtos['preco']; ?></span>
                                </div>
                                <div class="stat-block">
                                    <span class="label-tiny">Estoque</span>
                                    <span class="stat-value"><?php echo $produtos['estoque']; ?></span>
                                </div>
                                <div class="stat-block">
                                    <span class="label-tiny">Descrição</span>
                                    <span class="stat-value"><?php echo $produtos['descricao']; ?></span>
                                </div>

                            </div>

                            <!-- OPÇÕES (edit, view, remove) -->
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
                <?php
                    endforeach;
                } else {
                    echo "<p style='padding: 2rem; text-align: center; color: #666;'>Nenhum produto encontrado. Clique em 'Adicionar' para cadastrar seu primeiro produto.</p>";
                }
                ?>
            </div>
            <!-- PAGINAS -->
            <div class="pagination-area">
                <span class="pagination-text">Mostrando <strong>1</strong> a <strong>4</strong> de <strong>100</strong> registros</span>
                <div class="pagination-controls">
                    <button class="btn-secondary" style="padding: 0.5rem 1rem;">Anterior</button>
                    <button class="btn-secondary" style="padding: 0.5rem 1rem;">Próximo</button>
                </div>
            </div>

        </section>
        <!-- FIM SECTION -->

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