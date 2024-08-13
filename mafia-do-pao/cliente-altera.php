<?php

include('conectadb.php');
include('topo.php');

//Coleta valor ID na URL
$id= $_GET['id'];
$sql = "SELECT * FROM tb_clientes WHERE cli_id = $id";

$retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno))
    {
        $cpf = $tbl[1];
        $nome = $tbl[2];
        $email = $tbl[3];
        $telefone = $tbl [4];
        $status = $tbl[5];
    }

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $cpf = $_POST['cpf'];
    $email = $_POST['txtemail'];
    $status = $_POST['status'];

    $sql = "UPDATE tb_clientes
    SET cli_cpf = '$cpf', cli_nome = '$nome', cli_email = '$email', cli_cel = '$telefone', cli_status = '$status'
    WHERE cli_id = '$id'";

    mysqli_query($link, $sql);

    echo"<script>window.alert('USUÁRIO ALTERADO COM SUCESSO!');</script>";
    echo"<script>window.location.href='usuario-lista.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>ALTERAÇÃO DE CLIENTE</title>
</head>
<body>

    <div class="container-global">

        <form class="formulario" action="cliente-cadastro.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <label>CPF</label>
            <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" oninput="formatarCPF(this)" maxlength="15">
            <br>
            <label>NOME</label>
            <input type="text" name="txtnome" placeholder="Digite seu nome" value="<?=$nome?>" required>
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" value="<?=$email?>" required>
            <br>
            <label>TELEFONE</label>
            <input type="text" name="txtcel" id="telefone" placeholder="(00)00000-0000" maxlength="15" value="<?=$telefone?>" required>
            <br>
            
            <!-- Ativo ou Inativo -->
            <input type="radio" name="status" value="1" <?=$status == '1'?"checkrd": ""?>>ATIVO
            <input type="radio" name="status" value="1" <?=$status == '0'?"checkrd": ""?>>INATIVO            
            <br>
            <br>
            <input type="submit" value="CONFIRMAR">
        </form>
    </div>

    <script src="script/script.js"></script>

</body>
</html>