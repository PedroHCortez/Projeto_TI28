<?php

include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $cpf = $_POST['cpf'];
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $telefone = $_POST['telefone'];

    // VALIDA SE O CLIENTE QUE VAI SER CADASTRADO JÁ EXISTE
    $sql = "SELECT COUNT(cli_id) FROM tb_clientes
    WHERE cli_cpf = '$cpf' OR cli_email = '$email'";

    // RETORNO DO BANCO
    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno) [0];

    // VERIFICA SE CLIENTE EXISTE
    if($contagem == 0)
    {
        $sql = "INSERT INTO tb_clientes (cli_cpf, cli_nome, cli_email, cli_cel, cli_status)
        VALUES ('$cpf', '$nome', '$email', '$telefone', '1')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('CLIENTE CADASTRADO COM SUCESSO');</script>";
        echo"<script>window.location.href='login.php';</script>";
    }
    else if ($contagem >= 1)
    {
        echo"<script>window.alert('CLIENTE JÁ EXISTENTE');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>CADASTRO CLIENTE</title>
</head>

<body>

    <a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

    <div class="container-global">

        <form class="formulario" action="usuario-cadastro.php" method="post">
            <label>CPF</label>
            <input type="text" id="cpf" placeholder="000.000.000-00" oninput="formatarCPF(this)">
            <br>
            <label>NOME</label>
            <input type="text" name="txtnome" placeholder="Digite seu nome" required>
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" required>
            <br>
            <label>TELEFONE</label>
            <input type="text" id="telefone" placeholder="(00) 00000-0000" maxlength="15">
            <br>
            <input type="submit" value="CONFIRMAR">
        </form>
    </div>

    <script src="scripts/script.js"></script>

</body>

</html>