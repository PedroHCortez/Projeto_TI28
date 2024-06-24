<?php

// ACESSA O SERVIDOR COM PHP
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    // PREENCHENDO VARIÁVEIS COM METODO POST VINDO DO HTML
    $login = $_POST['txtlogin'];
    $senha = $_POST['txtsenha'];

    if ($login == "admin" & $senha == 123)
    {
        echo "<script>window.location.href='https://google.com';</script>";
        echo ("<br>");
    }
    
    else
    {
        echo "<script>window.alert('USUARIO OU SENHA INCORRETOS');</script>";
        echo ("<br>");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- STYLE PARA EVITAR ARQUIVO CSS -->
    <style>
        body {
            background-color: grey;
        }
        .container-global{
            display: flex;
            justify-content: center;
        }

        .formulario{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-flow: column wrap;
            width: 300px;
            height: 400px;      
        }

        .formulario input{
            border: 2px black solid;
            height: 20px;
            border-radius: 10px;
        }
    </style>
    <title>FORMULÁRIO LOGIN</title>
</head>

<body>
    <div class="container-global">
        <form class="formulario" action="formulario.php" method="post">
            <label>LOGIN</label>
            <br>
            <input type="text" name="txtlogin">
            <br>
            <label>SENHA</label>
            <br>
            <input type="password" name="txtsenha">
            <br>
            <br>
            <input type="submit" value="ACESSAR">
        </form>
    </div>
</body>

</html>