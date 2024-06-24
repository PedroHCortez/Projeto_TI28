<?php

$alunonota1 = 10;
$alunonota2 = 8;
$alunonota3 = 6;

echo("NOTA 1: " . $alunonota1 . "<br>" . "NOTA 2: " . $alunonota2 . "<br>" . "NOTA 3: " . $alunonota3 . "<br>");
echo("<br>");
echo("NOTA FINAL: ");
echo($alunonotafinal = ($alunonota1 + $alunonota2 + $alunonota3) / 3);
echo("<br>");
echo("<br>");

if ($alunonotafinal >= 7)
{
    echo("APROVADO!");
}
else if ($alunonotafinal == 6)
{
    echo("RECUPERAÇÃO!");
}
else if ($alunonotafinal < 6)
{
    echo("REPROVADO!");
}
else
{
    echo("ERRO!");
}

echo("<br>");
echo("- - -");
echo("<br>");


// MODO HARD

echo("<br>");
$valor = (342 / 100) * 12;
echo("12% DE 342 = " . $valor."%");

?>