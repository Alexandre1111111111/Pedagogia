<?php
    include("banco.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR" translate="no">
<head>
    <meta name="google" content="notranslate">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="alunos.css">
    <link rel="Icon" href="logo.png">
    <title>SRP - Sistema de Registro Pedagógico</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="lg">
            <img src="logo.png" alt="">
            <div>
            <h1>SRP</h1>
            <p>Sistema de Registro Pedagógico</p>
            </div>
        </div>
        <div class="log">
            <div class="cad">
            <h1 id="us"></h1>
            <div id="ft"></div>
            <div class="opt">
                <button>Sair</button>
            </div>
            </div>
        </div>
    </header>
    <main class="tab">
    <nav class="lte">
        <ul>
            <li title="Alunos"><a href="alunos.php"><img src="https://cdn-icons-png.flaticon.com/512/10252/10252944.png" alt=""></a></li>
            <li title="Ocorrências" style="background-color: #bbb8b8;"><a href="ocorrencia.php"><img src="https://cdn-icons-png.flaticon.com/512/1584/1584808.png" alt=""></a></li>
            <li title="Gerenciar Acesso"><a href="admin.php"><img src="https://cdn-icons-png.flaticon.com/512/807/807292.png" alt=""></a></li>
        </ul>
    </nav>
    <div class="tab-content">
        <div class="pes">
            <div>
            <form action="pesquisaocorr.php" method="get">
            <input name="termo" type="text" placeholder="Pesquisar..">
            <input type="submit" value="Pesquisar">
            </form>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Registro</th>
                    <th>Feito por:</th>
                    <th>Data da Gravação</th>
                    <th>Arquivos</th>
                    <th>Adendos</th>
                </tr>
            </thead>
            <tbody class="alunos">

            </tbody>
        </table>
        <button id="add">+ Adicionar ocorrência</button>
        </div>
    </main>
    <?php 
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nome"])){
        $_SESSION["nome"] = $_POST["nome"];
        $_SESSION["data"] = $_POST["data"];
        $_SESSION["registro"] = $_POST["registro"];
        $_SESSION["adendos"] = $_POST["adendos"];
        $nomeDocumento = $_FILES['documento']['name'];
        $diretorioDestino = "uploads/";
        $nomeDocumentoNovo = uniqid(). "_". basename($nomeDocumento);
        $caminhoCompleto = $diretorioDestino. $nomeDocumentoNovo;
        if (move_uploaded_file($_FILES['documento']['tmp_name'], $caminhoCompleto)) {
            echo "Documento carregado com sucesso!<br>";
        }
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $data = filter_input(INPUT_POST, "data", FILTER_SANITIZE_SPECIAL_CHARS);
        $registro = filter_input(INPUT_POST, "registro", FILTER_SANITIZE_SPECIAL_CHARS);
        $adendos = filter_input(INPUT_POST, "adendos", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "INSERT INTO ocorrencia (Nome, Data, Registro, Documentos, Adendos) VALUES ('$nome', '$data', '$registro', '$nomeDocumentoNovo', '$adendos')";
        mysqli_query($conn, $sql);
    }
    ?>
    <div class="arqct">
            <div class="arq">
            <button id="fcha"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
                <h1>Arquivos</h1>
            </div>
    </div>
    <script>
        let lin;
    </script>
    <?php
            $sql = "SELECT Nome, Data, Registro, FeitoPor, Gravação, Documentos, Adendos FROM ocorrencia";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc( $result)){
                echo "<script>
                lin = document.createElement('tr');
                lin.innerHTML = `
                 <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                 <td>". $row["Data"]. "</td>
                 <td>". $row["Registro"]. "</td>
                 <td>". $row["FeitoPor"]. "</td>
                 <td>". $row["Gravação"]. "</td>
                 <td><a href='uploads/". $row["Documentos"]."'>". $row["Documentos"]."</a></td>
                 <td>". $row["Adendos"]. "</td>
                `
                document.querySelector('.alunos').appendChild(lin);
                </script>";
            }
                mysqli_close($conn);
    ?>
    <div class="cadalct">
        <div class="cadal">
            <button id="fch"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
            <h2>Ocorrência</h2>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="formAluno" enctype="multipart/form-data">
                <div>
                    <label for="nome">Nome do Aluno:</label>
                    <input name="nome" type="text" id="nome" required>
                </div>
                <div>
                    <label for="data">Data:</label>
                    <input name="data" type="date" id="data">
                </div> 
                <div>
                    <label for="registro">Registro:</label>
                    <input name="registro" type="text" id="registro">
                </div> 
                <div>
                    <label for="documento">Documentos:</label>
                    <input name="documento" type="file" id="documento">
                </div> 
                <div>
                    <label for="adendos">Adendos:</label>
                    <input name="adendos" type="text" id="adendos">
                </div> 
                <input type="submit" value="Adicionar" id="env">
                </form>
        </div>
    </div>
    <script src="ocorrencia.js"></script>
</body>
</html>