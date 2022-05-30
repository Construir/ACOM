<?php if($origen == 1){ ?>	
	<h5 style="color:#016887;padding-top:5px">Usuarios - Nuevo usuario</h5>		
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
			<form action=""  method="post" enctype="multipart/form-data" name="formNuevoUsuario" id="formNuevoUsuario"> 
				
				<div class="card">
					<h5 class="card-header">Datos de Usuario</h5>
					<div class="card-body">						
								
						<div class="row form-group">
							  <div class="col-sm-6">
							<label>Nombre<sup style="color:red"><strong>*</strong></sup></label>
							<input name="nombreUsuario" id="nombreUsuario" type="text" class="form-control number required" placeholder="Ingrese un nombre">							
						  </div>
						  <div class="col-sm-6">
							<label>Apellido<sup style="color:red"><strong>*</strong></sup></label>
							<input name="apellidoUsuario" id="apellidoUsuario" type="text" class="form-control" placeholder="Ingrese un apellido">							
						  </div>
						</div>

						<div class="row form-group">						 	
							<div class="col-sm-6">
								<label>E-mail</label>
								<input name="emailUsuario" id="emailUsuario" type="text" class="form-control number" placeholder="Ingrese su direcci&oacute;n de email">				
							</div>
							<div class="col-sm-6">
								<label>Cuit</label>
								<input name="cuitUsuario" id="cuitUsuario" onkeyup="valida_cadena(event, this)" type="text" class="form-control required" placeholder="Ingrese un cuit">							
							</div>	
						</div>
						
						<div class="row form-group">
						  <div class="col-sm-6">
							<label>Teléfono</label>
							<input name="telefonoUsuario" id="telefonoUsuario" type="text" class="form-control" placeholder="Ingrese un teléfono">							
						  </div>
							<div class="col-sm-6">
								<label>Celular</label>
								<input name="celularUsuario" id="celularUsuario" type="text" class="form-control required email" placeholder="Ingrese un celular">
							</div>
						</div>			
						
						<div class="row form-group">
						  <div class="col-sm-6">
							<label>Colegio<sup style="color:red"><strong>*</strong></sup></label>
							<select class="form-control required" name="colegioAbogado" id="colegioAbogado" data-required="true">
								<option value="0">Seleccione un Colegio</option>												
								  <?php foreach ($departamentos as $departamento){ ?>					
										<option  value="<?php echo $departamento['IdDepartamento']?>"><?php echo $departamento['NombreDepartamento']?></option>
								  <?php }?>
							</select>							
						  </div>
							<div class="col-sm-6" invisible>
								
							</div>
						</div>

						<div class="row form-group">						 	
							<div class="col-sm-6">
								<label>Usuario<sup style="color:red"><strong>*</strong></sup></label>
								<input name="usuario" id="usuario" type="text" class="form-control number" placeholder="Ingrese un usuario">				
							</div>
							<div class="col-sm-6">
								<label>Contraseña<sup style="color:red"><strong>*</strong></sup></label>
								<input name="contrasenia" id="contrasenia" type="text" class="form-control required" placeholder="Ingrese una contraseña">							
							</div>	
						</div>
						<br><hr>						
					
						<button id="btn_enviar_formulario" style="float:right;margin-right:0.5%" class="btn btn-primary" type="button">Guardar</button>									
												
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
			<div id="div_cartel" class="alert"  role="alert">					
				<div class="form-group">
					<h5>¡Atención!</h5>
					<div id="mensaje"></div>						
				</div>
			</div>		
			<div class="modal-footer">			
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
					
						document.getElementById("partidoDomicilio").disabled = false;								
						$('#partidoDomicilio').html(rta).fadeIn();								
						
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
		
		$('#btn_enviar_formulario').click(function(){			
			
			if(validarNuevoUsuario()){
				
				var nombreUsuario = $('#nombreUsuario').val();
				var apellidoUsuario = $('#apellidoUsuario').val();
				var emailUsuario = $('#emailUsuario').val();				
				var cuitUsuario = $('#cuitUsuario').val();
				var telefonoUsuario = $('#telefonoUsuario').val();				
				var celularUsuario = $('#celularUsuario').val();
				var colegioAbogado = $('#colegioAbogado').val();							
				var usuario = $('#usuario').val();
				var contrasenia = $('#contrasenia').val();
											
				var url = 'guardar_nuevo_usuario_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{nombreUsuario:nombreUsuario,apellidoUsuario:apellidoUsuario,emailUsuario:emailUsuario,cuitUsuario:cuitUsuario,
						  telefonoUsuario:telefonoUsuario,celularUsuario:celularUsuario,colegioAbogado:colegioAbogado,usuario:usuario,contrasenia:contrasenia},
					success:function(rta){								
						$('#div_cartel').removeClass('alert-success');
						$('#div_cartel').removeClass('alert-danger');						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								
								$("#div_cartel").addClass("alert-danger");
								$('#mensaje').html('No se pudo agregar el usuario. Ya existe un usuario con el mismo apellido, nombre de usuario y contraseña. <br> Verifique y vuelva a intentar.');								  
								break;
						  case 1:
								
								$("#div_cartel").addClass("alert-success");								
								$('#mensaje').html('El usuario se agrego con éxito.');
								break;
						  default:
								$('#mensaje').html('No se pudo agregar el usuario.');																	
						}							
							
						reset_form_nuevo_sorteo();								
											
						$('#modal_mensaje').modal('show');
						
					}
				});						
			 							
			}			
			
		});			
		
	});
	
	function reset_form_nuevo_sorteo(){
		
		$("#formNuevoUsuario").trigger("reset");				
		document.getElementById('nombreUsuario').value = '';
		document.getElementById('apellidoUsuario').value = '';
		document.getElementById('emailUsuario').value = '';
		document.getElementById('cuitUsuario').value = '';
		document.getElementById('telefonoUsuario').value = '';
		document.getElementById('celularUsuario').value = '';
		document.getElementById('colegioAbogado').value = 0;
		document.getElementById('usuario').value = '';
		document.getElementById('contrasenia').value = '';
		
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