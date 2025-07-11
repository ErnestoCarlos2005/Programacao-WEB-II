<?php
require 'conexao.php';

$cpf = $_POST['cpf'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$cargo = $_POST['cargo'] ?? '';
$funcao = $_POST['funcao'] ?? '';
$login = $_POST['login'] ?? '';
$senha = $_POST['senha'] ?? '';


if (!$cpf || !$login || !$senha) {
    die('Preencha todos os campos obrigatórios!');
}

try {
    // Verifica se pessoa existe
    $stmt = $pdo->prepare("SELECT cpf FROM pessoa_fisica WHERE cpf = :cpf");
    $stmt->execute([':cpf' => $cpf]);
    if (!$stmt->fetch()) {
        die('Pessoa não encontrada! Não é possível cadastrar usuário.');
    }

    // Verifica duplicidade
    $stmt = $pdo->prepare("SELECT id FROM usuario WHERE cpf = :cpf");
    $stmt->execute([':cpf' => $cpf]);
    if ($stmt->fetch()) {
        die('Usuário já cadastrado!');
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario 
            (cpf, endereco, cargo, funcao, login, senha) 
            VALUES 
            (:cpf, :endereco, :cargo, :funcao, :login, :senha)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':cpf' => $cpf,
        ':endereco' => $endereco,
        ':cargo' => $cargo,
        ':funcao' => $funcao,
        ':login' => $login,
        ':senha' => $senha_hash,
    ]);


    echo "Usuário cadastrado com sucesso! <a href='cadastro_usuario.html'>Voltar</a>";

} catch (PDOException $e) {
    echo "Erro ao cadastrar usuário: " . $e->getMessage();
}
?>
