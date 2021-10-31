<?php


require("phpmailer/class.phpmailer.php");
require("phpmailer/class.smtp.php");







$nombre = $_POST["nameart"];

$telefono = $_POST["telefonoart"];

$dni = $_POST["dniart"];

$email = $_POST["mailart"];

$mensaje = $_POST["comentarioart"];




$destinatario = 'lucas_.caceres@hotmail.com.ar';





// Datos de la cuenta de correo utilizada para enviar v�a SMTP
$smtpHost = "mail.medipriva.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "asesorprepagassalud@medipriva.com";  // Mi cuenta de correo
$smtpClave = "13openmicompu";  // Mi contrase�a




$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;


$mail->From = $email; // Email desde donde env�o el correo.
$mail->FromName = $nombre;
$mail->AddAddress($destinatario); // Esta es la direcci�n a donde enviamos los datos del formulario

$mail->Subject = "Formulario desde el MEDIRPIVA PREPAGA"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "
<html> 

<body> 

<h1>Recibiste un nuevo desde Medipriva.com</h1>

<p>Informacion enviada por el usuario de la web:</p>

<p>nombre: {$nombre}</p>

<p>email: {$email}</p>

<p>telefono: {$telefono}</p>

<p>dni: {$dni}</p>

<p>mensaje: {$mensaje}</p>

</body> 

</html>

<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send(); 





?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<head>
	<meta charset="UTF-8">
	<title>Medicina Privada</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>


<script>
	swal("ENVIADO!","En instantes nos comunicaremos","success");
	let boton = document.querySelector(".swal-button").addEventListener("click",function(){
		window.location.href = "https://medipriva.com/";
	});
</script>
<style>

.swal-button{
  background-color:#dc3545;
}
.swal-button:hover{
  background-color:#384c64 !important;
}
.swal-icon--success__line{
  background-color:#384c64;
}
.swal-icon--success{
  background-color:white !important;
}

@media screen and (max-width:600px){
	
.swal-modal{
	width: 300px !important;
	height: 500px !important;
}

.swal-footer{
    text-align: center;
}
.swal-button{
    padding: 10px 50px;
}

}




	

</style>
	
</body>
</html>

