<h5 style="color:#016887;padding-top:5px">Novedades - Domicilios por aprobar</h5>
<div class="card">
	<div class="card-body">
		<table id="tabla-matriculaciones" style="font-size:95%" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th scope="col">Apellido y Nombre</th>
			  <th scope="col">E-mail</th>
			  <th scope="col">Cuit</th>
			  <th scope="col">Teléfono</th>			 			
			  <th scope="col">Matriculación</th>			
			  <th scope="col">Domicilio</th>			
			  <th scope="col">Horarios</th>			
			 			
			  <th scope="col" style='width:7%'>Acción</th>
			</tr>
		  </thead>
		  <tbody>
		  
		  	<?php foreach ($matriculaciones as $matriculacion){?>
		
			<tr>
				<input type="hidden" name="desc_matriculacion<?php echo $matriculacion['IdMatriculacion']?>" id="desc_matriculacion<?php echo $matriculacion['IdMatriculacion']?>" value="<?php echo $matriculacion['Apellido'].' '.$matriculacion['Nombre']?>">
				
				<td><?php echo $matriculacion['Apellido'].' '.$matriculacion['Nombre']?></td>
				<td><?php echo $matriculacion['Email']?></td>											
				<td><?php echo $matriculacion['Cuit']?></td>
				<td><?php echo $matriculacion['Telefono']?></td>
				
				<td>
				<?php if(empty($matriculacion['Matricula'])){
						echo 'Tomo: '.$matriculacion['Tomo'].' Folio: '.$matriculacion['Folio'];?>
				<?php } else {
						echo ' Matrícula: '.$matriculacion['Matricula'];
					  }
				echo ' <br>'.$matriculacion['NombreDepartamento'];
				?>
				</td>	
				<td><?php echo $matriculacion['Calle'].' '.$matriculacion['Numero'].' '.$matriculacion['Piso'].' '.$matriculacion['Oficina']?></td>							
				<td><?php echo $matriculacion['HorariosAtencion']?></td>																
																
				<td>										
				
					<div class="form-inline">
				
						<button style="margin-right:3px" type="button" class="btn btn-success btn-sm" id="btn_aprobar" href="#myModal" data-toggle="modal" data-target="#modal_aprobar" id="<?php echo $matriculacion['IdDomicilio']?>" onclick="cagar_domicilio_aprobar(<?php echo $matriculacion['IdMatriculacion']?>,<?php echo $matriculacion['IdDomicilio']?>)">
							<img src="<?php echo base_url(); ?>/imagenes/aceptar.png" width="18" height="18" title="Aprobar">
						</button>
						
						<button style="margin-right:3px;background-color:#f0ad4e" type="button" class="btn btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_desaprobar" id="<?php echo $matriculacion['IdDomicilio']?>" onclick="cagar_domicilio_desaprobar(<?php echo $matriculacion['IdMatriculacion']?>,<?php echo $matriculacion['IdDomicilio']?>)">
							<img src="<?php echo base_url(); ?>/imagenes/cancelar.png" width="18" height="18" title="Desaprobar">
						</button>				
				  
					</div>				
			   
				</td>
			</tr>
			<?php }?>
		  </tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal_aprobar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Mensaje para el usuario</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<div class="form-group">						
				<div class="alert alert-success"  role="alert">					
					<div class="form-group">
						<h5>¡Atención!</h5>
						<div>Usted esta a punto de <b>APROBAR</b> el nuevo domicilio de <b><label id="nombre_abogado_aprobar"></label></b></div>						
					</div>
				</div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="aprobar_domicilio" method="post" enctype="multipart/form-data" id="formaprobardomicilio" name="formaprobardomicilio">
				    <input type="hidden" name="id_domicilio_aprobar" id="id_domicilio_aprobar" value="">				   
					<button type="submit" id="btn_aprobar_confirmado" class="btn btn-success">Aprobar</button>
				</form>				
				<button type="button" id="btn_cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_desaprobar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Mensaje para el usuario</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<div class="form-group">						
				<div class="alert alert-danger"  role="alert">					
					<div class="form-group">
						<h5>¡Atención!</h5>
						<div>¿Esta seguro que quiere desaprobar la solicitud de nuevo domicilio de <b><label id="nombre_abogado_desaprobar"></label></b>?</div>						
					</div>
				</div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="desaprobar_domicilio" method="post" enctype="multipart/form-data" id="formdesaprobardomicilio" name="formdesaprobardomicilio">
					<input type="hidden" name="id_domicilio_desaprobar" id="id_domicilio_desaprobar" value="">
					<button type="submit" id="btn_eliminar_domicilio" class="btn btn-danger">Desaprobar</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
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
				<div class="alert alert-danger"  role="alert">					
					<div class="form-group">
						<h5>¡Atención!</h5>
						<div>¿Esta seguro que quiere desaprobar la solicitud de nuevo domicilio de <b><label id="datos_matriculacion"></label></b>?</div>						
					</div>
				</div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="desaprobar_domicilio" method="post" enctype="multipart/form-data" id="formeliminar" name="formeliminar">
				    <input type="hidden" name="id_matri" id="id_matri" value="">
				    <input type="hidden" name="id_domicilio" id="id_domicilio" value="">
					<button type="submit" id="btn_eliminar_domicilio" class="btn btn-danger">Desaprobar</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_cargar_suspencion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Nueva suspención para <b><label style="color:red" id="datos_matriculacion_suspender"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<form action=""  method="post" enctype="multipart/form-data" name="formNuevaSuspencion" id="formNuevaSuspencion"> 				
				<input type="hidden" name="id_matricula_suspender" id="id_matricula_suspender" value="">					
				<div class="row form-group">
				  <div class="col-sm-6">
					<label>Fecha de Inicio</label>
					<input name="fechaInicio" id="fechaInicio" type="date" class="form-control" placeholder="Ingrese una Fecha de Inicio" value="<?php echo date('Y-m-d')?>" >							
				   </div>
				  <div class="col-sm-6">
					<label>Fecha de Culminación</label>
					<input name="fechaFin" id="fechaFin" type="date" class="form-control" placeholder="Ingrese una Fecha de Fin." value="" >						
				  </div>
				</div>
				
				<div class="row form-group">
					<div class="col-sm-12">
						<label>Motivo</label>
						<textarea name="motivo" id="motivo" type="text" rows="7" class="form-control" value=""></textarea>						
					</div>						    
				</div>				
						
						
				<div class="modal-footer">
					<button id="btn_enviar_suspencion" style="float:right;margin-right:0.5%" class="btn btn-primary" type="button">Guardar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>									
			</form>					
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_ver_movimientos_matricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Movimientos de matrícula de <b><label style="color:red" id="datos_matriculacion_movimientos"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">						
				<div id="lista_movimientos"></div>		
				<div class="modal-footer">				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>									
			</form>					
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_ver_matricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Ver Inscripción</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">						
			<div id="datos_matricula"></div>		
			<div class="modal-footer">				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_ver_domicilios_matricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 1150px !important;" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Domicilios de matrícula de <b><label style="color:red" id="datos_matriculacion_domicilios"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">						
			<div id="lista_domicilios"></div>						
		</div> 
	</div>
  </div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		
		$('#tabla-matriculaciones').stacktable();
		$('#tabla-matriculaciones').DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 0, "asc" ]],
			"paging": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});
		$('#btn_eliminar').click(function(){
			
			$('#modal_mensaje').modal('show'); 
			
		});			
		$('#btn_eliminar_confirmado').click(function(){
			
			$("#formeliminar").attr("action","desaprobar_matriculacion");	            
			$("#formeliminar").submit();
			
		});			
		$('#btn_enviar_suspencion').click(function(){
			
			$("#formNuevaSuspencion").attr("action","guardar_nueva_suspencion");	            
			$("#formNuevaSuspencion").submit();
			
		});			
					
	});	
	function cagar_matriculacion(obj,IdDomicilio){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matri').value = obj;
		document.getElementById('id_domicilio').value = IdDomicilio;
		document.getElementById('datos_matriculacion').innerHTML=(matriculacion);		
	
	}	
	function cagar_matricula(obj,IdDomicilio){
		
		var url = 'devolver_matricula_domicilio_completo_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			
			data:{idmatriculacion:obj,IdDomicilio:IdDomicilio,origen:2},
			success:function(rta){
				
				$('#datos_matricula').html(rta);					
				$('#modal_ver_matricula').modal('show');			
			}
		});
	
	}
	function cagar_movimientos(obj){
		
		var matriculacion = $("#desc_matriculacion"+obj).val();
		document.getElementById('datos_matriculacion_movimientos').innerHTML=(matriculacion);
		
		var url = 'devolver_movimiento_matricula_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			
			data:{idmatriculacion:obj},
			success:function(rta){
				
				$('#lista_movimientos').html(rta);					
				$('#modal_ver_movimientos_matricula').modal('show');
				
				$('#tabla_movimientos').stacktable();
				$('#tabla_movimientos').DataTable( {
					"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
					//"ordering": false,
					"order": [[ 0, "asc" ]],
					"paging": true,
					"language": {
						"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
					}		
				});
				
			}
		});
	
	}
	function cagar_domicilios(obj){
		
		var matriculacion = $("#desc_matriculacion"+obj).val();
		document.getElementById('datos_matriculacion_domicilios').innerHTML=(matriculacion);
		
		var url = 'devolver_domicilios_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			
			data:{idmatriculacion:obj},
			success:function(rta){
				
				$('#lista_domicilios').html(rta);					
				$('#modal_ver_domicilios_matricula').modal('show');
				
				$('#tabla_domicilios').stacktable();
				$('#tabla_domicilios').DataTable( {
					"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
					//"ordering": false,
					"order": [[ 7, "desc" ]],
					"paging": true,
					"language": {
						"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
					}		
				});
				
			}
		});
	
	}
	function cagar_suspencion(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_suspender').value = obj;
		document.getElementById('datos_matriculacion_suspender').innerHTML=(matriculacion);		
	
	}	
	function cagar_domicilio_aprobar(IdMatricula,IdDomicilio){		
		
		var matriculacion = $("#desc_matriculacion"+IdMatricula).val();		
		document.getElementById('id_domicilio_aprobar').value = IdDomicilio;
		document.getElementById('nombre_abogado_aprobar').innerHTML=(matriculacion);	
			
	}	
	function cagar_domicilio_desaprobar(IdMatricula,IdDomicilio){		
		
		var matriculacion = $("#desc_matriculacion"+IdMatricula).val();		
		document.getElementById('id_domicilio_desaprobar').value = IdDomicilio;
		document.getElementById('nombre_abogado_desaprobar').innerHTML=(matriculacion);	
		
	}	
	</script>
  </body>
</html>