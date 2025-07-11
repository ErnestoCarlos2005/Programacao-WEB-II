<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Pessoa Física</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
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

        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px 20px;
            box-sizing: border-box;
        }

        form > div {
            display: flex;
            flex-direction: column;
        }

        form label {
            font-weight: bold;
            color: #002147;
            margin-bottom: 5px;
        }

        form input,
        form select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        .botao-salvar {
            margin-top: 23px;
            padding: 11px 10px;
            background-color: #002147;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: auto;
            float: right;
        }

        .botao-salvar:hover {
            background-color: #004080;
        }
    </style>
</head>
<body>

<?php include('menu.php'); ?>

<div class="content">
    <h1 class="header">Cadastro Pessoa Física</h1>

    <form method="POST" action="processa_pessoa_fisica.php" id="formPessoa">

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required />
        </div>

        <div>
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" required />
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" />
        </div>

        <div>
            <label for="dt_nascimento">Data de Nascimento:</label>
            <input type="date" name="dt_nascimento" id="dt_nascimento" />
        </div>

        <div>
            <label for="ddd">DDD:</label>
            <input type="text" name="ddd" id="ddd" maxlength="2" />
        </div>

        <div>
            <label for="celular">Celular:</label>
            <input type="text" name="celular" id="celular" />
        </div>

        <div>
            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo">
                <option value="">Selecione</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </select>
        </div>

        <div>
            <button type="submit" class="botao-salvar">Salvar</button>
        </div>
       

    </form>
</div>

<script>
    $(document).ready(function(){
        $('#cpf').mask('000.000.000-00');
        $('#celular').mask('00000-0000');
        $('#ddd').mask('00');
    });
</script>

</body>
</html>
