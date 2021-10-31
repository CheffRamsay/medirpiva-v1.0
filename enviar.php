<?php


require("phpmailer/class.phpmailer.php");
require("phpmailer/class.smtp.php");







$nombre = $_POST["name"];

$telefono = $_POST["telefono"];

$dni = $_POST["dni"];

$email = $_POST["email"];

$mensaje = $_POST["comentario"];


//$destinatario = "asesorprepagassalud@gmail.com";
$destinatario = "stormbringer.lu@gmail.com";



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
//$mail->addCC('stormbringer.lu@gmail.com');

$mail->Subject = "Formulario desde el Sitio Web"; // Este es el titulo del email.
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
	
	<!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-T6Z87PQ');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
    
    <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T6Z87PQ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

<!--
<script>
	swal("ENVIADO!","En instantes nos comunicaremos","success");
	let boton = document.querySelector(".swal-button").addEventListener("click",function(){
		window.location.href = "https://medipriva.com/";
	});
</script>

-->



<script>
	swal("ENVIADO!","En instantes nos comunicaremos","success");
	document.querySelector(".swal-overlay").addEventListener("click",function(){
		window.location.href = "https://medipriva.com/";
	});
</script>



<style>

.swal-button{
  background-color:#dc3545;
}
.swal-button:hover{
  background-color:#384c64;
}
.swal-icon--success__line{
  background-color:#384c64;
}
.swal-icon--success{
  background-color:white;
}


@media screen and (max-width:600px){
	
.swal-modal{
   width: calc(100% - 20px);
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

