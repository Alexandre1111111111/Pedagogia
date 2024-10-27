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
    <title>SRP - Excluídos</title>
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
            <li class="exb" style="background-color: #bbb8b8;" title="Excluidos"><a href="excluidos.php"><img src="https://cdn-icons-png.flaticon.com/512/484/484611.png" alt=""></a></li>
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
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Justificativa</th>
                </tr>
            </thead>
            <tbody class="alunos">

            </tbody>
        </table>
        <div class="na">Nenhum aluno disponível</div>
        </div>
    </main>
    <script>
        let lin;
    </script>
    <?php
        include("usuario.php");
    if(empty( $_GET['termo'] ) || $_GET['termo'] == null) {
            $sql = "SELECT * FROM excluidos";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc( $result)){
                echo "<script>
                lin = document.createElement('tr');
                lin.innerHTML = `
                    <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                    <td>". date("d-m-Y H:i:s", strtotime($row["Data"])). "</td>
                    <td class='nm'>". $row["Justificativa"]. "</td>
                `
                document.querySelector('.alunos').appendChild(lin);
                </script>";
            }
        }
        else {
            if (isset($_GET['termo'])) {

                $termo = "%" . $conn->real_escape_string($_GET['termo']) . "%";
            
                $sql = "SELECT * FROM excluidos WHERE Nome LIKE ? OR Data LIKE ? OR Justificativa LIKE ?";
                
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
                                <td>". date("d-m-Y H:i:s", strtotime($row["Data"])). "</td>
                                <td class='nm'>". $row["Justificativa"]. "</td>
                            `
                            document.querySelector('.alunos').appendChild(lin);
                            </script>";
                    }}
                    
                    $stmt->close();
                }
            }
        }
                mysqli_close($conn);
    ?>
    <script src="excluidos.js"></script>
</body>
</html>