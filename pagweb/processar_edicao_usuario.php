<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $endereco = $_POST['endereco'] ?? null;
    $cargo = $_POST['cargo'] ?? null;
    $funcao = $_POST['funcao'] ?? null;
    $login = $_POST['login'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $novo_status = $_POST['ativo'] ?? null;

    try {
        $pdo->beginTransaction();

        // Pega o status atual
        $stmt = $pdo->prepare("SELECT ativo FROM usuario WHERE id = :usuario_id");
        $stmt->execute([':usuario_id' => $usuario_id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            throw new Exception("Usuário não encontrado.");
        }

        $campos = [];
        $params = [':usuario_id' => $usuario_id];

        if (!empty($endereco)) {
            $campos[] = "endereco = :endereco";
            $params[':endereco'] = $endereco;
        }
        if (!empty($cargo)) {
            $campos[] = "cargo = :cargo";
            $params[':cargo'] = $cargo;
        }
        if (!empty($funcao)) {
            $campos[] = "funcao = :funcao";
            $params[':funcao'] = $funcao;
        }
        if (!empty($login)) {
            $campos[] = "login = :login";
            $params[':login'] = $login;
        }

        if (!empty($campos)) {
            $sql = "UPDATE usuario SET " . implode(', ', $campos) . " WHERE id = :usuario_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        }

        // Atualiza a senha se informada
        if (!empty($senha)) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuario SET senha = :senha WHERE id = :usuario_id");
            $stmt->execute([
                ':senha' => $senha_hash,
                ':usuario_id' => $usuario_id
            ]);
        }

        // Atualiza o status e histórico se mudou
        if (!is_null($novo_status) && $usuario['ativo'] != $novo_status) {
            mudarStatusUsuario($pdo, $usuario_id, $novo_status);
        }

        $pdo->commit();
        echo "Usuário atualizado com sucesso!";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Requisição inválida.";
}

function mudarStatusUsuario(PDO $pdo, int $usuario_id, int $novo_status) {
    // Atualiza status
    $stmt = $pdo->prepare("UPDATE usuario SET ativo = :novo_status WHERE id = :usuario_id");
    $stmt->execute([
        ':novo_status' => $novo_status,
        ':usuario_id' => $usuario_id
    ]);

    // Fecha status atual
    $stmt = $pdo->prepare("UPDATE usuario_status_historico 
                           SET data_fim = NOW()
                           WHERE usuario_id = :usuario_id AND data_fim IS NULL");
    $stmt->execute([':usuario_id' => $usuario_id]);

    // Insere novo
    $stmt = $pdo->prepare("INSERT INTO usuario_status_historico 
                           (usuario_id, status, data_inicio) 
                           VALUES (:usuario_id, :status, NOW())");
    $stmt->execute([
        ':usuario_id' => $usuario_id,
        ':status' => $novo_status
    ]);
}
?>
