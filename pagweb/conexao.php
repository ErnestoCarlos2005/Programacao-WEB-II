<?php
// Configurações do banco de dados
$host = "localhost";
$dbname = "pagweb";  
$usuario = "wenceslau";  // Usuário do banco
$senha = "atividadepagweb";      // Senha do banco

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    // Configura PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em produção, evite mostrar mensagens detalhadas.
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>
