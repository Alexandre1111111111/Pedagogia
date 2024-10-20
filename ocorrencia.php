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
        </div>
    </main>
    <script>
        let lin;
    </script>
    <?php
            $sql = "SELECT Nome, Data, Registro, FeitoPor, Gravação, Adendos FROM ocorrencia";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<script>
                lin = document.createElement('tr');
                lin.innerHTML = `
                 <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                 <td>". $row["Data"]. "</td>
                 <td>". $row["Registro"]. "</td>
                 <td>". $row["FeitoPor"]. "</td>
                 <td>". $row["Gravação"]. "</td>
                 <td><button>Ver</button></td>
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
                    <button>Ocorrência</button>
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
    <script src="alunos.js"></script>
</body>
</html>