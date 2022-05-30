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
	<link href="<?php echo base_url(); ?>/public/public/bootstrap/css/estilo-login.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/public/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 
  </head>

    <body class="" id="background_login" style="background-color:#f5f5f5">			
		<div class="container col-xs-6 col-sm-6 col-md-6 col-lg-3">
			<?php if(!empty($mensaje)){?>				
				 						  
					  <div id="mensajedealerta" class="alert alert-danger" role="alert">
						<?php echo $mensaje;?>
					  </div> 						 
				  		
			 <?php }?>

				<div id="contenedor">						
					<div class="panel-heading" id="titulo-panel-heading" style="text-align:center">
						<h3 class="panel-title">ACOM</h3>
					</div>								
					<div class="panel-body">
						<form style="width:100%;text-align:left" class="form-signin" action="" method="post" enctype="multipart/form-data" name="formLogin" id="formLogin">	
							<input type="hidden" name="origen_login" id="origen_login" value="1">
							<fieldset>							
								<div class="form-group">									
									<label class="font-weight-bold">Usuario</label>
									<input onchange="remover_mensaje_error(this.id)" type="usuario" name="usuario" id="usuario" class="form-control" placeholder="Usuario" autofocus required>    
									
								</div>	
								<div class="form-group ">									
									<label class="font-weight-bold">Contraseña</label>
									<input onchange="remover_mensaje_error(this.id)" type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
							
								</div>										
								<button class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login" id="botoncontinuar">Ingresar</button>
							</fieldset>									
						</form>
					</div>
					<div class="card-footer bg-transparent">
								<center>								
									<!--<a data-toggle="modal" data-target="#modalrecuperarcontrasena" data-toggle="modal tooltip" href="#" class="btn btn-link">Recupere su contraseña</a>-->
									<a href="mailto:desarrollo@colproba.org.ar">Soporte técnico</a> -
									<!--<a data-toggle="modal" data-target="#modalregistrodeusuario" data-toggle="modal tooltip" href="#" class="btn btn-link">Soporte</a>-	-->
									<a data-toggle="modal" data-target="#modalinstructivo" data-toggle="modal tooltip" href="#" class="btn btn-link">Instructivo de Uso</a>																
										
									<br> <small>© Copyright 2020 ColProBA </small> 
								</center>
					</div>					
				</div>
		
		</div>
	</body>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    
	<script type="text/javascript">

		jQuery(document).ready(function() {
			$('#botoncontinuar').click(function(){
				
				$("#formLogin").attr("action","valida_usuario");	            
				$("#formLogin").submit();
				
			});			
		});	
		function remover_mensaje_error(selector){
			
			 x = document.getElementById(selector).nextSibling;
			 if(x.nextElementSibling){
				x.nextElementSibling.remove();
			 }
		}
	</script>
 
</html>