<?php

    function send_whatsapp($message){
        $phone="+5491134212930";  // Enter your phone number here
        $apikey="794762";       // Enter your personal apikey received in step 3 above

       // $phone="+5491124635748";   Enter your phone number here
       // $apikey="141361";          Enter your personal apikey received in step 3 above

        $url='https://api.callmebot.com/whatsapp.php?source=php&phone='.$phone.'&text='.urlencode($message).'&apikey='.$apikey;

        if($ch = curl_init($url))
        {
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            $html = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            // echo "Output:".$html;  // you can print the output for troubleshooting
            curl_close($ch);
            return (int) $status;
        }
        else
        {
            return false;
        }
    }



    require_once '../vendor/autoload.php';
    require_once 'correo.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    $nombre = $_POST["nombre"] ?? '';
    $dni = $_POST["dni"] ?? '';
    $telefono = $_POST["telefono"] ?? '';
    $email = $_POST["email"] ?? '';
    $mensaje = $_POST["mensaje"] ?? '';
    
    $nuevoContactoTxt = "NUEVO CONTACTO MEDIPRIVA:";
    $nombreTexto = "Nombre:";
    $mailTexto = "Email: ";
    $telefonoTexto = "Telefono:";
    $dniTexto = "Dni: ";
    $mensajeTexto = "Mensaje:";
 
    $respuesta = [];
    $bandera = true;

    //Expresiones regulares
    $soloNumeros = "/[0-9]/";

    if($nombre == ""){
        $respuesta += ['nombre' => 'Ingrese su nombre'];
        $bandera= false;
    }

    if($dni == ''){
        $respuesta += ['dni' => 'Ingrese dni']; 
        $bandera= false;
    }

    if($telefono == '' ){
        $respuesta += ['telefono' => 'Ingrese telefono'];
        $bandera= false;
    }

	if($email == ''){
        $respuesta += ['email' => 'Ingrese email'];
        $bandera= false;
    }

    if($bandera){

		$mail = new PHPMailer(true);
		try {
			//Server settings
		    //       $mail->SMTPDebug = 2;                                       // Enable verbose debug output
			$mail->isSMTP();                                            // Set mailer to use SMTP
			$mail->Host       = 'mail.medipriva.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'asesorprepagassalud@medipriva.com';                     // SMTP username
			$mail->Password   = '13openmicompu';                               // SMTP password
			$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port       = 465;                                    // TCP port to connect to
			//Recipients
            $mail->setFrom('asesorprepagassalud@gmail.com', 'Medipriva - Contacto');
            $mail->addAddress('asesorprepagassalud@gmail.com', 'Maxi');
            $mail->addCC('stormbringer.lu@gmail.com');
		
			//$mail->setFrom('stormbringer.lu@gmail.com', 'Medipriva - Contacto');
			//$mail->addAddress('stormbringer.lu@gmail.com', 'Alphcode');
			// Content
			$mail->Subject = 'Nuevo contacto';
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Body    = correo($nombre,$dni,$telefono,$email,$mensaje);
			$mail->CharSet = 'UTF-8';
			$mail->send();
			$respuesta = ['respuesta' => true];
		} catch (Exception $e) {
			$respuesta = ['respuesta' => false];
		}

        
         send_whatsapp( $nuevoContactoTxt .'\n' .$nombreTexto .$nombre .'\n'
        .$mailTexto .$email .'\n'
        .$telefonoTexto .$telefono .'\n'
        .$dniTexto .$dni .'\n'
        .$mensajeTexto .$mensaje);




    }


    echo json_encode($respuesta);