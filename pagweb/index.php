<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pagweb - Login</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: sans-serif;
    }

    body {
    background: linear-gradient(to bottom right,rgb(255, 255, 255),rgb(255, 145, 0));
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
    }

    .login-container {
      background-color: white;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      width: 350px;
      text-align: center;
    }

    .login-container h2 {
      font-size: 18px;
      margin-bottom: 25px;
      font-weight: bold;
      color: #002366;
    }

    .login-container label {
      display: block;
      text-align: left;
      margin-bottom: 5px;
      color: #002366;
      font-size: 14px;
    }

    .login-container input[type="email"],
    .login-container input[type="password"],
    .login-container input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 5px;
      border: 1px solid #002366;
      border-radius: 6px;
      font-size: 14px;
    }

    .login-container input::placeholder {
      font-style: normal;
    }

    .input-group {
      position: relative;
      margin-bottom: 10px;
    }

    .input-group i {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      cursor: pointer;
      font-style: normal;
    }

    .error-message {
      text-align: right;
      color: red;
      font-size: 12px;
      margin-top: 5px;
      margin-bottom: 10px;
    }

    .login-container button {
      background-color:rgb(0, 70, 27);
      color: white;
      border: none;
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 10px;
    }

    .login-container .links {
      margin-top: 10px;
      font-size: 12px;
    }

    .login-container .links a {
      color: #002366;
      text-decoration: none;
      margin: 0 5px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Pagweb - Login</h2>
    <form method="POST" action="login.php">
      <label for="login">Login:</label>
      <input type="text" id="login" name="login" placeholder="Insira seu usuário" required
        oninvalid="this.setCustomValidity('Por favor, insira um usuário válido')"
        oninput="this.setCustomValidity('')" />

      <label for="senha">Senha:</label>
      <div class="input-group">
        <input type="password" id="senha" name="senha" placeholder="Insira sua senha de acesso" required />
      </div>

      <?php if (isset($_GET['erro']) && $_GET['erro'] == 1): ?>
        <div class="error-message">Login ou senha inválidos.</div>
      <?php endif; ?>

      <button type="submit">Entrar</button>
  
    </form>
  </div>

</body>
</html>
