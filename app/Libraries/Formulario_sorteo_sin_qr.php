		 <style type="text/css">
			.card {
			  position: relative;
			  display: -webkit-box;
			  display: -ms-flexbox;
			  display: flex;
			  -webkit-box-orient: vertical;
			  -webkit-box-direction: normal;
			  -ms-flex-direction: column;
			  flex-direction: column;
			  min-width: 0;
			  word-wrap: break-word;
			  background-color: #fff;
			  background-clip: border-box;
			  border: 1px solid rgba(0, 0, 0, 0.125);
			  border-radius: 0.25rem;
			}

			.card > hr {
			  margin-right: 0;
			  margin-left: 0;
			}

			.card > .list-group:first-child .list-group-item:first-child {
			  border-top-left-radius: 0.25rem;
			  border-top-right-radius: 0.25rem;
			}

			.card > .list-group:last-child .list-group-item:last-child {
			  border-bottom-right-radius: 0.25rem;
			  border-bottom-left-radius: 0.25rem;
			}

			.card-body {
			  -webkit-box-flex: 1;
			  -ms-flex: 1 1 auto;
			  flex: 1 1 auto;
			  padding: 1.25rem;
			}

			.card-title {
			  margin-bottom: 0.75rem;
			}

			.card-subtitle {
			  margin-top: -0.375rem;
			  margin-bottom: 0;
			}

			.card-text:last-child {
			  margin-bottom: 0;
			}

			.card-link:hover {
			  text-decoration: none;
			}

			.card-link + .card-link {
			  margin-left: 1.25rem;
			}

			.card-header {
			  padding: 0.75rem 1.25rem;
			  margin-bottom: 0;
			  background-color: rgba(0, 0, 0, 0.03);
			  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
			}

			.card-header:first-child {
			  border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
			}

			.card-header + .list-group .list-group-item:first-child {
			  border-top: 0;
			}

			.card-footer {
			  padding: 0.75rem 1.25rem;
			  background-color: rgba(0, 0, 0, 0.03);
			  border-top: 1px solid rgba(0, 0, 0, 0.125);
			}

			.card-footer:last-child {
			  border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
			}

			.card-header-tabs {
			  margin-right: -0.625rem;
			  margin-bottom: -0.75rem;
			  margin-left: -0.625rem;
			  border-bottom: 0;
			}

			.card-header-pills {
			  margin-right: -0.625rem;
			  margin-left: -0.625rem;
			}

			.card-img-overlay {
			  position: absolute;
			  top: 0;
			  right: 0;
			  bottom: 0;
			  left: 0;
			  padding: 1.25rem;
			}

			.card-img {
			  width: 100%;
			  border-radius: calc(0.25rem - 1px);
			}

			.card-img-top {
			  width: 100%;
			  border-top-left-radius: calc(0.25rem - 1px);
			  border-top-right-radius: calc(0.25rem - 1px);
			}

			.card-img-bottom {
			  width: 100%;
			  border-bottom-right-radius: calc(0.25rem - 1px);
			  border-bottom-left-radius: calc(0.25rem - 1px);
			}

			.card-deck {
			  display: -webkit-box;
			  display: -ms-flexbox;
			  display: flex;
			  -webkit-box-orient: vertical;
			  -webkit-box-direction: normal;
			  -ms-flex-direction: column;
			  flex-direction: column;
			}

			.card-deck .card {
			  margin-bottom: 15px;
			}

			@media (min-width: 576px) {
			  .card-deck {
				-webkit-box-orient: horizontal;
				-webkit-box-direction: normal;
				-ms-flex-flow: row wrap;
				flex-flow: row wrap;
				margin-right: -15px;
				margin-left: -15px;
			  }
			  .card-deck .card {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-webkit-box-flex: 1;
				-ms-flex: 1 0 0%;
				flex: 1 0 0%;
				-webkit-box-orient: vertical;
				-webkit-box-direction: normal;
				-ms-flex-direction: column;
				flex-direction: column;
				margin-right: 15px;
				margin-bottom: 0;
				margin-left: 15px;
			  }
			}

			.card-group {
			  display: -webkit-box;
			  display: -ms-flexbox;
			  display: flex;
			  -webkit-box-orient: vertical;
			  -webkit-box-direction: normal;
			  -ms-flex-direction: column;
			  flex-direction: column;
			}

			.card-group > .card {
			  margin-bottom: 15px;
			}

			@media (min-width: 576px) {
			  .card-group {
				-webkit-box-orient: horizontal;
				-webkit-box-direction: normal;
				-ms-flex-flow: row wrap;
				flex-flow: row wrap;
			  }
			  .card-group > .card {
				-webkit-box-flex: 1;
				-ms-flex: 1 0 0%;
				flex: 1 0 0%;
				margin-bottom: 0;
			  }
			  .card-group > .card + .card {
				margin-left: 0;
				border-left: 0;
			  }
			  .card-group > .card:first-child {
				border-top-right-radius: 0;
				border-bottom-right-radius: 0;
			  }
			  .card-group > .card:first-child .card-img-top,
			  .card-group > .card:first-child .card-header {
				border-top-right-radius: 0;
			  }
			  .card-group > .card:first-child .card-img-bottom,
			  .card-group > .card:first-child .card-footer {
				border-bottom-right-radius: 0;
			  }
			  .card-group > .card:last-child {
				border-top-left-radius: 0;
				border-bottom-left-radius: 0;
			  }
			  .card-group > .card:last-child .card-img-top,
			  .card-group > .card:last-child .card-header {
				border-top-left-radius: 0;
			  }
			  .card-group > .card:last-child .card-img-bottom,
			  .card-group > .card:last-child .card-footer {
				border-bottom-left-radius: 0;
			  }
			  .card-group > .card:only-child {
				border-radius: 0.25rem;
			  }
			  .card-group > .card:only-child .card-img-top,
			  .card-group > .card:only-child .card-header {
				border-top-left-radius: 0.25rem;
				border-top-right-radius: 0.25rem;
			  }
			  .card-group > .card:only-child .card-img-bottom,
			  .card-group > .card:only-child .card-footer {
				border-bottom-right-radius: 0.25rem;
				border-bottom-left-radius: 0.25rem;
			  }
			  .card-group > .card:not(:first-child):not(:last-child):not(:only-child) {
				border-radius: 0;
			  }
			  .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-img-top,
			  .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,
			  .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-header,
			  .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-footer {
				border-radius: 0;
			  }
			}

			.card-columns .card {
			  margin-bottom: 0.75rem;
			}

			@media (min-width: 576px) {
			  .card-columns {
				-webkit-column-count: 3;
				-moz-column-count: 3;
				column-count: 3;
				-webkit-column-gap: 1.25rem;
				-moz-column-gap: 1.25rem;
				column-gap: 1.25rem;
			  }
			  .card-columns .card {
				display: inline-block;
				width: 100%;
			  }
			.col-sm-6 {
				-webkit-box-flex: 0;
				-ms-flex: 0 0 50%;
				flex: 0 0 50%;
				max-width: 50%;
			  }
			.row {
			  display: -webkit-box;
			  display: -ms-flexbox;
			  display: flex;
			  -ms-flex-wrap: wrap;
			  flex-wrap: wrap;
			  margin-right: -15px;
			  margin-left: -15px;
			}
			}</style>';

		
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
					
					<img src="http://acom.org.ar/imagenes/acom-head.jpg"></img>	
							
					<table>
						<thead>
							<tr>
								<th style="text-align:left"><label></label></th>
								<th style="text-align:left"><label></label></th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<td style="text-align:left;width:400px">																		
									<label><strong>Número de sorteo:</strong><?php echo $data->IdConsulta?></label>
								</td>
								
								<td style="text-align:right;width:400px">
									<label><strong>Fecha de sorteo:</strong> <?php echo $data["FechaSorteo"]?></label>										
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					
					<div class="card">
					  <h4 class="card-header" style="margin-top:0px">Detalles del profesional sorteado</h4>
					  
					  <div class="card-body">
						<table>
							<tr>
								<td>
																
									<label><strong>Apellido y Nombre:</strong> <?php echo strtoupper($data["NombreyApellidoAbogado"])?></label><br>
									
									<label>'.$data["Datos_matricula"].'<br><br>
																	
									<label><strong>Datos del estudio</strong></label><br>
									<label><strong>Dirección:</strong> '.$data["Domicilio"].'</label><br>
									<label><strong>E-mail:</strong> '.$data["EmailEstudio"].'</label><br>
									<label><strong>Teléfono:</strong> '.$data["TelefonoEstudio"].'</label><br>
									<label><strong>Horario de atención:</strong> '.$data["HorariosAtencion"].'</label><br>
									
								</td>									
							</tr>
						</table>
					 </div>
					</div>
					<br>				
					
					<div class="card">
						<h4 class="card-header" style="margin-top:0px">Datos del consultante</h4>
						<div class="card-body">
																				 
							<label><strong>Apellido y Nombre:</strong> '.$data["NombreyApellidoConsultante"].'</label><br>
							<label><strong>Cuit:</strong> '.$data["Cuit"].'</label><br>
							<label><strong>Teléfono:</strong> '.$data["Telefono"].'</label><br>
							<label><strong>Celular:</strong> '.$data["Celular"].'</label><br>
							<label><strong>E-mail</strong>  '.$data["Email"].'</label><br>
							
												
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
				
			</body>
		</html>