<?php

require("class.phpmailer.php");
require("class.smtp.php");

$mail = new PHPMailer();
$mail->isSMTP();

$mail->Host = "mail.medipriva.com";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = true;

$mail->Username = 'test@medipriva.com';
$mail->Password = '+Lc&unpq-j1~';

$mail->From = 'test@medipriva.com';
$mail->FromName = "remitente";
$mail->AddAddress('stormbringer.lu@gmail.com', "destinatario");

$mail->WordWrap = 50;
$mail->IsHTML(true);

$mail->Subject = "Asunto .....";
$mail->Body    = $_POST['algo'];

$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);


if(!$mail->Send())

{
   echo "Error al enviar. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Mensaje enviado!";

?> 
