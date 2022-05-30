<br><div class="col-12" style="font-size:90%">
		<div class="row">
    <div class="col-8">
		<div class="card">
			<h5 class="card-header bg-info" style="color:#FFFFFF;padding-top:1%;padding-bottom:1%;text-align:justify">
			  <label>Detalles del caso</label>
			  <!--
			  <?php //if($consulta[0]['IdEstadoConsulta'] <> 8){?>
					<button style="float:right;margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_finalizar_causa" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_finalizar(this.id)">
						<img src="<?php //echo base_url(); ?>/imagenes/cerrar_causa_blanco.png" width="20" height="20" title="Cerrar Causa">
					</button> 
					<button style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_comision_medica" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_agregar_comision_medica(this.id)">
						<img src="<?php //echo base_url(); ?>/imagenes/cruz_blanca.png" width="20" height="20" title="Agregar Comisión Médica">
					</button>
			  <?php //}else{?>
					<button disabled style="float:right;margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_finalizar_causa" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_finalizar(this.id)">
						<img src="<?php //echo base_url(); ?>/imagenes/cerrar_causa_blanco.png" width="20" height="20" title="Cerrar Causa">
					</button> 
					<button disabled style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_comision_medica" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_agregar_comision_medica(this.id)">
						<img src="<?php //echo base_url(); ?>/imagenes/cruz_blanca.png" width="20" height="20" title="Agregar Comisión Médica">
					</button>
			  
			  <?php //}?>
			  -->
			  </h5>	

			  <div class="card-body">
				
				<label><strong>Número de sorteo: </strong> <?php echo $consulta[0]['IdConsulta']?></label><br>	
				<label><strong>Fecha de sorteo: </strong> <?php echo date("d-m-Y H:i:s",strtotime($consulta[0]['FechaSorteo']))?></label><br>		
					
				<label><strong>Resumen: </strong> <?php echo $consulta[0]['Descripcion']?></label><br>
				<?php if($consulta[0]['IdEstadoConsulta'] <> 8){?>
					<label><strong>Estado actual: </strong> <?php echo $consulta[0]['NombreEstadoConsulta']?></label><br><br>
				<?php }else{?>
					<label style="color:red"><strong>Estado actual: </strong> <?php echo $consulta[0]['NombreEstadoConsulta']?></label><br><br>
				<?php }?>
				<label><strong>Comisión Médica: </strong> <?php if(!empty($consulta[0]['IdComisionMedica'])){ echo $consulta[0]['NombreComisionMedica'];}else echo 'Sin definir';?></label><br>
			  </div>
			  	<div class="modal-footer">
					<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
					
					<button style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_comision_medica" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_agregar_comision_medica(this.id)">Agregar comisión médica</button>
					<button type="button" class="btn btn-danger btn-sm">Finalizar caso</button>
					<!--<button type="button" class="btn btn-success btn-sm">Guardar cambios</button>-->
				</div>
		</div>
		
		<div class="accordion" id="accordionExample">
		  <div class="card">
			<div class="card-header bg-info" style="padding-top:0px;padding-bottom:0px !important" id="headingOne">
			  <h2 class="mb-0">
				<button style="color:#FFFFFF !important"  class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					GESTION ADMINISTRATIVA
				</button>
			  </h2>
			</div>

			<div id="collapseOne" class="collapse    " aria-labelledby="headingOne" data-parent="#accordionExample">
			  <div class="card-body">

				<form>
				  <fieldset>
					<h4>Reclamo administrativo</h4>
					<div class="row">
						<div class="col">
						 	<label>Tipo de trámite</label>
							<select name="tipoconsulta" id="tipoconsulta" class="form-control required" data-required="true">
								<option value="0">Seleccione un tipo de trámite</option>												
									<?php foreach ($tiposconsulta as $tipos){ ?>					
											<option  value="<?php echo $tipos['IdTipoConsulta']?>"><?php echo $tipos['NombreTipoConsulta']?></option>
									<?php }?>				
							</select>
						</div>
						<div class="col">
							<div class="form-group">
							  <label for="disabledTextInput">Fecha incidente</label>
							  <input type="date" id="disabledTextInput" class="form-control">
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col">
							<div class="form-group">
							  <label for="disabledTextInput">Fecha sorteo</label>
							  <input type="date" id="disabledTextInput" class="form-control">
							</div>
						</div>
						<div class="col">
						  <div class="form-group">
							  <label for="disabledTextInput">Fecha entrevista c/trabajador</label>
							  <input type="date" id="disabledTextInput" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
						  <div class="form-group">
							  <label for="disabledTextInput">Fecha audiencia c/aseguradora</label>
							  <input type="date" id="disabledTextInput" class="form-control">
							</div>
						</div>
						<div class="col">

						</div>
					</div>									
					<hr/>
					<h4>Datos complementarios</h4>
					<div class="row">
						<div class="col">
						  <div class="form-group">
							  <label for="disabledTextInput">Fecha inicio del trámite</label>
							  <input type="date" id="disabledTextInput" class="form-control">
							</div>
						</div>
						<div class="col">
						  <div class="form-group">
							  <label for="disabledTextInput">Número de expedinete</label>
							  <input type="text" id="disabledTextInput" class="form-control">
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col">
						  <div class="form-group">
							  <label for="disabledTextInput">Fecha de audiencia médica</label>
							  <input type="date" id="disabledTextInput" class="form-control">
							</div>
						</div>
						<div class="col">
						  
						</div>
					</div>
					<hr/>					
					<div class="row">
						<div class="col">
							<div class="form-group">
							  <label>Solicitud de estudios médicos complementarios</label>							 
							</div>							
						</div>
						<div class="col">
						  	<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="solicitud_de_estudios_médicos_complementarios_si" name="solicitud_de_estudios_médicos_complementarios" class="custom-control-input" value="1">
							  <label class="custom-control-label" for="solicitud_de_estudios_médicos_complementarios_si">Si</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="solicitud_de_estudios_médicos_complementarios_no" name="solicitud_de_estudios_médicos_complementarios" class="custom-control-input" value="2">
							  <label class="custom-control-label" for="solicitud_de_estudios_médicos_complementarios_no">No</label>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col">
							<div class="form-group">
							  <label>Solicitud de documentacion complementaria</label>							 
							</div>							
						</div>
						<div class="col">
						  	<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="solicitud_de_documentacion_complementaria_si" name="solicitud_de_documentacion_complementaria" class="custom-control-input" value="1">
							  <label class="custom-control-label" for="solicitud_de_documentacion_complementaria_si">Si</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="solicitud_de_documentacion_complementaria_no" name="solicitud_de_documentacion_complementaria" class="custom-control-input" value="2">
							  <label class="custom-control-label" for="solicitud_de_documentacion_complementaria_no">No</label>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col">
							<div class="form-group">
							  <label>Solicitud de prorroga</label>							 
							</div>							
						</div>
						<div class="col">
						  	<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="solicitud_de_prorroga_si" name="solicitud_de_prorroga" class="custom-control-input" value="1">
							  <label class="custom-control-label" for="solicitud_de_prorroga_si">Si</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="solicitud_de_prorroga_no" name="solicitud_de_prorroga" class="custom-control-input" value="2">
							  <label class="custom-control-label" for="solicitud_de_prorroga_no">No</label>
							</div>
						</div>
					</div>
					<hr/>					
					<div class="row">
						<div class="col">
							<div class="form-group">
							  <label>Planteó alegato</label>							 
							</div>							
						</div>
						<div class="col">
						  	<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="planteo_alegato_si" name="planteo_alegato" class="custom-control-input" value="1">
							  <label class="custom-control-label" for="planteo_alegato_si">Si</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="planteo_alegato_no" name="planteo_alegato" class="custom-control-input" value="2">
							  <label class="custom-control-label" for="planteo_alegato_no">No</label>
							</div>
						</div>
					</div>
					<hr/>
					<h4>Finalización de trámite</h4>
					<div class="row">
						
						<div class="col">
						  	<label>Motivo de finalización de trámite</label>
							<!--
							<select class="form-control required" name="desplegable_tipo_movimiento" id="desplegable_tipo_movimiento" data-required="true">
								<option value="0">Seleccione un motivo de finalización</option>																
								  <?php //foreach ($motivos_fin_tramite as $motivo){ ?>					
										<option value="<?php //echo $motivo['IdMotivoFinalizacion']?>"><?php //echo $motivo['NombreMotivoFinalizacion']?></option>
								  <?php //}?>
							</select>
							-->
							 <select class="form-control required" name="desplegable_tipo_movimiento" id="desplegable_tipo_movimiento" data-required="true" disabled>
								<option value="0">Seleccione un motivo de finalización</option>
							 </select>
						<label style="color:red">*Este campo se habilita cuando selecciona un tipo de trámite</label>							 
						</div>
						
						<div class="col">
					
						</div>
					</div>
					<br>
					<div id="div_resultado_de_la_audiencia" style="display:none">
						<div class="row">
							<div class="col">
							  <div class="form-group">
								  <label for="disabledTextInput">Fecha de audiencia</label>
								  <input type="date" id="disabledTextInput" class="form-control">
								</div>
							</div>
							<div class="col">
							  
							</div>
						</div>
				
						<hr/>
						<div class="row">
							<div class="col">
								<div class="form-group">
								  <label>Resultado de la audiencia</label>							 
								</div>							
							</div>
							<div class="col">
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="resultado_de_la_audiencia_con_acuerdo_si" name="resultado_de_la_audiencia_con_acuerdo" class="custom-control-input" value="1">
								  <label class="custom-control-label" for="resultado_de_la_audiencia_con_acuerdo_si">Con acuerdo</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="resultado_de_la_audiencia_con_acuerdo_no" name="resultado_de_la_audiencia_con_acuerdo" class="custom-control-input" value="2">
								  <label class="custom-control-label" for="resultado_de_la_audiencia_con_acuerdo_no">Sin  acuerdo</label>
								</div>
							</div>
						</div>
						
						<div id="div_apelo_camara_revisora_padre" style="display:none">
							<hr/>
							<div class="row">
								<div class="col">
									<div class="form-group">
									  <label>Apelo a la cámara revisora</label>							 
									</div>							
								</div>
								<div class="col">
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="apelo_a_la_camara_revisora_si" name="apelo_a_la_camara_revisora" class="custom-control-input" value="1">
									  <label class="custom-control-label" for="apelo_a_la_camara_revisora_si">Si</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="apelo_a_la_camara_revisora_no" name="apelo_a_la_camara_revisora" class="custom-control-input" value="2">
									  <label class="custom-control-label" for="apelo_a_la_camara_revisora_no">No</label>
									</div>
								</div>
							</div>
							<div id="div_apelo_camara_revisora" style="display:none">
								<hr/>
								<h4>Apelación en cámara revisora</h4>
								<div class="row">
									<div class="col">
									  <div class="form-group">
										  <label for="disabledTextInput">Fecha de apelación</label>
										  <input type="date" id="disabledTextInput" class="form-control">
										</div>
									</div>
									<div class="col">
									 
									</div>
								</div>
							
								<div class="row">
									<div class="col">
										<div class="form-group">
										  <label>Finalización</label>							 
										</div>							
									</div>
									<div class="col">
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" id="finalizacion_camara_revisora_si" name="finalizacion_camara_revisora" class="custom-control-input" value="1">
										  <label class="custom-control-label" for="finalizacion_camara_revisora_si">Con acuerdo</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" id="finalizacion_camara_revisora_no" name="finalizacion_camara_revisora" class="custom-control-input" value="2">
										  <label class="custom-control-label" for="finalizacion_camara_revisora_no">Sin acuerdo</label>
										</div>
									</div>
								</div>
								<div id="div_tabla_movimientos_finalizacion_camara_revisora" style="display:none">
									<h4>Movimientos de apelación en cámara revisora</h4>
									<div class="card">
										<br>
										<table id="tabla_movimientos_finalizacion_camara_revisora" class="table table-striped table-sm">
										  <thead>
											<tr>
											  <th>Fecha</th>								 
											  <th>Descripción</th>								
											  <th>Acción</th>
											</tr>
										  </thead>
										  <tbody>
										
										<?php foreach ($movimientos as $movimiento){?>		  
											<tr>	
												<td>
													<span style="display:none"><?php if(!empty($movimiento['FechaMovimiento'])){echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']));}?></span> 
													<?php echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']))?>
												
												</td>						
																							
												<td><?php echo $movimiento['Detalle']?></td>											
																				
																										
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
									<button type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_movimiento_en_camara_revisora">Agregar movimiento</button>
									<br>	
								</div>	
												
									
							</div>
						</div>
					</div>			
				
				  </fieldset>
				   <div class="modal-footer">
					<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
					<!--<button type="button" class="btn btn-danger">Finalizar caso</button>-->
					<!--<button type="button" class="btn btn-success btn-sm">Guardar cambios</button>-->
				  </div>
				</form>
				
			  </div>
			</div>
		  </div>
		  
		  <div class="card">
			<div class="card-header bg-info" style="padding-top:0px;padding-bottom:0px !important" id="headingTwo">
			  <h2 class="mb-0">
				<button style="color:#FFFFFF !important" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				  GESTION JUDICIAL
				</button>
			  </h2>
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
			  <div class="card-body">
					<form>
				  <fieldset>
					<h4>Apelación justicia ordinaria</h4>
					<div class="row">
						<div class="col">
							<div class="form-group">
							  <label>Apelo a la justicia ordinaria</label>							 
							</div>							
						</div>
						<div class="col">
						  	<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="apelo_a_la_justicia_ordinaria_si" name="apelo_a_la_justicia_ordinaria" class="custom-control-input" value="1">
							  <label class="custom-control-label" for="apelo_a_la_justicia_ordinaria_si">Si</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="apelo_a_la_justicia_ordinaria_no" name="apelo_a_la_justicia_ordinaria" class="custom-control-input" value="2">
							  <label class="custom-control-label" for="apelo_a_la_justicia_ordinaria_no">No</label>
							</div>
						</div>
					</div>
					<div id="div_apelo_a_la_justicia_ordinaria" style="display:none">
						<hr/>
							
						<div class="row">
							<div class="col">
							  <div class="form-group">
								  <label for="disabledTextInput">Fecha de apelación</label>
								  <input type="date" id="disabledTextInput" class="form-control">
								</div>
							</div>
							<div class="col">
							  <div class="form-group">
								  <label for="disabledTextInput">Juzgado</label>
								  <input type="text" id="disabledTextInput" class="form-control">
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col">
							  <div class="form-group">
								  <label for="disabledTextInput">Número de expedinete</label>
								  <input type="text" id="disabledTextInput" class="form-control">
								</div>
							</div>
							<div class="col">
							  
							</div>
						</div>
						<hr/>
						<h4>Movimientos de la apelación</h4>
						<div class="card">
							<br>	
							<table id="tabla_movimientos_apelacion_justicia_ordinaria" class="table table-striped table-sm">
							  <thead>
								<tr>
								  <th>Fecha</th>								 
								  <th>Descripción</th>								 
								  <th>Acción</th>
								</tr>
							  </thead>
							  <tbody>
							
							<?php foreach ($movimientos as $movimiento){?>		  
								<tr>	
									<td>
										<span style="display:none"><?php if(!empty($movimiento['FechaMovimiento'])){echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']));}?></span> 
										<?php echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']))?>
									
									</td>								
											
									<td><?php echo $movimiento['Detalle']?></td>											
											
																							
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
						<button type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_movimiento_en_apelacion">Agregar movimiento</button>
						<hr/>
						<!------------------------------------------------------------------------------------------------------->
									
						<h4>Resultado</h4>
						<div class="row">
							<div class="col">
							  <div class="form-group">
								  <label for="disabledTextInput">Fecha de sentencia</label>
								  <input type="date" id="disabledTextInput" class="form-control">
								</div>
							</div>
							<div class="col">
							  
							</div>
						</div>
						
						<div class="row">
							<div class="col">
								<div class="form-group">
								  <label>Resultado</label>							 
								</div>							
							</div>
							<div class="col">
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="resultado_del_acuerdo_si" name="resultado_del_acuerdo" class="custom-control-input" value="1">
								  <label class="custom-control-label" for="resultado_del_acuerdo_si">Acuerdo</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="resultado_del_acuerdo_no" name="resultado_del_acuerdo" class="custom-control-input" value="2">
								  <label class="custom-control-label" for="resultado_del_acuerdo_no">No acuerdo</label>
								</div>
							</div>
						</div>
						<div id="div_resultado_del_acuerdo" style="display:none">
							<hr/>
							<h4>Recurso de apelación</h4>
							<div class="row">
								<div class="col">
								  <div class="form-group">
									  <label for="disabledTextInput">Fecha del recurso</label>
									  <input type="date" id="disabledTextInput" class="form-control">
									</div>
								</div>
								<div class="col">
									
								</div>
							</div>		
						   
						   <div class="form-group">
								<label for="exampleFormControlTextarea1">Resultado</label>
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
							</div>								
							
						</div>					
							
					</div>
				  </fieldset>
			
				</form>
			  </div>
			</div>
		  </div>

		</div>
	</div>
    <div class="col-4">
		<div class="card">
			<h5 class="card-header bg-info" style="padding-top:2.5%;padding-bottom:1%;color:#FFFFFF !important">
			  <label>DATOS DEL TRABAJADOR</label>
 
					<button style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_trabajador" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_agregar_comision_medica(this.id)">
						<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="20" height="20" title="Editar datos del trabajador">
					</button>
			  
			  
			  </h5>	

			  <div class="card-body">
				<label><strong>Apellido y Nombre: </strong> <?php echo $consulta[0]['Apellido'].' '.$consulta[0]['Nombre']?></label><br>
				<label><strong>Cuit: </strong> <?php echo $consulta[0]['Cuit']?></label><br>
				<label><strong>Teléfono: </strong> <?php echo $consulta[0]['Telefono']?></label><br>
				<label><strong>Celular: </strong> <?php echo $consulta[0]['Celular']?></label><br>
				<label><strong>E-mail: </strong> <?php echo $consulta[0]['Email']?></label><br>
				
			  </div>
		</div>
		<br>
		<div class="card">
			<h5 class="card-header bg-info" style="padding-top:2.5%;padding-bottom:1%;color:#FFFFFF;text-align: justify !important">
			  <label>DATOS DEL EMPLEADOR</label>
 
					<button style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_empleador" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_agregar_comision_medica(this.id)">
						<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="20" height="20" title="Editar datos del empleador">
					</button>
			  
			  
			  </h5>	

			  <div class="card-body">
				<label><strong>Razón social: </strong> <?php echo 'Lazaro Baez';?></label><br>
				<label><strong>Cuit: </strong> <?php echo '201503214565';?></label><br>
				<label><strong>Teléfono: </strong> <?php echo '456-8888';//echo $consulta[0]['Telefono']?></label><br>
				<label><strong>Celular: </strong> <?php echo'156-99999';//echo $consulta[0]['Celular']?></label><br>
				<label><strong>E-mail: </strong> <?php echo 'lazaro@gmail.com';//echo $consulta[0]['Email']?></label><br>
				
			  </div>
		</div>
	</div>
  </div>
 
	<br>	
</div>
<div class="modal fade" id="modal_agregar_movimiento_en_camara_revisora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Agregar movimiento en cámara revisora</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formnuevomovimiento" name="formnuevomovimiento">			
				<input type="hidden" name="id_consulta_guardar" id="id_consulta_guardar" value="<?php echo $consulta[0]['IdConsulta']?>">  
				
				<div class="row form-group">
					<div class="col-sm-6">
						<label>Fecha</label>
						<input name="fecha_nuevo_movimiento" id="fecha_nuevo_movimiento" type="date" class="form-control required" value="<?php echo date('Y-m-d')?>">							
					</div>
			
				</div>						
						
				<div class="form-group">
				
					<label for="observaciones">Descripción</label>
					<textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="6"></textarea>
					
				</div>
				<div class="modal-footer">
					<button type="button" id="guardarmovimiento" value="guardarmovimiento" class="btn btn-success btn-sm">Guardar</button>
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
				</div>
			</form>										
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_agregar_movimiento_en_apelacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Agregar movimiento de apelación en justicia ordinaria</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formnuevomovimiento" name="formnuevomovimiento">			
				<input type="hidden" name="id_consulta_guardar" id="id_consulta_guardar" value="<?php echo $consulta[0]['IdConsulta']?>">  
				
				<div class="row form-group">
					<div class="col-sm-6">
						<label>Fecha</label>
						<input name="fecha_nuevo_movimiento" id="fecha_nuevo_movimiento" type="date" class="form-control required" value="<?php echo date('Y-m-d')?>">							
					</div>
			
				</div>						
						
				<div class="form-group">
				
					<label for="observaciones">Descripción</label>
					<textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="6"></textarea>
					
				</div>
				<div class="modal-footer">
					<button type="button" id="guardarmovimiento" value="guardarmovimiento" class="btn btn-success btn-sm">Guardar</button>
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
				</div>
			</form>										
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_agregar_movimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Agregar de movimiento </h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formnuevomovimiento" name="formnuevomovimiento">			
				<input type="hidden" name="id_consulta_guardar" id="id_consulta_guardar" value="<?php echo $consulta[0]['IdConsulta']?>">  
				
				<div class="row form-group">
					  <div class="col-sm-6">
					<label>Fecha</label>
					<input name="fecha_nuevo_movimiento" id="fecha_nuevo_movimiento" type="date" class="form-control required" value="<?php echo date('Y-m-d')?>">							
				  </div>
				  <div class="col-sm-6">
					<label>Tipo de Movimiento</label>
					<select class="form-control required" name="desplegable_tipo_movimiento_1" id="desplegable_tipo_movimiento_1" data-required="true">
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
  </div>
</div>
<div class="modal fade" id="modal_editar_trabajador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Editar datos del trabajador</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formeditarTrabajador" name="formeditarTrabajador">			
				<input type="hidden" name="id_consulta_editar_trabajador" id="id_consulta_editar_trabajador" value="<?php echo $consulta[0]['IdConsulta']?>">  
															
				<div class="form-group">
					<label for="editar_titulo">Apellido y nombre</label>
					<input class="form-control form-control-sm" type="text" name="editar_apellido_y_nombre" id="editar_apellido_y_nombre">
				</div>		
				
				<div class="form-group">
					<label for="editar_titulo">Cuit</label>
					<input class="form-control form-control-sm" type="text" name="editar_cuit" id="editar_cuit">
				</div>		
				
				<div class="form-group">
					<label for="editar_titulo">Teléfono</label>
					<input class="form-control form-control-sm" type="text" name="editar_telefono" id="editar_telefono">
				</div>	
				
				<div class="form-group">
					<label for="editar_titulo">Celular</label>
					<input class="form-control form-control-sm" type="text" name="editar_telefono_celular" id="editar_telefono_celular">
				</div>		
				
				<div class="form-group">
					<label for="editar_titulo">E-mail</label>
					<input class="form-control form-control-sm" type="text" name="editar_email" id="editar_email">
				</div>			
						

				<div class="modal-footer">
					<button type="button" id="guardareditartrabajador" value="guardareditartrabajador" class="btn btn-success btn-sm">Guardar</button>
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>
				</div>
			</form>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_editar_empleador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Editar datos del empleador</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formeditarTrabajador" name="formeditarTrabajador">			
				<input type="hidden" name="id_consulta_editar_trabajador" id="id_consulta_editar_trabajador" value="<?php echo $consulta[0]['IdConsulta']?>">  
															
				<div class="form-group">
					<label for="editar_titulo">Razón social</label>
					<input class="form-control form-control-sm" type="text" name="editar_razon_social" id="editar_razon_social">
				</div>		
				
				<div class="form-group">
					<label for="editar_titulo">Cuit</label>
					<input class="form-control form-control-sm" type="text" name="editar_cuit_empleador" id="editar_cuit_empleador">
				</div>		
				
				<div class="form-group">
					<label for="editar_titulo">Teléfono</label>
					<input class="form-control form-control-sm" type="text" name="editar_telefono_empleador" id="editar_telefono_empleador">
				</div>	
				
				<div class="form-group">
					<label for="editar_titulo">Celular</label>
					<input class="form-control form-control-sm" type="text" name="editar_telefono_celular_empleador" id="editar_telefono_celular_empleador">
				</div>		
				
				<div class="form-group">
					<label for="editar_titulo">E-mail</label>
					<input class="form-control form-control-sm" type="text" name="editar_email_empleador" id="editar_email_empleador">
				</div>			
						

				<div class="modal-footer">
					<button type="button" id="guardareditartrabajador" value="guardareditartrabajador" class="btn btn-success btn-sm">Guardar</button>
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>
				</div>
			</form>									
							
		</div> 
	</div>
  </div>
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
					<button type="button" id="btn_guardar_comision_medica" class="btn btn-success btn-sm">Guardar</button>				
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>
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
<br>	
<br>	
<br>	
<div class="text-center" style="font-size:90%">
	<img style="width:30px;height:30px;font-size:90%" class="img-fluid" alt="Responsive image" src="<?php echo base_url()?>/imagenes/Colproba_400x400.jpg"></img>
	<a href="https://colproba.org.ar/" class="btn btn-link">Colegio de Abogados de la Provincia de Buenos Aires</a><br>
	<small>© Copyright 2020 ColProBA </small><br>
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
		$('#tabla_movimientos_finalizacion_camara_revisora').stacktable();
		$('#tabla_movimientos_finalizacion_camara_revisora').DataTable( {
			"lengthMenu": [[25, 50, -1], [25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 1, "asc" ]],
			"paging": true,
			"info": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});	
		$('#tabla_movimientos_apelacion_justicia_ordinaria').stacktable();
		$('#tabla_movimientos_apelacion_justicia_ordinaria').DataTable( {
			"lengthMenu": [[25, 50, -1], [25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 1, "asc" ]],
			"paging": true,
			"info": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});
		$("#tipoconsulta").change(function(){
						
			var tipoconsulta = $('#tipoconsulta').val();

			document.getElementById('div_resultado_de_la_audiencia').style.display = 'none';			
			
			if(tipoconsulta == 0){
				document.getElementById('desplegable_tipo_movimiento').value = 0;
				document.getElementById("desplegable_tipo_movimiento").disabled = true;	
			}else{
				var url = 'devolver_motivos_finalizacion_tramites_json';					
				$.ajax({
					type:"POST",					
					url:url,
					data:{tipoconsulta:tipoconsulta},
					success:function(rta){				
						
						document.getElementById("desplegable_tipo_movimiento").disabled = false;								
						$('#desplegable_tipo_movimiento').html(rta).fadeIn();								
						
					}
				});	
				
			}
		});	
		$("#desplegable_tipo_movimiento").change(function(){
			
			var tipomovimiento = $('#desplegable_tipo_movimiento').val();
			
			if((tipomovimiento == 1) || (tipomovimiento == 5)){
				
				$("#div_resultado_de_la_audiencia").show();		
			
			}else{
				document.getElementById('div_resultado_de_la_audiencia').style.display = 'none';
				
			}
			
		});	
			
		$("#finalizacion_camara_revisora_si").change(function(){
			
			if(document.getElementById('finalizacion_camara_revisora_si').checked) {

				$("#div_tabla_movimientos_finalizacion_camara_revisora").show();		
			
			}
			
		});	
		$("#finalizacion_camara_revisora_no").change(function(){
			
			if(document.getElementById('finalizacion_camara_revisora_no').checked) {

				document.getElementById('div_tabla_movimientos_finalizacion_camara_revisora').style.display = 'none';			
			
			}
			
		});		
		$("#apelo_a_la_justicia_ordinaria_si").change(function(){
			
			if(document.getElementById('apelo_a_la_justicia_ordinaria_si').checked) {

				$("#div_apelo_a_la_justicia_ordinaria").show();		
			
			}
			
		});	
		$("#apelo_a_la_justicia_ordinaria_no").change(function(){
			
			if(document.getElementById('apelo_a_la_justicia_ordinaria_no').checked) {

				document.getElementById('div_apelo_a_la_justicia_ordinaria').style.display = 'none';			
			
			}
			
		});		
		$("#resultado_de_la_audiencia_con_acuerdo_no").change(function(){
			
			if(document.getElementById('resultado_de_la_audiencia_con_acuerdo_no').checked) {

				$("#div_apelo_camara_revisora_padre").show();		
			
			}
			
		});
		$("#resultado_de_la_audiencia_con_acuerdo_si").change(function(){
			
			if(document.getElementById('resultado_de_la_audiencia_con_acuerdo_si').checked) {

				document.getElementById('div_apelo_camara_revisora_padre').style.display = 'none';			
			
			}
			
		});			
		$("#apelo_a_la_camara_revisora_si").change(function(){
			
			if(document.getElementById('apelo_a_la_camara_revisora_si').checked) {

				$("#div_apelo_camara_revisora").show();		
			
			}
			
		});
		$("#apelo_a_la_camara_revisora_no").change(function(){
			
			if(document.getElementById('apelo_a_la_camara_revisora_no').checked) {

				document.getElementById('div_apelo_camara_revisora').style.display = 'none';			
			
			}
			
		});		
		$("#resultado_del_acuerdo_si").change(function(){
			
			if(document.getElementById('resultado_del_acuerdo_si').checked) {

				document.getElementById('div_resultado_del_acuerdo').style.display = 'none';			
			
			}
			
		});
		$("#resultado_del_acuerdo_no").change(function(){
			
			if(document.getElementById('resultado_del_acuerdo_no').checked) {

				$("#div_resultado_del_acuerdo").show();			
			
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