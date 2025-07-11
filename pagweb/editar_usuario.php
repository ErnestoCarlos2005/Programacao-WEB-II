<?php
require_once 'conexao.php';

if (!isset($_GET['cpf'])) {
    die('CPF não informado.');
}

$cpf = $_GET['cpf'];

$sql = "SELECT * FROM usuario WHERE cpf = :cpf";
$stmt = $pdo->prepare($sql);
$stmt->execute([':cpf' => $cpf]);
$usuario = $stmt->fetch();

if (!$usuario) {
    die('Usuário não encontrado.');
}
?>
<style>
    body {
        background-color: #ffbd5b;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    h2 {
        font-size: 24px;
        color: #002147;
        padding: 20px;
        margin-bottom: 30px;
        border-bottom: 2px solid #002147;
        text-align: center;
    }

    form {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        box-sizing: border-box;
    }

    form label {
        font-weight: bold;
        color: #002147;
        margin-bottom: 5px;
        display: block;
    }

    form input[type="text"],
    form input[type="password"],
    form select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
    }

    form input[type="checkbox"] {
        margin-right: 8px;
    }

    h3 {
        font-size: 18px;
        font-weight: bold;
        color: #002147;
        margin-top: 10px;
    }

    button[type="submit"] {
        padding: 12px 20px;
        background-color: #002147;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: fit-content;
        justify-self: end;
    }

    button[type="submit"]:hover {
        background-color: #004080;
    }
</style>

<h2>Editar Usuário: <?php echo htmlspecialchars($usuario['login']); ?></h2>

<form method="POST" action="processar_edicao_usuario.php">
    <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">

<label>Endereço:</label>
    <input type="text" name="endereco" placeholder="Novo Endereço"
           value="<?= htmlspecialchars($usuario['endereco'] ?? '') ?>">

    <label>Cargo:</label>
    <input type="text" name="cargo" placeholder="Novo Cargo"
           value="<?= htmlspecialchars($usuario['cargo'] ?? '') ?>">

    <label>Função:</label>
    <input type="text" name="funcao" placeholder="Nova Função"
           value="<?= htmlspecialchars($usuario['funcao'] ?? '') ?>">

    <label>Login:</label>
    <input type="text" name="login" placeholder="Novo Login"
           value="<?= htmlspecialchars($usuario['login'] ?? '') ?>">

    <label>Senha:</label>
    <input type="password" name="senha" placeholder="Nova Senha">
    <!-- Obs: Senha normalmente não é exibida por segurança -->

    <label>Ativo:</label>
    <select name="ativo">
        <option value="">Não alterar</option>
        <option value="1" <?php if ($usuario['ativo']) echo 'selected'; ?>>Ativo</option>
        <option value="0" <?php if (!$usuario['ativo']) echo 'selected'; ?>>Inativo</option>
    </select>

    <button type="submit">Salvar Alterações</button>
</form>
