<h5 style="color:#016887;padding-top:5px">Movimientos de Causa <?php echo $consulta[0]['IdConsulta']?></h5>

<div class="container" style="font-size:90%">
		
	<div class="card">
	<h5 class="card-header bg-info" style="color:#FFFFFF">
	  <label>Causa</label>
	  
	  <?php if($consulta[0]['IdEstadoConsulta'] <> 8){?>
			<button style="float:right;margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_finalizar_causa" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_finalizar(this.id)">
				<img src="<?php echo base_url(); ?>/imagenes/cerrar_causa_blanco.png" width="20" height="20" title="Cerrar Causa">
			</button> 
			<button style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_comision_medica" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_agregar_comision_medica(this.id)">
				<img src="<?php echo base_url(); ?>/imagenes/cruz_blanca.png" width="20" height="20" title="Agregar Comisión Médica">
			</button>
	  <?php }else{?>
	  		<button disabled style="float:right;margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_finalizar_causa" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_finalizar(this.id)">
				<img src="<?php echo base_url(); ?>/imagenes/cerrar_causa_blanco.png" width="20" height="20" title="Cerrar Causa">
			</button> 
			<button disabled style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_comision_medica" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_agregar_comision_medica(this.id)">
				<img src="<?php echo base_url(); ?>/imagenes/cruz_blanca.png" width="20" height="20" title="Agregar Comisión Médica">
			</button>
	  
	  <?php }?>
	  
	  </h5>	

	  <div class="card-body">
		<label><strong>Apellido y Nombre: </strong> <?php echo $consulta[0]['Apellido'].' '.$consulta[0]['Nombre']?></label><br>
		<label><strong>Cuit: </strong> <?php echo $consulta[0]['Cuit']?></label><br>
		<label><strong>Teléfono: </strong> <?php echo $consulta[0]['Telefono']?></label><br>
		<label><strong>Celular: </strong> <?php echo $consulta[0]['Celular']?></label><br>
		<label><strong>E-mail: </strong> <?php echo $consulta[0]['Email']?></label><br>
		<label><strong>Fecha de sorteo: </strong> <?php echo date("d-m-Y H:i:s",strtotime($consulta[0]['FechaSorteo']))?></label><br>		
		<label><strong>Resumen: </strong> <?php echo $consulta[0]['Descripcion']?></label><br>
		<?php if($consulta[0]['IdEstadoConsulta'] <> 8){?>
			<label><strong>Estado actual: </strong> <?php echo $consulta[0]['NombreEstadoConsulta']?></label><br><br>
		<?php }else{?>
			<label style="color:red"><strong>Estado actual: </strong> <?php echo $consulta[0]['NombreEstadoConsulta']?></label><br><br>
		<?php }?>
		<label><strong>Comisión Médica: </strong> <?php if(!empty($consulta[0]['IdComisionMedica'])){ echo $consulta[0]['NombreComisionMedica'];}else echo 'Sin definir';?></label><br>
	  </div>
	</div>	
	<br>
	<div class="card">
		<br>	
		<table id="tabla-movimientos" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th style='width:25%'>Trámite</th>
			  <th style='width:20%'>Tipo de Movimiento</th>
			  <th style='width:30%'>Detalle</th>
			  <th>Fecha</th>
			  <th style='width:10%'>Acción</th>
			</tr>
		  </thead>
		  <tbody>
		
		<?php foreach ($movimientos as $movimiento){?>		  
			<tr>			
				<td><?php echo strtoupper($movimiento['Titulo'])?></td>											
				<td><?php echo $movimiento['NombreTipoMovimiento']?></td>											
				<td><?php echo $movimiento['Detalle']?></td>											
				<td>
					<span style="display:none"><?php if(!empty($movimiento['FechaMovimiento'])){echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']));}?></span> 
					<?php echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']))?>
				
				</td>											
																		
				<td>
					<div class="form-inline">
						
						<input type="hidden" name="visor_tramite<?php echo $movimiento['IdMovimientoConsulta']?>" id="visor_tramite<?php echo $movimiento['IdMovimientoConsulta']?>" value="<?php echo $movimiento['Titulo']?>">				 
						<input type="hidden" name="tipo_movimiento<?php echo $movimiento['IdMovimientoConsulta']?>" id="tipo_movimiento<?php echo $movimiento['IdMovimientoConsulta']?>" value="<?php echo $movimiento['NombreTipoMovimiento']?>">				 
						<input type="hidden" name="id_tipo_movimiento<?php echo $movimiento['IdMovimientoConsulta']?>" id="id_tipo_movimiento<?php echo $movimiento['IdMovimientoConsulta']?>" value="<?php echo $movimiento['IdTipoMovimiento']?>">				 
						<input type="hidden" name="visor_fecha<?php echo $movimiento['IdMovimientoConsulta']?>" id="visor_fecha<?php echo $movimiento['IdMovimientoConsulta']?>" value="<?php echo date("Y-m-d",strtotime($movimiento['FechaMovimiento']))?>">				 
						<input type="hidden" name="visor_fecha_eliminar<?php echo $movimiento['IdMovimientoConsulta']?>" id="visor_fecha_eliminar<?php echo $movimiento['IdMovimientoConsulta']?>" value="<?php echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']))?>">				 
						<input type="hidden" name="visor_detalle<?php echo $movimiento['IdMovimientoConsulta']?>" id="visor_detalle<?php echo $movimiento['IdMovimientoConsulta']?>" value="<?php echo $movimiento['Detalle']?>">				 
						<?php if($consulta[0]['IdEstadoConsulta'] <> 8){?>
							<button style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_movimiento" id="<?php echo $movimiento['IdMovimientoConsulta']?>" onclick="cargar_datos_movimiento_editar(this.id)">
								<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Editar">
							</button>					
						
							<button style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar_movimiento" id="<?php echo $movimiento['IdMovimientoConsulta']?>" onclick="cargar_datos_movimiento_eliminar(this.id)">
								<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="18" height="18" title="Eliminar">
							</button>
						<?php }else{?>
							<button disabled style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_movimiento" id="<?php echo $movimiento['IdMovimientoConsulta']?>" onclick="cargar_datos_movimiento_editar(this.id)">
								<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Editar">
							</button>					
						
							<button disabled  style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar_movimiento" id="<?php echo $movimiento['IdMovimientoConsulta']?>" onclick="cargar_datos_movimiento_eliminar(this.id)">
								<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="18" height="18" title="Eliminar">
							</button>
						<?php }?>
					</div>
				</td>				
			</tr>
			<?php }?>
		  </tbody>
		</table>
		<br>
	</div>
	<br>
	<?php if($consulta[0]['IdEstadoConsulta'] <> 8){?>
	<div class="card">
	 
		<h5 class="card-header bg-info" style="color:#FFFFFF">Agregar Movimiento</h5>
		<div class="card-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formnuevomovimiento" name="formnuevomovimiento">			
				<input type="hidden" name="id_consulta_guardar" id="id_consulta_guardar" value="<?php echo $consulta[0]['IdConsulta']?>">  
				
				<div class="row form-group">
					  <div class="col-sm-6">
					<label>Fecha</label>
					<input name="fecha_nuevo_movimiento" id="fecha_nuevo_movimiento" type="date" class="form-control required" value="<?php echo date('Y-m-d')?>">							
				  </div>
				  <div class="col-sm-6">
					<label>Tipo de Movimiento</label>
					<select class="form-control required" name="desplegable_tipo_movimiento" id="desplegable_tipo_movimiento" data-required="true">
						<option value="0">Seleccione un Tipo</option>												
						  <?php foreach ($tipos_movimientos as $movimiento){ ?>					
								<option  value="<?php echo $movimiento['IdTipoMovimiento']?>"><?php echo $movimiento['NombreTipoMovimiento']?></option>
						  <?php }?>
					</select>							
				  </div>
				</div>
								
				<div class="form-group">
					<label for="titulo">Trámite</label>
					<input class="form-control form-control-sm" type="text" name="titulo" id="titulo">
				</div>			
						
				<div class="form-group">
				
					<label for="observaciones">Descripción</label>
					<textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="6"></textarea>
					
				</div>
				<div class="modal-footer">
					<button type="button" id="guardarmovimiento" value="guardarmovimiento" class="btn btn-success btn-sm">Guardar</button>
					<button type="button" class="btn btn-primary btn-sm">Cancelar</button>
				</div>
			</form>			
		</div>
	</div>
	<br>
	<?php }?>
</div>
<div class="modal fade" id="modal_editar_movimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Editar de movimiento <b><label style="color:red" id="Id_datos_movimiento"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formeditarmovimiento" name="formeditarmovimiento">			
				<input type="hidden" name="id_consulta_editar_movimiento" id="id_consulta_editar_movimiento" value="<?php echo $consulta[0]['IdConsulta']?>">  
				<input type="hidden" name="id_movimiento_editar_movimiento" id="id_movimiento_editar_movimiento" value="">  
				
				<div class="row form-group">
				  <div class="col-sm-6">
					<label>Fecha</label>
					<input name="fecha_nuevo_movimiento_editar" id="fecha_nuevo_movimiento_editar" type="date" class="form-control required" value="">							
				  </div>
				  <div class="col-sm-6">
					<label>Tipo de Movimiento</label>
					<select class="form-control required" name="desplegable_tipo_movimiento_editar" id="desplegable_tipo_movimiento_editar" data-required="true">
						<option value="0">Seleccione un Tipo</option>												
						  <?php foreach ($tipos_movimientos as $movimiento){ ?>					
								<option  value="<?php echo $movimiento['IdTipoMovimiento']?>"><?php echo $movimiento['NombreTipoMovimiento']?></option>
						  <?php }?>
					</select>							
				  </div>
				</div>
								
				<div class="form-group">
					<label for="editar_titulo">Trámite</label>
					<input class="form-control form-control-sm" type="text" name="editar_titulo" id="editar_titulo">
				</div>			
						
				<div class="form-group">
				
					<label for="editar_descripcion">Descripción</label>
					<textarea class="form-control form-control-sm" name="editar_descripcion" id="editar_descripcion" rows="6"></textarea>
					
				</div>
				<div class="modal-footer">
					<button type="button" id="guardarmovimientoeditar" value="guardarmovimientoeditar" class="btn btn-success btn-sm">Guardar</button>
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>
				</div>
			</form>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_agregar_comision_medica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Agregar Comisión Médica</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
			<form class="" action="#" method="post" enctype="multipart/form-data" id="formComisionMedica" name="formComisionMedica">					
				<input type="hidden" name="id_consulta_guardar_comision_medica" id="id_consulta_guardar_comision_medica" value="">
				<div class="form-group">									
											
					<div class="form-group">
						<label for="titulo">Comisión Médica</label>
						<select class="form-control required" name="desplegable_comision_medica" id="desplegable_comision_medica" data-required="true">
							<option value="0">Seleccione una Comisión</option>												
							  <?php foreach ($comisiones as $comision){ ?>					
									<option  value="<?php echo $comision['IdComisionMedica']?>"><?php echo $comision['NombreComisionMedica']?></option>
							  <?php }?>
						</select>		
					</div>					
					
				</div>
						
				<div class="modal-footer">					
					<button type="button" id="btn_guardar_comision_medica" class="btn btn-success">Guardar</button>				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				</div>									
			</form>				
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_finalizar_causa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
			<form class="" action="finalizar_causa" method="post" enctype="multipart/form-data" id="formfinalizarcausa" name="formfinalizarcausa">					
				<input type="hidden" name="id_consulta_finalizar" id="id_consulta_finalizar" value="">
				<div class="form-group">						
									
					<div class="form-group">						
						<div style="color:red">¿Esta seguro que quiere <b>CERRAR</b> la causa <b><label id="numero_causa_finalizar"></label></b>?</div>						
					</div>
					
				</div>
						
				<div class="modal-footer">					
					<button type="submit" id="btn_finalizar" class="btn btn-danger">Cerrar</button>				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				</div>									
			</form>				
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_eliminar_movimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
			<form class="" action="#" method="post" enctype="multipart/form-data" id="formeliminarmovimiento" name="formeliminarmovimiento">					
				<input type="hidden" name="id_consulta_eliminar_movimiento" id="id_consulta_eliminar_movimiento" value="<?php echo $consulta[0]['IdConsulta']?>">  
				<input type="hidden" name="id_movimiento_eliminar_movimiento" id="id_movimiento_eliminar_movimiento" value="">  
				<div class="form-group">						
									
					<div class="form-group">						
						<div style="color:red">¿Esta seguro que quiere <b>ELIMINAR</b> el movimiento?</div>	<br>	
						
						<label id="titulo_ver_movimiento"></label><br>		
						<label id="tipo_movimiento_ver_movimiento"></label><br>		
						<label id="fecha_ver_movimiento"></label><br>		
						<label id="detalle_ver_movimiento"></label><br>						
					</div>
					
				</div>
						
				<div class="modal-footer">					
					<button type="button" id="btn_eliminar_movimiento" class="btn btn-danger">Eliminar</button>				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				</div>									
			</form>				
		</div> 
	</div>
  </div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		
		$('#tabla-movimientos').stacktable();
		$('#tabla-movimientos').DataTable( {
			"lengthMenu": [[25, 50, -1], [25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 1, "asc" ]],
			"paging": true,
			"info": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});
		
		$('#btn_guardar_comision_medica').click(function(){				
			
			if(validarComisionMedica()){			  
				$("#formComisionMedica").attr("action","guardar_comision_medica");	            
				$("#formComisionMedica").submit();	
			}
			
		});			
		$('#btn_eliminar_movimiento').click(function(){				
			
					  
			$("#formeliminarmovimiento").attr("action","eliminar_movimiento");	            
			$("#formeliminarmovimiento").submit();	
		
			
		});			
		$('#guardarmovimientoeditar').click(function(){				
			
			if(validarEditarMovimiento()){			  
				$("#formeditarmovimiento").attr("action","guardar_editar_movimiento");	            
				$("#formeditarmovimiento").submit();	
			}
			
		});	
		$('#guardarmovimiento').click(function(){				
			
			if(validarMovimiento()){			  
				$("#formnuevomovimiento").attr("action","guardar_movimiento_consulta");	            
				$("#formnuevomovimiento").submit();	
			}
			
		});				
					
	});
	function cargar_datos_movimiento_editar(obj){
		
		$(".estilos-errores").remove();
		var tramite = $("#visor_tramite"+obj).val();	
		var tipo_movimiento = $("#id_tipo_movimiento"+obj).val();	
		var fecha = $("#visor_fecha"+obj).val();	
		var detalle = $("#visor_detalle"+obj).val();
		
		document.getElementById('id_movimiento_editar_movimiento').value = obj;
		document.getElementById('fecha_nuevo_movimiento_editar').value = fecha;		
		document.getElementById('desplegable_tipo_movimiento_editar').value = tipo_movimiento;
		document.getElementById('editar_titulo').value = tramite;		
		document.getElementById('editar_descripcion').value = detalle;
		
	}	
	function cargar_datos_movimiento_eliminar(obj){
		
		var tramite = $("#visor_tramite"+obj).val();	
		var tipo_movimiento = $("#tipo_movimiento"+obj).val();	
		var fecha = $("#visor_fecha_eliminar"+obj).val();	
		var detalle = $("#visor_detalle"+obj).val();
		
		document.getElementById('id_movimiento_eliminar_movimiento').value = obj;
		document.getElementById('titulo_ver_movimiento').innerHTML=("<strong>Título: </strong>" + tramite);
		document.getElementById('tipo_movimiento_ver_movimiento').innerHTML=("<strong>Tipo de Movimiento: </strong>" + tipo_movimiento);
		document.getElementById('fecha_ver_movimiento').innerHTML=("<strong>Fecha: </strong>" + fecha);
		document.getElementById('detalle_ver_movimiento').innerHTML=("<strong>Descripción: </strong>" + detalle);
	}
	function cagar_datos_finalizar(obj){	
			
		document.getElementById('id_consulta_finalizar').value = obj;
		document.getElementById('numero_causa_finalizar').innerHTML=(obj);		
	
	}	
	function cagar_datos_agregar_comision_medica(obj){	
			
		document.getElementById('id_consulta_guardar_comision_medica').value = obj;		
	
	}
	</script>
  </body>
</html>