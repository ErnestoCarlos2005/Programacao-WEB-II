<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
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

    .opcoes-admin {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .opcoes-admin a {
        text-decoration: none;
        color: #002147;
        padding: 15px 20px;
        border: 2px solid #002147;
        border-radius: 8px;
        display: block;
        text-align: center;
        font-weight: bold;
        transition: background-color 0.2s ease, transform 0.2s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .opcoes-admin a:hover {
        background-color: #002147;
        color: white;
        transform: translateY(-3px);
    }
    </style>
</head>
<body>

<?php include("menu.php"); ?> 

<div class="content">
    <h1 class="header">Painel do Administrador</h1>

    <div class="opcoes-admin">
        <a href="cadastro_pessoa.php">Cadastrar Pessoa Física</a>
        <a href="cadastro_usuario.php">Cadastrar Usuário</a>
        <a href="buscar_usuario.html">Editar Usuário</a>
        <a href="consultar_usuario.html">Consultar usuarios</a>


    </div>
</div>

</body>
</html>
