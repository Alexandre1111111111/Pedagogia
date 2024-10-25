<?php 
include("banco.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pe"])){
    $pe = $_POST["pe"];
    $sql = "DELETE FROM acesso WHERE Cpf = '$pe'";
    mysqli_query($conn, $sql);
}
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["em"])){
        $_SESSION["em"] = $_POST["em"];
        $_SESSION["cpf"] = $_POST["cpf"];
        $_SESSION["nome"] = $_POST["nome"];

        $em = filter_input(INPUT_POST, "em", FILTER_SANITIZE_SPECIAL_CHARS);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "INSERT INTO acesso (Nome, Email, Cpf) VALUES ('$nome', '$em', '$cpf')";
        mysqli_query($conn, $sql);
    }
    else {
        mysqli_close($conn);
        header("Location: admin.php");
        exit();
    }
    mysqli_close($conn);
    header("Location: admin.php");
    exit();