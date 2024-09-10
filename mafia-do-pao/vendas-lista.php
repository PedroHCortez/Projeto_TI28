<?php
include("conectadb.php");
include("topo.php");
#PESQUISA DA VENDA
 
#PESQUISA A DATA MINIMA E MAXIMA PARA OS FILTROS
$selectdatamin = "SELECT MIN(ven_datavenda) FROM tb_venda";
$selectdatamax = "SELECT MAX(ven_datavenda) FROM tb_venda";
 
$resultado_data_min = mysqli_query($link, $selectdatamin);
$resultado_data_max = mysqli_query($link, $selectdatamax);
 
$data_min = mysqli_fetch_array($resultado_data_min);
$data_max = mysqli_fetch_array($resultado_data_max);
 
// CONFIGURANDO A DATA PARA QUE O HTML MOSTRE BONITINHO
$data_min_string = date("Y-m-d", strtotime($data_min[0]));
$data_max_string = date("Y-m-d", strtotime($data_max[0]));
 
// PESQUISA OS CLIENTES PARA O FILTRO
$sqlcli = "SELECT cli_id, cli_nome FROM tb_clientes";
$retornocli = mysqli_query($link, $sqlcli);
 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $idcliente = $_POST['idcliente'];
    $datainicial = $_POST['datainicial'];
    $datafinal = $_POST['datafinal'];
 
    if ($datainicial < 0)
    {
        $datainicial = $data_min_string;
    }
    if ($datafinal < 0)
    {
        $datafinal = $data_max_string;
    }
 

    //a pagina carregou oq ele vai trazer?
 
    //pesquisa no banco todos os produtos do banco
    $sql = "SELECT v.ven_id, v.ven_datavenda, v.ven_totalvenda, v.fk_iv_cod_iv, v.fk_cli_id, v.fk_usu_id, c.cli_nome, u.usu_login FROM tb_venda v 
    JOIN tb_clientes c ON v.fk_cli_id = c.cli_id
    JOIN tb_usuarios u ON v.fk_usu_id = u.usu_id WHERE v.ven_datavenda BETWEEN '$datainicial 0:0:0' AND 'datafinal 23:59:59' ";
 
    // $retorno = mysqli_query($link, $sql. "ORDER BY v.ven_id");
 
    $valortotal = "SELECT SUM(ven_totalvenda) FROM yb_venda WHERE v.ven_datavenda BETWEEN '$datainicial 0:0:0' AND '$datafinal 23:59:59' ";
    // $retornovalortotal = mysqli_query($link, $valortotal);
 
    if ($idcliente == 'todos')
    {
        $retorno = mysqli_query($link, $valortotal . "ORDER BY v.ven_id");
        $retornovalortotal = mysqli_query($link, $valortotal . "ORDER BY v.ven_id");
    }
    else
    {
        // ADICIONAR AO 'sql' A CONDIÇÃO DE PESQUISA AO NOME
        $sql .= "AND c.cli_id = " . $idcliente . "ORDER BY ven_id";
        $retorno = mysqli_query($link, $sql);
 
        $valortotal .= " AND c.cli_id = " . $idcliente . "ORDER BY ven_id";
        $retornovalortotal = mysqli_query($link, $valortotal);
    }
}
else
{
    $sql = "SELECT v.ven_id, v.ven_datavenda, v.ven_totalvenda, v.fk_iv_cod_iv, v.fk_cli_id, v.fk_usu_id, c.cli_nome, u.usu_login FROM tb_venda v
    JOIN
    tb_clientes c ON v.fk_cli_id = c.cli_id
    JOIN
    tb_usuarios u ON v.fk_usu_id = u.usu_id";
    $retorno = mysqli_query($link, $sql . "ORDER BY v.ven_id");
    $valortotal = "SELECT SUM(ven_totalvenda) FROM tb_venda";
    $retornovalortotal = mysqli_query($link, $valortotal);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>VENDA LISTA</title>
</head>

<body>
    <div class="container-global">
        <form class="formulario" action="venda-lista" method="post">
            <label>VALOR TOTAL BRUTO</label>
            <!-- PHP PARA RETORNAR A SOMA DO VALOR TOTAL -->
             <?php
             while ($tblvalortotal = mysqli_fetch_array($retornovalortotal))
             {
                echo "R$ ". $tblvalortotal[0];
             }?>
             <br>
             <br>
             <label>FILTROS</label>
             <br>
             <!-- FILTRO DE DATA MINIMA E MAXIMA -->
             <label for="data">SELECIONE A DATA INICIAL:</label>
             <input type="date">

             <!-- FILTRO PARA PESQUISA DE CLIENTE -->
              <label>SELECIONE O CLIENTE:</label>
              <select name="idcliente">
                <option value="todos">TODOS</option>
                <?php WHILE ($tblcli = mysqli_fetch_array($retornocli))
                {
                ?>
                    <option value="<?= $tblcli[0]?>"><?=strtoupper()
                    ?></option>

                <?php
                }
                ?>
              </select>
        </form>
    </div>    
</body>
</html>