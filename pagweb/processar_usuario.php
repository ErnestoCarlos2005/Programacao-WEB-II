<?php 
require_once 'conexao.php';

$cpf = $_POST['cpf'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$cargo = $_POST['cargo'] ?? '';
$funcao = $_POST['funcao'] ?? '';
$login = $_POST['login'] ?? '';
$senha = $_POST['senha'] ?? '';

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

try {
    // 1. Verifica se pessoa física existe
    $sql = "SELECT cpf FROM pessoa_fisica WHERE cpf = :cpf";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':cpf' => $cpf]);
    $pessoa = $stmt->fetch();

    if (!$pessoa) {
        echo "Pessoa física não encontrada. Cadastre primeiro.";
        exit;
    }

    // 2. Verifica se já existe um usuário com o mesmo CPF
    $sql = "SELECT COUNT(*) FROM usuario WHERE cpf = :cpf";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':cpf' => $cpf]);
    $existe = $stmt->fetchColumn();

    if ($existe > 0) {
        echo "Já existe um usuário cadastrado com este CPF.";
        exit;
    }

    // 3. Insere o usuário
    $sql = "INSERT INTO usuario 
            (cpf, endereco, cargo, funcao, login, senha, 
             permissao_folha_ponto, permissao_administrador, permissao_cadastro, 
             permissao_declaracoes, permissao_arquivos, ativo) 
            VALUES 
            (:cpf, :endereco, :cargo, :funcao, :login, :senha, 
             :permissao_folha_ponto, :permissao_administrador, :permissao_cadastro, 
             :permissao_declaracoes, :permissao_arquivos, 1)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':cpf' => $cpf,
        ':endereco' => $endereco,
        ':cargo' => $cargo,
        ':funcao' => $funcao,
        ':login' => $login,
        ':senha' => $senha_hash,

    ]);

    echo "Usuário cadastrado com sucesso!";
    echo '<br><a href="cadastro_usuario.html">Voltar</a>';

} catch (PDOException $e) {
    echo "Erro ao cadastrar usuário. Tente novamente mais tarde.";
    // Opcional: echo $e->getMessage();  // para debug
}
?>
