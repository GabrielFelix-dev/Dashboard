<?php
session_start();
require 'conn.php';

if (isset($_POST['criar_usuario'])) {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);

    if ($stmt->execute()) {
        // 1. Pega o ID numérico que o banco de dados acabou de gerar
        $novo_id = $conn->lastInsertId();

        // 2. Cria o "Crachá" de acesso (Auto-Login)
        $_SESSION['usuario_id'] = $novo_id;
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

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT id_usuario, nome, email, senha FROM usuario WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $dados = $stmt->fetch(PDO::FETCH_ASSOC); // salva na varável 'dados' tudo que foi puxado do db

        // verificação de senha correta
        if (password_verify($senha, $dados['senha'])) {
            $_SESSION['usuario_id'] = $dados['id_usuario']; // cria uma SESSION que vai receber $dados['id']
            $_SESSION['usuario_nome'] = $dados['nome'];
            $_SESSION['sms'] = "Bem vindo!";
            header("Location: pages/painel.php");
            exit();
        } else {
            $_SESSION['sms'] = "Senha incorreta!";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['sms'] = "Usuário não encontrado";
        header("Location: index.php");
    }
}

if (isset($_POST['cadastraProduto'])) {

    $nome_produto = trim($_POST['nome_produto']);
    $preco = (int)$_POST['preco'];
    $estoque = (int) $_POST['estoque'];
    $categoria = trim($_POST['categoria']);
    $descricao = trim($_POST['descricao']);
    $imagem_url = null;
    $usuario_id = $_SESSION['usuario_id'];

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
            $_SESSION['sms'] = "Formato de imagem inválido. Use apenas JPG, PNG ou WEBP.";
        }
    }

    $sql = "INSERT INTO produto (nome_produto, preco, estoque, categoria, descricao, imagem_url, id_usuario_fk ) VALUES (:nome_produto, :preco, :estoque, :categoria, :descricao, :imagem_url, :usuario_id)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nome_produto', $nome_produto);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque, PDO::PARAM_INT);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':imagem_url', $imagem_url);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['sms'] = "Produto cadastrado com sucesso!";
        header("Location: pages/painel.php");
        exit();
    } else {
        $_SESSION['sms'] = "Erro ao cadastrar!";
    }
}

// --- INÍCIO DO MODO DEBUG ---
//echo "<pre>"; // A tag <pre> do HTML deixa o texto formatado e fácil de ler
//var_dump($_POST); // Mostra tudo o que veio do formulário
//echo "</pre>";
//die("O script parou aqui para debug!"); // Mata a execução para o redirecionamento não acontecer
// --- FIM DO MODO DEBUG ---
?>