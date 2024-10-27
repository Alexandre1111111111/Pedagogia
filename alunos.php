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
    <title>SRP - Alunos</title>
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
        <button id="add">+ Adicionar estudante</button>
        <?php } ?>
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
        <div class="na">Nenhum aluno encontrado</div>
        </div>
    </main>
    <script>
    let lin;
    </script>
        <div class="del">
            <button title="Editar" class="editar"><img src="https://cdn-icons-png.flaticon.com/512/2280/2280532.png" alt=""></button>
            <a id="expp"><button title="Exportar" class="exp"><img src="https://cdn-icons-png.flaticon.com/512/12067/12067207.png" alt=""></button></a>
            <button title="Excluir" class="delet"><img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt=""></button>
        </div>
        <div class="excct">
            <div class="exc">
            <button id="fche"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
            <div class="info">
                <h1>Excluir o estudante</h1>
                <form action="cadal.php" method="post">
                <div>
                    <label style="pointer-events: none;" for="nme">Nome:</label>
                    <input readonly name="nme" type="text" id="nme">
                </div>
                <div>
                    <label style="pointer-events: none;" for="al">CPF:</label>
                    <input readonly name="al" type="text" id="al">
                </div>
                    <div>
                        <label for="just">Justificativa:
                            <div id="chk">
                        <label for="forma">Formação
                        <input name="jsf" type="radio" value="Formação" id="forma" checked>
                        </label>
                        <label for="transf">Transferência
                        <input name="jsf" type="radio" value="Transferência" id="transf">
                        </label>
                        </div>
                        </label>
                    </div>
                        <input id="excl" type="submit" value="Excluir">
                    </div>
                </form>
            </div>
            </div>
            <div class="edict">
            <div style="height: 60vh;" class="edi">
            <button id="fchd"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
            <div class="info">
                <h1>Editar</h1>
                <form action="cadal.php" method="post">
                <div>
                    <label style="pointer-events: none;" for="cp">CPF:</label>
                    <input readonly name="cp" type="text" id="cp">
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
             <td class='ne' style='font-weight: bold;'>". $row["Nome"]. "</td>
             <td>". date("Y"). "</td>
             <td class='tu'>". $row["Turma"]. "</td>
             <td>". $row["Responsaveis"]. "</td>
             <td class='tfe'>". $row["TelefoneEstudante"]. "</td>
             <td class='tfr'>". $row["TelefoneResponsaveis"]. "</td>
             <td class='en'>". $row["Endereco"]. "</td>
             <td class='med'>". $row["Medicamento"]. "</td>
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
            $termo = "%" . $conn->real_escape_string($_GET['termo']) . "%";
        
            $sql = "SELECT * FROM pedagogia WHERE Nome LIKE ? OR Cgm LIKE ? OR Turma LIKE ?";
            
            if ($stmt = $conn->prepare($sql)) {

                $stmt->bind_param("sss", $termo, $termo, $termo);
                
                $stmt->execute();
                
                $resultado = $stmt->get_result();
        
                if ($resultado->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($resultado)){    
                            echo "<script>
                            lin = document.createElement('tr');
                            lin.innerHTML = `
                                <td><img src='uploads/" . $row["Foto"] . "' alt=''></td>
                                <td class='ne' style='font-weight: bold;'>". $row["Nome"]. "</td>
                                <td>". date("Y"). "</td>
                                <td class='tu'>". $row["Turma"]. "</td>
                                <td>". $row["Responsaveis"]. "</td>
                                <td class='tfe'>". $row["TelefoneEstudante"]. "</td>
                                <td class='tfr'>". $row["TelefoneResponsaveis"]. "</td>
                                <td class='en'>". $row["Endereco"]. "</td>
                                <td class='med'>". $row["Medicamento"]. "</td>
                                <td><button onclick='location.href=\"ocorrencia.php?termo=". $row["Nome"]."\"'>Ver</button></td>
                                <td class='cg'>". $row["Cgm"]. "</td>
                                <td class='nm'>". $row["Cpf"]. "</td>
                            `
                            document.querySelector('.alunos').appendChild(lin);

                            lin.addEventListener('click', function(){
                                const del = document.querySelector('.del');
                                del.style.display = 'flex';
                                setTimeout(() => {
                                del.style.bottom = '0';
                                del.style.opacity = '1';
                            }, 10)
                    })
                            </script>";
                        }
                } else {
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
            <h1>Cadastro de Estudante</h1>
            <form action="cadal.php" method="post" id="formAluno" enctype="multipart/form-data">
                <div>
                    <label for="foto"><em>*</em>Foto:
                    <input name="foto" type="file" id="foto" accept=".png, .jpeg, .jpg" required>
                    </label>
                </div>
                <div>
                    <label for="nome"><em>*</em>Nome:
                    <input name="nome" type="text" id="nome" minlength="4" required>
                    </label>
                </div>
                <div>
                    <label for="turma"><em>*</em>Turma:
                    <input name="turma" type="text" id="turma" minlength="3" required>
                    </label>
                </div>
                <div>
                    <label for="responsaveis"><em>*</em>Responsáveis:
                    <input name="res" type="text" id="responsaveis" minlength="4" required>
                    </label>
                </div>
                <div>
                    <label for="telefone">Telefone do Estudante:
                    <input name="tele" type="tel" id="telefone">
                    </label>
                </div> 
                <div>
                    <label for="telres"><em>*</em>Telefone do Responsável:
                    <input name="telr" type="tel" id="telres" required>
                    </label>
                </div>
                <div>
                    <label for="Endereco"><em>*</em>Endereço:
                    <input name="end" type="text" id="end" minlength="5" required>
                    </label>
                </div>
                <div>
                    <label for="saude">Problema de Saúde / Medicamento:
                    <input name="saude" type="text" id="saude">
                    </label>
                </div>
                <div>
                    <label for="cgm"><em>*</em>CGM:
                    <input name="cgm" type="number" id="cgm" required>
                    </label>
                </div>
                <div>
                    <label for="cpf"><em>*</em>CPF:
                    <input name="cpf" type="text" id="cpf" required>
                    </label>
                </div> 
                <h1 id="ob">* Obrigatório</h1>
                <input type="submit" value="+ Adicionar" id="env">
                </form>
                </div>
        </div>
    </div>
    <script src="alunos.js"></script>
</body>
</html>