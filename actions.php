<?php 
session_start();
require 'conn.php';

if(isset($_POST['criar_usuario'])) {
    
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";

    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);
    
    if($stmt->execute()) {
        // 1. Pega o ID numérico que o banco de dados acabou de gerar
        $novo_id = $conn->lastInsertId();
        
        // 2. Cria o "Crachá" de acesso (Auto-Login)
        $_SESSION['user_id'] = $novo_id;
        $_SESSION['email'] = $email;
        
        // 3. Salva a mensagem de Sucesso para exibir na próxima tela
        $_SESSION['sms'] = "Conta criada com sucesso! Bem-vindo.";

        header("Location: pages/painel.php");
        exit;
    } else {
        $_SESSION['sms'] = "Erro ao cadastrar usuário. Tente novamente.";        
        // E redirecionamos de volta para o formulário de cadastro
        header("Location: cadastro.php"); // Substitua pelo nome do seu arquivo de cadastro
        exit;
    }
    
}

if(isset($_POST['salvar'])){

    // --- INÍCIO DO MODO DEBUG ---
    echo "<pre>"; // A tag <pre> do HTML deixa o texto formatado e fácil de ler
    var_dump($_POST); // Mostra tudo o que veio do formulário
    echo "</pre>";
    //die("O script parou aqui para debug!"); // Mata a execução para o redirecionamento não acontecer
    // --- FIM DO MODO DEBUG ---
    
    $nome = trim($_POST['nome']);
    $preco = (int)$_POST['preco'];
    $estoque = (int) $_POST['estoque'];
    $categoria = trim($_POST['categoria']);
    $descricao = trim($_POST['descricao']);
    $imagem_url = null;

    // Verifica se o arquivo foi enviado e se não houve erros no upload
    if (isset($_FILES['imagem_produto']) && $_FILES['imagem_produto']['error'] === UPLOAD_ERR_OK) {
    
        // Pega a extensão do arquivo (ex: jpg, png) e converte para minúsculo
        $extensao = strtolower(pathinfo($_FILES['imagem_produto']['name'], PATHINFO_EXTENSION));
        
        // Define quais formatos são permitidos por segurança
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($extensao, $extensoes_permitidas)) {
            
            // Gera um nome único e aleatório para a imagem (Evita substituir arquivos com o mesmo nome)
            $novo_nome = uniqid('produto_') . '.' . $extensao;
            
            // Define a pasta onde a imagem será salva
            $diretorio_destino = 'uploads/'; 
            $caminho_completo = $diretorio_destino . $novo_nome;

            // Move o arquivo da memória temporária do servidor para a pasta definitiva
            if (move_uploaded_file($_FILES['imagem_produto']['tmp_name'], $caminho_completo)) {
                // Sucesso! A variável que vai pro banco de dados recebe o caminho do arquivo
                $imagem_url = $caminho_completo;
            } else {
                die("Erro ao salvar a imagem na pasta do servidor.");
            }
            
        } else {
            die("Formato de imagem inválido. Use apenas JPG, PNG ou WEBP.");
        }
    }

    $sql = "INSERT INTO dashboard (nome_produto, preco, estoque, categoria, descricao, imagem_url) VALUES (:nome_produto, :preco, :estoque, :categoria, :descricao, :imagem_url)";

    $stmt = $conn->prepare($sql);

    // Vinculando as variáveis do PHP aos apelidos da Query
    $stmt->bindParam(':nome', $nome_produto);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque, PDO::PARAM_INT);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':imagem_url', $imagem_url); 

    if($stmt->execute()) {
        header("Location: painel.php");
        exit;
    } else {
        echo "Erro ao cadastrar!";
    }


}

?>