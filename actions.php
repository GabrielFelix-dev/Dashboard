<?php
session_start();
require 'conn.php';

// Usuário
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
            $_SESSION['sms'] = "Bem vindo, " . $dados['nome'] . "!";
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

// CRUD Produto
if (isset($_POST['cadastraProduto'])) {

    $nome_produto = trim($_POST['nome_produto']);
    $preco = (int)$_POST['preco'];
    $estoque = (int) $_POST['estoque'];
    $categoria = trim($_POST['categoria']);
    $descricao = trim($_POST['descricao']);
    $imagem_url = null;
    $usuario_id = $_SESSION['usuario_id'];


    $sql = "INSERT INTO produto (nome_produto, preco, estoque, categoria, descricao, id_usuario_fk ) VALUES (:nome_produto, :preco, :estoque, :categoria, :descricao, :usuario_id)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nome_produto', $nome_produto);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque, PDO::PARAM_INT);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['sms'] = "Produto cadastrado com sucesso!";
        header("Location: pages/painel.php");
        exit();
    } else {
        $_SESSION['sms'] = "Erro ao cadastrar!";
    }
}

if (isset($_POST['editProduto'])) {

    $id_produto = $_POST['id_produto'];

    $nome_produto = trim($_POST['nome_produto']);
    $preco = $_POST['preco'];
    $estoque = (int)$_POST['estoque'];
    $categoria = trim($_POST['categoria']);
    $descricao = trim($_POST['descricao']);
    $usuario_id = $_SESSION['usuario_id'];

    $sql = "UPDATE produto SET nome_produto = :nome_produto, preco = :preco, estoque = :estoque, categoria = :categoria, descricao = :descricao, id_usuario_fk = :usuario_id WHERE id_produto = :id_produto";


    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->bindParam(':nome_produto', $nome_produto);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque, PDO::PARAM_INT);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);


    if ($stmt->execute()) {
        $_SESSION['sms'] = "Produto editado com sucesso!";
        header("Location: pages/painel.php");
        exit();
    } else {
        $_SESSION['sms'] = "Erro ao editar!";
    }
}

if (isset($_POST['removerProduto'])) {

    $id_produto = $_POST['id_produto'];

    $sql = "DELETE FROM produto WHERE id_produto = :id_produto";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['sms'] = "Produto removido com sucesso!";
        header("Location: pages/painel.php");
        exit();
    } else {
        $_SESSION['sms'] = "Erro ao remover!";
    }
}

// CRUD Anotações
if (isset($_POST['cadastrarAnotacao'])) {

    $titulo = trim($_POST['titulo']);
    $data_publicacao = $_POST['data_publicacao'];
    $tipo = trim($_POST['tipo']);
    $tag = trim($_POST['tag']);
    $descricao = trim($_POST['descricao']);
    $id_usuario = $_SESSION['usuario_id'];

    $sql = "INSERT INTO anotacoes (titulo, data_publicacao, tipo, tag, descricao, id_usuario_fk) VALUES (:titulo, :data_publicacao, :tipo, :tag, :descricao, :id_usuario)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':data_publicacao', $data_publicacao);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':tag', $tag);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['sms'] = "Anotação cadastrada com sucesso!";
        header("Location: pages/painel.php");
        exit();
    } else {
        $_SESSION['sms'] = "Erro ao cadastrar anotação!";
    }
}

if (isset($_POST['removerAnotacao'])) {

    $id_anotacao = $_POST['id_anotacao'];

    $sql = "DELETE FROM anotacoes WHERE id_anotacao = :id_anotacao";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_anotacao', $id_anotacao, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['sms'] = "Anotação removida com sucesso!";
        header("Location: pages/painel.php");
        exit();
    } else {
        $_SESSION['sms'] = "Erro ao remover!";
    }
}

if (isset($_POST['editarAnotacao'])) {

    $id_anotacao = $_POST['id_anotacao'];

    $titulo = trim($_POST['titulo']);
    $data_publicacao = $_POST['data_publicacao'];
    $tipo = trim($_POST['tipo']);
    $tag = trim($_POST['tag']);
    $descricao = trim($_POST['descricao']);
    $id_usuario = $_SESSION['usuario_id'];

    $sql = "UPDATE anotacoes SET titulo = :titulo, data_publicacao = :data_publicacao, tipo = :tipo, tag = :tag, descricao = :descricao, id_usuario_fk = :id_usuario WHERE id_anotacao = :id_anotacao";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_anotacao', $id_anotacao, PDO::PARAM_INT);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':data_publicacao', $data_publicacao);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':tag', $tag);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['sms'] = "Anotação editada com sucesso!";
        header("Location: pages/painel.php");
        exit();
    } else {
        $_SESSION['sms'] = "Erro ao editar anotação!";
        header("Location: pages/painel.php");
        exit();
    }
}
// TESTE
// --- INÍCIO DO MODO DEBUG ---
//echo "<pre>"; // A tag <pre> do HTML deixa o texto formatado e fácil de ler
//var_dump($_POST); // Mostra tudo o que veio do formulário
//echo "</pre>";
//die("O script parou aqui para debug!"); // Mata a execução para o redirecionamento não acontecer
// --- FIM DO MODO DEBUG ---
