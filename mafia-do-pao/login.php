<?php

include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $login = $_POST['txtlogin'];
    $senha = $_POST['txtsenha'];

    // COMEÇA VALIDAR BANCO DE DADOS
    $sql = "SELECT COUNT(usu_id) FROM tb_usuarios
    WHERE usu_login = '$login' AND usu_senha = '$senha' AND
    usu_status = '1'";

    // RETORNO DO BANCO
    $retorno = mysqli_query($link, $sql);

    $contagem = mysqli_fetch_array($retorno) [0];

    // VERIFICA SE NATAN EXISTE
    if($contagem == 1)
    {
        echo"<script>window.location.href='home.php';</script>";
    }
    else
    {
        echo"<script>window.alert('USUARIO OU SENHA INCORRETOS');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LOGIN USUÁRIO</title>
</head>

<body>

    <div class="container-global">
        <form class="formulario" action="login.php" method="post">
            <img src="img/logo.png" width=100px height=100px>
            <label>LOGIN</label>
            <input type="text" name="txtlogin" required>
            <br>
            <label>SENHA</label>
            <input type="password" name="txtsenha" required>
            <br>
            <br>
            <input type="submit" value="ACESSAR">
        </form>
    </div>

</body>

</html>