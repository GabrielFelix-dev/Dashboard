<?php 

require('../../conn.php');
require('../../auth.php');

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Anotação</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <link rel="stylesheet" href="../../assets/css/add.css">
    <link rel="stylesheet" href="../../assets/css/sms.css"></head>

<body>

    <main class="main-container">
        
        <header class="page-header">
            <a href="../painel.php" class="btn-icon-text" style="text-decoration: none;">
                <i data-lucide="arrow-left"></i> Voltar para Anotações
            </a>
            <h1 class="page-title">Criar Nova Anotação</h1>
        </header>

        <form class="product-form" action="../../actions.php" method="POST">

            <div class="form-section">
                
                <div class="form-group">
                    <label class="form-label" for="titulo">Título da Anotação</label>
                    <input type="text" id="titulo" name="titulo" class="form-input" placeholder="Ex: Reunião de alinhamento" required>
                </div>

                <div class="form-row-3">
                    
                    <div class="form-group">
                        <label class="form-label" for="dataPublicacao">Data</label>
                        <input type="date" id="dataPublicacao" name="data_publicacao" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="tipo">Tipo</label>
                        <select id="tipo" name="tipo" class="form-input" required>
                            <option value="" disabled selected>Selecione uma categoria...</option>
                            <option value="geral">Geral</option>
                            <option value="academico">Estoque</option>
                            <option value="projeto">Comercial</option>
                            <option value="projeto">Problema/Aviso</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tag">Tag Principal</label>
                        <input type="text" id="tag" name="tag" class="form-input" placeholder="Ex: Reunião, Apresentação..." required>
                    </div>
                    
                </div>

                <div class="form-group">
                    <label class="form-label" for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-input textarea" placeholder="Escreva todos os detalhes, links e referências importantes da sua anotação aqui..." style="min-height: 200px;" required></textarea>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" name="cadastrarAnotacao" class="btn-primary">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i> Salvar Anotação
                </button>
            </div>

        </form>

    </main>

    <script>
        lucide.createIcons();
        
    </script>
</body>
</html>