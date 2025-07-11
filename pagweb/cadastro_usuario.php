<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Usuário</title>
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
            border-bottom: 2px solid #002147;
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

        .campo-cpf {
            grid-column: 1 / -1; 
            padding-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .campo-cpf label {
            min-width: 60px;
            font-weight: bold;
            color: #002147;
        }

        .campo-cpf input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .campo-cpf button {
            padding: 10px 15px;
            background-color: #002147;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .campo-cpf button:hover {
            background-color: #004080;
        }

        form > div:not(.campo-cpf) {
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

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-check label {
            font-weight: normal;
            margin: 0;
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
        }

        .botao-salvar:hover {
            background-color: #004080;
        }
        /* Estilo customizado para checkboxes */
        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            user-select: none;
            position: relative;
            padding-left: 30px; /* espaço para o quadrado custom */
        }

        .form-check input[type="checkbox"] {
            /* Esconde o checkbox padrão */
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .form-check label {
            font-weight: normal;
            margin: 0;
            color: #002147;
        }

        /* Caixa customizada */
        .form-check label::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 18px;
            width: 18px;
            border: 2px solid #002147;
            border-radius: 4px;
            background-color: white;
            box-sizing: border-box;
        }

        /* Marca de check */
        .form-check input[type="checkbox"]:checked + label::before {
            background-color: #002147;
            border-color: #002147;
        }

        .form-check input[type="checkbox"]:checked + label::after {
            content: "";
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            box-sizing: content-box;
        }

        /* Hover no label */
        .form-check:hover label::before {
            border-color: #004080;
        }

        /* Focus no checkbox */
        .form-check input[type="checkbox"]:focus + label::before {
            outline: 2px solid #004080;
            outline-offset: 2px;
        }
        


    </style>
</head>
<body>

<?php include('menu.php'); ?>

<div class="content">
    <h1 class="header">Cadastro de Usuário</h1>

    <form method="POST" action="processar_cadastro_usuario.php">

        <div class="campo-cpf">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required />
        </div>

        <div>
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" />
        </div>

        <div>
            <label for="cargo">Cargo:</label>
            <input type="text" id="cargo" name="cargo" />
        </div>

        <div>
            <label for="funcao">Função:</label>
            <input type="text" id="funcao" name="funcao" />
        </div>

        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required />
        </div>

        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required />
        </div>

        <div>
            <button type="submit" class="botao-salvar">Cadastrar</button>
        </div>

    </form>
</div>

<script>
    $(document).ready(function(){
        $('#cpf').mask('000.000.000-00');
    });

    function buscarPessoa() {
        const cpf = document.getElementById('cpf').value.replace(/\D/g,''); // remove máscara

        if (cpf.length !== 11) {
            alert('CPF inválido!');
            return;
        }

        fetch('buscar_pessoa.php?cpf=' + encodeURIComponent(cpf))
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    if (data.endereco) document.getElementById('endereco').value = data.endereco;
                    if (data.cargo) document.getElementById('cargo').value = data.cargo;
                    if (data.funcao) document.getElementById('funcao').value = data.funcao;
                } else {
                    alert(data.mensagem || 'Pessoa não encontrada!');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao buscar pessoa.');
            });
    }
</script>

</body>
</html>
