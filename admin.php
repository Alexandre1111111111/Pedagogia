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
    <title>SRP - Acessos</title>
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
        <button id="addp">+ Adicionar Acesso</button>
        <?php }?>
        <div class="tb">
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
        </div>
        <div class="na">Nenhum acesso encontrado</div>
        </div>
    </main>
    <script>
        let lin;
    </script>
    <?php
        include("usuario.php");
    if(empty( $_GET['termo'] ) || $_GET['termo'] == null) {
            $sql = "SELECT * FROM acesso";
            $result = mysqli_query($conn, $sql);
            echo "<script>";
            while($row = mysqli_fetch_assoc( $result)){
                echo "
                lin = document.createElement('tr');
                lin.innerHTML = `
                    <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                    <td>". $row["Email"]. "</td>
                    <td class='nm'>". $row["Cpf"]. "</td>
                `
                document.querySelector('.alunos').appendChild(lin);
                    if(". $row["Admin"] ." == 0) {
                    lin.addEventListener('click', function(){
                    const del = document.querySelector('.del');
                    del.style.display = 'flex';
                    setTimeout(() => {
                    del.style.bottom = '0';
                    del.style.opacity = '1';
                    }, 10)
                    })
                    }
                    else {
                    lin.style.backgroundColor = '#C3C5FF';
                    }";
            }
            echo "</script>";
        }
        else {
            if (isset($_GET['termo'])) {

                $termo = "%" . $conn->real_escape_string($_GET['termo']) . "%";
            
                $sql = "SELECT * FROM acesso WHERE Email LIKE ? OR Cpf LIKE ? OR Nome LIKE ?";
                
                if ($stmt = $conn->prepare($sql)) {

                    $stmt->bind_param("sss", $termo, $termo, $termo);
                    
                    $stmt->execute();
                    
                    $resultado = $stmt->get_result();
            
                    if ($resultado->num_rows > 0) {
                        echo "<script>";
                        while($row = mysqli_fetch_assoc($resultado)){    
                            echo "
                            lin = document.createElement('tr');
                            lin.innerHTML = `
                            <td style='font-weight: bold;'>". $row["Nome"]. "</td>
                             <td>". $row["Email"]. "</td>
                             <td class='nm'>". $row["Cpf"]. "</td>
                            `
                            document.querySelector('.alunos').appendChild(lin);
                            if(". $row["Admin"] ." == 0) {
                            lin.addEventListener('click', function(){
                            const del = document.querySelector('.del');
                            del.style.display = 'flex';
                            setTimeout(() => {
                            del.style.bottom = '0';
                            del.style.opacity = '1';
                            }, 10)
                        })
                        }
                        else {
                        lin.style.backgroundColor = '#C3C5FF';
                        }";
                    }
                    echo "</script>";
                }
                    
                    $stmt->close();
                }
            }
        }
                mysqli_close($conn);
    ?>
            <div class="excct">
            <div class="excp">
            <button id="fche"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
            <div class="info">
                <h1>Excluir Acesso?</h1>
                <form action="cadmin.php" method="post">
                <div>
                    <label style="pointer-events: none;" for="pe">CPF:
                    <input readonly name="pe" type="text" id="pe">
                    </label>
                </div>
                        <input id="excl" type="submit" value="Excluir">
                    </div>
                </form>
            </div>
            </div>
        <div class="del">
            <button title="Excluir" class="delet"><img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt=""></button>
        </div>
    <div class="cadalct">
        <div style="height: 50vh;" class="cadal">
            <button id="fch"><img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt=""></button>
            <div class="info">
            <h1>Cadastro Pedagógico</h1>
            <form action="cadmin.php" method="post" id="formAluno">
                <div>
                    <label for="nome"><em>*</em>Nome:</label>
                    <input name="nome" type="text" id="nome" required>
                </div> 
                <div>
                    <label for="em"><em>*</em>Email:</label>
                    <input placeholder="@escola" pattern=".+@escola.pr.gov.br" name="em" type="email" id="em" required>
                </div> 
                <div>
                    <label for="cpf"><em>*</em>Cpf:</label>
                    <input name="cpf" type="text" id="cpf" required>
                </div> 
                <h1 id="ob">* Obrigatório</h1>
                <input type="submit" value="+ Adicionar" id="env">
                </form>
            </div>
        </div>
    </div>
    <script src="admin.js"></script>
</body>
</html>