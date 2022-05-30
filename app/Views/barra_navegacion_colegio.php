<nav class="navbar navbar-expand-lg bg-primary">
  <a class="navbar-brand" href="home" style="color:#FFFFFF">Acom</a>
  <button class="text-white navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <img src="<?php echo base_url(); ?>/public/imagenes/menu.png"style="color:white" width="25" height="25" class="img-responsive" title="Menú"/>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav mr-auto">
		
	    <li class="nav-item dropdown">
        <a  style="color:#FFFFFF" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Novedades <span class="badge badge-light"><?php echo $cantidad_domicilios_pendientes + $cantidad_matriculas_pendientes?></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="nuevos_inscriptos">Nuevas Solicitudes <span class="badge badge-primary"><?php echo $cantidad_matriculas_pendientes?></span></a>
          <a class="dropdown-item" href="domicilios_por_aprobar">Domicilios por Aprobar <span class="badge badge-primary"><?php echo $cantidad_domicilios_pendientes?></span></a>
		</div>
        <li class="nav-item dropdown">
        <a  style="color:#FFFFFF" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sorteos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="sorteos">Sorteos</a>
          <a class="dropdown-item" href="nuevo_sorteo">Nuevo Sorteo</a>
		</div>
		<!--
		  <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
		-->
      </li> 
	  <!--
	  <li class="nav-item active">
        <a class="nav-link" href="#" style="color:#FFFFFF">Licencias</a>
      </li>
	  <li class="nav-item active">
        <a class="nav-link" href="#" style="color:#FFFFFF">Profesionales</a>
      </li>
	  <li class="nav-item active">
        <a class="nav-link" href="#" style="color:#FFFFFF">Colegios</a>
      </li>
	 
	  <li class="nav-item active">
        <a class="nav-link" href="usuarios" style="color:#FFFFFF">Usuarios</a>
      </li>
	   -->
	  <li class="nav-item active">
        <a class="nav-link" href="matriculaciones" style="color:#FFFFFF">Matriculados</a>
      </li>
	  
	  <li class="nav-item active">
			<a class="nav-link" href="sanciones" style="color:#FFFFFF">Sanciones</a>
	  </li>

	  <li class="nav-item dropdown">
        <a  style="color:#FFFFFF" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Configuración
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="localidades_por_colegio">Localidades</a>         
		</div>	
      </li> 
	  <!--
	  <li class="nav-item active">
        <a class="nav-link" href="mandar_mail" style="color:#FFFFFF">Mandar mail</a>
      </li>
	  -->
      <!--
	  <li class="nav-item dropdown">
        <a  style="color:#FFFFFF" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reportes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Sorteos por Abogados</a>
          <a class="dropdown-item" href="#">Sorteos por Partido</a>
		
		  <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
		
      </li> 
	  -->
    </ul>
	<!--
	<ul class="navbar-nav navbar-right">
		<li class="nav-item dropdown" id="dropdown-colproba">								
			<a style="color:#FFFFFF" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdown" href="#" role="button" aria-haspopup="true" aria-extended="true">
				<?php echo "<strong>Usuario: </strong>".$nombreusuario?>
			</a>																	
			<div class="dropdown-menu">	
			     <a class="dropdown-item" href="<?php echo base_url(); ?>">Cerrar Sesión</a>							  
			</div>
		 </li>			
	</ul> 
	-->
	<form class="form-inline my-2 my-lg-0">
      	<ul class="navbar-nav navbar-right">
			<li class="nav-item dropdown" id="dropdown-colproba">								
				<a style="color:#FFFFFF" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdown" href="#" role="button" aria-haspopup="true" aria-extended="true">
					<?php echo "<strong>Usuario: </strong>".$nombreusuario?><small id="emailHelp" class="form-text text-muted"><?php echo 'Mar del Plata (C.A.M.D.P.)'?></small></a>
				</a>																	
				<div class="dropdown-menu">	
					
					<a class="dropdown-item" href="#" id="abrir_ayuda">Ayuda</a>						  
					<div class="dropdown-divider"></div>					 						  
					 <a class="dropdown-item" href="#" id="abrir_cambiar_contrasenia">Cambiar contraseña</a>							  
					 <a class="dropdown-item" href="#" id="abrir_cambiar_datos_de_contacto">Cambiar datos de contacto</a>							  
					 <div class="dropdown-divider"></div>
					 <a class="dropdown-item" href="<?php echo base_url(); ?>">Cerrar Sesión</a>							  
				
				</div>
			 </li>			
		</ul>	
    </form>
  </div>
</nav>
<div class="modal" id="cambiar_contrasenia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		<form action=""  method="post" enctype="multipart/form-data" name="formCambiarContrasenia" id="formCambiarContrasenia">
			  <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $idusuario?>">
			  <div class="modal-body">
				<div class="form-group ">									
					<label class="font-weight-bold">Contraseña (Entre 6 y 30 Caracteres)</label>
					<input class="form-control" id="passworcambiapassword" name="passworcambiapassword" type="password" onfocus>
				
				</div>
				<div class="form-group ">									
					<label class="font-weight-bold">Confirme Contraseña</label>
					<input class="form-control" id="confirmarcambiapassword" name="confirmarcambiapassword" type="password">
					
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>		
				<input class="btn btn-primary btn-sm" id="botoncambiarcontrasenia" type="button" value="Guardar">
			  </div>
		</form>
    </div>
  </div>
</div>
<div class="modal" id="cambiar_datos_de_contacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Cambiar datos de contacto</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  
		  <div class="modal-body"> 
			
			<div id="mensaje_actualizar_datos_de_contacto"  style="display:none">
				
				<label class="font-weight-bold" style="color:red">Solicitamos actualizar sus datos de contacto como operador del sistema. Los mismos serán utilizados eventualmente para contactarlo ante alguna situación o consulta de un profesional o trabajador y para poder recuperar su contraseña en caso de olvido.</label>
				<label class="font-weight-bold" style="color:red">Muchas gracias.</label>
				<label class="font-weight-bold" style="font-size:90%">Cada persona que accede al sistema debe tener su propio usuario y contraseña, en caso de necesitar crear otro usuario para la institución solicitamos requerirlo por medio de un e-mail a la dirección <a href="mailto:acom@colproba.org.ar">acom@colproba.org.ar</a></label>
				
				<hr/>
			</div>
			
			<form action=""  method="post" enctype="multipart/form-data" name="formCambiarDatosContacto" id="formCambiarDatosContacto">
				  
				  <input type="hidden" name="id_usuario_datos_personales" id="id_usuario_datos_personales" value="<?php echo $idusuario?>">
				 
					<div class="form-group ">									
						<label class="font-weight-bold">Usuario</label>
						<input class="form-control" id="nombre_usuario_datos_personales" name="nombre_usuario_datos_personales" type="text" value="<?php echo $nombre_usuario?>" onfocus>				
					</div>
					<div class="form-group ">									
						<label class="font-weight-bold">Apellido</label>
						<input class="form-control" id="apellido_datos_personales" name="apellido_datos_personales" type="text" value="<?php echo $apellidoUsuario?>">				
					</div>
					<div class="form-group ">									
						<label class="font-weight-bold">Nombre</label>
						<input class="form-control" id="nombre_datos_personales" name="nombre_datos_personales" type="text" value="<?php echo $nombre?>">					
					</div>				
					<div class="form-group ">									
						<label class="font-weight-bold">E-mail</label>
						<input class="form-control" id="email_datos_personales" name="email_datos_personales" type="text" value="<?php echo $email?>">					
					</div>
					<div class="form-group ">									
						<label class="font-weight-bold">Celular</label>
						<input class="form-control" id="celular_datos_personales" name="celular_datos_personales" type="text" value="<?php echo $celular?>">					
					</div>
					<div class="form-group ">									
						<label class="font-weight-bold">Teléfono</label>
						<input class="form-control" id="telefono_datos_personales" name="telefono_datos_personales" type="text" value="<?php echo $telefono?>">					
					</div>
				
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>		
					<input class="btn btn-primary btn-sm" id="botoncambiardatoscontacto" type="button" value="Guardar">
				  </div>
			</form>
		  </div>
    </div>
  </div>
</div>
<div class="modal" id="ayuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>		
	  <div class="modal-body">
	
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>		
	  </div>
    </div>
  </div>
</div>
<div class="modal" id="modal_exito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>     
      </div>
	  <div class="modal-body">
		<div class="alert alert-success" role="alert">	  
			<div id="mensaje_exito"></div>					
		</div>
	  </div>
	   <div class="modal-footer">
		<button type="button"  id="cerrar_modal_aceptar_ok" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>		
	  </div>
    </div>
  </div>
</div>
<div class="modal" id="modal_fallo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <div class="modal-body">
		<div class="alert alert-danger" role="alert">
		   <div id="mensaje_fallo"></div>
		</div>	
	  </div>	
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>		
	  </div>		
    </div>
  </div>
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    
	<script type="text/javascript">		
		jQuery(document).ready(function() {
			
			var actualizar_datos_personales = '<?php echo $actualizar_datos_personales?>';
		
			if(actualizar_datos_personales){				
				$('#mensaje_actualizar_datos_de_contacto').show();									
				$('#cambiar_datos_de_contacto').modal('show');									
			}
			
			$('#cerrar_modal_aceptar_ok').click(function(){
				
				location.reload();
				
			});
			$('#abrir_cambiar_contrasenia').click(function(){	
				$(".estilos-errores").remove();
			
				document.getElementById('passworcambiapassword').value = '';
				document.getElementById('confirmarcambiapassword').value = '';
				
				$('#cambiar_contrasenia').modal('show');			
			});			
			$('#abrir_cambiar_datos_de_contacto').click(function(){	
				
				$(".estilos-errores").remove();
				$("#formCambiarDatosContacto").trigger("reset");								
				$('#cambiar_datos_de_contacto').modal('show');	
				
			});
			
			$('#botoncambiarcontrasenia').click(function(){
				
				if(validarContrasenia()=== true){
					
					var url = 'guardar_cambiar_contrasenia';
					
					var cont1 = $("#passworcambiapassword").val();
					var cont2 = $("#confirmarcambiapassword").val();
					var idusuario = $("#idusuario").val();
					
					$.ajax({
						type:"POST",
						url:url,
						data:{pass1:cont1,pass2:cont2,idusuario:idusuario},					
						success:function(rta){
							if(rta){
								$('#cambiar_contrasenia').modal('hide');
								$('#mensaje_exito').html('La Contraseña se cambio con Exito!');								
								$('#modal_exito').modal('show');
							}else{
								$('#cambiar_contrasenia').modal('hide');
								$('#mensaje_fallo').html('No se pudo cambiar la Contraseña. Por favor, contacte a su Administrador.');								
								$('#modal_fallo').modal('show');
							}														
						}
					});
				}
			});
			$('#botoncambiardatoscontacto').click(function(){
				
				if(validarDatosPersonales()=== true){					
					
					var apellido = $("#apellido_datos_personales").val();
					var nombre = $("#nombre_datos_personales").val();
					var email = $("#email_datos_personales").val();
					var nombre_usuario = $("#nombre_usuario_datos_personales").val();
					var celular = $("#celular_datos_personales").val();
					var telefono = $("#telefono_datos_personales").val();
					var idusuario = $("#id_usuario_datos_personales").val();
					
					var url = 'guardar_cambiar_datos_contacto';
					
					$.ajax({
						type:"POST",
						url:url,
						data:{apellido:apellido,nombre:nombre,email:email,idusuario:idusuario,nombre_usuario:nombre_usuario,celular:celular,telefono:telefono},					
						success:function(rta){
								
							switch (parseInt(rta, 10)) {
								
								case 0:										
										$('#cambiar_datos_de_contacto').modal('hide');
										$('#mensaje_fallo').html('Hemos detectado que el usuario actual no es el mismo que quiere cambiar los datos. Por favor, póngase en contacto con su administrador.');	
										$('#modal_fallo').modal('show');								
										break;
								case 1:
										$('#cambiar_datos_de_contacto').modal('hide');
										$('#mensaje_exito').html('Los datos se guardaron con Exito!');	
										$('#modal_exito').modal('show');
										break;
								case 2:
										$('#cambiar_datos_de_contacto').modal('hide');
										$('#mensaje_fallo').html('Hemos detectado que existe un Usuario con el nombre de usuario ingresado. Por favor, ingrese otro usuario y vuelva a intentar.');	
										$('#modal_fallo').modal('show');
										break;
								default:
										$('#cambiar_datos_de_contacto').modal('hide');
										$('#mensaje_fallo').html('No se pudieron guardar los nuevos datos. Por favor, contacte a su Administrador.');	
										$('#modal_fallo').modal('show');	
										
							}
														
						}
					});
				}
			});	
			
			$('#abrir_ayuda').click(function(){				
				$('#ayuda').modal('show');			
			});			
		});

	</script>