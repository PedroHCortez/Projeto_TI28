<?php
include('conectadb.php');
include('topo.php');

// CONSULTA CLIENTES CADASTRADOS
$sql = "SELECT * FROM tb_clientes WHERE cli_status = '1'";
$retorno = mysqli_query($link, $sql);
$status = '1';

// ENVIANDO PARA O SERVIDOR O SELETOR RADIO EM 0 OU 1
if($_SERVER['REQUEST_METHOD']=='POST'){
    $status = $_POST['status'];
 
    if($status == 1){
        $sql = "SELECT * FROM tb_clientes WHERE cli_status = '1'";;
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT * FROM tb_clientes WHERE cli_status = '0'";;
        $retorno = mysqli_query($link, $sql);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LISTA DE CLIENTES</title>
</head>
<body>

    <div class="container-listausuarios">
        <!-- FAZER DEPOIS DO ROLÊ -->
        <form action="cliente-lista.php" method="post">
            <input type="radio" name="status" value="1" required onclick="submit()" <?= $status=='1' ? "checked": ""?>>ATIVOS
            <br>
            <input type="radio" name="status" value="0" required onclick="submit()" <?= $status=='0' ? "checked": ""?>>INATIVOS
            <br>
        </form>
        <!-- LISTAR A TABELA DE CLIENTES -->
        <table class="lista">
            <tr>
                <th>CPF</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>

            <!-- BUSCAR NO BANCO DE DADOS DE TODOS OS CLIENTES -->
             <?php
                while($tbl = mysqli_fetch_array($retorno))
                {
                    ?>
                    <tr>
                        <td><?=$tbl[1]?></td> <!-- COLETA O CPF DO CLIENTE -->
                        <td><?=$tbl[2]?></td> <!-- COLETA O NOME DO CLIENTE -->
                        <td><?=$tbl[3]?></td> <!-- COLETA O EMAIL DO CLIENTE -->
                        <td><?=$tbl[4]?></td> <!-- COLETA O TELEFONE DO CLIENTE -->
                        <td><?=$tbl[5]?></td> <!-- COLETA O STATUS DO CLIENTE -->
                        <td>
                            <a href="cliente-altera.php?id=<?=$tbl[0]?>">
                                <input type="button" value="ALTERAR">
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
        </table>
    </div>
</body>
</html>