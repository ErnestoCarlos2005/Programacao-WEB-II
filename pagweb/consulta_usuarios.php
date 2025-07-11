<?php
require_once 'conexao.php';

$filtro = $_GET['filtro'] ?? 'todos';
$data_inicio = $_GET['data_inicio'] ?? null;
$data_fim = $_GET['data_fim'] ?? null;
$exportar = $_GET['exportar'] ?? null;

// Construir consulta dinamicamente
$where = [];
$params = [];

// Filtro ativo/inativo
if ($filtro === 'ativos') {
    $where[] = "ativo = 1";
} elseif ($filtro === 'inativos') {
    $where[] = "ativo = 0";
}

$sql = "SELECT * FROM usuario";
if ($where) {
    $sql .= " WHERE " . implode(' AND ', $where);
}

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Consulta</title>
    <style>
        
    </style>
</head>
<body>
    <style>
    body {
        background-color: #ffbd5b;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        max-width: 1000px;
        margin: 0 auto;
    }

    h2 {
        font-size: 24px;
        color: #002147;
        margin-bottom: 20px;
        border-bottom: 2px solid #002147;
        padding-bottom: 10px;
    }

    p {
        font-size: 14px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table thead {
        background-color: #002147;
        color: white;
    }

    table th, table td {
        padding: 12px 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 15px;
        background-color: #ccc;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    a:hover {
        background-color: #bbb;
    }
</style>

<div class="container">
    <h2>Resultado da Consulta - <?= htmlspecialchars(ucfirst($filtro)) ?></h2>
    <?php if ($data_inicio || $data_fim): ?>
        <p>Período: <?= htmlspecialchars($data_inicio) ?> até <?= htmlspecialchars($data_fim) ?></p>
    <?php endif; ?>


    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>CPF</th>
                <th>Endereço</th>
                <th>Cargo</th>
                <th>Função</th>
                <th>Login</th>
                <th>Status</th>
                <th>Data cadastro do usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($usuarios): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id']) ?></td>
                        <td><?= htmlspecialchars($usuario['cpf']) ?></td>
                        <td><?= htmlspecialchars($usuario['endereco']) ?></td>
                        <td><?= htmlspecialchars($usuario['cargo']) ?></td>
                        <td><?= htmlspecialchars($usuario['funcao']) ?></td>
                        <td><?= htmlspecialchars($usuario['login']) ?></td>
                        <td><?= $usuario['ativo'] ? 'Ativo' : 'Inativo' ?></td>
                        <td><?= htmlspecialchars($usuario['data_cadastro']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">Nenhum usuário encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a href="consultar_usuario.html">Nova Consulta</a>
</div>
</body>
</html>
