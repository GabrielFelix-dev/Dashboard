<?php
require('../../conn.php');
require('../../auth.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="../../assets/css/add.css">
    <link rel="stylesheet" href="../../assets/css/sms.css">

</head>

<body>
    <?php include '../sms.php' ?>

    <main class="main-container">

        <header class="page-header">
            <a href="../painel.php">
                <button class="btn-icon-text">
                    <i data-lucide="arrow-left"></i> Voltar para Produtos
                </button>
            </a>

            <h1 class="page-title">Adicionar Novo Produto</h1>
        </header>

        <form class="product-form" action="../../actions.php" enctype="multipart/form-data" method="POST">

            <div class="form-grid">

                <!-- imagem -->
                <div class="form-section">
                    <label class="form-label">Imagem do Produto</label>
                    <div class="upload-area">
                        <i data-lucide="image-plus"></i>
                        <span>Arraste uma imagem ou clique para fazer upload</span>

                    </div>
                </div>

                <div class="form-section">

                    <!-- NOME -->
                    <div class="form-group">
                        <label class="form-label" for="produtoNome">Nome do Produto</label>
                        <input type="text" id="produtoNome" name="nome_produto" class="form-input" placeholder="Ex: Apple iMac 27&quot;" required>
                    </div>

                    <div class="form-row">
                        <!-- CATEGORIA -->
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label" for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-input" required>
                                <option value="" disabled selected>Selecione uma categoria...</option>
                                <option value="PC/Desktop PC">PC/Desktop PC</option>
                                <option value="Gaming/Console">Gaming/Console</option>
                                <option value="TV/Monitor">TV/Monitor</option>
                                <option value="Smartphone">Smartphone</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                        <!-- PREÇO -->
                        <div class="form-group">
                            <label class="form-label" for="preco">Preço ($)</label>
                            <input type="number" id="preco" name="preco" class="form-input" placeholder="0.00" step="0.001" required>
                        </div>
                        <!-- ESTOQUE -->
                        <div class="form-group">
                            <label class="form-label" for="estoque">Estoque</label>
                            <input type="number" id="estoque" name="estoque" class="form-input" placeholder="0" required>
                        </div>
                    </div>
                    <!-- DESCRIÇÂO (opcional) -->
                    <div class="form-group">
                        <label class="form-label" for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-input textarea" placeholder="Insira os detalhes e especificações do produto..."></textarea>
                    </div>

                </div>
            </div>

            <!-- botões cadastra -->
            <div class="form-actions">
                <button type="submit" name="cadastraProduto" class="btn-primary">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i> Cadastrar Produto
                </button>
            </div>

        </form>

    </main>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>