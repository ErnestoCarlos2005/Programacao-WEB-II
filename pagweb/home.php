<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Início</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        body {
            background-color: #f9f9f9;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .content {
            padding: 40px;
        }

        .header {
        font-size: 20px;
        color: #002147;
        padding: 20px;
        margin-bottom: 30px;
        border-bottom: 2px solid #002147; /* Adiciona a linha */
        }

        .imagem-centro {
            display: block;
            margin: 0 auto;
            max-width: 600px; /* opcional, ajusta o tamanho da imagem */
        }
    </style>
</head>
<body>

<?php include("menu.php"); ?>

<div class="content">
    <h1 class="header">Página Inicial</h1>
    <img src="imagens/construcao.png" alt="Em construção" class="imagem-centro">
</div>

</body>
</html>
