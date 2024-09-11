<?php
include ("conectadb.php");
include("topo.php");

$id = $_GET['id'];
$sql = "SELECT pro.pro_id, pro.pro_nome, pro.pro";