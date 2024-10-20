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
        </ul>
    </nav>
    <script>
        let lin;
    </script>
    <div class="tab-content">
        <div class="pes">
            <div>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="get">
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
            <?php
        include("banco.php");
        
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
                             <td><img src='' alt=''></td>
                             <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                             <td>". $row["AnoLetivo"]. "</td>
                             <td>". $row["Turma"]. "</td>
                             <td>". $row["Responsaveis"]. "</td>
                             <td>". $row["TelefoneEstudante"]. "</td>
                             <td>". $row["TelefoneResponsaveis"]. "</td>
                             <td>". $row["Endereco"]. "</td>
                             <td>". $row["Medicamento"]. "</td>
                             <td><button>Ver</button></td>
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
        mysqli_close($conn);
        ?>
        </table>
        </div>
    </main>
    <script src="pesquisa.js"></script>
</body>
</html>