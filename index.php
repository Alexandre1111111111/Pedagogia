<?php
    include("banco.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="style.css">
    <link rel="Icon" href="">
</head>
<body>
    <form action=>
      <p>Faça login</p>
       <label for="Cpf">CPF<input type="text" id="cpf"/></label>
       <label for="Senha">Senha<input type="password" id="senha"/></label>
       <button>Continuar</button>
        <a href="esqueci.html">Esqueci minha senha</a>
        <a href="Criar.html">Não tenho conta!</a>
    </form>
</body>
</html>