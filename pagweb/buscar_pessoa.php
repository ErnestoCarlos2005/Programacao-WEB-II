<?php
require 'conexao.php';

$cpf = $_GET['cpf'] ?? '';

if (!$cpf) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'CPF não informado']);
    exit;
}

// Buscando apenas os campos que existem na tabela
$sql = "SELECT nome, cpf, email, dt_nascimento, ddd, celular, sexo FROM pessoa_fisica WHERE cpf = :cpf";
$stmt = $pdo->prepare($sql);
$stmt->execute([':cpf' => $cpf]);

$pessoa = $stmt->fetch(PDO::FETCH_ASSOC);

if ($pessoa) {
    echo json_encode(['sucesso' => true] + $pessoa);
} else {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Pessoa não encontrada']);
}
?>
