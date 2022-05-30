<h5 style="color:#016887;padding-top:5px">Matriculados</h5>
<?php if($idPerfil_session == 6){?>
	<div class="container">
		<form action=""  method="post" enctype="multipart/form-data" name="formFiltroColegios" id="formFiltroColegios"> 
		  <div class="row">
		  
		  
			<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">		
									
				<select  style="margin-top:3px;margin-botom:3px" onclick="deshabilita_numerocuit()" name="desplegablecolegio" id="desplegablecolegio" class="form-control">
					<option value="0" selected>Seleccione un colegio</option>												
					  <?php foreach ($colegios as $colegio){ ?>						
													
							<?php if( $colegio['IdDepartamento'] == $colegio_actual){?>														
									<option selected value="<?php echo $colegio['IdDepartamento']?>"><?php echo strtoupper($colegio['NombreDepartamento'])?></option>
							<?php }else{?>
									<option  value="<?php echo $colegio['IdDepartamento']?>"><?php echo strtoupper($colegio['NombreDepartamento'])?></option>
							<?php }?>									  
													  
					  <?php }?>				
				</select>
				
			</div>	
		  
			<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">		
									
				<select  style="margin-top:3px;margin-botom:3px" onclick="deshabilita_numerocuit()" name="desplegableestadomatriculacion" id="desplegableestadomatriculacion" class="form-control">
					<option value="0" selected>Seleccione un estado</option>												
					  <?php foreach ($estados_matriculas as $estado){ ?>						
													
							<?php if( $estado['IdTiposEstadoMatricula'] == $estado_actual){?>														
									<option selected value="<?php echo $estado['IdTiposEstadoMatricula']?>"><?php echo $estado['NombreTipoEstado']?></option>
							<?php }else{?>
									<option  value="<?php echo $estado['IdTiposEstadoMatricula']?>"><?php echo $estado['NombreTipoEstado']?></option>
							<?php }?>									  
													  
					  <?php }?>				
				</select>
				
			</div>
			
			<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
			  <input  style="margin-top:3px;margin-botom:3px" onclick="deshabilita_filtro_colegio_y_estado()" type="text" class="form-control" id="numerocuit" name="numerocuit" placeholder="Número de Cuit">
			</div>	
		
			<div class="col-sm-12 col-md-12 col-lg-3 col-xl-2">
			  <button  style="margin-top:3px;margin-botom:3px" type="button" id="btn_buscar_matriculados" class="btn btn-primary">Buscar</button>
			</div>	
			
		  </div>
		</form>
		
	</div>
	
<?php }?>
<br>
<div class="card">
	<div class="card-body">
		<table id="tabla-matriculaciones" style="font-size:95%" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th >Apellido y Nombre</th>
			  <th >E-mail</th>
			  <th >Cuit</th>
			  <th >Teléfono</th>			 		
			  <th >Matriculación</th>			
			  <th >Localidad</th>			
			  <th >Domicilio</th>			
			  <th >Horarios</th>			
			  <th >Estado</th>			
			  <th style="width:12% !important">Acción</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($matriculaciones as $matriculacion){?>				  
			<tr>
				<input type="hidden" name="desc_matriculacion<?php echo $matriculacion['IdMatriculacion']?>" id="desc_matriculacion<?php echo $matriculacion['IdMatriculacion']?>" value="<?php echo $matriculacion['Apellido'].' '.$matriculacion['Nombre']?>">
				<input type="hidden" name="cuit<?php echo $matriculacion['IdMatriculacion']?>" id="cuit<?php echo $matriculacion['IdMatriculacion']?>" value="<?php echo $matriculacion['Cuit']?>">
				
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
				<td><?php echo $matriculacion['NombreLocalidad']?></td>							
				<td><?php echo $matriculacion['Calle'].' '.$matriculacion['Numero'].' '.$matriculacion['Piso'].' '.$matriculacion['Oficina']?></td>							
				<td><?php echo $matriculacion['HorariosAtencion']?></td>	
				<?php if($matriculacion['EstadoMatriculacion'] == 4){?>				
					<td style="color:red;text-align:center">
					<?php echo $matriculacion['NombreTipoEstado']?>
				
					<br>
					<button style="margin-right:3px;margin-top:3px" type="button" class="btn btn-outline-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_ver_sancion" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_sanciones(this.id)">
						<img src="<?php echo base_url(); ?>/imagenes/ver_negro.png" width="20" height="20" title="Ver Suspenciones">
					</button>
					
					</td>																		
				<?php }else{?>
					<td><?php echo $matriculacion['NombreTipoEstado']?></td>																		
				<?php }?>				
				<td>										
				
				<div class="form-inline">	
					<button style="margin-right:3px;margin-top:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_ver_movimientos_matricula" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_movimientos(this.id)">
						<img src="<?php echo base_url(); ?>/imagenes/ver.png" width="20" height="20" title="Ver Legajo">
					</button>					
					
					<button style="margin-right:3px;margin-top:3px" type="button" class="btn btn-warning btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_ver_domicilios_matricula" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_domicilios(this.id)">
						<img src="<?php echo base_url(); ?>/imagenes/oficina3.png" width="20" height="20" title="Ver Domicilios">
					</button>		
					
					<button style="margin-right:3px;margin-top:3px" type="button" class="btn btn-info btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_ver_sorteos_matricula" id="<?php echo $matriculacion['IdAbogado']?>" onclick="cagar_sorteos(this.id,<?php echo $matriculacion['IdMatriculacion']?>)">
						<img src="<?php echo base_url(); ?>/imagenes/sorteos.png" width="20" height="20" title="Ver Sorteos">
					</button>
					
					<form class="form-inline" action="reimprimir_comprobante_inscripcion" method="post" enctype="multipart/form-data" id="descargarpdf" name="descargarpdf">
						<input type="hidden" name="id_matriculacion" id="id_matriculacion" value="<?php echo $matriculacion['IdMatriculacion']?> ">
						<button style="margin-right:3px;margin-top:3px" type="submit" class="btn btn-secondary btn-sm">
							<img src="<?php echo base_url(); ?>/imagenes/impresora_blanca.png" width="20" height="20" title="Imprimir">
						</button>
					</form>
					
					<?php if($matriculacion['EstadoMatriculacion'] == 2){?>	
						<button style="margin-right:3px;margin-top:3px" type="button" class="btn btn-sm btn-success" href="#myModal" data-toggle="modal" data-target="#modal_mensaje_desahabilitar" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_matriculado_deshabilitar(this.id)">
						<img src="<?php echo base_url(); ?>/imagenes/candado_abierto_blanco.png" width="20" height="20" title="Habilitado">
						</button>
					<?php } else if(($matriculacion['EstadoMatriculacion'] == 4) or ($matriculacion['EstadoMatriculacion'] == 8)){?>
						<button style="margin-right:3px;margin-top:3px;background-color:#fd7e14" type="button" class="btn btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_mensaje_habilitar" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_matriculado_habilitar(this.id)">
						<img src="<?php echo base_url(); ?>/imagenes/cerrar_causa_blanco.png" width="20" height="20" title="Deshabilitado">
						</button>					
					<?php }?>
					
					<button style="margin-right:3px;margin-top:3px" type="button" class="btn btn-dark btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_cargar_sancion" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_matriculacion_sancion(this.id)">
					<img src="<?php echo base_url(); ?>/imagenes/martillo_blanco.png" width="20" height="20" title="Cargar suspención">
					</button>
					
					<button style="margin-right:3px;margin-top:3px;background-color:#53A494" type="button" class="btn btn-sm" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_matriculacion_resetear_contrasenia(this.id)">
					<img src="<?php echo base_url(); ?>/imagenes/icono_cambiar_contrasena_blanco.png" width="20" height="20" title="Resetear contraseña">
					</button>					
					
					<button style="margin-right:3px;margin-top:3px" type="button" class="btn btn-danger btn-sm" id="<?php echo $matriculacion['IdMatriculacion']?>" onclick="cagar_matriculacion(this.id)">
					<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="20" height="20" title="Eliminar">
					</button>							
				</div>	
								

			   </td>
			</tr>
			<?php }?>
		  </tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal_mensaje_desahabilitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
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
						<div>¿Esta seguro que quiere deshabilitar al Matriculado <b><label id="datos_matriculado_deshabilitar"></label></b>?</div>						
					</div>
				</div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="deshabilitar_matriculacion" method="post" enctype="multipart/form-data" id="formdeshabilitar" name="formdeshabilitar">								
				    <input type="hidden" name="id_matricula_deshabilitar" id="id_matricula_deshabilitar" value="">
					<button type="submit" id="btn_deshabilitar_confirmado" class="btn btn-danger">Deshabilitar</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_mensaje_habilitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<div class="form-group">						
				<div class="alert alert-success" role="alert">					
					<div class="form-group">					
						<div>¿Esta seguro que quiere habilitar al Matriculado <b><label id="datos_matriculado_habilitar"></label></b>?</div>						
					</div>
				</div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="habilitar_matriculacion" method="post" enctype="multipart/form-data" id="formhabilitar" name="formhabilitar">					
				    <input type="hidden" name="id_matricula_habilitar" id="id_matricula_habilitar" value="">
					<button type="submit" id="btn_habilitar_confirmado" class="btn btn-success">Habilitar</button>
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
						<div>¿Esta seguro que quiere eliminar de manera <b>PERMANENTE</b> la Matriculación <b><label id="datos_matriculacion"></label></b>?</div>						
					</div>
				</div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="eliminar_matriculacion" method="post" enctype="multipart/form-data" id="formeliminar" name="formeliminar">
					<input type="hidden" name="origen" id="origen" value="1">
				    <input type="hidden" name="id_matricula_eliminar" id="id_matricula_eliminar" value="">
					<button type="submit" id="btn_eliminar_confirmado" class="btn btn-danger">Eliminar</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_cargar_sancion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Nueva suspención para <b><label style="color:red" id="abogado_sancion"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<form action="" method="post" enctype="multipart/form-data" name="formNuevaSancion" id="formNuevaSancion"> 				
				<input type="hidden" name="id_matricula_sancion" id="id_matricula_sancion" value="">					
				<div class="row form-group">
				  <div class="col-sm-6">
					<label>Fecha de Inicio</label>
					<input name="fechaInicioSancion" id="fechaInicioSancion" type="date" class="form-control" placeholder="Ingrese una Fecha de Inicio" value="<?php echo date('Y-m-d')?>" >							
				   </div>
				  <div class="col-sm-6">
					<label>Fecha Fin</label>
					<input name="fechaFinSancion" id="fechaFinSancion" type="date" class="form-control" placeholder="Ingrese una Fecha de Fin." value="" >						
				  </div>
				</div>
				
				<div class="row form-group">
					<div class="col-sm-12">
						<label>Motivo</label>
						<textarea name="motivoSancion" id="motivoSancion" type="text" rows="7" class="form-control" value=""></textarea>						
					</div>						    
				</div>				
						
						
				<div class="modal-footer">
					<button id="btn_enviar_sancion" style="float:right;margin-right:0.5%" class="btn btn-primary" type="button">Guardar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>									
			</form>					
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
								
			<form action="" method="post" enctype="multipart/form-data" name="formNuevaSuspencion" id="formNuevaSuspencion"> 				
				<input type="hidden" name="id_matricula_suspender" id="id_matricula_suspender" value="">					
				<div class="row form-group">
				  <div class="col-sm-6">
					<label>Fecha de Inicio</label>
					<input name="fechaInicio" id="fechaInicio" type="date" class="form-control" placeholder="Ingrese una Fecha de Inicio" value="<?php echo date('Y-m-d')?>" >							
				   </div>
				  <div class="col-sm-6">
					<label>Fecha Fin</label>
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
  <div  class="modal-dialog modal-lg" style="max-width:950px" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Movimientos de matrícula de <b><label style="color:red" id="datos_matriculacion_movimientos"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">						
			<div id="lista_movimientos"></div>		
				<form action=""  method="post" enctype="multipart/form-data" name="formNuevoMovimiento" id="formNuevoMovimiento"> 				
					<input type="hidden" name="id_matricula_nuevo_movimiento" id="id_matricula_nuevo_movimiento" value="">					
					<input type="hidden" name="cuit_nuevo_movimiento" id="cuit_nuevo_movimiento" value="">					
					<?php if($idPerfil_session == 6){?>	
					<hr>
					<div class="row form-group">						
						<div class="col-sm-6">
							<label>Tipo de movimiento<sup style="font-weight:bold;color:red;font-size:13px">*</sup></label>
							<select name="tipo_movimiento" id="tipo_movimiento" class="form-control required" data-required="true">
								<option value="0">Seleccione un movimiento</option>												
								  <?php foreach ($estados_matriculas as $estado){ ?>					
										<option  value="<?php echo $estado['IdTiposEstadoMatricula']?>"><?php echo $estado['NombreTipoEstado']?></option>
								  <?php }?>				
							</select>
						</div>
						<div class="col-sm-6 invisible"></div>							
					</div>
					
					<div class="row form-group">
					  <div class="col-sm-6">
						<label>Fecha de Inicio<sup style="font-weight:bold;color:red;font-size:13px">*</sup></label>
						<input name="fechaInicioMovimiento" id="fechaInicioMovimiento" type="datetime-local" class="form-control" placeholder="Ingrese una Fecha de Inicio" min="<?php echo date('Y-m-d\TH:i')?>"  value="<?php echo date('Y-m-d\TH:i')?>" >							
						
					   </div>
					  <div class="col-sm-6">
						<label>Fecha Fin</label>
						<input name="fechaFinMovimiento" id="fechaFinMovimiento" type="datetime-local" class="form-control" placeholder="Ingrese una Fecha de Fin" min="<?php echo date('Y-m-d\TH:i')?>" value="" >						
					  </div>
					</div>
					
					<div class="row form-group">
						<div class="col-sm-12">
							<label>Motivo<sup style="font-weight:bold;color:red;font-size:13px">*</sup></label>
							<textarea name="motivoMovimiento" id="motivoMovimiento" type="text" rows="3" class="form-control" value=""></textarea>						
						</div>						    
					</div>					
					<label style="font-weight:bold;color:red;font-size:13px">* Campo obligatorio</label>	
					<?php }?>						
					<div class="modal-footer">
						<?php if($idPerfil_session == 6){?>	
						<button id="btn_enviar_movimiento" style="float:right;margin-right:0.5%" class="btn btn-primary" type="button">Guardar</button>
						<?php }?>	
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>									
				</form>	
								
								
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
<div class="modal fade" id="modal_ver_sorteos_matricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 1150px !important;" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Sorteo de <b><label style="color:red" id="datos_abogado_sorteos"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">						
			<div id="lista_sorteos"></div>						
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_ver_sancion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 1150px !important;" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Suspenciones de <b><label style="color:red" id="datos_abogado_sancion"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">						
			<div id="argumento_sancion"></div>						
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		</div>			
	</div>
  </div>
</div>
<div class="modal fade" id="modal_mensaje_no_se_puede_eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				<div id="mensaj_mensaje_no_se_puede_eliminar"></div>		
			</div>			
			
			<div class="modal-footer">						
				<button type="button" id="cerrar_modal_ver_ventas" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>		
			</div>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_mensaje_cambiar_contrasenia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
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
						<div>¿Esta seguro que quiere resetear la contraseña del matriculado <b><label id="mensaje_cambiar_contrasenia"></label></b>?</div>						
					</div>
				</div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="" method="post" enctype="multipart/form-data" id="formdeshabilitar" name="formdeshabilitar">								
				    <input type="hidden" name="cuit_resetear_contrasenia" id="cuit_resetear_contrasenia" value="">
					<button type="button" id="btn_resetear_confirmado" class="btn btn-danger">Resetear</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_mensaje_generico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<div class="form-group">						
								
					<div id="div_mensaje_generico" class="alert alert-danger" role="alert">					
						<label id="mensaje_generico"></label>						
					</div>
													
			</div>
						
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		
		var estado_actual = '<?php echo $estado_actual?>';
		
		if(estado_actual.length > 0){
			document.getElementById('numerocuit').disabled = true;
		}
			
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
		$('#btn_resetear_confirmado').click(function(){
			
			var cuit = $("#cuit_resetear_contrasenia").val();			
			var url = 'resetear_contrasenia_json';			
			
			$.ajax({
				type:"POST",					
				url:url,
				data:{cuit:cuit},
				success:function(rta){	
				
					$('#modal_mensaje_cambiar_contrasenia').modal('toggle');
					
					switch (parseInt(rta, 10)) {							

						  case 1:	
								$("#div_mensaje_generico").removeClass("alert-danger");
								$("#div_mensaje_generico").addClass("alert-success");						  
								$('#mensaje_generico').html('La contraseña se reseteo con éxito.Informe al profesional que debe utilizar el número de CUIT para ingresar.');
								break;
						  default:
								$("#div_mensaje_generico").removeClass("alert-success");
								$("#div_mensaje_generico").addClass("alert-danger");								
								$('#mensaje_generico').html('No se pudo resetear la contraseña.');																	
						}												
											
						$('#modal_mensaje_generico').modal('show');								
					
				}
			});	
			
		});		
		$('#btn_eliminar_confirmado').click(function(){
			
			$("#formeliminar").attr("action","eliminar_matriculacion");	            
			$("#formeliminar").submit();
			
		});			
		$('#btn_enviar_suspencion').click(function(){
			
			$("#formNuevaSuspencion").attr("action","guardar_nueva_suspencion");	            
			$("#formNuevaSuspencion").submit();
			
		});			
		$('#btn_enviar_sancion').click(function(){
			
			$("#formNuevaSancion").attr("action","guardar_nueva_sancion");	            
			$("#formNuevaSancion").submit();
			
		});		
		$('#btn_enviar_movimiento').click(function(){
			
			if(validarNuevaSuspencion()){
				
				$("#formNuevoMovimiento").attr("action","guardar_nuevo_movimiento");	            
				$("#formNuevoMovimiento").submit();
			}
			
		});	
		$('#btn_buscar_matriculados').on('click', function() {
			
			if(validaFiltro()){
				
				$("#formFiltroColegios").attr("action","matriculaciones");	            
				$("#formFiltroColegios").submit();	
				
			}
			
		});		
					
	});	
	function validaFiltro(){

		var validadoOK = true;
		
		var desplegablecolegio = $("#desplegablecolegio").val();
		var desplegableestadomatriculacion = $("#desplegableestadomatriculacion").val();
		
		var numerocuit = $("#numerocuit").val();	
			
		if($("#numerocuit").prop('disabled') == true){	
			
			if((desplegablecolegio == 0) || (desplegableestadomatriculacion == 0)){			
				
				if (desplegablecolegio == 0){agregaMensajeValidacion($("#desplegablecolegio"), "Debe seleccionar un colegio")};	
				if (desplegableestadomatriculacion == 0){agregaMensajeValidacion($("#desplegableestadomatriculacion"), "Debe seleccionar un estado")};	
								
				validadoOK = false;		
		
			}
		}
		
		if($("#numerocuit").prop('disabled') == false){			
				
			if(numerocuit.length == 0){
				
				agregaMensajeValidacion($("#numerocuit"), "Debe ingresar un número de cuit");
				
				validadoOK = false;	
			
			}					
			
		}
		return validadoOK;
		
	}
	function cagar_matriculado_deshabilitar(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_deshabilitar').value = obj;
		document.getElementById('datos_matriculado_deshabilitar').innerHTML=(matriculacion);		
	
	}	
	function cagar_matriculado_habilitar(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_habilitar').value = obj;
		document.getElementById('datos_matriculado_habilitar').innerHTML=(matriculacion);		
	
	}
	
	function cagar_matriculacion_resetear_contrasenia(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		var cuit = $("#cuit"+obj).val();		
		document.getElementById('cuit_resetear_contrasenia').value = cuit;
		document.getElementById('mensaje_cambiar_contrasenia').innerHTML=(matriculacion.toUpperCase());		
		$('#modal_mensaje_cambiar_contrasenia').modal('show');
		
	}
	
	function cagar_matriculacion(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_eliminar').value = obj;
		document.getElementById('datos_matriculacion').innerHTML=(matriculacion);	
		
		var url = 'verifica_posee_sorteos_json';
			console.log(obj);			
		$.ajax({
			type:"POST",					
			url:url,
			data:{matriculacion:obj},
			success:function(rta){	
			console.log(rta);
				switch (parseInt(rta, 10)) {
					
				  case 0:
						$('#mensaj_mensaje_no_se_puede_eliminar').html('El Abogado no puedo ser eliminado porque tiene sorteos a su nombre.');
						$('#modal_mensaje_no_se_puede_eliminar').modal('show');																		
						break;
				  case 1:
						$('#modal_mensaje').modal('show');										
						break;
				  default:
						$('#mensaj_mensaje_no_se_puede_eliminar').html('El Abogado no puedo ser eliminado porque tiene sorteos a su nombre.');	
						$('#modal_mensaje_no_se_puede_eliminar').modal('show');																		
				}
																
				
				
			}
		});			
	
	}	
	function cagar_matriculacion_sancion(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_sancion').value = obj;
		document.getElementById('abogado_sancion').innerHTML=(matriculacion);		
	
	}	
	function cagar_movimientos(obj){
		
		var matriculacion = $("#desc_matriculacion"+obj).val();
		var cuit = $("#cuit"+obj).val();
			
		document.getElementById('datos_matriculacion_movimientos').innerHTML=(matriculacion);
		document.getElementById('id_matricula_nuevo_movimiento').value = obj;
		document.getElementById('cuit_nuevo_movimiento').value = cuit;
		if ($('#tipo_movimiento').prop('visible')){
			document.getElementById('tipo_movimiento').value = 0;		
		}
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
					"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
					//"ordering": false,
					"order": [[ 0, "desc" ]],
					"paging": true,					
					"language": {
						"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
					}		
				});
				
			}
		});
	
	}
	function cagar_sanciones(obj){
		
		var matriculacion = $("#desc_matriculacion"+obj).val();
			
		document.getElementById('datos_abogado_sancion').innerHTML=(matriculacion);
		document.getElementById('id_matricula_nuevo_movimiento').value = obj;
	
		var url = 'devolver_sanciones_matricula_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			
			data:{idmatriculacion:obj},
			success:function(rta){
				
				$('#argumento_sancion').html(rta);					
				$('#modal_ver_sancion').modal('show');
		
				
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
	function cagar_sorteos(obj,IdMatriculacion){
		
		var matriculacion = $("#desc_matriculacion"+IdMatriculacion).val();
		document.getElementById('datos_abogado_sorteos').innerHTML=(matriculacion);
		
		var url = 'devolver_sorteos_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			
			data:{idabogado:obj},
			success:function(rta){
				
				$('#lista_sorteos').html(rta);					
				$('#modal_ver_sorteos_matricula').modal('show');
				
				$('#tabla_sorteos').stacktable();
				$('#tabla_sorteos').DataTable( {
					"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
					//"ordering": false,
					"order": [[ 0, "desc" ]],
					"paging": true,
					"language": {
						"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
					}		
				});
				
			}
		});
	
	}
	function deshabilita_numerocuit(){				
		
		document.getElementById('numerocuit').disabled = true;		
		document.getElementById('desplegablecolegio').disabled = false;		
		document.getElementById('desplegableestadomatriculacion').disabled = false;
		
		document.getElementById('numerocuit').value = '';		
			
	}	
	function deshabilita_filtro_colegio_y_estado(){	
			
		document.getElementById('desplegablecolegio').disabled = true;
		document.getElementById('desplegableestadomatriculacion').disabled = true;		
		document.getElementById('numerocuit').disabled = false;			
		
		document.getElementById('desplegablecolegio').value = 0;		
		document.getElementById('desplegableestadomatriculacion').value = 0;		
			
	}
	function cagar_suspencion(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_suspender').value = obj;
		document.getElementById('datos_matriculacion_suspender').innerHTML=(matriculacion);		
	
	}	
	</script>
  </body>
</html>