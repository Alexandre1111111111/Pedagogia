<?php
    include("banco.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie sua conta</title>
    <link rel="stylesheet" href="style.css">
    <link rel="Icon" href="">
</head>
<body>
<form action=>
    <p>Siga os passo para criar sua conta</p>
    <label for="Cpf">Coloque seu CPF:<input type="text" id="cpf"/></label>
    <label for="Senha">Crie sua senha:<input type="password" id="senha"/></label>
    <label for="email">Coloque seu e-mail:<input type="text" id="email"/></label>
    <button>Continuar</button>
    <a href="index.html">Já tenho uma conta </a>
</form>
</body>
</html>