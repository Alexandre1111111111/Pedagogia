<?php
    include("banco.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $cpfus = $_POST["cpfus"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM acesso WHERE Cpf = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $cpfus);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result)){    
    if($row["Cpf"] === $cpfus && $row["Senha"] === $senha){
        $_SESSION['cpfus'] = $cpfus;
        header("Location: alunos.php");
    }
    }

    $stmt->close();

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="778157023274-5sp5859kjitdjco0jcfg48reg1abksnj.apps.googleusercontent.com">
    <link rel="stylesheet" href="style.css">
    <link rel="Icon" href="logo.png">
    <title>SRP - Sistema de Registro Pedagógico</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <div class="lg">
            <img src="logo.png" alt="">
            <div>
            <h1>SRP</h1>
            <p>Sistema de Registro Pedagógico</p>
            </div>
        </div>
      <p>Faça login</p>
      
       <label for="Cpf">CPF<input name="cpfus" type="text" id="cpfus" required></label>

       <label for="Senha">Senha<input name="senha" type="password" id="senha" required></label>

       <button type="submit">Continuar</button>
        <a href="esqueci.html">Esqueci minha senha</a>
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
    </form>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="script.js"></script>
</body>
</html>