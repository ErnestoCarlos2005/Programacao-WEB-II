<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos estão setados
    if (isset($_POST['login'], $_POST['senha'])) {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        // Preparar e executar a consulta para buscar o usuário ativo
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE login = :login AND ativo = 1");
        $stmt->bindParam(':login', $login);
        $stmt->execute();


        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario'] = $usuario;
            header("Location: administrador.php"); // redireciona para painel após login
            exit;
        } else {
            echo "Login inválido ou usuário inativo.";
        }
    } else {
        echo "Por favor, preencha o login e a senha.";
    }
} else {
    // Se tentar acessar direto sem POST, mostra o formulário (opcional)
    ?>
    <form method="POST" action="">
        Login: <input type="text" name="login" required><br>
        Senha: <input type="password" name="senha" required><br>
        <button type="submit">Entrar</button>
    </form>
    <?php
}
?>
