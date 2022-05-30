<?php
namespace App\Libraries;

class Credencial{	

	public function imprimir($data){
		
		require_once("vendor/autoload.php"); 
		$mpdf = new \Mpdf\Mpdf();
			
		$html = '
		<!DOCTYPE html>
		<html lang="en">
		  <head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="description" content="">
			<meta name="author" content="Ialonardi Nestor Claudio">
			
			<title>Comprobante de Sorteo</title>	  
		  
			</head>
			<body>
					
					<img src="http://acom.org.ar/imagenes/frente_cred.jpg"></img>	
					<img src="http://acom.org.ar/imagenes/dorso_cred.jpg"></img>	
											

				
			</body>
		</html>

		';
		//$mpdf->SetWatermarkImage('../public/imagenes/Colproba_400x400.jpg',0.1,'',array(50,70));
		$mpdf->showWatermarkImage = true;
		$mpdf->setFooter('{DATE j-m-Y H:m}');	
		header("Content-Type: application/pdf");
		$mpdf->WriteHTML($html);
		//$mpdf->header('Content-type: application/pdf');
		//$mpdf->Output('Credencial.pdf', \Mpdf\Output\Destination::DOWNLOAD);
		$mpdf->Output('Credencial.pdf', \Mpdf\Output\Destination::INLINE);
		//$mpdf->Output();
		//$pdfFilePath = "BONOS.pdf";	
		//$mpdf->Output('Acom Registro de Inscripción.pdf', \Mpdf\Output\Destination::FILE);
		//$mpdf->WriteHTML($html);
		//$mpdf->Output('Acom Registro de Inscripción.pdf', 'D');
		//$mpdf->Output($pdfFilePath, "I");
		//$mpdf->Output($pdfFilePath, "D");
	}
}

?>