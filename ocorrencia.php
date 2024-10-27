<?php
    include("banco.php");
    session_start();
    if (!isset($_SESSION['cpfus'])) {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR" translate="no">
<head>
    <meta name="google" content="notranslate">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="alunos.css">
    <link rel="Icon" href="logo.png">
    <title>SRP - Ocorrências</title>
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
            <a href="logout.php"><button>Sair</button></a>
            </div>
            </div>
        </div>
    </header>
    <main class="tab">
    <nav class="lte">
        <ul>
            <li title="Alunos"><a href="alunos.php"><img src="https://cdn-icons-png.flaticon.com/512/10252/10252944.png" alt=""></a></li>
            <li title="Ocorrências" style="background-color: #bbb8b8;"><a href="ocorrencia.php"><img src="https://cdn-icons-png.flaticon.com/512/1584/1584808.png" alt=""></a></li>
            <li class="exb" title="Excluidos"><a href="excluidos.php"><img src="https://cdn-icons-png.flaticon.com/512/484/484611.png" alt=""></a></li>
        </ul>
    </nav>
    <div class="tab-content">
        <div class="pes">
            <div>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="get">
            <input name="termo" type="text" placeholder="Pesquisar..">
            <input id="bus" type="submit" value="Pesquisar">
            </form>
            </div>
        </div>
        <?php if(empty( $_GET['termo'] ) || $_GET['termo'] == null) { ?>
        <button id="addo">+ Adicionar ocorrência</button>
        <?php }?>
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
        <div class="na">Nenhuma Ocorrência encontrada</div>
        </div>
    </main>
    <?php 
        include("usuario.php");
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nome"])){
        $_SESSION["nome"] = $_POST["nome"];
        $_SESSION["data"] = $_POST["data"];
        $_SESSION["registro"] = $_POST["registro"];
        $_SESSION["adendos"] = $_POST["adendos"];
        $nomeDocumento = $_FILES['documento']['name'];
        $diretorioDestino = "uploads/";
        $nomeDocumentoNovo = uniqid(). "_". basename($nomeDocumento);
        if(empty($_FILES['documento']['name'])) {
            $nomeDocumentoNovo = "";
        }
        $caminhoCompleto = $diretorioDestino. $nomeDocumentoNovo;
        if (move_uploaded_file($_FILES['documento']['tmp_name'], $caminhoCompleto)) {
            echo "Documento carregado com sucesso!<br>";
        }
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $data = filter_input(INPUT_POST, "data", FILTER_SANITIZE_SPECIAL_CHARS);
        $registro = filter_input(INPUT_POST, "registro", FILTER_SANITIZE_SPECIAL_CHARS);
        $adendos = filter_input(INPUT_POST, "adendos", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "INSERT INTO ocorrencia (Nome, Data, Registro, FeitoPor, Documentos, Adendos) VALUES ('$nome', '$data', '$registro', '$usuario', '$nomeDocumentoNovo', '$adendos')";
        mysqli_query($conn, $sql);
        header("Location: ocorrencia.php");
        exit();
    }
    ?>
    <script>
        let lin;
    </script>
    <?php
    if(empty( $_GET['termo'] ) || $_GET['termo'] == null) {
            $sql = "SELECT Nome, Data, Registro, FeitoPor, Gravação, Documentos, Adendos FROM ocorrencia";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc( $result)){
                echo "<script>
                lin = document.createElement('tr');
                lin.innerHTML = `
                 <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                 <td>". date("d-m-Y", strtotime($row["Data"])). "</td>
                 <td>". $row["Registro"]. "</td>
                 <td>". $row["FeitoPor"]. "</td>
                 <td>". date("d-m-Y H:i:s", strtotime($row["Gravação"])). "</td>
                 <td><a href='uploads/". $row["Documentos"]."'>". $row["Documentos"]."</a></td>
                 <td>". $row["Adendos"]. "</td>
                `
                document.querySelector('.alunos').appendChild(lin);
                </script>";
            }
        }
        else {
            if (isset($_GET['termo'])) {

                $termo = "%" . $conn->real_escape_string($_GET['termo']) . "%";

                $sql = "SELECT * FROM ocorrencia WHERE Nome LIKE ? OR Data LIKE ? OR FeitoPor LIKE ?";
                
                if ($stmt = $conn->prepare($sql)) {

                    $stmt->bind_param("sss", $termo, $termo, $termo);
                    
                    $stmt->execute();
                    
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($resultado)){    
                            echo "<script>
                            lin = document.createElement('tr');
                            lin.innerHTML = `
                             <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                             <td>". date("d-m-Y", strtotime($row["Data"])). "</td>
                             <td>". $row["Registro"]. "</td>
                             <td>". $row["FeitoPor"]. "</td>
                             <td>". date("d-m-Y H:i:s", strtotime($row["Gravação"])). "</td>
                             <td><a href='uploads/". $row["Documentos"]."'>". $row["Documentos"]."</a></td>
                             <td>". $row["Adendos"]. "</td>
                            `
                            document.querySelector('.alunos').appendChild(lin);
                            </script>";
                    }} else {
                        echo "Nenhum aluno encontrado.";
                    }
                    
                    $stmt->close();
                } else {
                    echo "Erro na preparação da consulta.";
                }
            }
        }
                mysqli_close($conn);
    ?>
    <div class="cadalct">
        <div class="cadal">
            <button id="fch"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
            <div class="info">
            <h1>Ocorrência</h1>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="formAluno" enctype="multipart/form-data">
                <div>
                    <label for="nome"><em>*</em>Nome do Aluno:
                    <input name="nome" type="text" id="nome" required>
                    </label>
                </div>
                <div>
                    <label for="data"><em>*</em>Data:
                    <input name="data" type="date" id="data" required>
                    </label>
                </div> 
                <div>
                    <label for="registro"><em>*</em>Registro:
                    <input name="registro" type="text" id="registro" required>
                    </label>
                </div> 
                <div>
                    <label for="documento">Documentos:
                    <input name="documento" type="file" id="documento">
                    </label>
                </div> 
                <div>
                    <label for="adendos">Adendos:
                    <input name="adendos" type="text" id="adendos">
                    </label>
                </div> 
                <h1 id="ob">* Obrigatório</h1>
                <input type="submit" value="+ Adicionar" id="env">
                </form>
            </div>
        </div>
    </div>
    <script src="ocorrencia.js"></script>
</body>
</html>