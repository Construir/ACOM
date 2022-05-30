		<div class="container">			
			 
			<div class="col-12" >	
				<img  class="img-fluid" alt="Responsive image"  src="/imagenes/acom-head.jpg">			
				<center> <a class="text" style="color:#ee9d19;" href="https://www.argentina.gob.ar/srt" class="btn btn-link">Superintendencia de Riesgos del Trabajo</a></center>
			</div>			
			
			<form action=""  method="post" enctype="multipart/form-data" name="formNuevoAbogado" id="formNuevoAbogado"> 
				
				<div class="card">
				  <h5 class="card-header ">Datos Personales</h5>
				  <div class="card-body">
						
						<div class="row form-group">
						  <div class="col-sm-6">
							<label>Nombre</label>
							<input name="nombreAbogado" id="nombreAbogado" type="text" class="form-control required" placeholder="Ingrese su nombre" data-required="true">							
						   </div>
						  <div class="col-sm-6">
							<label>Apellido</label>
							<input name="apellidoAbogado" id="apellidoAbogado" type="text" class="form-control required" placeholder="Ingrese su apellido" data-required="true">						
						  </div>
						</div>
						<div class="row form-group">
							<div class="col-sm-6">
							<label>Cuit</label>
								<input name="cuitAbogado" id="cuitAbogado" onkeyup="valida_cadena(event, this)" type="text" class="form-control integer number required" minlength="11" maxlength="11" placeholder="Ingrese su nro. de CUIT">
							</div>
							<!--					
							<div class="col-sm-6">
								<label>Email</label>
								<input name="emailAbogado" id="emailAbogado" type="text" class="form-control required email" placeholder="Ingrese su direcci&oacute;n de email">
							</div>
							
							<div class="col-sm-6">
								<label>Celular</label>
								<input name="celularAbogado" id="celularAbogado" type="text" class="form-control" placeholder="Ingrese una celular">						
							</div>
							-->
						</div>
						<!--
						<div class="row form-group">						 	
						    <div class="col-sm-6">
								<label>Telefono</label>
								<input name="telefono" id="telefono" type="text" class="form-control number" placeholder="Ingrese su nro. de tel&eacute;fono">				
						    </div>
						</div>	
						-->
											
				  </div>
				</div>
				<br>
				
				<div class="card">
					<h5 class="card-header">Domicilio</h5>
					<div class="card-body">						
				
						<div class="row form-group">						
							<div class="col-sm-6">
								<label>Provincia</label>
								<select name="provincia" id="provincia" class="form-control required" data-required="true">
									<option value="0">Seleccione una provincia</option>												
									  <?php foreach ($provincias as $provincia){ ?>
										<?php //if($provincia['IdProvincia'] <> 32){ ?>	
											<option  value="<?php echo $provincia['IdProvincia']?>"><?php echo $provincia['NombreProvincia']?></option>
										<?php //}?>				
									  <?php }?>				
								</select>
							</div>
							<div class="col-sm-6">
								<label>Partido</label>
																
								 <select class="form-control required" name="partidoDomicilio" id="partidoDomicilio" data-required="true" disabled>
									<option value="0">Seleccione un patido</option>
								 </select>									
								
							</div>							
						</div>
						
						<div class="row form-group">
							<div class="col-sm-6">
								<label>Localidad</label>
				
								<select class="form-control required" name="localidadDomicilio" id="localidadDomicilio" data-required="true" disabled>
									<option value="0">Seleccione una localidad</option>
								 </select>
							</div>
							<div class="col-sm-6">
								<label>Calle</label>
								<input name="calleDomicilio" id="calleDomicilio" type="text" class="form-control required" placeholder="Ingrese la calle del inmueble">							
							</div>							
						</div>	
						
						<div class="row form-group">
							  <div class="col-sm-6">
							<label>N&uacute;mero</label>
							<input name="numeroDomicilio" id="numeroDomicilio" type="text" class="form-control number required" placeholder="Ingrese el nro del inmueble">							
						  </div>
						  <div class="col-sm-6">
							<label>Piso</label>
							<input name="pisoDomicilio" id="pisoDomicilio" type="text" class="form-control" placeholder="Ingrese el piso del inmueble">							
						  </div>
						</div>

						<div class="row form-group">
						  <div class="col-sm-6">
							<label>Oficina</label>
							<input name="oficinaDomicilio" id="oficinaDomicilio" type="text" class="form-control" placeholder="Ingrese la oficina del inmueble">							
						  </div>
							<div class="col-sm-6">
								<label>Email</label>
								<input name="emailEstudio" id="emailEstudio" type="text" class="form-control required email" placeholder="Ingrese su direcci&oacute;n de email">
							</div>
						</div>			

						<div class="row form-group">						 	
							<div class="col-sm-6">
								<label>Telefono</label>
								<input name="telefonoEstudio" id="telefonoEstudio" type="text" class="form-control number" placeholder="Ingrese su nro. de tel&eacute;fono">				
							</div>
							<div class="col-sm-6">
								<label>D&iacute;as y horario de atenci&oacute;n</label>
								<input name="horarioDomicilio" id="horarioDomicilio" type="text" class="form-control required" placeholder="Ingrese los d&iacute;as y horarios de atenci&oacute;n">
							</div>
						</div>
					
						<br><hr/><br>					
					
						<div class="row form-group">
							<div class="col-sm-6">
							<label>Colegio de Abogados</label>
							<!--
							<select class="form-control required" name="colegioAbogado" id="colegioAbogado" data-required="true" disabled>
								<option value="0">Seleccione un Colegio</option>												
								  <?php //foreach ($departamentos as $departamento){ ?>					
										<option  value="<?php //echo $departamento['IdDepartamento']?>"><?php //echo $departamento['NombreDepartamento']?></option>
								  <?php //}?>
							</select>
							-->							
							<select class="form-control required" name="colegioAbogado" id="colegioAbogado" data-required="true" disabled>
								<option value="0">Seleccione un colegio</option>
							</select>	
						   </div>

							<div class="col-sm-6" id="div_matricula">
								<label>Matrícula</label>
								<input name="matriculaAbogado" onfocus="deshabilitarTomoFolio()" id="matriculaAbogado" type="text" class="form-control required integer" minlength="1" maxlength="" placeholder="Ingrese su matrícula" data-required="true"title="Ingrese Matrícula o Tomo y Folio dependiendo de la Provincia a la que pertenezca" disabled>
							 </div>						   
						</div>

						<div class="row form-group" id="div_tomo_folio">
						   <div class="col-sm-6">
							<label>Tomo</label>
							<input name="tomoAbogado" onfocus="deshabilitarMatricula()" onkeyup="valida_cadena(event, this)" id="tomoAbogado" type="text" class="form-control required integer" minlength="1" maxlength="3" placeholder="Ingrese su tomo" data-required="true" title="Ingrese Tomo y Folio o Matrícula dependiendo de la Provincia a la que pertenezca" disabled>							
						   </div>
							<div class="col-sm-6">
								<label>Folio</label>
								<input name="folioAbogado" onfocus="deshabilitarMatricula()" onkeyup="valida_cadena(event, this)" id="folioAbogado" type="text" class="form-control required integer" minlength="1" maxlength="3" placeholder="Ingrese su folio" data-required="true" title="Ingrese Tomo y Folio o Matrícula dependiendo de la Provincia a la que pertenezca" disabled>						
							</div>							 
						</div>						
							
						<div class="row form-group">
							<div class="col-sm-12">
								<div style="float:left !important" class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" name="checkboxAcepto" id="checkboxAcepto" value="">
								  Acepto el<label class="form-check-label" for="inlineCheckbox1"><a data-toggle="modal" data-target="#exampleModal" href="#" class="btn btn-link"> reglamento y condiciones de uso</a></label>
								</div>
																			
									
								<div style="float:left !important" class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" name="checkboxdeclaracionJurada" id="checkboxdeclaracionJurada" value="">
								  <label style="font-size:15px" class="form-check-label" >Declaro no haber sido empleado de ninguna ART ni empresa del grupo económico de las mismas durante los 2 (dos) años anteriores a su inscripción.</label>
								</div>		
							</div>		
						</div>			
						
						<div class="modal-footer">
						<button id="btn_enviar_formulario" style="float:right;margin-right:0.5%" class="btn btn-primary" type="button">Enviar inscripci&oacute;n</button>							
						<a style="float:right;margin-right:0.5%"href="<?php echo base_url()?>" class="btn btn-secondary active" role="button" aria-pressed="true">Volver</a>
						</div>					
					</div>
				</div>	
			</form>					
			<br>		
		</div>
		<br>	
		<div class="text-center">
			<img style="width:30px;height:30px" class="img-fluid" alt="Responsive image" src="<?php echo base_url()?>/imagenes/Colproba_400x400.jpg"></img>
			<a href="https://colproba.org.ar/" class="btn btn-link">Colegio de Abogados de la Provincia de Buenos Aires</a><br>
			<small>© Copyright 2020 ColProBA </small><br>
		</div>
		<br>
		
<!----------------------------------------------MODALES--------------------------------------------------------------------->		

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">REGLAMENTO REGISTRO DE ABOGADOS EN COMISIONES MEDICAS</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
				
					• Será obligación del profesional estar disponible para la atención remota a través de su teléfono celular y correo electrónico y encontrarse adherido a “e-Servicios SRT-Sistema de Ventanilla Electrónica” disponible en el portal de AFIP, Res . SRT 22/18.<br>

					• En caso de imposibilidad temporaria que impida el ejercicio de la profesión el abogado deberá solicitar su bloqueo del registro, durante el tiempo en que se produzca la misma.<br>

					• El ejercicio profesional del patrocinio asumido a través del presente es personal.<br>

					• En caso de encontrarse imposibilitado el designado para asistir a una audiencia y/o efectuar alguna presentación podrá autorizar a otro integrante de este Registro a su libre elección, comunicando la misma dentro del plazo de 3 días.<br>

					• Los letrados para inscribirse y permanecer en el listado de sorteos del Registro deberán mantener vigente la matrícula de su Colegio.<br>

					• El profesional deberá acceder con los datos de su usuario y contraseña a la plataforma ACOM, que constituirá la vía de comunicación obligatoria y exclusiva para informar sobre el resultado de las labores realizadas y sobre los datos que se le requieran respecto de la implementación del programa y la auditoría de la gestión. Completar la información requerida en el sistema tiene carácter obligatorio.<br>

					• El abogado o abogada que sea sorteado se encuentra obligado a aceptar el caso y tramitarlo hasta su finalización. En caso de verificarse alguna causal por la cual deba excusarse de atender al cliente, incompatibilidad, inhabilidad o prohibición para la toma del asunto, la misma deberá ser comunicada dentro de la 24 horas al Colegio donde está matriculado, a los fines de su admisión o rechazo. En el caso de que el letrado no pueda aceptar el caso por motivos imputables al trabajador, en idéntico plazo deberá informar dicha circunstancia, con explicación de lo acontecido.<br>

					• El letrado se encuentra obligado a establecer una fecha de entrevista con el trabajador dentro de las 72 horas hábiles desde la aceptación del caso. Dicha entrevista podrá ser realizada de manera presencial o por el medio electrónico que el letrado determine. En caso de incumplimiento del letrado designado, el mismo será removido y se procederá al sorteo de un nuevo profesional.<br>

					• Cada designación será comunicada al abogado mediante correo electrónico. Sin perjuicio de ello, cada abogado será responsable de ingresar a la plataforma periódicamente para controlar los casos que se le asignen.<br>

					• Sin perjuicio de las obligaciones precedentes, será obligación del abogado informar los datos que le sean requeridos, tales como objeto y fecha de inicio del expediente administrativo, fecha de audiencia médica, fecha de audiencia de acuerdo, existencia o no de acuerdo o si continuará con el reclamo en el Poder Judicial. Para el supuesto que se cierre la etapa sin acuerdo y que el trabajador no pretenda continuar con las actuaciones en el Poder Judicial deberá informarlo al Colegio.<br>

					• El abogado que abogado que incumpla con las obligaciones previstas en este reglamento o que incurra en negligencia grave en el ejercicio de su función profesional será excluido del registro.<br>

					• Los honorarios que se devenguen por la actuación profesional serán solo los percibidos de la aseguradora de riesgos del trabajo o de la empleadora autoasegurada.<br>

					• Por ningún concepto el trabajador estará obligado a pagar honorarios o anticipos de gastos o suma alguna, por la labor ante las Comisiones Médicas.<br>

					• Los letrados deberán realizar y aprobar las capacitaciones que el Colegio y/o demás autoridades de aplicación dispongan respecto del conocimiento de los trámites en el ámbito de las Comisiones Médicas Jurisdiccionales y en el Sistema de Riesgos del Trabajo.<br>

					• Para el caso de que el trabajador o los derechohabientes no presten conformidad a la realización de un acuerdo ante el Servicio de Homologación, o que el mismo no sea viable por cualquier circunstancia, el letrado deberá de inmediato y de modo fehaciente comunicar a su representado/s sobre los alcances de la cosa juzgada en los términos del art 15 LCT prevista en el ordenamiento, a fin de posibilitar el acceso razonable a la vía recursiva del sistema de riesgos del trabajo y de la opción de interponer acción laboral ordinaria, independientemente de quién sea el profesional que los asista en una eventual y futura etapa de acceso a la Justicia.<br>

					• El profesional designado no se encuentra impedido de continuar patrocinando al trabajador y/o a sus derechohabientes luego de agotada la instancia administrativa.<br>

					• Independientemente de que el domicilio del trabajador determina el Colegio interviniente en la designación, el profesional designado podrá actuar ante cualquiera de las Comisiones Médicas previstas por el art. 1 párrafo 2 Ley Nº 27.348, quedando totalmente habilitado al ejercicio de la triple opción allí prevista.<br>

					• El letrado se compromete a guardar la más estricta confidencialidad y secreto profesional en relación a los asuntos encomendados y demás datos a los que acceda por su intervención en el presente programa, como así también se responsabiliza por la seguridad de la información que manejare a resultas del mismo en los términos de la Ley Nº 25.326.<br>

					• El abogado deberá declarar bajo juramento que no ha sido empleado en relación de dependencia ni prestado servicios a favor de ninguna ART, ni empresa del grupo económico perteneciente a alguna de ellas, ni de la SRT, ni de empleadores autoasegurados, ni de ningún sindicato  u organización sindical, durante los 2 (dos) años anteriores a la firma del presente.<br>
			
		</p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		<!--<button type="button" class="btn btn-primary">Save changes</button>-->
	  </div>
	</div>
  </div>
</div>
		
<div class="modal fade" id="modal_mensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<div class="form-group">						
				<div  id="mensaje_abogado"></div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="imprimir_comprobante_inscripcion" method="post" enctype="multipart/form-data" id="descargarpdf" name="descargarpdf">
				    <input type="hidden" name="apellido_imprimir" id="apellido_imprimir" value="">
				    <input type="hidden" name="nombre_imprimir" id="nombre_imprimir" value="">
				    <input type="hidden" name="tomo_imprimir" id="tomo_imprimir" value="">
				    <input type="hidden" name="folio_imprimir" id="folio_imprimir" value="">
				    <input type="hidden" name="matricula_imprimir" id="matricula_imprimir" value="">
				    <input type="hidden" name="colegio_imprimir" id="colegio_imprimir" value="">
				    <input type="hidden" name="email_imprimir" id="email_imprimir" value="">
				    <input type="hidden" name="cuit_imprimir" id="cuit_imprimir" value="">
				    <input type="hidden" name="calle_imprimir" id="calle_imprimir" value="">
				    <input type="hidden" name="numero_imprimir" id="numero_imprimir" value="">
				    <input type="hidden" name="piso_imprimir" id="piso_imprimir" value="">
				    <input type="hidden" name="oficina_imprimir" id="oficina_imprimir" value="">
				    <input type="hidden" name="localidad_imprimir" id="localidad_imprimir" value="">
				    <input type="hidden" name="provincia_imprimir" id="provincia_imprimir" value="">
				    <input type="hidden" name="horarios_imprimir" id="horarios_imprimir" value="">
				    <input type="hidden" name="telefono_imprimir" id="telefono_imprimir" value="">
				    <input type="hidden" name="celular_imprimir" id="celular_imprimir" value="">
				    <input type="hidden" name="partido_imprimir" id="partido_imprimir" value="">
					<button type="submit" class="btn btn-primary">Imprimir</button>
				</form>
				<!--
				<form class="form-inline" action="reimprimir_comprobante_inscripcion" method="post" enctype="multipart/form-data" id="descargarpdf2" name="descargarpdf2">
					<input type="hidden" name="id_matriculacion" id="id_matriculacion" value="">
					<button type="submit" class="btn btn-primary">Imprimir</button>					
				</form>	
				-->
				<button type="button" id="cerrar_modal_ver_ventas" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
		 
<div class="modal fade" id="modal_ayuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Ayuda!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<b>RECOMENDACIONES PARA LA CARGA DE DOMICILIOS</b><br>
			Recomendamos a los abogados que tengan más de un domicilio de atención, ingresar los datos por separado.<br>
			Ser específicos  en cuanto a los domicilios y datos de contacto.<br>						
			Desde ya, gracias por su atención.<br>
			</p>
						
			<div class="modal-footer">
				<button type="button" id="cerrar_modal_ver_ventas" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>

<div class="modal fade " id="modal_mensaje_ya_existe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Mensaje para el Usuario</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
			<div class="alert alert-success"  role="alert">					
				<div class="form-group">
					<h5>¡Atención!</h5>
					<div  id="mensaje_ya_existe"></div>						
				</div>
			</div>		
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>													
			</div>							
		</div> 
	</div>
  </div>
</div>
<div id="loading-screen" style="display:none">
	<img src="<?php echo base_url()?>/imagenes/spinning-circles.svg">
</div>
<!-- Bootstrap core JavaScript================================================== -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		
		var screen = $('#loading-screen');
		
		$("#provincia").change(function(){
			
			var provincia = $('#provincia').val();
			document.getElementById('localidadDomicilio').value = 0;
			document.getElementById("localidadDomicilio").disabled = true;
			
				document.getElementById('tomoAbogado').value = '';				
				document.getElementById("tomoAbogado").disabled = true;
				document.getElementById('folioAbogado').value = '';				
				document.getElementById("folioAbogado").disabled = true;
				document.getElementById('matriculaAbogado').value = '';				
				document.getElementById("matriculaAbogado").disabled = true;
				$("#div_matricula").show();
				$("#div_tomo_folio").show();
			
			if(provincia == 0){
				
				//console.log(provincia);
				document.getElementById('partidoDomicilio').value = 0;
				document.getElementById("partidoDomicilio").disabled = true;
				document.getElementById('colegioAbogado').value = 0;				
				document.getElementById("colegioAbogado").disabled = true;
		

				
			} else {				
				
				var url = 'devolver_partidos_registro_json';					
				$.ajax({
					type:"POST",					
					url:url,
					data:{provincia:provincia},
					success:function(rta){	
					
						document.getElementById("partidoDomicilio").disabled = false;								
						$('#partidoDomicilio').html(rta).fadeIn();								
						
					}
				});	
				var url = 'devolver_departamento_judicial_json';					
				$.ajax({
					type:"POST",					
					url:url,
					data:{provincia:provincia},
					success:function(rta){	
									
						document.getElementById("colegioAbogado").disabled = false;			
						$('#colegioAbogado').html(rta).fadeIn();							
						
					}
				});
				/*
				var url = 'devolver_tipo_de_matricula_json';
						
				$.ajax({
					type:"POST",					
					url:url,
					data:{provincia:provincia},
					success:function(rta){	
										
						if(rta == 1){
							document.getElementById('div_matricula').style.display = 'none';
							document.getElementById("tomoAbogado").disabled = false;
							document.getElementById("folioAbogado").disabled = false;
							$("#div_tomo_folio").show();							
						} else {
							document.getElementById('div_tomo_folio').style.display = 'none';
							document.getElementById("matriculaAbogado").disabled = false;							
							$("#div_matricula").show();
						}						
						
					}
				});
				*/
			}
		});	
		$("#colegioAbogado").change(function(){
			//console.log($('#colegioAbogado').val());
			document.getElementById("tomoAbogado").disabled = false;
			document.getElementById("folioAbogado").disabled = false;
			document.getElementById("matriculaAbogado").disabled = false;
			document.getElementById('tomoAbogado').value = '';				
			document.getElementById('folioAbogado').value = '';				
			document.getElementById('matriculaAbogado').value = '';
			
			$("#div_tomo_folio").show();
			$("#div_matricula").show();
			//document.getElementById("div_tomo_folio").className = "visible";
			//document.getElementById("div_matricula").className = "visible";

		});
		$("#partidoDomicilio").change(function(){
			var partido = $('#partidoDomicilio').val();
			if(partido == 0){
				
				document.getElementById('localidadDomicilio').value = 0;
				document.getElementById("localidadDomicilio").disabled = true;

				
			} else {	
				var url = 'devolver_localidades_json';
				//console.log(partido);
				$.ajax({
					type:"POST",					
					url:url,
					
					data:{partido:partido},
					success:function(rta){	
					//console.log(rta);
						document.getElementById("localidadDomicilio").disabled = false;			
						$('#localidadDomicilio').html(rta).fadeIn();								
						
					}
				});	
			}
		});	
		$('#btn_enviar_formulario').click(function(){
			//console.log(validarNuevoAbogado());
			if(validarNuevoAbogado()){				  
				
				var nombreAbogado = $('#nombreAbogado').val();
				var apellidoAbogado = $('#apellidoAbogado').val();
				var cuitAbogado = $('#cuitAbogado').val();
				var emailAbogado = '';
				var celular = '';
				var telefono = '';
				var tomoAbogado = $('#tomoAbogado').val();
				var folioAbogado = $('#folioAbogado').val();
				var colegioAbogado = $('#colegioAbogado').val();
				var matriculaAbogado = $('#matriculaAbogado').val();				
				var provincia = $('#provincia').val();				
				var partidoDomicilio = $('#partidoDomicilio').val();
				var localidadDomicilio = $('#localidadDomicilio').val();
				var calleDomicilio = $('#calleDomicilio').val();
				var numeroDomicilio = $('#numeroDomicilio').val();
				var pisoDomicilio = $('#pisoDomicilio').val();
				var oficinaDomicilio = $('#oficinaDomicilio').val();
				var emailEstudio = $('#emailEstudio').val();			
				var telefonoEstudio = $('#telefonoEstudio').val();
				var horarioDomicilio = $('#horarioDomicilio').val();
				var checkboxAcepto = $('#checkboxAcepto').val();				
				var checkboxdeclaracionJurada = $('#checkboxdeclaracionJurada').val();								
								  
				if($("#checkboxAcepto").is(':checked')) {	
					if($("#checkboxdeclaracionJurada").is(':checked')) {	
						
						screen.fadeIn();
						document.getElementById("btn_enviar_formulario").disabled = true;
						
						var url = 'guarda_nuevo_abogado_json';
						
						$.ajax({
							type:"POST",					
							url:url,
							data:{nombreAbogado:nombreAbogado,apellidoAbogado:apellidoAbogado,tomoAbogado:tomoAbogado,
								  folioAbogado:folioAbogado,colegioAbogado:colegioAbogado,matriculaAbogado:matriculaAbogado,emailAbogado:emailAbogado,
								  calleDomicilio:calleDomicilio,numeroDomicilio:numeroDomicilio,pisoDomicilio:pisoDomicilio,cuitAbogado:cuitAbogado,
								  oficinaDomicilio:oficinaDomicilio,provincia:provincia,partidoDomicilio:partidoDomicilio,
								  localidadDomicilio:localidadDomicilio,celular:celular,telefono:telefono,emailEstudio:emailEstudio,
								  telefonoEstudio:telefonoEstudio,horarioDomicilio:horarioDomicilio,origen:1},
							success:function(rta){									
								
								document.getElementById("btn_enviar_formulario").disabled = false;
								document.getElementById('loading-screen').style.display = 'none';
								
								var obj = jQuery.parseJSON(rta);								
								
								var estado = obj.estado;
								var	idMatriculacion = obj.idMatriculacion;
								var	mensaje = obj.mensaje;
								//var	array_matricula = obj.array_matricula;
								
								switch (parseInt(estado, 10)) {
									
								  case 0:										
										$('#mensaje_abogado').html(mensaje);
										document.getElementById('descargarpdf').style.display = 'none';									
										break;
								  case 1:
										$('#mensaje_abogado').html(mensaje);
										//console.log(obj);
										cargar_datos_imprimir_registro(obj);
										//document.getElementById('id_matriculacion').value = idMatriculacion;
										$("#descargarpdf").show();
										break;
								  default:
										$('#mensaje_abogado').html('El Abogado no se pudo guardar. Por favor, póngase en contacto con su administrador.');	
										document.getElementById('descargarpdf').style.display = 'none';																		
								}
								window.scrollTo(500, 0);
								reset_form_nuevo_abogado();
													
								$('#modal_mensaje').modal('show');
								
							}
						});	
					
					} else {  
						$('#mensaje_abogado').html('Debe Aceptar la declaracion Jurada.');	
						document.getElementById('descargarpdf').style.display = 'none';	
						$('#modal_mensaje').modal('show');  
					}
				} else {  
					$('#mensaje_abogado').html('Debe Aceptar el Reglamento y Condiciones.');
					document.getElementById('descargarpdf').style.display = 'none';						
					$('#modal_mensaje').modal('show');  
				}	
			 							
			} else {
				
				document.getElementById('descargarpdf').style.display = 'none';
				$('#mensaje_abogado').html('Complete los campos señalados como obligatorios.');
				window.scrollTo(500, 0);
				
			}
		});	
		
	});	
	
	
	function cargar_datos_imprimir_registro(array_matricula){
		
		document.getElementById('apellido_imprimir').value = array_matricula.Apellido;	
		document.getElementById('nombre_imprimir').value = array_matricula.Nombre;	
		document.getElementById('tomo_imprimir').value = array_matricula.Tomo;	
		document.getElementById('folio_imprimir').value = array_matricula.Folio;	
		document.getElementById('matricula_imprimir').value = array_matricula.Matricula;	
		document.getElementById('colegio_imprimir').value = array_matricula.IdColegio;
		document.getElementById('email_imprimir').value = array_matricula.Email;	
		document.getElementById('cuit_imprimir').value = array_matricula.Cuit;				
		document.getElementById('calle_imprimir').value = array_matricula.Calle;		
		document.getElementById('numero_imprimir').value = array_matricula.Numero;		
		document.getElementById('piso_imprimir').value = array_matricula.Piso;		
		document.getElementById('oficina_imprimir').value = array_matricula.Oficina;					
		document.getElementById('localidad_imprimir').value = array_matricula.Localidad;
		document.getElementById('partido_imprimir').value = array_matricula.Partido;
		document.getElementById('provincia_imprimir').value = array_matricula.Provincia;	
		document.getElementById('horarios_imprimir').value = array_matricula.Horarios;	
		document.getElementById('telefono_imprimir').value = array_matricula.Telefono;			
		
	}
	function reset_form_nuevo_abogado(){
		
		$("#formNuevoAbogado").trigger("reset");
		document.getElementById("folioAbogado").disabled = false;
		document.getElementById("tomoAbogado").disabled = false;
		document.getElementById("matriculaAbogado").disabled = false;
		document.getElementById("partidoDomicilio").disabled = true;
		document.getElementById("localidadDomicilio").disabled = true;
		document.getElementById("colegioAbogado").disabled = true;
		
	}
	function deshabilitarTomoFolio(){
		document.getElementById("folioAbogado").disabled = true;
		document.getElementById("tomoAbogado").disabled = true;
		//document.getElementById("div_tomo_folio").className = "invisible";	
		document.getElementById('div_tomo_folio').style.display = 'none';
	}
	function deshabilitarMatricula(){
		document.getElementById("matriculaAbogado").disabled = true;
		//document.getElementById("div_matricula").className = "invisible";		
		
		document.getElementById('div_matricula').style.display = 'none';
	}
	function valida_cadena(event, el){//Validar nombre	
		//Obteniendo posicion del cursor 
		var val = el.value;//Valor de la caja de texto
		var pos = val.slice(0, el.selectionStart).length;
		
		var out = '';//Salida
		var filtro = '0123456789';
		var v = 0;//Contador de caracteres validos
		
		//Filtar solo los numeros
		for (var i=0; i<val.length; i++){
		   if (filtro.indexOf(val.charAt(i)) != -1){
			 v++;
			 out += val.charAt(i);		   
			 //Agregando un espacio cada 4 caracteres
			 //if((v==4) || (v==8) || (v==12))
				 //out+=' ';
		   }
		}
		//Reemplazando el valor
		el.value = out;
		
		//En caso de modificar un numero reposicionar el cursor
		//if(event.keyCode==8){//Tecla borrar precionada
			//el.selectionStart = pos;
			//el.selectionEnd = pos;
		//}
	}
	</script>
  </body>
</html>