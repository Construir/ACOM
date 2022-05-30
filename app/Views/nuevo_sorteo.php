<?php if($origen == 1){ ?>	
	<h5 style="color:#016887;padding-top:5px">Sorteos - Nuevo sorteo</h5>		
<?php } else {?>	
	<br>	
<?php } ?>		
		<div class="container">			
			<?php if($origen == 0){ ?>
			<div class="col-12" >	
				<img  class="img-fluid" alt="Responsive image"  src="/imagenes/acom-head.jpg">			
				<center> <a class="text" style="color:#ee9d19;" href="https://www.argentina.gob.ar/srt" class="btn btn-link">Superintendencia de Riesgos del Trabajo</a></center>
			</div>
			<?php } ?>
			<form action=""  method="post" enctype="multipart/form-data" name="formNuevoSorteo" id="formNuevoSorteo"> 
				
				<div class="card">
				  <h5 class="card-header ">Detalles de Consulta</h5>
				  <div class="card-body">
						
						<div class="row form-group">
						  <div class="col-sm-6">
							<label>Cuit</label>
							<input name="cuitRequirente" id="cuitRequirente" onkeyup="validarCuitRequirente();valida_cadena(event, this)" type="text" class="form-control required" placeholder="Ingrese su cuit" data-required="true">							
							<label style="color:#ee9d19;">Si no conoce su Cuit, ingrese</label> <a class="text" href="https://www.anses.gob.ar/consulta/constancia-de-cuil" class="btn btn-link"> aquí "ANSES"</a>
						   </div>
						  <div class="col-sm-6">
							<label>Tipo de trámite</label>
								<select name="tipoconsulta" id="tipoconsulta" class="form-control required" data-required="true" disabled>
									<option value="0">Seleccione un tipo de trámite</option>												
									  <?php foreach ($tiposconsulta as $tipos){ ?>					
											<option  value="<?php echo $tipos['IdTipoConsulta']?>"><?php echo $tipos['NombreTipoConsulta']?></option>
									  <?php }?>				
								</select>						
						  </div>
						</div>
						<div class="row form-group">
																
							<div class="col-sm-6">
								<label>Provincia</label>
								<select name="provincia" id="provincia" class="form-control required" data-required="true" disabled>
									<option value="0">Seleccione una provincia</option>												
									  <?php foreach ($provincias as $provincia){ ?>	
											<?php //if($provincia['IdProvincia'] <> 32){ ?>	
												<option  value="<?php echo $provincia['IdProvincia']?>"><?php echo $provincia['NombreProvincia']?></option>
											<?php//}?>				
									  <?php }?>				
								</select>
							</div>
							<div class="col-sm-6">
								<label>Partido</label>
								<!--
								<select class="form-control required" name="partidoDomicilio" id="partidoDomicilio" data-required="true">
								<option value="0">Seleccione un Patido</option>												
								  <?php //foreach ($partidos as $partido){ ?>					
										<option  value="<?php //echo $partido['IdPartido']?>"><?php //echo $partido['NombrePartido']?></option>
								  <?php //}?>
								</select>
								-->	
																
								 <select class="form-control required" name="partidoDomicilio" id="partidoDomicilio" data-required="true" disabled>
									<option value="0">Seleccione un patido</option>
								 </select>									
								
							</div>
						</div>
						<div class="row form-group">						
	
							<div class="col-sm-6">
								<label>Localidad</label>
								<!--
								<select name="localidadDomicilio" id="localidadDomicilio" class="form-control required" data-required="true">
									<option value="0">Seleccione una Localidad</option>	
									<?php foreach ($localidades as $localidad){ ?>					
										<option  value="<?php echo $localidad['IdLocalidad']?>"><?php echo $localidad['NombreLocalidad']?></option>
								  <?php }?>
								</select>
								-->
								<select class="form-control required" name="localidadDomicilio" id="localidadDomicilio" data-required="true" disabled>
									<option value="0">Seleccione una localidad</option>
								 </select>
							</div>
						</div>		
						
				  </div>
				</div>
				<br>
				<div class="card">
					<h5 class="card-header">Datos Personales</h5>
					<div class="card-body">						
								
						<div class="row form-group">
							  <div class="col-sm-6">
							<label>Nombre</label>
							<input name="nombreRequirente" id="nombreRequirente" type="text" class="form-control number required" placeholder="Ingrese un nombre" disabled>							
						  </div>
						  <div class="col-sm-6">
							<label>Apellido</label>
							<input name="apellidoRequirente" id="apellidoRequirente" type="text" class="form-control" placeholder="Ingrese un apellido" disabled>							
						  </div>
						</div>

						<div class="row form-group">
						  <div class="col-sm-6">
							<label>Teléfono</label>
							<input name="telefonoRequirente" id="telefonoRequirente" type="text" class="form-control" placeholder="Ingrese un teléfono" disabled>							
						  </div>
							<div class="col-sm-6">
								<label>Celular</label>
								<input name="celularRequirente" id="celularRequirente" type="text" class="form-control required email" placeholder="Ingrese un celular" disabled>
							</div>
						</div>			

						<div class="row form-group">						 	
							<div class="col-sm-6">
								<label>E-mail</label>
								<input name="emailRequirente" id="emailRequirente" type="text" class="form-control number" placeholder="Ingrese su direcci&oacute;n de email" disabled>				
							</div>
							<div class="col-sm-6">
								<label>Calle</label>
								<input name="calleDomicilio" id="calleDomicilio" type="text" class="form-control required" placeholder="Ingrese la calle del inmueble" disabled>							
							</div>	
						</div>

						<div class="row form-group">
							  <div class="col-sm-6">
							<label>N&uacute;mero</label>
							<input name="numeroDomicilio" id="numeroDomicilio" type="text" class="form-control number required" placeholder="Ingrese el nro del inmueble" disabled>							
						  </div>
						  <div class="col-sm-6">
							<label>Piso</label>
							<input name="pisoDomicilio" id="pisoDomicilio" type="text" class="form-control" placeholder="Ingrese el piso del inmueble" disabled>							
						  </div>
						</div>

						<div class="row form-group">
						  <div class="col-sm-6">
							<label>Departamento</label>
							<input name="departamentoDomicilio" id="departamentoDomicilio" type="text" class="form-control" placeholder="Ingrese su departamento" disabled>							
						  </div>
							<div class="col-sm-6" invisible>
								
							</div>
						</div>
						
						<div class="row form-group">						
							<div class="col-sm-12">
								<label>Detalle</label>
								<textarea name="detalle" id="detalle" type="text" class="form-control" rows="5" disabled></textarea>
							</div>
						</div>	
							
						<br><hr>						
						<?php if($origen == 0){?>
							<a style="float:right;margin-right:0.5%"href="<?php echo base_url()?>" class="btn btn-secondary active" role="button" aria-pressed="true">Volver</a>
						<?php }?>
						<button id="btn_enviar_formulario" style="float:right;margin-right:0.5%" class="btn btn-primary" type="button">Sortear</button>									
												
					</div>
				</div>	
			</form>					
			<br>		
		</div>
		<br>	

		<br>
		
<!----------------------------------------------MODALES--------------------------------------------------------------------->		
		
<div class="modal fade " id="modal_mensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Mensaje para el Usuario</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
			<div id="div_mensaje" class="alert alert-success"  role="alert">					
				<div class="form-group">
					<h5>¡Atención!</h5>
					<div id="mensaje"></div>						
				</div>
			</div>		
			<div class="modal-footer">
				<form class="form-inline" action="reimprimir_comprobante_sorteo" method="post" enctype="multipart/form-data" id="descargarpdf" name="descargarpdf">
					<input type="hidden" name="id_consulta" id="id_consulta" value="">
					<button type="submit" class="btn btn-success" style="margin-right:3px">Imprimir</button>					
				</form>	
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>													
			</div>							
		</div> 
	</div>
  </div>
</div>
<!-- Bootstrap core JavaScript================================================== -->

<script type="text/javascript">
	jQuery(document).ready(function() {
		
		$("#provincia").change(function(){
			
			var provincia = $('#provincia').val();
			document.getElementById('localidadDomicilio').value = 0;
			document.getElementById("localidadDomicilio").disabled = true;
			
			if(provincia == 0){
				
				document.getElementById('partidoDomicilio').value = 0;
				document.getElementById("partidoDomicilio").disabled = true;
	
				
			} else {
				var url = 'devolver_partidos_json';					
				$.ajax({
					type:"POST",					
					url:url,
					data:{provincia:provincia},
					success:function(rta){	
						
						if(parseInt(rta, 10) == 0){
							
							$("#div_mensaje").removeClass("alert-success");
							$("#div_mensaje").addClass("alert-danger");
							document.getElementById('descargarpdf').style.display = 'none';
							$('#mensaje').html('La Provincia seleccionada no registra profesionales letrados disponibles para sorteo. Por favor, seleccione otra Provincia y vuelva a intentar.');										
							$('#modal_mensaje').modal('show');
						
						}else{
							document.getElementById("partidoDomicilio").disabled = false;								
							$('#partidoDomicilio').html(rta).fadeIn();								
						}
					}
				});	
			
			}
		});	
		
		$("#partidoDomicilio").change(function(){
			
			var partido = $('#partidoDomicilio').val();
			if(partido == 0){
				
				document.getElementById('localidadDomicilio').value = 0;
				document.getElementById("localidadDomicilio").disabled = true;
				
			} else {	
				var url = 'devolver_localidades_json';
			
				$.ajax({
					type:"POST",					
					url:url,					
					data:{partido:partido},
					success:function(rta){	
				
						document.getElementById("localidadDomicilio").disabled = false;			
						$('#localidadDomicilio').html(rta).fadeIn();								
						
					}
				});	
			}
		});	
		/*
		$('#btn_enviar_formulario').click(function(){
			$("#formNuevoSorteo").attr("action","realizar_nuevo_sorteo_json");	            
			$("#formNuevoSorteo").submit();	
		});	
		*/
		
		$('#btn_enviar_formulario').click(function(){
			
			
			if(validarNuevoSorteo()){				  
				
				var cuitRequirente = $('#cuitRequirente').val();				
				var tipoconsulta = $('#tipoconsulta').val();				
				var provincia = $('#provincia').val();				
				var partidoDomicilio = $('#partidoDomicilio').val();
				var localidadDomicilio = $('#localidadDomicilio').val();				
				var nombreRequirente = $('#nombreRequirente').val();
				var apellidoRequirente = $('#apellidoRequirente').val();			
				var emailRequirente = $('#emailRequirente').val();
				var telefonoRequirente = $('#telefonoRequirente').val();
				var celularRequirente = $('#celularRequirente').val();			
				var calleDomicilio = $('#calleDomicilio').val();			
				var numeroDomicilio = $('#numeroDomicilio').val();			
				var pisoDomicilio = $('#pisoDomicilio').val();			
				var departamentoDomicilio = $('#departamentoDomicilio').val();			
				var detalle = $('#detalle').val();			
								
				var url = 'realizar_nuevo_sorteo_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{cuitRequirente:cuitRequirente,tipoconsulta:tipoconsulta,provincia:provincia,partidoDomicilio:partidoDomicilio,
						  localidadDomicilio:localidadDomicilio,nombreRequirente:nombreRequirente,apellidoRequirente:apellidoRequirente,emailRequirente:emailRequirente,
						  telefonoRequirente:telefonoRequirente,celularRequirente:celularRequirente,calleDomicilio:calleDomicilio,numeroDomicilio:numeroDomicilio,
						  pisoDomicilio:pisoDomicilio,departamentoDomicilio:departamentoDomicilio,detalle:detalle},
					success:function(rta){								
							
						var obj = jQuery.parseJSON(rta);								
						
						var estado = obj.estado;
						var	idConsulta = obj.idConsulta;
						var	mensaje = obj.mensaje;
							
						document.getElementById('id_consulta').value = idConsulta;	
						$('#mensaje').html(mensaje);	
						reset_form_nuevo_sorteo();								
						$("#div_mensaje").removeClass("alert-danger");
						$("#div_mensaje").addClass("alert-success");
						$("#descargarpdf").show();					
						$('#modal_mensaje').modal('show');
						
					}
				});						
			 							
			}
			window.scrollTo(500, 0);
			
		});	
		
		
	});
	function validarCuitRequirente(){
		
		var validacion = validaCuitCuil($('#cuitRequirente').val());

		if(validacion){
				document.getElementById("tipoconsulta").disabled = false;
				document.getElementById("provincia").disabled = false;
				document.getElementById("nombreRequirente").disabled = false;
				document.getElementById("apellidoRequirente").disabled = false;
				document.getElementById("emailRequirente").disabled = false;
				document.getElementById("telefonoRequirente").disabled = false;
				document.getElementById("celularRequirente").disabled = false;
				document.getElementById("calleDomicilio").disabled = false;
				document.getElementById("numeroDomicilio").disabled = false;
				document.getElementById("pisoDomicilio").disabled = false;
				document.getElementById("departamentoDomicilio").disabled = false;
				document.getElementById("detalle").disabled = false;
				$(".estilos-errores").remove();
		}else{
				document.getElementById("tipoconsulta").disabled = true;
				document.getElementById("provincia").disabled = true;
				document.getElementById("partidoDomicilio").disabled = true;
				document.getElementById("localidadDomicilio").disabled = true;
				document.getElementById("nombreRequirente").disabled = true;
				document.getElementById("apellidoRequirente").disabled = true;
				document.getElementById("emailRequirente").disabled = true;
				document.getElementById("telefonoRequirente").disabled = true;
				document.getElementById("celularRequirente").disabled = true;
				document.getElementById("calleDomicilio").disabled = true;
				document.getElementById("numeroDomicilio").disabled = true;
				document.getElementById("pisoDomicilio").disabled = true;
				document.getElementById("departamentoDomicilio").disabled = true;
				document.getElementById("detalle").disabled = true;	
				
				var cuit = $('#cuitRequirente').val();
				if(cuit.length == 11){
					agregaMensajeValidacion($("#cuitRequirente"), "Debe ingresar un Cuit válido");				
				}
		}
		document.getElementById('tipoconsulta').value = 0;
		document.getElementById('provincia').value = 0;
		document.getElementById('partidoDomicilio').value = 0;
		document.getElementById('localidadDomicilio').value = 0;
		document.getElementById('nombreRequirente').value = '';
		document.getElementById('apellidoRequirente').value = '';
		document.getElementById('emailRequirente').value = '';
		document.getElementById('telefonoRequirente').value = '';
		document.getElementById('celularRequirente').value = '';
		document.getElementById('calleDomicilio').value = '';
		document.getElementById('numeroDomicilio').value = '';
		document.getElementById('pisoDomicilio').value = '';
		document.getElementById('departamentoDomicilio').value = '';
		document.getElementById('detalle').value = '';
	}	
	function reset_form_nuevo_sorteo(){
		
		$("#formNuevoSorteo").trigger("reset");
		document.getElementById("tipoconsulta").disabled = true;
		document.getElementById("provincia").disabled = true;
		document.getElementById("nombreRequirente").disabled = true;
		document.getElementById("apellidoRequirente").disabled = true;
		document.getElementById("emailRequirente").disabled = true;
		document.getElementById("telefonoRequirente").disabled = true;
		document.getElementById("celularRequirente").disabled = true;
		document.getElementById("calleDomicilio").disabled = true;
		document.getElementById("numeroDomicilio").disabled = true;
		document.getElementById("pisoDomicilio").disabled = true;
		document.getElementById("departamentoDomicilio").disabled = true;
		document.getElementById("detalle").disabled = true;
		
		document.getElementById("partidoDomicilio").disabled = true;
		document.getElementById("localidadDomicilio").disabled = true;
		
		document.getElementById('tipoconsulta').value = 0;
		document.getElementById('provincia').value = 0;
		document.getElementById('partidoDomicilio').value = 0;
		document.getElementById('localidadDomicilio').value = 0;
		document.getElementById('nombreRequirente').value = '';
		document.getElementById('apellidoRequirente').value = '';
		document.getElementById('emailRequirente').value = '';
		document.getElementById('telefonoRequirente').value = '';
		document.getElementById('celularRequirente').value = '';
		document.getElementById('calleDomicilio').value = '';
		document.getElementById('numeroDomicilio').value = '';
		document.getElementById('pisoDomicilio').value = '';
		document.getElementById('departamentoDomicilio').value = '';
		document.getElementById('detalle').value = '';
		
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