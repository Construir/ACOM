				
<!DOCTYPE html>
<html lang="en">
	  <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="Ialonardi Nestor Claudio">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>/imagenes/Colproba_400x400.jpg" width="20" height="20"> 
		
		<title>Comprobante de Sorteo</title>	  
		 
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url(); ?>/bootstrap/css/estilo-login.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	</head>
	<body>
		<div class="container">	
			<img class="img-fluid" alt="Responsive image" src="http://acom.org.ar/imagenes/acom-head.jpg"></img>	
																									
			<label><strong>Número de sorteo:</strong><?php echo $IdConsulta?></label>
			<br>		
			<label><strong>Fecha de sorteo:</strong> <?php echo $FechaSorteo?></label>										
			<br>
			
			<div class="card">
			  <h4 class="card-header" style="margin-top:0px">Profesional sorteado</h4>
			  
			  <div class="card-body">
				<table>
					<tr>
						<td>
														
							<label><strong>Apellido y Nombre:</strong> <?php echo strtoupper($NombreyApellidoAbogado)?></label><br>
							
							<label><?php echo $Datos_matricula?><br><br>
															
							<label><strong>Datos del estudio</strong></label><br>
							<label><strong>Dirección:</strong> <?php echo $Domicilio?></label><br>
							<label><strong>E-mail:</strong> <?php echo $EmailEstudio?></label><br>
							<label><strong>Teléfono:</strong> <?php echo $TelefonoEstudio?></label><br>
							<label><strong>Horario de atención:</strong> <?php echo $HorariosAtencion?></label><br>
							
						</td>									
					</tr>
				</table>
			 </div>
			</div>
			<br>				
			
			<div class="card">
				<h4 class="card-header" style="margin-top:0px">Datos del consultante</h4>
				<div class="card-body">
																		 
					<label><strong>Apellido y Nombre:</strong> <?php echo $NombreyApellidoConsultante?></label><br>
					<label><strong>Cuit:</strong> <?php echo $Cuit?></label><br>
					<label><strong>Teléfono:</strong> <?php echo $Telefono?></label><br>
					<label><strong>Celular:</strong> <?php echo $Celular?></label><br>
					<label><strong>E-mail</strong>  <?php echo $Email?></label><br>
					
										
				</div>
			</div>
			<br>
			
			<div class="card">
				<h4 class="card-header" style="margin-top:0px">Consideraciones</h4>
				<div class="card-body">
				
					<label>Contacte al profesional sorteado para acordar una reunión y poder realizar su consulta.</label><br>	
					<label><strong>Recuerde llevar este comprobante cuando concurra al estudio.</strong></label><br><br>
													
					<label><strong>Superintendencia de Riesgos del Trabajo - SRT</strong></label><br>
					<label><strong>Sarmiento 1962, CABA</strong></label><br>
					<label><strong>E-mail: ayuda@srt.gob.ar</strong></label><br><br>
					
					<label><strong>Ministerio de Trabajo.</strong></label><br>
					<label><strong>0800-666-2187</strong></label><br>
					
				</div>			  
			</div>
		</div>
	</body>
</html>