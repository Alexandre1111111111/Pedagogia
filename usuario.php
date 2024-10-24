<?php

$sql = "SELECT * FROM acesso WHERE Admin = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row["Cpf"] === $_SESSION['cpfus']) {
    echo "<script>
        let adm;
        adm = document.createElement('li');
        adm.title='Gerenciar Acesso';
        if(window.location.href.includes('admin')) {
            adm.style.backgroundColor = '#bbb8b8';
        }
        adm.innerHTML = `<a href='admin.php'><img src='https://cdn-icons-png.flaticon.com/512/807/807292.png' alt=''></a>`;
        document.querySelector('.lte ul').appendChild(adm);
    </script>";
}
$sql = "SELECT * FROM acesso WHERE Cpf = '" . $_SESSION['cpfus'] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row["Cpf"] === $_SESSION['cpfus']) {
    echo "<script>
        document.getElementById('us').textContent = '". $row["Nome"]. "';
    </script>";
    $usuario = $row["Nome"];
}