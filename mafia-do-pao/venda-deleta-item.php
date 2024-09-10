<?php
include ("conectadb.php");

$idiv = $_GET['id'];
$sqldeleta = "DELETE FROM tb_item_venda WHERE id_iv = $idiv";
$resultado = mysqli_query($link, $sqldeleta);

header("Location: vendas.php");