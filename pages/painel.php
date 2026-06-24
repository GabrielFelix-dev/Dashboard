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
    <script src="../assets/js/painel.js" defer></script>

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
                <a href="#Produtos" target="_self">Produtos</a>
                <a href="#Anotacoes" target="_self">Anotações</a>
            </nav>

            <div class="nav-actions">
                <a href="#" class="login-btn"><i data-lucide="circle-user-round"></i> </a>
                <a href="usuario/logout.php" class="start-btn">Sair</a>
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
                    <a href="produtos/addProduto.php" class="btn-primary">
                        <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Adicionar
                    </a>
                    <button class="btn-secondary">
                        <i data-lucide="filter" style="width: 14px; height: 14px;"></i> Filtros
                    </button>
                </div>
            </div>

            <!-- INICIO LISTAGEM DE PRODUTOS -->
            <div class="product-list" id="Produtos">
                <?php
                $usuario_id = $_SESSION['usuario_id'];

                // calcular inicio visualização
                $itens_por_pagina = 4;
                $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                $inicio = ($pagina_atual - 1) * $itens_por_pagina;

                $sql = "SELECT * FROM produto WHERE id_usuario_fk = :usuario_id ORDER BY id_produto DESC LIMIT :inicio, :itens_por_pagina";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam("usuario_id", $usuario_id);
                $stmt->bindParam("inicio", $inicio, PDO::PARAM_INT);
                $stmt->bindParam("itens_por_pagina", $itens_por_pagina, PDO::PARAM_INT);

                $stmt->execute();

                $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($produtos) > 0) {
                    foreach ($produtos as $produtos):

                ?>

                        <div class="product-row">
                            <!-- IMAGEM -->
                            <div class="product-image">
                                <i data-lucide="image"></i>
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
                                    <span class="stat-value">R$<?php echo $produtos['preco']; ?></span>
                                </div>
                                <div class="stat-block">
                                    <span class="label-tiny">Estoque</span>
                                    <span class="stat-value"><?php echo $produtos['estoque']; ?> und</span>
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

                                    <!-- BOTÃO VISUALIZAR -->
                                    <a href="produtos/visualizarProduto.php?id_produto=<?= $produtos['id_produto'] ?>" class="dropdown-item">
                                        <i data-lucide="eye"></i> Visualizar
                                    </a>

                                    <!-- BOTÃO EDITAR -->
                                    <a href="produtos/editarProduto.php?id_produto=<?= $produtos['id_produto'] ?>" class="dropdown-item">
                                        <i data-lucide="edit"></i> Editar
                                    </a>

                                    <!-- BOTÃO REMOVER -->
                                    <a href="produtos/removerProduto.php?id_produto=<?= $produtos['id_produto'] ?>" class="dropdown-item danger">
                                        <i data-lucide="trash-2"></i> Remover
                                    </a>

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
            <?php
            // calcular total de produtos para paginação
            $sql_total = "SELECT COUNT(*) FROM produto WHERE id_usuario_fk = :usuario_id";
            $stmt_total = $conn->prepare($sql_total);
            $stmt_total->bindParam("usuario_id", $_SESSION['usuario_id'], PDO::PARAM_INT);
            $stmt_total->execute();
            $total_produtos = $stmt_total->fetchColumn();

            $total_paginas = ceil($total_produtos / $itens_por_pagina);
            ?>
            <!-- área de paginação -->
            <div class="pagination-area">
                <span class="pagination-text">
                    Mostrando <strong><?php echo $total_produtos > 0 ? $inicio + 1 : 0; ?></strong> a
                    <strong><?php echo min($inicio + $itens_por_pagina, $total_produtos); ?></strong> de
                    <strong><?php echo $total_produtos; ?></strong> registros
                </span>

                <div class="pagination-controls">

                    <?php if ($pagina_atual > 1): ?>
                        <a href="?pagina=<?php echo $pagina_atual - 1; ?>" class="btn-secondary" style="padding: 0.5rem 1rem; text-decoration: none;">Anterior</a>
                    <?php else: ?>
                        <button class="btn-secondary" style="padding: 0.5rem 1rem;" disabled>Anterior</button>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <?php if ($i == $pagina_atual): ?>
                            <button class="btn-primary" style="padding: 0.5rem 1rem;" disabled><?php echo $i; ?></button>
                        <?php else: ?>
                            <a href="?pagina=<?php echo $i; ?>" class="btn-secondary" style="padding: 0.5rem 1rem; text-decoration: none;"><?php echo $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($pagina_atual < $total_paginas): ?>
                        <a href="?pagina=<?php echo $pagina_atual + 1; ?>" class="btn-secondary" style="padding: 0.5rem 1rem; text-decoration: none;">Próximo</a>
                    <?php else: ?>
                        <button class="btn-secondary" style="padding: 0.5rem 1rem;" disabled>Próximo</button>
                    <?php endif; ?>

                </div>
            </div>
            <!-- FIM LISTAGEM DE PRODUTOS -->


            <!-- INICIO ANOTAÇÕES -->
            <div class="notes-area" id="Anotacoes">
                <!-- toobar -->
                <div class="toolbar">
                    <!-- pesquisa -->
                    <div class="search-box">
                        <i data-lucide="search"></i>
                        <input type="text" placeholder="Pesquisar nas anotações...">
                    </div>
                    <!-- Adicionar e filtro -->
                    <div class="action-buttons">
                        <a href="addAnotacao.php">
                            <button class="btn-primary">
                                <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Nova Anotação
                            </button>
                        </a>
                        <button class="btn-secondary">
                            <i data-lucide="filter" style="width: 14px; height: 14px;"></i> Etiquetas
                        </button>
                    </div>
                </div>

                <!-- CARDS Anotações -->
                <div class="notes-grid">

                    <?php

                    $usuario_id = $_SESSION["usuario_id"];

                    $sql = "SELECT * FROM anotacoes WHERE id_usuario_fk = :usuario_id ";

                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":usuario_id", $usuario_id);
                    $stmt->execute();

                    $anotacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($anotacoes) > 0) {
                        foreach ($anotacoes as $anotacao):
                    ?>

                            <div class="note-card">
                                <div class="note-header">
                                    <div class="note-title-group">
                                        <h3 class="note-title"><?php echo $anotacao['titulo'] ?></h3>
                                        <span class="note-meta"><?php echo $anotacao['data_publicacao'], " • ", $anotacao['tipo'] ?></span>
                                    </div>

                                    <!-- AÇÕES -->
                                    <div class="action-menu-wrapper">
                                        <button class="btn-icon action-toggle"><i data-lucide="more-horizontal"></i></button>
                                        <div class="action-dropdown">

                                            
                                            <!-- Visualizar -->
                                            <a href="anotacoes/visualizarAnotacao.php?id_anotacao=<?= $anotacao['id_anotacao'] ?>" style="text-decoration: none;">
                                                <button class="dropdown-item"><i data-lucide="eye"></i> Visualizar</button>
                                            </a>

                                            <!-- EDITAR -->
                                            <a href="anotacoes/editarAnotacao.php?id_anotacao=<?= $anotacao['id_anotacao'] ?>" style="text-decoration: none;">
                                                <button class="dropdown-item"><i data-lucide="edit"></i> Editar</button>
                                            </a>

                                            <!-- REMOVER -->
                                            <a href="anotacoes/removeAnotacao.php?id_anotacao=<?= $anotacao['id_anotacao'] ?>" style="text-decoration: none;">
                                                <button class="dropdown-item danger"><i data-lucide="trash-2"></i> Excluir</button>
                                            </a>

                                        </div>
                                    </div>
                                </div>

                                <p class="note-body"><?php echo $anotacao['descricao'] ?></p>

                                <div class="note-tags">
                                    <span class="tag tag-blue"><?php echo $anotacao['tag'] ?></span>
                                </div>
                            </div>

                    <?php
                        endforeach;
                    } else {
                        echo "<p style='padding: 2rem; text-align: center; color: #666;'>Nenhuma anotação encontrada. Clique em 'Nova Anotação' para cadastrar.</p>";
                    }
                    ?>



                </div>

            </div>
            <!-- INICIO ANOTAÇÕES -->



        </section>
        <!-- FIM SECTION -->

    </main>


</body>

</html>