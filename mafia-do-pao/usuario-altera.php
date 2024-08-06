<?php

include('conectadb.php');

//Coleta valor ID na URL
$id= $_GET['id'];
$sql = "SELECT * FROM tb_usuarios WHERE usu_id = $id";

$retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno))
    {
        $login = $tbl[1];
        $email = $tbl[2];
        $senha = $tbl[3];
        $status = $tbl[4];
    }

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $senha = $_POST['txtsenha'];
    $email = $_POST['txtemail'];
    $status = $_POST['status'];

    $sql = "UPDATE tb_usuarios
    SET usu_senha = '$senha', usu_email = '$email', usu_status = '$status'
    WHERE usu_id = '$id'";

    mysqli_query($link, $sql);

    echo"<script>window.alert('USUÁRIO ALTERADO COM SUCESSO!');</script>";
    echo"<script>window.location.href='usuario-lista.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>ALTERAÇÃO DE USUÁRIO</title>
</head>
<body>

    <a href="usuario-lista.php"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

    <div class="container-global">

        <form class="formulario" action="usuario-cadastro.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <label>LOGIN</label>
            <input type="text" name="txtlogin" value="<?=$login?>" required>
            <br>
            <label>SENHA</label>
            <input type="password" name="txtsenha" placeholder="Digite sua senha" value="<?=$senha?>" required>
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" value="<?=$email?>" required>
            
            <!-- Ativo ou Inativo -->
            <input type="radio" name="status" value="1" <?=$status == '1'?"checkrd": ""?>>ATIVO
            <input type="radio" name="status" value="1" <?=$status == '0'?"checkrd": ""?>>INATIVO            
            <br>
            <br>
            <input type="submit" value="CONFIRMAR">
        </form>
    </div>
</body>
</html>