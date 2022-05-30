<h5 style="color:#016887;padding-top:5px">Novedades - Nuevas Solicitudes</h5>
<div class="card">
	<div class="card-body">
		<table id="tabla-matriculaciones" style="font-size:90%" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th scope="col" style='width:15%'>Apellido y Nombre</th>
			  <th scope="col">E-mail</th>
			  <th scope="col">Cuit</th>
			  <th scope="col">Teléfono</th>			 		
			  <th scope="col">Matriculación</th>			
			  <th scope="col">Domicilio</th>			
			  <th scope="col">Horarios</th>			
			 			
			  <th scope="col" style='width:12%'>Acción</th>
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
				echo ' <br>'.$matriculacion['NombreColegio'];
				?>
				</td>	
				<td><?php echo $matriculacion['Calle'].' '.$matriculacion['Numero'].' '.$matriculacion['Piso'].' '.$matriculacion['Oficina'].'<br>'.$matriculacion['NombreLocalidad']?></td>							
				<td><?php echo $matriculacion['HorariosAtencion']?></td>			<!--.' '.$matriculacion['NombreLocalidad']-->													
																				
				<td>										
				
					<div class="form-inline">
					
						<button style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_ver_matricula" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_matricula(this.id)">
							<img src="<?php echo base_url(); ?>/imagenes/ver.png" width="18" height="18" title="Ver Matriculación">
						</button>
				
						<button style="margin-right:3px" type="button" class="btn btn-success btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_aprobar" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_matriculacion_aprobar(this.id)">
							<img src="<?php echo base_url(); ?>/imagenes/aceptar.png" width="18" height="18" title="Aprobar">
						</button>
				
						<button style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_matriculacion_eliminar(this.id)">
							<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="18" height="18" title="Eliminar">
						</button>
						
						<form class="form-inline" action="reimprimir_comprobante_inscripcion" method="post" enctype="multipart/form-data" id="descargarpdf" name="descargarpdf">
							<input type="hidden" name="id_matriculacion" id="id_matriculacion" value="<?php echo $matriculacion['IdMatriculacion']?> ">
							<button style="margin-right:3px" type="submit" class="btn btn-secondary btn-sm">
								<img src="<?php echo base_url(); ?>/imagenes/impresora_blanca.png" width="18" height="18" title="Imprimir">
							</button>
						</form>						
										
					</div>
				  
			   </td>
			</tr>
			<?php }?>
		  </tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal_mensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
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
						<div>¿Esta seguro que quiere rechazar la solicitud de inscripción de <b><label id="datos_matriculacion_rechazar"></label></b>?</div>						
					</div>
				</div>										
			</div>
			<form class="" action="desaprobar_matriculacion" method="post" enctype="multipart/form-data" id="formrechazar" name="formrechazar">
				<input type="hidden" name="id_matricula_rechazar" id="id_matricula_rechazar" value="">
				<div class="row form-group">
					<div class="col-sm-12">
						<label>Motivo</label>
						<textarea name="motivo" id="motivo" type="text" rows="5" class="form-control" value=""></textarea>						
					</div>						    
				</div>				
				<div class="modal-footer">					
					<button type="submit" id="btn_rechazar_confirmado" class="btn btn-danger">Confirmar</button>					
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>	
				
			</form>				
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						<div>¿Esta seguro que quiere eliminar de manera <b>PERMANENTE</b> la Matriculación <b><label id="datos_matriculacion_eliminar"></label></b>?</div>						
					</div>
				</div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="eliminar_matriculacion" method="post" enctype="multipart/form-data" id="formeliminar" name="formeliminar">
				    <input type="hidden" name="origen" id="origen" value="2">
				    <input type="hidden" name="id_matricula_eliminar" id="id_matricula_eliminar" value="">
					<button type="submit" id="btn_eliminar_confirmado" class="btn btn-danger">Eliminar</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
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
							<div>Usted esta a punto de <b>APROBAR</b> la solicitud de matriculación de <b><label id="datos_matriculacion_aprobar"></label></b></div>						
						</div>
					</div>										
				</div>
							
				<div class="modal-footer">
					
					<input type="hidden" name="id_matriculacion_aprobar" id="id_matriculacion_aprobar" value="">															
					
					<button type="button" id="btn_aprobar_confirmado" class="btn btn-success">Aprobar</button>
					
					<button type="button" id="btn_cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				
				</div>									
								
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
 <div class="modal fade" id="modal_mensaje_aprobacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>		
		</div>			
		<div class="modal-body">		
								
			<div class="form-group">						
				<div  id="mensaje_abogado"></div>										
			</div>
						
			<div class="modal-footer">
				
				<button type="button" id="cerrar_modal_aceptar_ok" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				
			</div>									
							
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
		
		$('#btn_enviar_suspencion').click(function(){
			
			$("#formNuevaSuspencion").attr("action","guardar_nueva_suspencion");	            
			$("#formNuevaSuspencion").submit();
			
		});			
		$('#cerrar_modal_aceptar_ok').click(function(){
			
			location.reload();
			
		});			
					
	});	

	$('#btn_aprobar_confirmado').click(function(){		
				
		var id_matriculacion_aprobar = $('#id_matriculacion_aprobar').val();
														
		var url = 'aprobar_matricula_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			data:{id_matriculacion:id_matriculacion_aprobar},
			success:function(rta){				
				//console.log(rta);
				switch (parseInt(rta, 10)) {					
				 
				  case 1:
						$('#btn_cerrar').trigger("click");
						location.reload();
						
						//$('#mensaje_abogado').html('El profesional fue aprobado con éxito. Para ver sus movimientos, consulte la sección Matriculados.');						
						break;
				  default:
						$('#btn_cerrar').trigger("click");
						$('#mensaje_abogado').html('Ocurrió un problema en la aprobación. Por favor, póngase en contacto con el administrador.');
						$('#modal_mensaje_aprobacion').modal('show');						
																						
				}		
				//location.reload();					
				//$('#modal_mensaje_aprobacion').modal('show');
				
			}
		});		 							
	});		
	function cagar_matriculacion_rechazar(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_rechazar').value = obj;
		document.getElementById('datos_matriculacion_rechazar').innerHTML=(matriculacion);		
	
	}
	function cagar_matriculacion_eliminar(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_eliminar').value = obj;
		document.getElementById('datos_matriculacion_eliminar').innerHTML=(matriculacion);		
	
	}
	function cagar_matriculacion_aprobar(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matriculacion_aprobar').value = obj;
		document.getElementById('datos_matriculacion_aprobar').innerHTML=(matriculacion);		
	
	}
	function cagar_matricula(obj){
		
		var url = 'devolver_matricula_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			
			data:{idmatriculacion:obj,origen:1},
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
	</script>
  </body>
</html>