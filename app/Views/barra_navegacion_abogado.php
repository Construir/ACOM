<nav class="navbar navbar-expand-lg bg-primary">
 <a class="navbar-brand" href="home" style="color:#FFFFFF">Acom</a>
  <button class="text-white navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <img src="<?php echo base_url(); ?>/imagenes/menu.png"style="color:white" width="25" height="25" class="img-responsive" title="Menú"/>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="sorteos" style="color:#FFFFFF">Causas</a>
      </li>
	   <li class="nav-item dropdown">
        <a  style="color:#FFFFFF" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Licencias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="licencias_abogado">Licencias</a>
          <a class="dropdown-item" href="nueva_licencia">Nueva Licencia</a>
		</div>
		<!--
		  <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
		-->
      </li> 
	  <!--
	  <li class="nav-item active">
        <a class="nav-link" href="#" style="color:#FFFFFF">Profesionales</a>
      </li>
	  -->
	   <li class="nav-item dropdown">
        <a  style="color:#FFFFFF" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mis Datos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="matriculas_abogado">Legajo</a>
          <a class="dropdown-item" href="nueva_matricula">Nueva Matrícula</a>
		</div>
		<!--
		  <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
		-->
      </li>
      <!--
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
					<?php echo "<strong>Usuario: </strong>".$nombreusuario?>
				</a>																	
				<div class="dropdown-menu">	
					
					<a class="dropdown-item" href="https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub" target="_blank" id="">Ayuda</a>							  
					<div class="dropdown-divider"></div>					
					<a class="dropdown-item" href="#" id="abrir_cambiar_contrasenia">Cambiar Contraseña</a>							  
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
<div class="modal" id="ayuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>		
	  <div class="modal-body">
		<div>
		
			<label style="font-size:18px"><b>1-Sorteos</b></label><br>
			<div class="text-justify" style="font-size:13px">
				En esta sección usted podrá ver los sorteos de causas en los que fue favorecido y optar por alguna de las siguientes funcionalidades.			
			</div><br>
			<label style="font-size:18px"><b>1.1-Ver Sorteos</b></label><br>
			<div class="text-justify" style="font-size:13px">
				Con el botón <img src="<?php echo base_url(); ?>/imagenes/ver_negro.png" width="25" height="25" title="Ver Sorteo"> usted podrá visualizar la información completa del sorteo y con ellos ponerse en contacto con el cliente.
			</div><br>
			<label style="font-size:18px"><b>1.2 Aceptar la causa</b></label><br>
			<div class="text-justify" style="font-size:13px">
				Con el botón <img src="<?php echo base_url(); ?>/imagenes/aceptar_negro.png" width="25" height="25" title="Aceptar Sorteo"> usted podrá comenzar con la causa.
			</div><br>
			<label style="font-size:18px"><b>1.3 Excusame de la Causa</b></label><br>
			<div class="text-justify" style="font-size:13px">
				Con el botón <img src="<?php echo base_url(); ?>/imagenes/excusarme_negro.png" width="25" height="25" title="Excusarme"> usted podrá excusarse de la causa y reingresar a los sorteo nuevamente. Recuerde que puede excusarse 3 veces seguidas y luego será bloqueado para sorteos.			
			</div><br>
			<label style="font-size:18px"><b>1.3 Imprimir Sorteo</b></label><br>
			<div class="text-justify" style="font-size:13px">
				Con el botón <img src="<?php echo base_url(); ?>/imagenes/impresora.png" width="25" height="25" title="Imprimir"> usted podrá imprimir en PDF una copia del sorteo para su control.			
			</div><br>
			
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>		
	  </div>
    </div>
  </div>
</div>
<div class="modal" id="modal_exito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <div class="modal-body">
		<div class="alert alert-success" role="alert">	  
			<label class="font-weight-bold">La Contraseña se cambio con Exito!</label>					
		</div>
	  </div>
	   <div class="modal-footer">
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>		
	  </div>
    </div>
  </div>
</div>
<div class="modal" id="modal_fallo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <div class="modal-body">
		<div class="alert alert-danger" role="alert">
		   <label>No se pudo cambiar la Contraseña. Por favor, contacte a su Administrador.</label>
		</div>	
	  </div>	
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>		
	  </div>		
    </div>
  </div>
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    
	<script type="text/javascript">

		jQuery(document).ready(function() {
			
			$('#abrir_cambiar_contrasenia').click(function(){
				$(".estilos-errores").remove();
							
				document.getElementById('passworcambiapassword').value = '';
				document.getElementById('confirmarcambiapassword').value = '';				
				
				$('#cambiar_contrasenia').modal('show');			
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
								$('#modal_exito').modal('show');
							}else{
								$('#cambiar_contrasenia').modal('hide');
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