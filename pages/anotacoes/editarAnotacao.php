<?php

require('../../conn.php');
require('../../auth.php');

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar anotação</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="../../assets/css/add.css">
    <link rel="stylesheet" href="../../assets/css/sms.css">
</head>

<body>

    <main class="main-container">

        <header class="page-header">
            <a href="../painel.php" class="btn-icon-text" style="text-decoration: none;">
                <i data-lucide="arrow-left"></i> Voltar para Anotações
            </a>
            <h1 class="page-title">Editar Anotação</h1>
        </header>

        <form class="product-form" action="../../actions.php" method="POST">

            <div class="form-section">

                <?php

                $id_anotacao = $_GET['id_anotacao'];

                $usuario_id = $_SESSION['usuario_id'];

                $sql = "SELECT * FROM anotacoes WHERE id_anotacao = :id_anotacao  AND id_usuario_fk = :usuario_id";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id_anotacao", $id_anotacao);
                $stmt->bindParam(":usuario_id", $usuario_id);

                $stmt->execute();

                $anotacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($anotacoes) > 0) {
                    foreach ($anotacoes as $anotacao):
                ?>

                        <input type="hidden" name="id_anotacao" value="<?= $anotacao['id_anotacao'] ?>">

                        <div class="form-group">
                            <label class="form-label" for="titulo">Título da Anotação</label>
                            <input type="text" id="titulo" name="titulo" class="form-input" value="<?= htmlspecialchars($anotacao['titulo']) ?>" required>
                        </div>

                        <div class="form-row-3">

                            <div class="form-group">
                                <label class="form-label" for="dataPublicacao">Data de Publicação</label>
                                <input id="dataPublicacao" name="data_publicacao" class="form-input" value="<?= htmlspecialchars($anotacao['data_publicacao']) ?>" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="tipo">Tipo</label>
                                <select id="tipo" name="tipo" class="form-input" required>
                                    <option value="" <?= empty($anotacao['tipo']) ? 'selected' : '' ?>>Selecione...</option>
                                    <option value="Geral" <?= ($anotacao['tipo'] == 'Geral') ? 'selected' : '' ?>>Geral</option>
                                    <option value="Estoque" <?= ($anotacao['tipo'] == 'Estoque') ? 'selected' : '' ?>>Estoque</option>
                                    <option value="Comercial" <?= ($anotacao['tipo'] == 'Comercial') ? 'selected' : '' ?>>Comercial</option>
                                    <option value="Problema" <?= ($anotacao['tipo'] == 'Problema') ? 'selected' : '' ?>>Problema/Aviso</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="tag">Tag Principal</label>
                                <input type="text" id="tag" name="tag" class="form-input" value="<?= htmlspecialchars($anotacao['tag']) ?>" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="form-label" for="descricao">Descrição</label>
                            <textarea id="descricao" name="descricao" class="form-input textarea" style="min-height: 200px;" required><?= htmlspecialchars($anotacao['descricao']) ?></textarea>
                        </div>

                <?php
                    endforeach;
                }
                ?>
            </div>

            <div class="form-actions">
                <button type="submit" name="editarAnotacao" class="btn-primary">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i> Editar Anotação
                </button>
            </div>

        </form>

    </main>

    <script>
        lucide.createIcons();
        
    </script>
</body>

</html>