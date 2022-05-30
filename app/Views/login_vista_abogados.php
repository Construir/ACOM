<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ialonardi Nestor Claudio">    
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono_cafe.PNG" width="20" height="20">
    <title>ACOM</title>
		
    <!-- Bootstrap core CSS -->
	<link href="<?php echo base_url(); ?>/public/bootstrap/css/estilo-login.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	 
  </head>

    <body class="" id="background_login" style="background-color:#f5f5f5">			
		<div class="container col-xs-6 col-sm-6 col-md-6 col-lg-3">
			<?php if(!empty($mensaje)){?>				
				 						  
					  <div id="mensajedealerta" class="alert alert-danger" role="alert">
						<?php echo $mensaje;?>
						<a id="olvido_su_contraseña_error" href="#" class="btn btn-link" style="font-size:12px">¿Olvidó su contraseña?</a>
					  </div> 						 
				  		
			 <?php }?>

				<div id="contenedor">						
					<div class="panel-heading" id="titulo-panel-heading" style="text-align:center">
						<h3 class="panel-title">ACOM-Abogados</h3>
					</div>								
					<div class="panel-body">
						<form style="width:100%;text-align:left" class="form-signin" action="" method="post" enctype="multipart/form-data" name="formLogin" id="formLogin">	
							<input type="hidden" name="origen_login" id="origen_login" value="1">
							<fieldset>							
								<div class="form-group">									
									<label class="font-weight-bold">Cuit</label>
									<input onchange="remover_mensaje_error(this.id)" type="usuario" name="usuario" id="usuario" class="form-control" placeholder="CUIT. Ej: 20201236789" autofocus required>    
									
								</div>	
								<div class="form-group ">									
									<label class="font-weight-bold">Contraseña</label>
									<input onchange="remover_mensaje_error(this.id)" type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
									<a id="olvido_su_contraseña" href="#" class="btn btn-link" style="font-size:12px;float:left;padding-left:0px;padding-top:2px;padding-bottom:10px">¿Olvidó su contraseña?</a>
								</div>										
								<button class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login" id="botoncontinuar">Ingresar</button>
							</fieldset>									
						</form>
					</div>
					<div class="card-footer bg-transparent">
						<center> 										
										
							
							<a href="mailto:desarrollo@colproba.org.ar" class="btn btn-link">Soporte técnico</a> -
							<a href="registro" class="btn btn-link">Registrarme</a>-
							<a id="modalrecuperarcontrasena" href="#" class="btn btn-link">Recupere su contraseña</a>-
							
							<a href="https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub" class="btn btn-link">Manual de usuario</a>	
							<!--
							<a href="https://docs.google.com/document/d/1rCytFtK6CbeEC4wn5IVUJXQJVLGCFG2sPK8h49xvF8c/edit?usp=sharing" class="btn btn-link">Manual de usuario</a>	
							-->
							<br> <small>© Copyright 2020 ColProBA </small> 
						</center>
					</div>					
				</div>
		
		</div>
	</body>
<div class="modal fade" id="modalrecuperarcontrasenia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Recuperar contraseña</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
			
			<div id="div_ingreso_datos_basicos">	
				<div class="row">
				
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="form-group">
							<label>Cuit</label>
							<input style="margin-left:3px;margin-top:3px" type="text" onkeyup="validarCuitRequirente();valida_cadena(event, this)" class="form-control" maxlength="11" placeholder="Ingrese su Cuit" name="cuitrecuperarcontrasena" id="cuitrecuperarcontrasena">
						</div>
					</div>
					<br>
					<div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label>Colegio</label>
						<select style="margin-left:3px;margin-top:3px;margin-bottom:10px" onchange="remover_mensaje_error(this.id)" name="desplegabledepartamentorecuperarcontrasena" id="desplegabledepartamentorecuperarcontrasena" class="form-control">
							<option value = "0" selected >Seleccione un Colegio</option>
							  <?php foreach ($departamentos as $departamento) {?>
									  <option value="<?php echo $departamento['IdDepartamento']?>"><?php echo strtoupper($departamento['NombreProvincia']).' - '.$departamento['NombreDepartamento']?></option>
							  <?php } ?>
						</select>
						
					</div>					
					<!--
					<div  style="text-align:center" class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label>Dependiendo de su Colegio Profesional</label>
					</div>	
					
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
					  <input style="margin-left:3px;margin-top:3px" type="text" class="form-control" onclick="sacarMatricula()" onkeyup="valida_cadena(event, this)" placeholder="Tomo" maxlength="3" name="tomorecuperarcontrasena" id="tomorecuperarcontrasena" >
					</div>
					
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
					  <input style="margin-left:3px;margin-top:3px" type="text" class="form-control" onclick="sacarMatricula()"  onkeyup="valida_cadena(event, this)" placeholder="Folio" maxlength="3" name="foliorecuperarcontrasena" id="foliorecuperarcontrasena">
					</div>
					
					<div  style="text-align:center" class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label>o</label>
					</div>				

					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
					  <input style="margin-left:3px;margin-top:3px" type="text" class="form-control" onclick="sacarTomoFolio()" placeholder="Matrícula" name="matricularecuperarcontrasena" id="matricularecuperarcontrasena">
					</div>				
					-->
				</div>		
			
				<div id="mensaje_validacion" style="display:none"></div> 				
				<br>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
					<input class="btn btn-primary" id="btn_siguiente" type="button" value="Siguiente">	
				</div>
			</div>
			
			<div id="div_lista_domicilios" style="display:none"></div> 										
			
			<div id="div_mensaje_final" style="display:none"></div>
			
			<div id="div_mensaje_fallo" style="display:none">
				<div class="alert alert-danger" role="alert">
				<h4>¡Atención!</h4>
				<label id="label_mensaje_fallo"></label>
				</div>				
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
				</div>			
			</div>
			
			<div id="div_mensaje_exito" style="display:none">
				<div class="alert alert-success" role="alert">
				<h4>¡Atención!</h4>
				<label id="label_mensaje_exito"></label>
				</div>				
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
				</div>			
			</div>
			
		</div> 	
	</div>
  </div>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    
	<script type="text/javascript">

		jQuery(document).ready(function() {
			$('#botoncontinuar').click(function(){
				
				$("#formLogin").attr("action","valida_usuario");	            
				$("#formLogin").submit();
				
			});	
			$('#modalrecuperarcontrasena').click(function(){
				$(".estilos-errores").remove();
				
				//document.getElementById("matricularecuperarcontrasena").disabled = false;
				//document.getElementById("tomorecuperarcontrasena").disabled = false;
				//document.getElementById("foliorecuperarcontrasena").disabled = false;
			
				document.getElementById('cuitrecuperarcontrasena').value = '';
				//document.getElementById('tomorecuperarcontrasena').value = '';
				//document.getElementById('foliorecuperarcontrasena').value = '';				
				//document.getElementById('matricularecuperarcontrasena').value = '';				
				document.getElementById('desplegabledepartamentorecuperarcontrasena').value = 0;				
				
				document.getElementById('div_lista_domicilios').style.display = 'none';
				document.getElementById('div_mensaje_final').style.display = 'none';
				document.getElementById('div_mensaje_fallo').style.display = 'none';
				document.getElementById('div_mensaje_exito').style.display = 'none';
				$('#div_ingreso_datos_basicos').show();
				$('#modalrecuperarcontrasenia').modal('show');			
			});			
			$('#olvido_su_contraseña').click(function(){
				$(".estilos-errores").remove();
				
				//document.getElementById("matricularecuperarcontrasena").disabled = false;
				//document.getElementById("tomorecuperarcontrasena").disabled = false;
				//document.getElementById("foliorecuperarcontrasena").disabled = false;
			
				document.getElementById('cuitrecuperarcontrasena').value = '';
				//document.getElementById('tomorecuperarcontrasena').value = '';
				//document.getElementById('foliorecuperarcontrasena').value = '';				
				//document.getElementById('matricularecuperarcontrasena').value = '';				
				document.getElementById('desplegabledepartamentorecuperarcontrasena').value = 0;				
				
				document.getElementById('div_lista_domicilios').style.display = 'none';
				document.getElementById('div_mensaje_final').style.display = 'none';
				document.getElementById('div_mensaje_fallo').style.display = 'none';
				document.getElementById('div_mensaje_exito').style.display = 'none';
				$('#div_ingreso_datos_basicos').show();
				$('#modalrecuperarcontrasenia').modal('show');			
			});	
			$('#olvido_su_contraseña_error').click(function(){
				$(".estilos-errores").remove();
				
				//document.getElementById("matricularecuperarcontrasena").disabled = false;
				//document.getElementById("tomorecuperarcontrasena").disabled = false;
				//document.getElementById("foliorecuperarcontrasena").disabled = false;
			
				document.getElementById('cuitrecuperarcontrasena').value = '';
				//document.getElementById('tomorecuperarcontrasena').value = '';
				//document.getElementById('foliorecuperarcontrasena').value = '';				
				//document.getElementById('matricularecuperarcontrasena').value = '';				
				document.getElementById('desplegabledepartamentorecuperarcontrasena').value = 0;				
				
				document.getElementById('div_lista_domicilios').style.display = 'none';
				document.getElementById('div_mensaje_final').style.display = 'none';
				document.getElementById('div_mensaje_fallo').style.display = 'none';
				document.getElementById('div_mensaje_exito').style.display = 'none';
				$('#div_ingreso_datos_basicos').show();
				$('#modalrecuperarcontrasenia').modal('show');			
			});	
		
			$('#btn_siguiente').click(function(){
				//console.log(validarRecuperarContrasenia());
				if(validarRecuperarContrasenia()){				  
					
					var cuit = $('#cuitrecuperarcontrasena').val();
					var tomo = $('#tomorecuperarcontrasena').val();
					var folio = $('#foliorecuperarcontrasena').val();				
					var matricula = $('#matricularecuperarcontrasena').val();
					var departamento = $('#desplegabledepartamentorecuperarcontrasena').val();							  
							
					var url = 'devolver_domicilios_recuperar_contrasenia_json';
					//console.log(cuit,tomo,folio,matricula,departamento);
					$.ajax({
						type:"POST",					
						url:url,
						data:{cuit:cuit,tomo:tomo,folio:folio,matricula:'999',departamento:departamento},
						success:function(rta){									
							
							document.getElementById('div_ingreso_datos_basicos').style.display = 'none';
							document.getElementById('div_mensaje_final').style.display = 'none';
							document.getElementById('div_mensaje_fallo').style.display = 'none';
							document.getElementById('div_mensaje_exito').style.display = 'none';
							
							$('#div_lista_domicilios').show();
							$('#div_lista_domicilios').html(rta);
							
							$('#tabla_domicilios').stacktable();
							$('#tabla_domicilios').DataTable({	
								"lengthMenu": [[50, -1], [50, "Todos"]],
								"searching":false,		
								"info":false,		
								"ordering":false,			
								"paging": false,		
								"language": {
									"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
								}	
							});						
													
						}
					});	
						
								
				} else {
					
					
					$('#mensaje_validacion').html('Complete los campos señalados como obligatorios.');
					
					
				}
			});	
			
			$('#btn_verificar').click(function(){
				
					var emailcompletar = $('#emailcompletar').val();
					var checkDomicilio = $('#checkDomicilio').val();
										
					var url = 'validacion_final_recuperar_contrasenia_json';
					//console.log(checkDomicilio,checkDomicilio);
					$.ajax({
						type:"POST",					
						url:url,
						data:{emailcompletar:emailcompletar,checkDomicilio:checkDomicilio},
						success:function(rta){					
							
							switch (parseInt(rta, 10)) {
										
							  case 0:										
									$('#div_mensaje_final').html('No es posible resetear su contraseña. Por favor, contacte a desarrollo@colproba.org.ar indicando Tomo, Folio, Colegio y CUIT.');								
									break;
							  case 1:
									$('#div_mensaje_final').html('Su contrseña se reseteo con éxito. Por favor ingrese al sistema con su cuit como contraseña');
									break;
							  default:
									$('#div_mensaje_final').html('No es posible resetear su contraseña. Por favor, contacte a desarrollo@colproba.org.ar indicando Tomo, Folio, Colegio y CUIT.');																		
							}
							
							document.getElementById('div_ingreso_datos_basicos').style.display = 'none';
							document.getElementById('div_lista_domicilios').style.display = 'none';
							document.getElementById('div_mensaje_fallo').style.display = 'none';
							document.getElementById('div_mensaje_exito').style.display = 'none';
							$('#div_mensaje_final').show();
							//$('#div_mensaje_final').html(rta);					
													
						}
					});	
						
			});				
				
		});				
		function validacion_final(){
			
			var emailcompletar = $('#emailcompletar').val();
			//var checkDomicilio = $('#checkDomicilio').val();
			var checkDomicilio = $('input:radio[name=checkDomicilio]:checked').val();
			
			if(validar_check_y_mail()){
				
				var url = 'validacion_final_recuperar_contrasenia_json';
				//console.log(checkDomicilio,emailcompletar);
				$.ajax({
					type:"POST",					
					url:url,
					data:{emailcompletar:emailcompletar,checkDomicilio:checkDomicilio},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
									
						  case 0:					  
								$('#label_mensaje_fallo').html('No es posible resetear su contraseña. Por favor, contacte a desarrollo@colproba.org.ar indicando Tomo, Folio, Colegio y CUIT.');								
								$('#div_mensaje_fallo').show();
								break;
						  case 1:
								$('#label_mensaje_exito').html('Su contrseña se reseteo con éxito. Por favor ingrese al sistema con su cuit como contraseña');
								$('#div_mensaje_exito').show();
								break;
						  default:
								$('#label_mensaje_fallo').html('No es posible resetear su contraseña. Por favor, contacte a desarrollo@colproba.org.ar indicando Tomo, Folio, Colegio y CUIT.');																		
								$('#div_mensaje_fallo').show();
						}
						
						document.getElementById('div_ingreso_datos_basicos').style.display = 'none';
						document.getElementById('div_lista_domicilios').style.display = 'none';
						//$('#div_mensaje_final').show();
						//$('#div_mensaje_final').html(rta);					
												
					}
				});
				
			}
				
		}
		function validar_check_y_mail(){
			
			var emailcompletar = $("#emailcompletar").val();
			var checkDomicilio = $('input:radio[name=checkDomicilio]:checked').val();			
			
			validadoOK = true;
			
			if ((emailcompletar.length == 0) || (!checkDomicilio)){
				
				if (emailcompletar.length == 0){agregaMensajeValidacion($("#emailcompletar"), "Ingrese un mail");}
				if (!checkDomicilio){
					
					agregaMensajeValidacion($("#div_selecciones_domicilio"), "Seleccione un domicilio");
					$('#div_selecciones_domicilio').show();
				
				}
															
				validadoOK = false;	
			}
			if(!validaEmail(emailcompletar)){
				agregaMensajeValidacion($('#emailcompletar'), "Debe ingresar un E-mail válido");	
				validadoOK = false;				
			}
		
			return validadoOK;
		}
		function ingreso_usuario(){
				
			//$("#form1").attr("action","login/valida_usuario");	            
			//$("#form1").submit();
		}	
			
		function remover_mensaje_error(selector){
			
			 x = document.getElementById(selector).nextSibling;
			 if(x.nextElementSibling){
				x.nextElementSibling.remove();
			 }
		}
		function validarCuitRequirente(){
		
			var validacion = validaCuitCuil($('#cuitrecuperarcontrasena').val());

			if(validacion){
				$(".estilos-errores").remove();
			}else{
				var cuit = $('#cuitrecuperarcontrasena').val();
				if(cuit.length == 11){
					agregaMensajeValidacion($("#cuitrecuperarcontrasena"), "Cuit no válido");				
				}else{
					$(".estilos-errores").remove();
				}
			}
		
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
		function validarRecuperarContrasenia(){
						
			var cuit = $("#cuitrecuperarcontrasena").val();
			//var tomo = $("#tomorecuperarcontrasena").val();
			//var folio = $("#foliorecuperarcontrasena").val();
			//var matricula = $("#matricularecuperarcontrasena").val();
			var departamento = $("#desplegabledepartamentorecuperarcontrasena").val();
			
			validadoOK = true;
			
			if ((cuit.length == 0) || (departamento == 0)){
				
				if (cuit.length == 0){agregaMensajeValidacion($("#cuitrecuperarcontrasena"), "Ingrese un cuit");}
				if (departamento == 0){agregaMensajeValidacion($("#desplegabledepartamentorecuperarcontrasena"), "Seleccione un departamento");}
													
				validadoOK = false;	
			}
			/*
			if($('#matricularecuperarcontrasena').prop('disabled')){
				
				if ((tomo.length == 0) || (folio.length == 0)){					
					
					if (tomo.length == 0){agregaMensajeValidacion($("#tomorecuperarcontrasena"), "Ingrese un tomo");}
					if (folio.length == 0){agregaMensajeValidacion($("#foliorecuperarcontrasena"), "Ingrese un folio");}
												
					validadoOK = false;	
				}
				
			}
			
			if($('#tomorecuperarcontrasena').prop('disabled')){
				
				if (matricula.length == 0){
					
					if (matricula.length == 0){agregaMensajeValidacion($("#matricularecuperarcontrasena"), "Ingrese una matrícula");}	
												
					validadoOK = false;	
				}
				
			}
			*/
			return validadoOK;
		}
		function sacarMatricula(){
			document.getElementById("matricularecuperarcontrasena").disabled = true;
		}
		function sacarTomoFolio(){
			document.getElementById("tomorecuperarcontrasena").disabled = true;
			document.getElementById("foliorecuperarcontrasena").disabled = true;
		}
	</script>
 
</html>