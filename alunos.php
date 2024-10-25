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
            <a href="logout.php"><button>Sair</button></a>
            </div>
            </div>
        </div>
    </header>
    <main class="tab">
    <nav class="lte">
        <ul>
            <li title="Alunos" style="background-color: #bbb8b8;"><a href="alunos.php"><img src="https://cdn-icons-png.flaticon.com/512/10252/10252944.png" alt=""></a></li>
            <li title="Ocorrências"><a href="ocorrencia.php"><img src="https://cdn-icons-png.flaticon.com/512/1584/1584808.png" alt=""></a></li>
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
        <?php if(empty( $_GET['termo'] ) || $_GET['termo'] == null) { ?>
        <button id="add">+ Adicionar estudante</button>
        <?php } ?>
        </div>
    </main>
    <script>
    let lin;
    </script>
        <div class="del">
            <button title="Editar" class="editar"><img src="https://cdn-icons-png.flaticon.com/512/2280/2280532.png" alt=""></button>
            <button title="Exportar" class="exp"><img src="https://cdn-icons-png.flaticon.com/512/12067/12067207.png" alt=""></button>
            <button title="Excluir" class="delet"><img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt=""></button>
        </div>
        <div class="excct">
            <div class="exc">
                <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["just"])){
                        $al = $_POST["al"];
                        $sql = "DELETE FROM pedagogia WHERE Cpf = '$al'";
                        mysqli_query($conn, $sql);
                    }
                ?>
            <button id="fche"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
            <div class="info">
                <h1>Excluir o estudante</h1>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <div>
                    <label style="pointer-events: none;" for="al">CPF:</label>
                    <input name="al" type="text" id="al">
                </div>
                    <div>
                        <label for="just">Justificativa:</label>
                        <input name="just" type="text" id="just" required>
                    </div>
                        <input id="excl" type="submit" value="Excluir">
                    </div>
                </form>
            </div>
            </div>
            <div class="edict">
            <div style="height: 60vh;" class="edi">
            <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $al = $_POST["cp"];
                        $sql = "UPDATE pedagogia SET Turma = ?, TelefoneEstudante = ?, TelefoneResponsaveis = ?, Endereco = ?, Medicamento = ? WHERE Cpf = '$al'";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sssss", $_POST["turmae"], $_POST["telee"], $_POST["telre"], $_POST["ende"], $_POST["saudee"]);
                        $stmt->execute();
                        $stmt->close();
                    }
                ?>
            <button id="fchd"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
            <div class="info">
                <h1>Editar</h1>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <div>
                    <label style="pointer-events: none;" for="cp">CPF:</label>
                    <input name="cp" type="text" id="cp">
                </div>
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
                        <input id="atua" type="submit" value="Atualizar">
                </form>
            </div>
            </div>
            </div>
    <?php
    include("usuario.php");
if(empty( $_GET['termo'] ) || $_GET['termo'] == null) {
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
             <td><button onclick='location.href=\"ocorrencia.php?termo=". $row["Nome"]."\"'>Ver</button></td>
             <td class='cg'>". $row["Cgm"]. "</td>
             <td class='nm'>". $row["Cpf"]. "</td>
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
    }
    else {
        if (isset($_GET['termo'])) {
            // Prevenir SQL injection utilizando prepared statements
            $termo = "%" . $conn->real_escape_string($_GET['termo']) . "%";
        
            // Consulta SQL para buscar os produtos que correspondem ao termo de pesquisa
            $sql = "SELECT * FROM pedagogia WHERE Nome LIKE ? OR Cgm LIKE ? OR Turma LIKE ?";
            
            // Preparar a consulta
            if ($stmt = $conn->prepare($sql)) {
                // Substitui os "?" pelos valores da variável $termo
                $stmt->bind_param("sss", $termo, $termo, $termo);
                
                // Executar a consulta
                $stmt->execute();
                
                // Obter o resultado
                $resultado = $stmt->get_result();
        
                // Verificar se encontrou resultados
                if ($resultado->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($resultado)){    
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
                             <td><button onclick='location.href=\"ocorrencia.php?termo=". $row["Nome"]."\"'>Ver</button></td>
                             <td>". $row["Cgm"]. "</td>
                             <td>". $row["Cpf"]. "</td>
                            `
                            document.querySelector('.alunos').appendChild(lin);
                            </script>";
                        }
                } else {
                    echo "Nenhum aluno encontrado.";
                }
                
                // Fechar o statement
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
            <h1>Cadastro de Estudante</h1>
            <form action="cadal.php" method="post" id="formAluno" enctype="multipart/form-data">
                <div>
                    <label for="foto">Foto:
                    <input name="foto" type="file" id="foto" accept=".png, .jpeg, .jpg" required>
                    </label>
                </div>
                <div>
                    <label for="nome">Nome:
                    <input name="nome" type="text" id="nome" required>
                    </label>
                </div>
                <div>
                    <label for="ano">Ano letivo:
                    <input name="ano" type="number" id="ano" required>
                    </label>
                </div>
                <div>
                    <label for="turma">Turma:
                    <input name="turma" type="text" id="turma" required>
                    </label>
                </div>
                <div>
                    <label for="responsaveis">Responsáveis:
                    <input name="res" type="text" id="responsaveis" required>
                    </label>
                </div>
                <div>
                    <label for="telefone">Telefone do Estudante:
                    <input name="tele" type="tel" id="telefone">
                    </label>
                </div> 
                <div>
                    <label for="telres">Telefone do Responsável:
                    <input name="telr" type="tel" id="telres" required>
                    </label>
                </div>
                <div>
                    <label for="Endereco">Endereço:
                    <input name="end" type="text" id="end" required>
                    </label>
                </div>
                <div>
                    <label for="saude">Problema de Saúde / Medicamento:
                    <input name="saude" type="text" id="saude">
                    </label>
                </div>
                <div>
                    <label for="cgm">CGM:
                    <input name="cgm" type="number" id="cgm" required>
                    </label>
                </div>
                <div>
                    <label for="cpf">CPF:
                    <input name="cpf" type="text" id="cpf" required>
                    </label>
                </div> 
                <input type="submit" value="+ Adicionar" id="env">
                </form>
                </div>
        </div>
    </div>
    <script src="alunos.js"></script>
</body>
</html>