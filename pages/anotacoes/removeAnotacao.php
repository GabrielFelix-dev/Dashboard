<?php

require('../../conn.php');
require('../../auth.php');

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Anotação</title>

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
            <h1 class="page-title">Tem certeza que deseja remover esta anotação?</h1>
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
                        <div class="form-group">
                            <label class="form-label" for="titulo">Título da Anotação</label>
                            <input type="text" id="titulo" name="titulo" class="form-input" value="<?= htmlspecialchars($anotacao['titulo']) ?>" readonly>
                        </div>

                        <div class="form-row-3">

                            <div class="form-group">
                                <label class="form-label" for="dataPublicacao">Data de Publicação</label>
                                <input id="dataPublicacao" name="data_publicacao" class="form-input" value="<?= htmlspecialchars($anotacao['data_publicacao']) ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="tipo">Tipo</label>
                                <select id="tipo" name="tipo" class="form-input" disabled>
                                    <option value="" selected><?= htmlspecialchars($anotacao['tipo']) ?></option>
                                    <option value="Geral">Geral</option>
                                    <option value="Academico">Estoque</option>
                                    <option value="Projeto">Comercial</option>
                                    <option value="Problema/Aviso">Problema/Aviso</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="tag">Tag Principal</label>
                                <input type="text" id="tag" name="tag" class="form-input" value="<?= htmlspecialchars($anotacao['tag']) ?>" readonly>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="form-label" for="descricao">Descrição</label>
                            <textarea id="descricao" name="descricao" class="form-input textarea" style="min-height: 200px;" readonly><?= htmlspecialchars($anotacao['descricao']) ?></textarea>
                        </div>

                <?php
                    endforeach;
                }
                ?>
            </div>

            <div class="form-actions">
                <button type="submit" name="removerAnotacao" class="btn-primary" style="background-color:red">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i> Remover Anotação
                </button>
            </div>

        </form>

    </main>

    <script>
        lucide.createIcons();
        
    </script>
</body>

</html>