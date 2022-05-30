<?php
namespace App\Libraries;

class Enviar_mail{	

	public function enviar_mail($direccion_email,$asunto,$mensaje_original){	
	
		$mensaje = $mensaje_original. "<br>";
		$mensaje .= 'Atentamente.' . "<br>";
		$mensaje .= 'Web: www.acom.org.ar' . "<br>";
		$mensaje .= 'Soporte: acom@colproba.org.ar' . "<br>";
		$mensaje .= 'Soporte Sistema ACOM.' . "<br>";
		
		ini_set( 'display_errors', 1 );
		error_reporting( E_ALL );
		
		$from = "acom@colproba.org.ar";
		$to = $direccion_email;
		$subject = $asunto;
		$message = $mensaje;
		
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From:" . $from;
		$resultado = mail($to,$subject,$message, $headers);
	
	}
}

?>