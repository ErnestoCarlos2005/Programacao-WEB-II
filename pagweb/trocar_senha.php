<?php
include 'conexao.php';

$id = $_GET['id'];

$nova_senha = password_hash('novasenha123', PASSWORD_DEFAULT);

$sql = "UPDATE usuario SET senha='$nova_senha', trocar_senha=1 WHERE id_matricula='$id'";

if (mysqli_query($conn, $sql)) {
    echo "Senha alterada e usuário deve trocar no próximo login.";
} else {
    echo "Erro: " . mysqli_error($conn);
}
?>
