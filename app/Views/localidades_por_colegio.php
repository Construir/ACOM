<h5 style="color:#016887;padding-top:5px">Configuración - Localidades</h5>
<div class="container" style="display:none" id="div_filtro_administrador">
	<form action=""  method="post" enctype="multipart/form-data" name="formFiltroPartidosAmin" id="formFiltroPartidosAmin"> 
	  <div class="row">
		
		<div  class="col-sm-6 col-md-6 col-lg-6 col-xl-6">		
								
			<select  style="margin-top:3px;margin-botom:3px" name="desplegableprovinciasadmin" id="desplegableprovinciasadmin" class="form-control">
				<option value="0" selected>Seleccione una provincia</option>												
				  <?php foreach ($provincias as $provincia){ ?>						
												
						<?php if($provincia['IdProvincia'] == $provincia_actual){?>														
								<option selected value="<?php echo $provincia['IdProvincia']?>"><?php echo $provincia['NombreProvincia']?></option>
						<?php }else{?>
								<option  value="<?php echo $provincia['IdProvincia']?>"><?php echo $provincia['NombreProvincia']?></option>
						<?php }?>																  
												  
				  <?php }?>				
			</select>
			
		</div>	 
		<br>		
		<div  class="col-sm-6 col-md-6 col-lg-6 col-xl-6">		
								
			<select  disabled style="margin-top:3px;margin-botom:3px" name="desplegablepartidosadmin" id="desplegablepartidosadmin" class="form-control">
				<option value="0">Seleccione un patido</option>				
			</select>
			
		</div>
		
	  </div>
	</form>
	
</div>
<br>
<div class="container" style="display:none" id="div_filtro_colegios">
	<form action=""  method="post" enctype="multipart/form-data" name="formFiltroPartidos" id="formFiltroPartidos"> 
	  <div class="row">
			
		<div  class="col-sm-12 col-md-12 col-lg-12 col-xl-12">		
								
			<select style="margin-top:3px;margin-botom:3px" name="desplegablepartidos" id="desplegablepartidos" class="form-control">
				<option value="0" selected>Seleccione un partido</option>												
				  <?php foreach ($partidos as $partido){ ?>						
												
						<?php if($partido['Id'] == $partido_actual){?>														
								<option selected value="<?php echo $partido['Id']?>"><?php echo $partido['NombrePartido']?></option>
						<?php }else{?>
								<option  value="<?php echo $partido['Id']?>"><?php echo $partido['NombrePartido']?></option>
						<?php }?>																  
												  
				  <?php }?>				
			</select>
			
		</div>
		
	  </div>
	</form>
	
</div>
<br>
<div class="container">
	<div class="card">
		<div class="card-body">
			<table id="tabla-localidades" class="table table-striped table-sm">
			  <thead>
				<tr>
				  <th scope="col">Municipio</th>
				  <th scope="col">Localidad</th>
				  <th scope="col">Estado</th>
				  		
				  <th scope="col" style='width:5%'>Acción</th>
				</tr>
			  </thead>
			  <tbody>
				<?php foreach ($localidades as $localidad){?>				  
				<tr>
					<td><?php echo $localidad['Municipio']?></td>
					<td><?php echo $localidad['NombreLocalidad']?></td>	
					<td>
				
						<?php if($localidad['Estado'] == 1){?>
							
							Habilitada
							
						<?php }else{?>
						
							Deshabilitada	
							
						<?php }?>
						
				   </td>					
																				
					<td>
					<div class="form-inline">
						<?php if($localidad['Estado'] == 1){?>
							
							<form class="form-inline" action="desahilitar_localidad" method="post" enctype="multipart/form-data" id="formdeshabilitarlocalidad" name="formdeshabilitarlocalidad">
								<input type="hidden" name="id_localiadad_deshabilitar" id="id_localiadad_deshabilitar" value="<?php echo $localidad['IdLocalidad']?>">
								<input type="hidden" name="id_partido" id="id_partido" value="<?php echo $partido_actual?>">
								<input type="hidden" name="id_provincia" id="id_provincia" value="<?php echo $provincia_actual?>">
								<button style="margin-right:3px" type="submit" class="btn btn-danger btn-sm">
									<img src="<?php echo base_url(); ?>/imagenes/recusar.png" width="18" height="18" title="Deshabilitar localidad para sorteo">
								</button>
							</form>
							
						<?php }else{?>
						
							<form class="form-inline" action="habilitar_localidad" method="post" enctype="multipart/form-data" id="formhabilitarlocalidad" name="formhabilitarlocalidad">
								<input type="hidden" name="id_localiadad_habilitar" id="id_localiadad_habilitar" value="<?php echo $localidad['IdLocalidad']?>">
								<input type="hidden" name="id_partido" id="id_partido" value="<?php echo $partido_actual?>">
								<input type="hidden" name="id_provincia" id="id_provincia" value="<?php echo $provincia_actual?>">
								<button style="margin-right:3px" type="submit" class="btn btn-success btn-sm">
									<img src="<?php echo base_url(); ?>/imagenes/agregar_blanco.png" width="18" height="18" title="Habilitar localidad para sorteo">
								</button>
							</form>	
							
						<?php }?>
					</div>	
				   </td>
				</tr>
				<?php }?>
			  </tbody>
			</table>
		</div>
	</div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		
		var idPerfil=<?php echo json_encode($idPerfil);?>;
		
		if(idPerfil == 6){
			document.getElementById('div_filtro_colegios').style.display = 'none';
			$("#div_filtro_administrador").show();
		} else if(idPerfil == 2){
			document.getElementById('div_filtro_administrador').style.display = 'none';
			$("#div_filtro_colegios").show();
		}
		
		$('#tabla-localidades').stacktable();
		$('#tabla-localidades').DataTable( {
			"lengthMenu": [[25, 50, -1], [25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 0, "asc" ]],
			"paging": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});
		$("#desplegablepartidosadmin").change(function(){
			
			var partido = $('#desplegablepartidosadmin').val();
			if(partido > 0){
					
				$("#formFiltroPartidosAmin").attr("action","localidades_por_colegio");	            
				$("#formFiltroPartidosAmin").submit();	
				
			}
		});	
		$("#desplegablepartidos").change(function(){
			
			var partido = $('#desplegablepartidos').val();
			if(partido > 0){
					
				$("#formFiltroPartidos").attr("action","localidades_por_colegio");	            
				$("#formFiltroPartidos").submit();	
				
			}
		});	
		$("#desplegableprovinciasadmin").change(function(){
			var provincia = $('#desplegableprovinciasadmin').val();
			if(provincia == 0){
				
				document.getElementById('desplegablepartidosadmin').value = 0;
				document.getElementById("desplegablepartidosadmin").disabled = true;

				
			} else {	
				var url = 'devolver_partidos_json';					
				$.ajax({
					type:"POST",					
					url:url,
					data:{provincia:provincia},
					success:function(rta){	
					
						document.getElementById("desplegablepartidosadmin").disabled = false;								
						$('#desplegablepartidosadmin').html(rta).fadeIn();								
						
					}
				});		
			}
		});		
					
	});
	
	</script>
  </body>
</html>