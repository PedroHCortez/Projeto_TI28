<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; // para usar a pasta e comandoa do PHPMailer

require 'PHPMail/src/Exception.php';
require 'PHPMail/src/PHPMailer.php';
require 'PHPMail/src/SMTP.php';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include('conectadb.php');
    $email = $_POST['email'];
    //verificação se o usuario é valido
    $sql = "SELECT COUNT (usu_id) FROM tb_usuarios WHERE usu_email = '$email'";
    $resultado = mysqli_query($link,$sql);
    while($tbl = mysqli_fetch_array($resultado))
    {
        $cont = $tbl[0];
    }
    if($cont != 0)
    {
        $recupera = rand(100000, 999999); //gerar um random de 6 digitos
        $sql = "UPDATE tb_usuarios SET recupera = '$recupera'
        WHERE usu_email = '$email'";
        mysqli_query($link,$sql);

        // parte para a recuperação do email usando o PHPMail
        $to = $email;
        $subject = "RECUPERAÇÃO DE SENHA";
        $message = "Esse é o seu código de recuperação: $recupera . <br>
        Acesse <a href='https://localhost/Projeto_TI28/mafia-do-pão/redefinesenha.php'>aqui</a> para redefinir sua senha.";
        $mail = new PHPMailer(true);
        try
        {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com'; //usando o serviço SMTP da Microsoft
            $mail->SMTPAuth = true;
            $mail->Username = 'seuemail@outlook.com'; //coloque seu email outlook real
            $mail->Password = 'suasenha'; //coloque sua senha de email real
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; //porta usada pelo serviço SMTP da Microsoft
            $mail->setFrom('seuemail@outlook.com', 'EMAIL REC');
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->send();
            echo "<script>window.alert('EMAIL ENVIADO COM SUCESSO!');</script>";
        }
        catch (Exception $e)
        {
            echo "NÃO FOI POSSIVEL ENVIAR A MENSAGEM: {$mail->ErrorInfo}";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>RECUPERAÇÃO DE SENHA</title>
</head>
<body>
    <div class="container-global">
        <form class="formulario" action="recuperasenha.php" method="POST">
            <h2><label>REDEFINIR SENHA</label></h2>
            <label for="email">EMAIL</label>
            <input type="text" id="email" name="email">
            <br>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>