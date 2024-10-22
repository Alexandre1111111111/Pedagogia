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
            <li title="Alunos" style="background-color: #bbb8b8;"><a href="alunos.php"><img src="https://cdn-icons-png.flaticon.com/512/10252/10252944.png" alt=""></a></li>
            <li title="Ocorrências"><a href="ocorrencia.php"><img src="https://cdn-icons-png.flaticon.com/512/1584/1584808.png" alt=""></a></li>
            <li title="Gerenciar Acesso"><a href="admin.php"><img src="https://cdn-icons-png.flaticon.com/512/807/807292.png" alt=""></a></li>
        </ul>
    </nav>
    <div class="tab-content">
        <div class="pes">
            <div>
            <form action="pesquisa.php" method="get">
            <input name="termo" type="text" placeholder="Pesquisar..">
            <input type="submit" value="Pesquisar">
            </form>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Ano letivo</th>
                    <th>Turma</th>
                    <th>Responsáveis</th>
                    <th>Telefone do Estudante</th>
                    <th>Telefone dos Responsáveis</th>
                    <th>Endereço</th>
                    <th>Problema de Saúde / Medicamento</th>
                    <th>Ocorrência</th>
                    <th>CGM</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody class="alunos">

            </tbody>
        </table>
        <button id="add">+ Adicionar estudante</button>
        </div>
    </main>
    <script>
    let lin;
    </script>
        <div class="del">
            <button title="Editar" class="editar"><img src="https://cdn-icons-png.flaticon.com/512/2280/2280532.png" alt=""></button>
            <button title="Excluir" class="delet"><img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt=""></button>
        </div>
        <div class="excct">
            <div class="exc">
                <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["just"])){
                        $cg = $_POST["cgme"];
                        $sql = "DELETE FROM pedagogia WHERE Cgm = $cg";
                        mysqli_query($conn, $sql);
                    }
                ?>
            <button id="fche"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
                <h1>Excluir o estudante</h1>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <div>
                        <label for="just">Justificativa:</label>
                        <input name="just" type="text" id="just" required>
                    </div>
                        <input type="submit" value="Excluir">
                    </div>
                </form>
            </div>
            <div class="edict">
            <div class="edi">
            <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["turmae"])){
                        $cg = $_POST["cgme"];
                        $sql = "UPDATE pedagogia SET Turma = ?, TelefoneEstudante = ?, TelefoneResponsaveis = ?, Endereco = ?, Medicamento = ? WHERE Cgm = $cg";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sssss", $_POST["turmae"], $_POST["telee"], $_POST["telre"], $_POST["ende"], $_POST["saudee"]);
                        $stmt->execute();
                        $stmt->close();
                    }
                ?>
            <button id="fchd"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
                <h1>Editar</h1>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <div>
                    <label for="turmae">Turma:</label>
                    <input name="turmae" type="text" id="turmae">
                </div>
                <div>
                    <label for="telefonee">Telefone do Estudante:</label>
                    <input name="telee" type="tel" id="telefonee">
                </div> 
                <div>
                    <label for="telrese">Telefone do Responsável:</label>
                    <input name="telre" type="tel" id="telrese">
                </div>
                <div>
                    <label for="Enderecoe">Endereço:</label>
                    <input name="ende" type="text" id="ende">
                </div>
                <div>
                    <label for="saudee">Problema de Saúde / Medicamento:</label>
                    <input name="saudee" type="text" id="saudee">
                </div>
                        <input type="submit" value="Atualizar">
                    </div>
                </form>
            </div>
    <?php
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
    try{
        mysqli_query($conn, $sql);
        header("Location: alunos.php");
        }
        catch(mysqli_sql_exception){
            echo"Aluno já Cadastrado";
        }
    }

        $sql = "SELECT Foto, Nome, AnoLetivo, Turma, Responsaveis, TelefoneEstudante, TelefoneResponsaveis, Endereco, Medicamento, Cgm, Cpf FROM pedagogia";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){

            echo "<script>
            lin = document.createElement('tr');
            lin.innerHTML = `
             <td><img src='uploads/" . $row["Foto"] . "' alt=''></td>
             <td style='font-weight: bold;'>". $row["Nome"]. "</td>
             <td>". $row["AnoLetivo"]. "</td>
             <td>". $row["Turma"]. "</td>
             <td>". $row["Responsaveis"]. "</td>
             <td>". $row["TelefoneEstudante"]. "</td>
             <td>". $row["TelefoneResponsaveis"]. "</td>
             <td>". $row["Endereco"]. "</td>
             <td>". $row["Medicamento"]. "</td>
             <td><button onclick='location.href=\"pesquisaocorr.php?termo=". $row["Nome"]."\"'>Ver</button></td>
             <td class='cg'>". $row["Cgm"]. "</td>
             <td>". $row["Cpf"]. "</td>
            `
            lin.addEventListener('click', function(){
            const del = document.querySelector('.del');
            del.style.display = 'flex';
            setTimeout(() => {
            del.style.bottom = '0';
            del.style.opacity = '1';
        }, 10)
        })

            document.querySelector('.alunos').appendChild(lin);
            </script>";
        }
            mysqli_close($conn);
            ?>
    <div class="cadalct">
        <div class="cadal">
            <button id="fch"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
            <div class="info">
            <h1>Cadastro de Estudante</h1>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="formAluno" enctype="multipart/form-data">
                <div>
                    <label for="foto">Foto:</label>
                    <input name="foto" type="file" id="foto" accept=".png" required>
                </div>
                <div>
                    <label for="nome">Nome:</label>
                    <input name="nome" type="text" id="nome" required>
                </div>
                <div>
                    <label for="ano">Ano letivo:</label>
                    <input name="ano" type="number" id="ano" required>
                </div>
                <div>
                    <label for="turma">Turma:</label>
                    <input name="turma" type="text" id="turma" required>
                </div>
                <div>
                    <label for="responsaveis">Responsáveis:</label>
                    <input name="res" type="text" id="responsaveis" required>
                </div>
                <div>
                    <label for="telefone">Telefone do Estudante:</label>
                    <input name="tele" type="tel" id="telefone">
                </div> 
                <div>
                    <label for="telres">Telefone do Responsável:</label>
                    <input name="telr" type="tel" id="telres" required>
                </div>
                <div>
                    <label for="Endereco">Endereço:</label>
                    <input name="end" type="text" id="end" required>
                </div>
                <div>
                    <label for="saude">Problema de Saúde / Medicamento:</label>
                    <input name="saude" type="text" id="saude">
                </div>
                <div>
                    <label for="cgm">CGM:</label>
                    <input name="cgm" type="number" id="cgm" required>
                </div>
                <div>
                    <label for="cpf">CPF:</label>
                    <input name="cpf" type="text" id="cpf" required>
                </div> 
                <input type="submit" value="Adicionar" id="env">
                </form>
                </div>
        </div>
    </div>
    <script src="alunos.js"></script>
</body>
</html>