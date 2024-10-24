<?php
    include("banco.php");
    session_start();
    if (!isset($_SESSION['cpfus'])) {
        header("Location: index.php");
        exit();
    }
    $sql = "SELECT * FROM acesso WHERE Admin = 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
if ($row["Cpf"] != $_SESSION['cpfus']) {
    header("Location: alunos.php");
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
            <li title="Alunos"><a href="alunos.php"><img src="https://cdn-icons-png.flaticon.com/512/10252/10252944.png" alt=""></a></li>
            <li title="Ocorrências"><a href="ocorrencia.php"><img src="https://cdn-icons-png.flaticon.com/512/1584/1584808.png" alt=""></a></li>
        </ul>
    </nav>
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
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody class="alunos">

            </tbody>
        </table>
        <?php if(empty( $_GET['termo'] ) || $_GET['termo'] == null) { ?>
        <button id="add">+ Adicionar Acesso</button>
        <?php }?>
        </div>
    </main>
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
        include("usuario.php");
    if($_GET['termo'] == null) {
            $sql = "SELECT * FROM acesso";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc( $result)){
                echo "<script>
                lin = document.createElement('tr');
                lin.innerHTML = `
                    <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                    <td>". $row["Email"]. "</td>
                    <td>". $row["Cpf"]. "</td>
                `
                document.querySelector('.alunos').appendChild(lin);
                </script>";
            }
        }
        else {
            if (isset($_GET['termo'])) {
                // Prevenir SQL injection utilizando prepared statements
                $termo = "%" . $conn->real_escape_string($_GET['termo']) . "%";
            
                // Consulta SQL para buscar os produtos que correspondem ao termo de pesquisa
                $sql = "SELECT * FROM acesso WHERE Email LIKE ? OR Cpf LIKE ? OR Nome LIKE ?";
                
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
                            <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                             <td>". $row["Email"]. "</td>
                             <td>". $row["Cpf"]. "</td>
                            `
                            document.querySelector('.alunos').appendChild(lin);
                            </script>";
                    }} else {
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
            <h2>Cadastro Pedagógico</h2>
            <form action="cadmin.php" method="post" id="formAluno">
                <div>
                    <label for="nome">Nome:</label>
                    <input name="nome" type="text" id="nome" required>
                </div> 
                <div>
                    <label for="em">Email:</label>
                    <input placeholder="@escola" pattern=".+@escola.pr.gov.br" name="em" type="email" id="em" required>
                </div> 
                <div>
                    <label for="cpf">Cpf:</label>
                    <input name="cpf" type="text" id="cpf" required>
                </div> 
                <input type="submit" value="Adicionar" id="env">
                </form>
        </div>
    </div>
    <script src="ocorrencia.js"></script>
</body>
</html>