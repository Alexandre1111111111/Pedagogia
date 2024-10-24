<?php
include("banco.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nome"])){
        $_SESSION["nome"] = $_POST["nome"];
        $_SESSION["ano"] = $_POST["ano"];
        $_SESSION["turma"] = $_POST["turma"];
        $_SESSION["res"] = $_POST["res"];
        $_SESSION["tele"] = $_POST["tele"];
        $_SESSION["telr"] = $_POST["telr"];
        $_SESSION["end"] = $_POST["end"];
        $_SESSION["saude"] = $_POST["saude"];
        $_SESSION["cgm"] = $_POST["cgm"];
        $_SESSION["cpf"] = $_POST["cpf"];

        $nomeArquivo = $_FILES['foto']['name']; 
        $diretorioDestino = "uploads/";
        $nomeArquivoNovo = uniqid() . "_" . basename($nomeArquivo);
        $caminhoCompleto = $diretorioDestino . $nomeArquivoNovo;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {
            echo "Imagem carregada com sucesso!<br>";
        }
        
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $ano = filter_input(INPUT_POST, "ano", FILTER_SANITIZE_SPECIAL_CHARS);
        $turma = filter_input(INPUT_POST, "turma", FILTER_SANITIZE_SPECIAL_CHARS);
        $res = filter_input(INPUT_POST, "res", FILTER_SANITIZE_SPECIAL_CHARS);
        $tele = filter_input(INPUT_POST, "tele", FILTER_SANITIZE_SPECIAL_CHARS);
        $telr = filter_input(INPUT_POST, "telr", FILTER_SANITIZE_SPECIAL_CHARS);
        $end = filter_input(INPUT_POST, "end", FILTER_SANITIZE_SPECIAL_CHARS);
        $saude = filter_input(INPUT_POST, "saude", FILTER_SANITIZE_SPECIAL_CHARS);
        $cgm = filter_input(INPUT_POST, "cgm", FILTER_SANITIZE_SPECIAL_CHARS);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "INSERT INTO pedagogia (Foto, Nome, AnoLetivo, Turma, Responsaveis, TelefoneEstudante, TelefoneResponsaveis, Endereco, Medicamento, Cgm, Cpf) VALUES ('$nomeArquivoNovo', '$nome', '$ano', '$turma', '$res', '$tele', '$telr', '$end', '$saude', '$cgm', '$cpf')";

        mysqli_query($conn, $sql);
    }
    else {
        header("Location: alunos.php");
        exit();
    }
            mysqli_close($conn);
            header("Location: alunos.php");
            exit();