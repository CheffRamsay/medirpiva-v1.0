<?php

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$localidad = $_POST['localidad'];
$dni = $_POST['dni'];
$comentario = $_POST['mensaje'];
    

    $nuevoContactoTxt = "Hola maxi te solicito información te paso mís datos personales que me pediste:"; 
    $nombreTexto = "Nombre: ";
    $dniTexto = "Dni: ";
    $mailTexto = "Email: ";
    $telefonoTexto = "Telefono: ";
    $dniTexto = "Dni: ";
    $mensajeTexto = "Mensaje: ";
    $localidadesTexto = "Localidad: ";
    $comentarioTexto = 'Mensaje: ';
   


function send_whatsapp($message){
        $phone="+5491134212930";  // Enter your phone number here
        $apikey="794762";       // Enter your personal apikey received in step 3 above

       //$phone="+5491124635748";   //Enter your phone number here
       //$apikey="141361";          //Enter your personal apikey received in step 3 above

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
     /*
     
      send_whatsapp( $nuevoContactoTxt .'\n' .$nombreTexto .$nombre .'\n'
    .$mailTexto .$email .'\n'
    .$telefonoTexto .$telefono .'\n'
    .$dniTexto .$dni .'\n'
    .$mensajeTexto .$mensaje);
     */
   
  
  send_whatsapp( $nuevoContactoTxt .'\n' .$nombreTexto .$nombre .'\n'
                  .$mailTexto .$correo .'\n' 
                  .$telefonoTexto .$telefono .'\n' 
                  .$localidadesTexto .$localidad .'\n'
                  .$dniTexto .$dni .'\n'
                  );
  
    

  //send_whatsapp($nuevoContactoTxt .'\n'$mailTexto);