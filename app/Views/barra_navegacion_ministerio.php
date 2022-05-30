<nav class="navbar navbar-expand-lg bg-primary">
  <a class="navbar-brand" href="home" style="color:#FFFFFF">Acom</a>
  <button class="text-white navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <img src="<?php echo base_url(); ?>/imagenes/menu.png"style="color:white" width="25" height="25" class="img-responsive" title="Menú"/>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <!--
		<li class="nav-item dropdown">
        <a  style="color:#FFFFFF" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sorteos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="sorteos">Sorteos</a>
          <a class="dropdown-item" href="nuevo_sorteo">Nuevo Sorteo</a>
		</div>
		
		  <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
	
      </li> 
	  -->
	   <!--
	  <li class="nav-item active">
        <a class="nav-link" href="recusaciones" style="color:#FFFFFF">Recusaciones</a>
      </li>
	  -->
	  <!--
	  <li class="nav-item active">
        <a class="nav-link" href="#">Profesionales</a>
      </li>
	
	  <li class="nav-item active">
        <a class="nav-link" href="#">Consultas</a>
      </li>
   
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
	  	<li class="nav-item dropdown">
			<a  style="color:#FFFFFF" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Reportes
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <!--
			  <a class="dropdown-item" href="reporte_abogados_activos_por_provincias">Abogados activos por provincia</a>  
			  -->
			  <a class="dropdown-item" href="reporte_abogados_inscriptos_por_colegio">Abogados inscriptos por colegio profesional</a> 
			  <a class="dropdown-item" href="reporte_abogados_inscriptos_por_partido">Abogados inscriptos por partido</a> 
			  <a class="dropdown-item" href="reporte_sorteos_por_provincias">Sorteos por Provincias y Partidos</a>
			  <a class="dropdown-item" href="reporte_sorteos_por_partido_por_provincias_entre_fechas">Sorteos por Provincias y Partidos entre Fechas</a> 			  
			  <a class="dropdown-item" href="reporte_abogados_sorteados_por_partido_movimiento">Sorteos por Abogado y Estados entre Fechas</a> 			  
			  <a class="dropdown-item" href="reporte_causas_por_comisiones_medicas">Causas por Comisiones Médicas</a> 			  
			  <!--			  
			  <a class="dropdown-item" href="reporte_sorteos_por_comisiones_medicas">Sorteos por comisiones médicas</a> 			  
			  -->
			</div>	
		</li>
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
					 <!--
					<a class="dropdown-item" href="#" id="abrir_ayuda">Ayuda</a>						  
					<div class="dropdown-divider"></div>	
					-->
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