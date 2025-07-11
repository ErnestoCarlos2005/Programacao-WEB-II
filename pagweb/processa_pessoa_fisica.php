<?php
// Inclui o arquivo de conexão
require_once 'conexao.php';

// Receber dados do formulário com segurança
$nome = trim($_POST['nome'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$email = trim($_POST['email'] ?? '');
$dt_nascimento = $_POST['dt_nascimento'] ?? null;
$ddd = trim($_POST['ddd'] ?? '');
$celular = trim($_POST['celular'] ?? '');
$sexo = $_POST['sexo'] ?? '';

// Array para armazenar mensagens de erro
$erros = [];

// Validação básica
if (empty($nome)) {
    $erros[] = "O campo <strong>Nome</strong> é obrigatório.";
}
if (empty($cpf)) {
    $erros[] = "O campo <strong>CPF</strong> é obrigatório.";
}

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = "O <strong>Email</strong> informado não é válido.";
}


if (!empty($erros)) {
    echo '<div style="background:#f8d7da; color:#842029; border:1px solid #f5c2c7; padding:15px; border-radius:5px; max-width:400px; margin:auto;">';
    echo '<h3>Erro(s) no cadastro:</h3><ul>';
    foreach ($erros as $erro) {
        echo "<li>$erro</li>";
    }
    echo '</ul>';
    echo '<a href="cadastro_pessoa.php" style="display:inline-block; margin-top:10px; color:#842029; text-decoration:underline;">Voltar ao formulário</a>';
    echo '</div>';
    exit;
}

try {
  
    $sql = "INSERT INTO pessoa_fisica (nome, cpf, email, dt_nascimento, ddd, celular, sexo) 
            VALUES (:nome, :cpf, :email, :dt_nascimento, :ddd, :celular, :sexo)";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':nome' => $nome,
        ':cpf' => $cpf,
        ':email' => $email,
        ':dt_nascimento' => $dt_nascimento,
        ':ddd' => $ddd,
        ':celular' => $celular,
        ':sexo' => $sexo
    ]);

    echo '<div style="background:#d1e7dd; color:#0f5132; border:1px solid #badbcc; padding:15px; border-radius:5px; max-width:400px; margin:auto; text-align:center;">';
    echo "<h3>Cadastro realizado com sucesso!</h3>";
    echo '<a href="cadastro_pessoa.php" style="color:#0f5132; text-decoration:underline;">Voltar ao formulário</a>';
    echo '</div>';

} catch (PDOException $e) {
    echo '<div style="background:#f8d7da; color:#842029; border:1px solid #f5c2c7; padding:15px; border-radius:5px; max-width:400px; margin:auto;">';
    echo "<strong>Erro ao cadastrar:</strong> " . htmlspecialchars($e->getMessage());
    echo '<br><a href="cadastro_pessoa.php" style="color:#842029; text-decoration:underline;">Voltar ao formulário</a>';
    echo '</div>';
}
?>
