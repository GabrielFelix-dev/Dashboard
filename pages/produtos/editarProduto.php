<?php
require('../../conn.php');
require('../../auth.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="../../assets/css/add.css">
    <link rel="stylesheet" href="../../assets/css/sms.css">

</head>

<body>
    <?php include '../sms.php' ?>

    <main class="main-container">
        <header class="page-header">
            <a href="../painel.php" class="btn-icon-text" style="text-decoration: none;">
                <i data-lucide="arrow-left"></i> Voltar para Produtos
            </a>

            <h1 class="page-title">Editar Produto</h1>
        </header>

        <form class="product-form" action="../../actions.php" method="POST">

            <?php

            $id_produto = $_GET['id_produto']; 
            $usuario_id = $_SESSION['usuario_id']; 

            $sql = "SELECT * FROM produto WHERE id_produto = :id_produto AND id_usuario_fk = :usuario_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":usuario_id", $usuario_id);
            $stmt->bindParam(":id_produto", $id_produto);
            $stmt->execute();

            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($produtos) > 0) {
                foreach ($produtos as $produto):
            ?>

                    <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">

                    <div class="form-grid">
                        <div class="form-section">
                            <label class="form-label">Imagem do Produto</label>
                            <div class="upload-area">
                                <i data-lucide="image-plus"></i>
                                <span>Arraste uma imagem ou clique para fazer upload</span>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-group">
                                <label class="form-label" for="produtoNome">Nome do Produto</label>
                                <input type="text" id="produtoNome" name="nome_produto" class="form-input" value="<?= htmlspecialchars($produto['nome_produto']) ?>">
                            </div>

                            <div class="form-row">
                                <div class="form-group" style="grid-column: span 2;">
                                    <label class="form-label" for="categoria">Categoria</label>
                                    <select name="categoria" id="categoria" class="form-input">
                                        <option value="PC/Desktop PC" <?= ($produto['categoria'] == 'PC/Desktop PC') ? 'selected' : '' ?>>PC/Desktop PC</option>
                                        <option value="Gaming/Console" <?= ($produto['categoria'] == 'Gaming/Console') ? 'selected' : '' ?>>Gaming/Console</option>
                                        <option value="TV/Monitor" <?= ($produto['categoria'] == 'TV/Monitor') ? 'selected' : '' ?>>TV/Monitor</option>
                                        <option value="Smartphone" <?= ($produto['categoria'] == 'Smartphone') ? 'selected' : '' ?>>Smartphone</option>
                                        <option value="Outro" <?= ($produto['categoria'] == 'Outro') ? 'selected' : '' ?>>Outro</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="preco">Preço ($)</label>
                                    <input type="number" id="preco" name="preco" class="form-input" value="<?= htmlspecialchars($produto['preco']) ?>" step="0.001">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="estoque">Estoque</label>
                                    <input type="number" id="estoque" name="estoque" class="form-input" value="<?= htmlspecialchars($produto['estoque']) ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="descricao">Descrição</label>
                                <textarea id="descricao" name="descricao" class="form-input textarea"><?= htmlspecialchars($produto['descricao']) ?></textarea>
                            </div>

                        </div>
                    </div>
            <?php
                endforeach;
            } else {
                echo "<p style='padding: 2rem; text-align: center; color: #666;'>Produto não encontrado ou sem permissão.</p>";
            }
            ?>

            <div class="form-actions">
                <button type="submit" name="editProduto" class="btn-primary">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i> Atualizar Produto
                </button>
            </div>

        </form>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>