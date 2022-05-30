<br><div class="col-12" style="font-size:90%">
		<div class="row">
    <div class="col-8">
		<div class="card">
			<h5 class="card-header bg-info" style="color:#FFFFFF;padding-top:1%;padding-bottom:1%;text-align:justify">
			  <label>DETALLES DE LA CAUSA</label>

			  </h5>					
			  <div class="card-body">
				<input type="hidden" name="id_consulta_global" id="id_consulta_global" value="<?php echo $consulta[0]['IdConsulta']?>">  
				<label><strong>Número de sorteo: </strong> <?php echo $consulta[0]['IdConsulta']?></label><br>	
				<label><strong>Fecha de sorteo: </strong> <?php echo date("d-m-Y H:i:s",strtotime($consulta[0]['FechaSorteo']))?></label><br>		
					
				<label><strong>Resumen: </strong> <?php echo $consulta[0]['Descripcion']?></label><br>
				
				<label id="label_comision_medica"><strong>Comisión Médica: </strong> <?php if(!empty($consulta[0]['IdComisionMedica'])){ echo $consulta[0]['NombreComisionMedica'];}else echo 'Sin definir';?></label><br>
			  
				<?php if($consulta[0]['IdEstadoConsulta'] <> 8){?>
					<label><strong>Estado actual: </strong> <?php echo $consulta[0]['NombreEstadoConsulta']?></label><br>
				<?php }else{?>
					<label style="color:red"><strong>Estado actual: </strong> <?php echo $consulta[0]['NombreEstadoConsulta']?></label><br>
				<?php }?>
				
			  </div>
			  
			  	<div class="modal-footer">
								
					<button style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm btn_agregar_comision_medica" href="#myModal" data-toggle="modal" data-target="#modal_agregar_comision_medica" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_agregar_comision_medica(this.id)">Agregar comisión médica</button>
					<button style="float:right;margin-right:3px" type="button" class="btn btn-danger btn-sm btn_cerrar_causa" href="#myModal" data-toggle="modal" data-target="#modal_finalizar_causa" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_finalizar(this.id)">Finalizar causa</button>
					
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

			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
			  <div class="card-body">

				<form>
				  <fieldset>
					<h4>Reclamo administrativo</h4>
					<hr/>
					<div class="row">
						<div class="col">
						 	<label>Tipo de trámite</label>
							<select name="tipoconsulta" id="tipoconsulta" class="form-control required" data-required="true">
								<option value="0">Seleccione un tipo de trámite</option>												
									<?php foreach ($tiposconsulta as $tipos){
											if($tipos['IdTipoConsulta'] == $detalles_movimiento[0]['IdTipoTramite']){?>
												  <option value="<?php echo $tipos['IdTipoConsulta']?>" <?php echo set_select('tipoconsulta',$tipos['IdTipoConsulta'], TRUE)?>  ><?php echo $tipos['NombreTipoConsulta']?></option>
											  <?php }else{?>
												  <option value="<?php echo $tipos['IdTipoConsulta']?>" <?php echo set_select('tipoconsulta',$tipos['IdTipoConsulta'])?>><?php echo $tipos['NombreTipoConsulta']?></option>
										  <?php }										
									 }?>				
							</select>
						</div>
						<div class="col">
							<div class="form-group">
							  <label for="fecha_incidente">Fecha incidente</label>
							  <input type="date" id="fecha_incidente" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaIncidente']?>">
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col">
							<div class="form-group">
							  <label for="fecha_audincia_con_aseguradora">Fecha audiencia c/ aseguradora</label>
							  <input type="date" id="fecha_audincia_con_aseguradora" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaAudienciaConAseguradora']?>">
							</div>
						</div>
						<div class="col">
						  <div class="form-group">
							  <label for="fecha_entrevista_con_trabajador">Fecha entrevista c/ trabajador</label>
							  <input type="date" id="fecha_entrevista_con_trabajador" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaEntrevistaConTrabajador']?>">
							</div>
						</div>
					</div>
									
					<hr/>
					<h4>Trámite ante la Comisión Médica</h4>
					<hr/>
					<div class="row">
						<div class="col">
						  <div class="form-group">
							  <label for="fecha_inicio_tramite">Fecha inicio del trámite</label>
							  <input type="date" id="fecha_inicio_tramite" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaInicioTramite']?>">
							</div>
						</div>
						<div class="col">
						  <div class="form-group">
							  <label for="numero_expediente">Número de expediente</label>
							  <input type="text" id="numero_expediente" class="form-control" value="<?php echo $detalles_movimiento[0]['NumeroExpediente']?>">
							</div>
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
							  <label for="fecha_audiencia_medica">Fecha de audiencia médica</label>
							  <input type="date" id="fecha_audiencia_medica" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaAudienciaMedica']?>">
							</div>
						</div>
						<div class="col">
						  
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
					<hr/>
					<div class="row">
						
						<div class="col">
							<div class="form-group">
							  <label for="fecha_dictamen_medico">Fecha de dictamen médico</label>
							  <input type="date" id="fecha_dictamen_medico" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaDictamenMedico']?>">
							</div>						
						</div>
						
						<div class="col">
							
						</div>
					</div>
					
					<br>
					<div class="row">
						
						<div class="col">
						  	<label>Motivo de finalización de trámite</label>
							 <select class="form-control required" name="desplegable_motivo_finalizacion_tramite" id="desplegable_motivo_finalizacion_tramite" data-required="true" disabled>
								<option value="0">Seleccione un motivo de finalización</option>
							 </select>
						<label style="color:red">*Este campo se habilita cuando selecciona un tipo de trámite</label>							 
						</div>
						
						<div class="col">
							
						</div>
					</div>
					
					<br>
					<div id="div_fecha_acto_clausura" style="display:none">
						<div class="row">
							
							<div class="col">
								<div class="form-group">
								  <label for="fecha_acto_clausura">Fecha acto clausura</label>
								  <input type="date" id="fecha_acto_clausura" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaActoClausura']?>">
								</div>						
							</div>
							
							<div class="col">
								
							</div>
						</div>
					</div>
					<div id="div_resultado_de_la_audiencia" style="display:none">
						<div class="row">
							<div class="col">
								<div class="form-group">
								  <label for="fecha_de_audiencia_de_acuerdo">Fecha de audiencia de acuerdo</label>
								  <input type="date" id="fecha_de_audiencia_de_acuerdo" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaAudienciaAcuerdo']?>">
								  <label style="color:red">*Complete este campo si corresponde</label>
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
					 <!--
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
										  <label for="fecha_apelacion_camara_revisora">Fecha de apelación</label>
										  <input type="date" id="fecha_apelacion_camara_revisora" class="form-control">
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
						-->
					</div>			
				
				  </fieldset>
				   <div class="modal-footer">
					<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
					<!--<button type="button" class="btn btn-danger">Finalizar caso</button>-->
					<!--<button type="button" class="btn btn-success btn-sm">Guardar cambios</button>-->
				  </div>
				</form>
				
			  </div>
			<div class="modal-footer">
				<button type="button" id="btn_guardar_datos_gestion_administrativa" class="btn btn-success btn-sm">Guardar</button>
			</div>
			</div>
		  </div>
		  
		  <div id="seccion_apelacion_comision_medica_central" class="card" style="display:none">
			<div class="card-header bg-info" style="padding-top:0px;padding-bottom:0px !important" id="headingTwo">
			  <h2 class="mb-0">
				<button style="color:#FFFFFF !important" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				  APELACION COMISION MEDICA CENTRAL
				</button>
				<!--
				<button style="float:right;margin-top:5px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_ayuda_justicia_ordinaria" id="<?php //echo $movimiento['IdMovimientoConsulta']?>" onclick="cargar_datos_movimiento_editar(this.id)">
					<img src="<?php //echo base_url(); ?>/imagenes/ayuda_blanco.png" width="18" height="18" title="Ayuda">
				</button>	
				-->
			  </h2>
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
			  <div class="card-body">
					
					<div class="row">
						<div class="col">
						  <div class="form-group">
							  <label for="fecha_apelacion_comision_medica_central">Fecha de apelación</label>
							  <input type="date" id="fecha_apelacion_comision_medica_central" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaApelacionComisionMedicaCentral']?>">
							</div>
						</div>
						<div class="col">
						 
						</div>
					</div>	
					<hr/>
						<h4>Movimiento en Comisión Médica Central</h4>
						<div class="card">
							<br>	
							<table id="tabla_movimientos_comision_medica_central" class="table table-striped table-sm">
							  <thead>
								<tr>
								  <th>Fecha</th>								 
								  <th>Descripción</th>								 
								  <th>Acción</th>
								</tr>
							  </thead>
							  <tbody>
							
							<?php foreach ($movimientos_comision_medica_central as $movimiento){?>	
							
								<tr id="fila_movimiento_CMC_<?php echo $movimiento['IdMovimiento']?>">	
								
									<td id="td_fecha_CMC_<?php echo $movimiento['IdMovimiento']?>">
									
										<span style="display:none"><?php if(!empty($movimiento['FechaMovimiento'])){echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']));}?></span> 
										<?php echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']))?>
									
									</td>								
											
									<td id="td_detalle_CMC_<?php echo $movimiento['IdMovimiento']?>"><?php echo $movimiento['Detalle']?></td>											
											
																							
									<td style="width:11% !important">
										<div class="form-inline">
											
											<input type="hidden" name="id_movimiento_CMC<?php echo $movimiento['IdMovimiento']?>" id="id_movimiento_CMC<?php echo $movimiento['IdMovimiento']?>" value="<?php echo $movimiento['IdMovimiento']?>">				 
											<input type="hidden" name="fecha_movimiento_original_CMC<?php echo $movimiento['IdMovimiento']?>" id="fecha_movimiento_original_CMC<?php echo $movimiento['IdMovimiento']?>" value="<?php echo date("Y-m-d",strtotime($movimiento['FechaMovimiento']))?>">				 
											<input type="hidden" name="fecha_movimiento_CMC<?php echo $movimiento['IdMovimiento']?>" id="fecha_movimiento_CMC<?php echo $movimiento['IdMovimiento']?>" value="<?php echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']))?>">				 
											<input type="hidden" name="detalle_movimiento_CMC<?php echo $movimiento['IdMovimiento']?>" id="detalle_movimiento_CMC<?php echo $movimiento['IdMovimiento']?>" value="<?php echo $movimiento['Detalle']?>">				 
																						
											<?php if($consulta[0]['IdEstadoConsulta'] <> 8){?>
												<button style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_movimiento_CMC" id="<?php echo $movimiento['IdMovimiento']?>" onclick="cargar_datos_movimiento_editar_CMC(this.id)">
													<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Editar">
												</button>					
											
												<button style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar_movimiento_CMC" id="<?php echo $movimiento['IdMovimiento']?>" onclick="cargar_datos_movimiento_eliminar_CMC(this.id)">
													<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="18" height="18" title="Eliminar">
												</button>
											<?php }else{?>
												<button disabled style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_movimiento_CMC" id="<?php echo $movimiento['IdMovimiento']?>" onclick="cargar_datos_movimiento_editar_CMC(this.id)">
													<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Editar">
												</button>					
											
												<button disabled  style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar_movimiento_CMC" id="<?php echo $movimiento['IdMovimiento']?>" onclick="cargar_datos_movimiento_eliminar_CMC(this.id)">
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
						<button type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_movimiento_en_comision_medica_central">Agregar movimiento</button>
						<hr/>
						<h4>Finalización</h4>
						<div class="row">
							<div class="col">
							  <div class="form-group">
								  <label for="fecha_finalizacion_comision_medica_central">Fecha de finalización</label>
								  <input type="date" id="fecha_finalizacion_comision_medica_central" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaFinalizacionComisionMedicaCentral']?>">
								</div>
							</div>
							<div class="col">
							 
							</div>
						</div>	
						<hr/>
						
						<div class="row">
							<div class="col">
								<div class="form-group">
								  <label>Resultado</label>							 
								</div>							
							</div>
							<div class="col">
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="resultado_del_acuerdo_si" name="resultado_del_acuerdo_comision_medica_central" class="custom-control-input" value="1">
								  <label class="custom-control-label" for="resultado_del_acuerdo_si">Con acuerdo</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="resultado_del_acuerdo_no" name="resultado_del_acuerdo_comision_medica_central" class="custom-control-input" value="2">
								  <label class="custom-control-label" for="resultado_del_acuerdo_no">Sin acuerdo</label>
								</div>
							</div>
						</div>									
					
			  </div>
			  	<div class="modal-footer">
					<button type="button" id="btn_guardar_detalle_comision_medica_central" class="btn btn-success btn-sm">Guardar</button>
				</div>	
			</div>

		  </div>

		 <div id="seccion_gestion_judicial" class="card" style="display:none">
			<div class="card-header bg-info" style="padding-top:0px;padding-bottom:0px !important" id="headingThree">
			  <h2 class="mb-0">
				<button style="color:#FFFFFF !important" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
				  GESTION JUDICIAL
				</button>
				<!--
				<button style="float:right;margin-top:5px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_ayuda_justicia_ordinaria" id="<?php //echo $movimiento['IdMovimientoConsulta']?>" onclick="cargar_datos_movimiento_editar(this.id)">
					<img src="<?php //echo base_url(); ?>/imagenes/ayuda_blanco.png" width="18" height="18" title="Ayuda">
				</button>	
				-->
			  </h2>
			</div>
			<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
			  <div class="card-body">
					<form>
				  <fieldset>
					<h4>Apelación justicia ordinaria</h4>
					<!--
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
					-->
					<div id="div_apelo_a_la_justicia_ordinaria" style="">
						<hr/>
							
						<div class="row">
							<div class="col">
							  <div class="form-group">
								  <label for="fecha_apelacion_justicia_ordinaria">Fecha de apelación</label>
								  <input type="date" id="fecha_apelacion_justicia_ordinaria" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaApelacionJusticiaOrdinaria']?>">
								</div>
							</div>
							<div class="col">
							  <div class="form-group">
								  <label for="juzgado_justicia_ordinaria">Juzgado</label>
								  <input type="text" id="juzgado_justicia_ordinaria" class="form-control" value="<?php echo $detalles_movimiento[0]['Juzgado']?>">
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="numero_expediente_justicia_ordinaria">Número de expediente</label>
									<input type="text" id="numero_expediente_justicia_ordinaria" class="form-control" value="<?php echo $detalles_movimiento[0]['NumeroExpedienteJusticiaOrdinaria']?>">
								</div>
							</div>
							<div class="col">
							  	<div class="form-group">
									<label for="caratula_justicia_ordinaria">Carátula</label>
									<input type="text" id="caratula_justicia_ordinaria" class="form-control" value="<?php echo $detalles_movimiento[0]['Caratula']?>">
								</div>
							</div>
						</div>
						<hr/>
						<h4>Actuaciones / Movimiento de la Causa / Novedades</h4>
						<div class="card">
							<br>	
							<table id="tabla_movimientos_apelacion_justicia_ordinaria" class="table table-striped table-sm">
							  <thead>
								<tr>
								  <th>Fecha</th>								 
								  <th>Descripción</th>								 
								  <th >Acción</th>
								</tr>
							  </thead>
							  <tbody>
							
							<?php foreach ($movimientos_justicia_ordinaria as $movimiento){?>		  
								
								<tr id="fila_movimiento_JO_<?php echo $movimiento['IdMovimiento']?>">
								
									<td id="td_fecha_JO_<?php echo $movimiento['IdMovimiento']?>">
									
										<span style="display:none"><?php if(!empty($movimiento['FechaMovimiento'])){echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']));}?></span> 
										<?php echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']))?>
									
									</td>								
											
									<td id="td_detalle_JO_<?php echo $movimiento['IdMovimiento']?>"><?php echo $movimiento['Detalle']?></td>											
											
																							
									<td style="width:11% !important">
										<div class="form-inline">
											
											<input type="hidden" name="id_movimiento_JO<?php echo $movimiento['IdMovimiento']?>" id="id_movimiento_JO<?php echo $movimiento['IdMovimiento']?>" value="<?php echo $movimiento['IdMovimiento']?>">				 
											<input type="hidden" name="fecha_movimiento_original_JO<?php echo $movimiento['IdMovimiento']?>" id="fecha_movimiento_original_JO<?php echo $movimiento['IdMovimiento']?>" value="<?php echo date("Y-m-d",strtotime($movimiento['FechaMovimiento']))?>">				 
											<input type="hidden" name="fecha_movimiento_JO<?php echo $movimiento['IdMovimiento']?>" id="fecha_movimiento_JO<?php echo $movimiento['IdMovimiento']?>" value="<?php echo date("d-m-Y",strtotime($movimiento['FechaMovimiento']))?>">				 
											<input type="hidden" name="detalle_movimiento_JO<?php echo $movimiento['IdMovimiento']?>" id="detalle_movimiento_JO<?php echo $movimiento['IdMovimiento']?>" value="<?php echo $movimiento['Detalle']?>">				 
											
											<?php if($consulta[0]['IdEstadoConsulta'] <> 8){?>
												<button style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_movimiento_JO" id="<?php echo $movimiento['IdMovimiento']?>" onclick="cargar_datos_movimiento_editar_JO(this.id)">
													<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Editar">
												</button>					
											
												<button style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar_movimiento_JO" id="<?php echo $movimiento['IdMovimiento']?>" onclick="cargar_datos_movimiento_eliminar_JO(this.id)">
													<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="18" height="18" title="Eliminar">
												</button>
											<?php }else{?>
												<button disabled style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_movimiento_JO" id="<?php echo $movimiento['IdMovimiento']?>" onclick="cargar_datos_movimiento_editar_JO(this.id)">
													<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Editar">
												</button>					
											
												<button disabled  style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar_movimiento_JO" id="<?php echo $movimiento['IdMovimiento']?>" onclick="cargar_datos_movimiento_eliminar_JO(this.id)">
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
						<button type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_movimiento_en_justicia_ordinaria">Agregar movimiento</button>
						<hr/>
						<!------------------------------------------------------------------------------------------------------->
									
						<h4>Resultado de la sentencia</h4>
						<hr/>
						<div class="row">
							<div class="col">
							  <div class="form-group">
								  <label for="fecha_sentencia_justicia_ordinaria">Fecha de sentencia</label>
								  <input type="date" id="fecha_sentencia_justicia_ordinaria" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaSentenciaJusticiaOrdinaria']?>">
								</div>
							</div>
							<div class="col">
							  
							</div>
						</div>
						
						<div class="row">
							<div class="col">
								<div class="form-group">
								  <label>Resultado de la sentencia</label>							 
								</div>							
							</div>
							<div class="col">
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="resultado_del_acuerdo_justicia_ordinaria_si" name="resultado_del_acuerdo_justicia_ordinaria" class="custom-control-input" value="1">
								  <label class="custom-control-label" for="resultado_del_acuerdo_justicia_ordinaria_si">Favorable</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="resultado_del_acuerdo_justicia_ordinaria_no" name="resultado_del_acuerdo_justicia_ordinaria" class="custom-control-input" value="2">
								  <label class="custom-control-label" for="resultado_del_acuerdo_justicia_ordinaria_no">Desfavorable</label>
								</div>
							</div>
						</div>
						<div id="div_resultado_del_acuerdo" style="display:none">
							<hr/>
							<div class="row">
								<div class="col">
								  <div class="form-group">
									  <label for="fecha_resultado_del_acuerdo">Fecha apelación en cámara</label>
									  <input type="date" id="fecha_resultado_del_acuerdo" class="form-control" value="<?php echo $detalles_movimiento[0]['FechaResultadoSentenciaJusticiaOrdinaria']?>">
									</div>
								</div>
								<div class="col">
									
								</div>
							</div>		
						   <!--
							<div class="form-group">
								<label for="textarea_resultado_del_acuerdo">Resultado</label>
								<textarea class="form-control" id="textarea_resultado_del_acuerdo" rows="3"><?php //echo $detalles_movimiento[0]['ResultadoJusticiaOrdinaria']?></textarea>
							</div>								
							-->
						</div>					
							
					</div>
				  </fieldset>
			
				</form>
			  </div>
			<div class="modal-footer">
				<button type="button" id="btn_guardar_detalle_justicia_ordinaria" class="btn btn-success btn-sm">Guardar</button>
			</div>
			</div>
		  </div>
		</div>
		<div class="modal-footer">
			<button style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm" id="btn_iniciar_apelacion_en_comision_medica_central">Iniciar Apelación en Comisión Médica Central</button>
			<button type="button" class="btn btn-primary btn-sm" id="btn_iniciar_caso_justicia_ordinaria">Iniciar caso en Justicia Ordinaria</button>		
		</div>

	</div>
    <div class="col-4">
		<div class="card">
			<h5 class="card-header bg-info" style="padding-top:2.5%;padding-bottom:1%;color:#FFFFFF !important">
			  <label>DATOS DEL TRABAJADOR</label>
 
					<button style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm btn_datos_trabajador" href="#myModal" data-toggle="modal" data-target="#modal_editar_trabajador" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_editar_trabajador(this.id)">
						<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="20" height="20" title="Editar datos del trabajador">
					</button>
			  
			  
			  </h5>	

			  <div class="card-body">
								
				<label id="apellido_empleado"><strong>Apellido y Nombre: </strong> <?php echo $consulta[0]['Apellido'].' '.$consulta[0]['Nombre']?></label><br>
				<label id="nombre_empleado"><strong>Cuit: </strong> <?php echo $consulta[0]['Cuit']?></label><br>
				<label id="telefono_empleado"><strong>Teléfono: </strong> <?php echo $consulta[0]['Telefono']?></label><br>
				<label id="celular_empleado"><strong>Celular: </strong> <?php echo $consulta[0]['Celular']?></label><br>
				<label id="email_empleado"><strong>E-mail: </strong> <?php echo $consulta[0]['Email']?></label><br>
				
			  </div>
		</div>
		<br>
		<div class="card">
			<h5 class="card-header bg-info" style="padding-top:2.5%;padding-bottom:1%;color:#FFFFFF;text-align: justify !important">
			  <label>DATOS DEL EMPLEADOR</label>
 
					<button style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm btn_datos_empleador" href="#myModal" data-toggle="modal" data-target="#modal_editar_empleador" id="<?php echo $consulta[0]['IdConsulta']?>" onclick="cagar_datos_editar_empleador(this.id)">
						<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="20" height="20" title="Editar datos del empleador">
					</button>
			  
			  
			  </h5>	

			  <div class="card-body">
				<label id="razon_social_empleador"><strong>Razón social: </strong> <?php echo $detalles_movimiento[0]['RazonSocialEmpleador'];?></label><br>
				<label id="cuit_empleador"><strong>Cuit: </strong> <?php echo $detalles_movimiento[0]['CuitEmpleador'];?></label><br>
				<label id="telefono_empleador"><strong>Teléfono: </strong> <?php echo $detalles_movimiento[0]['TelefonoEmpleador'];?></label><br>
				<label id="celular_empleador"><strong>Celular: </strong> <?php echo $detalles_movimiento[0]['CelularEmpleador'];?></label><br>
				<label id="email_empleador"><strong>E-mail: </strong> <?php echo $detalles_movimiento[0]['EmailEmpleador'];?></label><br>
				
			  </div>
		</div>
		<br>		
		<div class="card">
			<h5 class="card-header bg-info" style="padding-top:2.5%;padding-bottom:1%;color:#FFFFFF;text-align: justify !important">
				<label>NOTAS</label> 
				<button id="btn_agregar_nota" style="float:right;margin-right:3px" type="button" class="btn btn-secondary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_agregar_nota">
					<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="20" height="20" title="Agregar nota">
				</button>			  
			</h5>	

			 <div class="card-body">
				<label id="label_notas"><?php echo $detalles_movimiento[0]['Notas']?></label>							
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
				<input type="hidden" name="id_consulta_editar_empleador" id="id_consulta_editar_empleador" value="<?php echo $consulta[0]['IdConsulta']?>">  
															
				<div class="form-group">
					<label for="editar_apellido">Apellido</label>
					<input class="form-control form-control-sm" type="text" name="editar_apellido" id="editar_apellido" value="<?php echo $consulta[0]['Apellido']?>">
				</div>				
				
				<div class="form-group">
					<label for="editar_nombre">Nombre</label>
					<input class="form-control form-control-sm" type="text" name="editar_nombre" id="editar_nombre" value="<?php echo $consulta[0]['Nombre']?>">
				</div>		
				
				<div class="form-group">
					<label for="editar_cuit">Cuit</label>
					<input class="form-control form-control-sm" onkeyup="valida_cadena(event, this)" type="text" name="editar_cuit" id="editar_cuit" value="<?php echo $consulta[0]['Cuit']?>">
				</div>		
				
				<div class="form-group">
					<label for="editar_telefono">Teléfono</label>
					<input class="form-control form-control-sm" type="text" name="editar_telefono" id="editar_telefono" value="<?php echo $consulta[0]['Telefono']?>">
				</div>	
				
				<div class="form-group">
					<label for="editar_telefono_celular">Celular</label>
					<input class="form-control form-control-sm" type="text" name="editar_telefono_celular" id="editar_telefono_celular" value="<?php echo $consulta[0]['Celular']?>">
				</div>		
				
				<div class="form-group">
					<label for="editar_email">E-mail</label>
					<input class="form-control form-control-sm" type="text" name="editar_email" id="editar_email" value="<?php echo $consulta[0]['Email']?>">
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
<div class="modal fade" id="modal_agregar_nota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Agregar nota</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formagregarnota" name="formagregarnota">																
				<input type="hidden" name="id_consulta_agregar_notas" id="id_consulta_agregar_notas" value="<?php echo $consulta[0]['IdConsulta']?>"> 
				<div class="form-group">
					<label for="agregar_notas">Anotaciones</label>
					<textarea class="form-control" id="agregar_notas" rows="3"></textarea>
				</div>

				<div class="modal-footer">
					<button type="button" id="btn_agregar_nota_modal" value="btn_agregar_nota_modal" class="btn btn-success btn-sm">Guardar</button>
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
					<input class="form-control form-control-sm" type="text" name="editar_razon_social" id="editar_razon_social" value="<?php echo $detalles_movimiento[0]['RazonSocialEmpleador']?>">
				</div>		
				
				<div class="form-group">
					<label for="editar_titulo">Cuit</label>
					<input class="form-control form-control-sm" onkeyup="valida_cadena(event, this)" type="text" name="editar_cuit_empleador" id="editar_cuit_empleador" value="<?php echo $detalles_movimiento[0]['CuitEmpleador']?>">
				</div>		
				
				<div class="form-group">
					<label for="editar_titulo">Teléfono</label>
					<input class="form-control form-control-sm" type="text" name="editar_telefono_empleador" id="editar_telefono_empleador" value="<?php echo $detalles_movimiento[0]['TelefonoEmpleador']?>">
				</div>	
				
				<div class="form-group">
					<label for="editar_titulo">Celular</label>
					<input class="form-control form-control-sm" type="text" name="editar_telefono_celular_empleador" id="editar_telefono_celular_empleador" value="<?php echo $detalles_movimiento[0]['CelularEmpleador']?>">
				</div>		
				
				<div class="form-group">
					<label for="editar_titulo">E-mail</label>
					<input class="form-control form-control-sm" type="text" name="editar_email_empleador" id="editar_email_empleador" value="<?php echo $detalles_movimiento[0]['EmailEmpleador']?>">
				</div>			
						

				<div class="modal-footer">
					<button type="button" id="guardareditarempleador" value="guardareditarempleador" class="btn btn-success btn-sm">Guardar</button>
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>
				</div>
			</form>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_agregar_movimiento_en_comision_medica_central" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div  class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Agregar movimiento en Comisión Médica Central </h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			</div>			
			<div class="modal-body">
					
					<div class="row form-group">
						<div class="col-sm-6">
							<label>Fecha</label>
							<input name="fecha_nuevo_movimiento_CMC" id="fecha_nuevo_movimiento_CMC" type="date" class="form-control required">							
						</div>			
					</div>						
							
					<div class="form-group">
					
						<label for="observaciones">Descripción</label>
						<textarea class="form-control form-control-sm" name="nuevo_movimiento_descripcion_CMC" id="nuevo_movimiento_descripcion_CMC" rows="6"></textarea>
						
					</div>
					<div class="modal-footer">
						<button type="button" id="btn_guardar_movimiento_CMC" name="btn_guardar_movimiento_CMC" class="btn btn-success btn-sm">Guardar</button>
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>						
					</div> 
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_agregar_movimiento_en_justicia_ordinaria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div  class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Agregar Movimiento en Justicia Ordinaria</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			</div>			
			<div class="modal-body">
					
					<div class="row form-group">
						<div class="col-sm-6">
							<label>Fecha</label>
							<input name="fecha_nuevo_movimiento_JO" id="fecha_nuevo_movimiento_JO" type="date" class="form-control required">							
						</div>			
					</div>						
							
					<div class="form-group">
					
						<label for="observaciones">Descripción</label>
						<textarea class="form-control form-control-sm" name="nuevo_movimiento_descripcion_JO" id="nuevo_movimiento_descripcion_JO" rows="6"></textarea>
						
					</div>
					<div class="modal-footer">
						<button type="button" id="btn_guardar_movimiento_JO" name="btn_guardar_movimiento_JO" class="btn btn-success btn-sm">Guardar</button>
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>						
					</div> 
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_editar_movimiento_CMC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Editar movimiento <b><label style="color:red" id="Id_datos_movimiento"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formeditarmovimientoCMC" name="formeditarmovimientoCMC">			
				
				<input type="hidden" name="id_consulta_editar_movimiento_CMC" id="id_consulta_editar_movimiento_CMC" value="<?php echo $consulta[0]['IdConsulta']?>">  
				<input type="hidden" name="id_movimiento_editar_movimiento_CMC" id="id_movimiento_editar_movimiento_CMC" value="">  
				
				<div class="form-group">
				  
					<label>Fecha</label>
					<input name="fecha_nuevo_movimiento_editar_CMC" id="fecha_nuevo_movimiento_editar_CMC" type="date" class="form-control required" value="">							
				  
				</div>
				
				<div class="form-group">
				
					<label for="editar_descripcion">Descripción</label>
					<textarea class="form-control form-control-sm" name="editar_descripcion_CMC" id="editar_descripcion_CMC" rows="6"></textarea>
					
				</div>
				<div class="modal-footer">
					<button type="button" id="btn_guardar_movimiento_editar_CMC" name="btn_guardar_movimiento_editar_CMC" class="btn btn-success btn-sm">Guardar</button>
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>
				</div>
			</form>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_editar_movimiento_JO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Editar movimiento <b><label style="color:red" id="Id_datos_movimiento"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<form action="#" method="post" enctype="multipart/form-data" id="formeditarmovimientoJO" name="formeditarmovimientoJO">			
				<input type="hidden" name="id_consulta_editar_movimiento_JO" id="id_consulta_editar_movimiento_JO" value="<?php echo $consulta[0]['IdConsulta']?>">  
				<input type="hidden" name="id_movimiento_editar_movimiento_JO" id="id_movimiento_editar_movimiento_JO" value="">  
				
				<div class="form-group">
				 
					<label>Fecha</label>
					<input name="fecha_nuevo_movimiento_editar_JO" id="fecha_nuevo_movimiento_editar_JO" type="date" class="form-control required" value="">	
					
				</div>
							
				<div class="form-group">
				
					<label for="editar_descripcion_JO">Descripción</label>
					<textarea class="form-control form-control-sm" name="editar_descripcion_JO" id="editar_descripcion_JO" rows="6"></textarea>
					
				</div>
				<div class="modal-footer">
					<button type="button" id="btn_guardar_movimiento_editar_JO" name="btn_guardar_movimiento_editar_JO" class="btn btn-success btn-sm">Guardar</button>
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>
				</div>
			</form>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_ayuda_justicia_ordinaria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Ayuda</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
		
			<label>Si usted inicio una apelación en la Justicia Ordinaria utilice esta sección para su gestión y completando los campos que considere necesarios para su control.</label>
			<div class="modal-footer">				
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>
			</div>			
							
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
		<h5 class="modal-title" id="exampleModalLabel">Mensaje para el usuario</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
			<form class="" action="finalizar_causa" method="post" enctype="multipart/form-data" id="formfinalizarcausa" name="formfinalizarcausa">					
				<input type="hidden" name="id_consulta_finalizar" id="id_consulta_finalizar" value="">
				<div class="form-group">						
									
					<div class="form-group">						
						<div style="color:red"><b>¡Atención!</b> ¿Esta seguro que quiere <b>CERRAR</b> la causa <b><label id="numero_causa_finalizar"></label></b>?</div>						
						<div style="color:red">Cuando cierre la causa, usted no podrá hacer modificaciones sobre la misma.</div>						
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
<div class="modal fade" id="modal_eliminar_movimiento_CMC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
			<form class="" action="#" method="post" enctype="multipart/form-data" id="formeliminarmovimientoCMC" name="formeliminarmovimientoCMC">					
				<input type="hidden" name="id_consulta_eliminar_movimiento_CMC" id="id_consulta_eliminar_movimiento_CMC" value="<?php echo $consulta[0]['IdConsulta']?>">  
				<input type="hidden" name="id_movimiento_eliminar_movimiento_CMC" id="id_movimiento_eliminar_movimiento_CMC" value="">  
				<div class="form-group">						
									
					<div class="form-group">						
						<div style="color:red">¿Esta seguro que quiere <b>ELIMINAR</b> el movimiento?</div>	<br>	
	
						<label id="fecha_ver_movimiento_CMC"></label><br>		
						<label id="detalle_ver_movimiento_CMC"></label><br>			
						
					</div>
					
				</div>
						
				<div class="modal-footer">					
					<button type="button" id="btn_eliminar_movimiento_CMC" class="btn btn-danger">Eliminar</button>				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				</div>									
			</form>				
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_eliminar_movimiento_JO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
			<form class="" action="#" method="post" enctype="multipart/form-data" id="formeliminarmovimientoJO" name="formeliminarmovimientoJO">					
				<input type="hidden" name="id_consulta_eliminar_movimiento_JO" id="id_consulta_eliminar_movimiento_JO" value="<?php echo $consulta[0]['IdConsulta']?>">  
				<input type="hidden" name="id_movimiento_eliminar_movimiento_JO" id="id_movimiento_eliminar_movimiento_JO" value="">  
				<div class="form-group">						
									
					<div class="form-group">						
						<div style="color:red">¿Esta seguro que quiere <b>ELIMINAR</b> el movimiento?</div>	<br>	
	
						<label id="fecha_ver_movimiento_JO"></label><br>		
						<label id="detalle_ver_movimiento_JO"></label><br>			
						
					</div>
					
				</div>
						
				<div class="modal-footer">					
					<button type="button" id="btn_eliminar_movimiento_JO" class="btn btn-danger">Eliminar</button>				
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
<br>
<div class="modal fade" id="modal_mensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Mensaje para el usuario</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">								
	
			<div id="alerta_mensaje" class="alert alert-success"  role="alert">					
				<div class="form-group">
					<h5>¡Atención!</h5>
					<div  id="mensaje_abogado"></div>						
				</div>
			</div>
			
			<div class="modal-footer">		
				<button type="button" id="cerrar_modal_ver_ventas" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		
		var ApeloComisionMedicaCentral = "<?php echo $detalles_movimiento[0]['ApeloComisionMedicaCentral']?>";
		var ApeloJusticiaOrdinaria = "<?php echo $detalles_movimiento[0]['ApeloJusticiaOrdinaria']?>";		
		var EstudioComplementarios = "<?php echo $detalles_movimiento[0]['EstudioComplementarios']?>";
		var DocumentacionComplementaria = "<?php echo $detalles_movimiento[0]['DocumentacionComplementaria']?>";
		var SolicitudProrroga = "<?php echo $detalles_movimiento[0]['SolicitudProrroga']?>";
		var PlanteoAlegato = "<?php echo $detalles_movimiento[0]['PlanteoAlegato']?>";
		var ResultadoAudiencia = "<?php echo $detalles_movimiento[0]['ResultadoAudiencia']?>";
		var IdMotivoFinalizacionTramite = "<?php echo $detalles_movimiento[0]['IdMotivoFinalizacionTramite']?>";
		var tipoconsulta = "<?php echo $detalles_movimiento[0]['IdTipoTramite']?>";
		var ResultadoComisionMedicaCentral = "<?php echo $detalles_movimiento[0]['ResultadoComisionMedicaCentral']?>";
		var ResultadoSentenciaJusticiaOrdinaria = "<?php echo $detalles_movimiento[0]['ResultadoSentenciaJusticiaOrdinaria']?>";
		var IdEstadoConsulta = "<?php echo $consulta[0]['IdEstadoConsulta']?>";
		
		if(IdEstadoConsulta == 8){
			
			if(ApeloComisionMedicaCentral == 1){
				$("#seccion_apelacion_comision_medica_central").show();				
			}
			if(ApeloJusticiaOrdinaria == 1){
				$("#seccion_gestion_judicial").show();				
			}
			
			document.getElementById('btn_iniciar_apelacion_en_comision_medica_central').style.display = 'none';		
			document.getElementById('btn_iniciar_caso_justicia_ordinaria').style.display = 'none';			
			
			$(".btn_agregar_comision_medica").addClass("invisible");
			$(".btn_cerrar_causa").addClass("invisible");
			$("#btn_agregar_nota").addClass("invisible");
			$(".btn_datos_empleador").addClass("invisible");
			$(".btn_datos_trabajador").addClass("invisible");
			$("#btn_guardar_datos_gestion_administrativa").addClass("invisible");
			$("#btn_guardar_detalle_comision_medica_central").addClass("invisible");
			$("#btn_guardar_detalle_justicia_ordinaria").addClass("invisible");
			
		}
				
		if(tipoconsulta == 0){
			document.getElementById('desplegable_motivo_finalizacion_tramite').value = 0;
			document.getElementById("desplegable_motivo_finalizacion_tramite").disabled = true;	
		}else{
			
			var url = 'devolver_motivos_finalizacion_tramites_json';					
			$.ajax({
				type:"POST",					
				url:url,
				data:{tipoconsulta:tipoconsulta},
				success:function(rta){				
					
					document.getElementById("desplegable_motivo_finalizacion_tramite").disabled = false;								
					$('#desplegable_motivo_finalizacion_tramite').html(rta).fadeIn();
					document.getElementById('desplegable_motivo_finalizacion_tramite').value = IdMotivoFinalizacionTramite;					
					
				}
			});	
			
		}				
		if(ResultadoSentenciaJusticiaOrdinaria == 1){
			$("#resultado_del_acuerdo_justicia_ordinaria_si").prop("checked", true);
		}else if(ResultadoSentenciaJusticiaOrdinaria == 2){
			$("#resultado_del_acuerdo_justicia_ordinaria_no").prop("checked", true);
			$("#div_resultado_del_acuerdo").show();	
		}		
		if(ResultadoComisionMedicaCentral == 1){
			$("#resultado_del_acuerdo_si").prop("checked", true);
		}else if(ResultadoComisionMedicaCentral == 2){
			$("#resultado_del_acuerdo_no").prop("checked", true);
		}	
		if((IdMotivoFinalizacionTramite == 1) || (IdMotivoFinalizacionTramite == 5)){
			
			$("#div_resultado_de_la_audiencia").show();		
		
		}else{
			document.getElementById('div_resultado_de_la_audiencia').style.display = 'none';
			
		}
		if(IdMotivoFinalizacionTramite == 2){
			$("#div_fecha_acto_clausura").show();
		}else{
			document.getElementById('div_fecha_acto_clausura').style.display = 'none';
		}	
			
		if(EstudioComplementarios == 1){
			$("#solicitud_de_estudios_médicos_complementarios_si").prop("checked", true);
		}else if(EstudioComplementarios == 2){
			$("#solicitud_de_estudios_médicos_complementarios_no").prop("checked", true);
		}
		
		if(DocumentacionComplementaria == 1){
			$("#solicitud_de_documentacion_complementaria_si").prop("checked", true);
		}else if(DocumentacionComplementaria == 2){
			$("#solicitud_de_documentacion_complementaria_no").prop("checked", true);
		}
		
		if(SolicitudProrroga == 1){
			$("#solicitud_de_prorroga_si").prop("checked", true);
		}else if(SolicitudProrroga == 2){
			$("#solicitud_de_prorroga_no").prop("checked", true);
		}		
		
		if(PlanteoAlegato == 1){
			$("#planteo_alegato_si").prop("checked", true);
		}else if(PlanteoAlegato == 2){
			$("#planteo_alegato_no").prop("checked", true);
		}
		
		if(ResultadoAudiencia == 1){
			$("#resultado_de_la_audiencia_con_acuerdo_si").prop("checked", true);
		}else if(ResultadoAudiencia == 2){
			$("#resultado_de_la_audiencia_con_acuerdo_no").prop("checked", true);
		}
		
		if(ApeloComisionMedicaCentral == 1){
			$("#seccion_apelacion_comision_medica_central").show();
			document.getElementById('btn_iniciar_apelacion_en_comision_medica_central').style.display = 'none';
		}
		if(ApeloJusticiaOrdinaria == 1){
			$("#seccion_gestion_judicial").show();
			document.getElementById('btn_iniciar_caso_justicia_ordinaria').style.display = 'none';			
		}
		
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
		$('#tabla_movimientos_comision_medica_central').stacktable();
		$('#tabla_movimientos_comision_medica_central').DataTable( {
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
				document.getElementById('desplegable_motivo_finalizacion_tramite').value = 0;
				document.getElementById("desplegable_motivo_finalizacion_tramite").disabled = true;	
			}else{
				var url = 'devolver_motivos_finalizacion_tramites_json';					
				$.ajax({
					type:"POST",					
					url:url,
					data:{tipoconsulta:tipoconsulta},
					success:function(rta){				
						
						document.getElementById("desplegable_motivo_finalizacion_tramite").disabled = false;								
						$('#desplegable_motivo_finalizacion_tramite').html(rta).fadeIn();								
						
					}
				});	
				
			}
		});	
		$("#btn_iniciar_apelacion_en_comision_medica_central").click(function(){
			
			document.getElementById('btn_iniciar_apelacion_en_comision_medica_central').style.display = 'none';			
			$("#seccion_apelacion_comision_medica_central").show();
			
		});			
		$("#btn_iniciar_caso_justicia_ordinaria").click(function(){
			
			document.getElementById('btn_iniciar_caso_justicia_ordinaria').style.display = 'none';
			$("#seccion_gestion_judicial").show();						
			
		});		
		$("#desplegable_motivo_finalizacion_tramite").change(function(){
			
			var tipomovimiento = $('#desplegable_motivo_finalizacion_tramite').val();
			
			if((tipomovimiento == 1) || (tipomovimiento == 5)){
				
				$("#div_resultado_de_la_audiencia").show();		
			
			}else{
				document.getElementById('div_resultado_de_la_audiencia').style.display = 'none';
				
			}
			if(tipomovimiento == 2){
				$("#div_fecha_acto_clausura").show();
			}else{
				document.getElementById('div_fecha_acto_clausura').style.display = 'none';
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

				//$("#div_apelo_camara_revisora_padre").show();		
			
			}
			
		});
		$("#resultado_de_la_audiencia_con_acuerdo_si").change(function(){
			
			if(document.getElementById('resultado_de_la_audiencia_con_acuerdo_si').checked) {

				//document.getElementById('div_apelo_camara_revisora_padre').style.display = 'none';			
			
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
		$("#resultado_del_acuerdo_justicia_ordinaria_si").change(function(){
			
			if(document.getElementById('resultado_del_acuerdo_justicia_ordinaria_si').checked) {

				document.getElementById('div_resultado_del_acuerdo').style.display = 'none';			
			
			}
			
		});
		$("#resultado_del_acuerdo_justicia_ordinaria_no").change(function(){
			
			if(document.getElementById('resultado_del_acuerdo_justicia_ordinaria_no').checked) {

				$("#div_resultado_del_acuerdo").show();			
			
			}
			
		});
		$('#btn_guardar_comision_medica').click(function(){				
			
			if(validarComisionMedica()){
				
				var id_consulta = $('#id_consulta_global').val();
				var id_comision_medica = $('#desplegable_comision_medica').val();
				var nombre_comision_medica = $("#desplegable_comision_medica option:selected").text();
				
				var url = 'guarda_comision_medica_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,id_comision_medica:id_comision_medica},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								break;
						  case 1:						  		
								document.getElementById('label_comision_medica').innerHTML=('<strong>Comisión Médica:</strong> '+ nombre_comision_medica);
								
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");							  
								$('#mensaje_abogado').html('La Comisión Médica se guardó con éxito.');							
								break;
						  default:
						  		$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");	
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');	
																									
						}
						$('#modal_agregar_comision_medica').modal('toggle');										
						$('#modal_mensaje').modal('show');
						
					}
				});		
			}
			
		});			
		$('#btn_eliminar_movimiento').click(function(){				
			
					  
			$("#formeliminarmovimiento").attr("action","eliminar_movimiento");	            
			$("#formeliminarmovimiento").submit();	
		
			
		});			
		$('#btn_guardar_movimiento_editar_CMC').click(function(){				
			
			if(validarEditarMovimientoCMC()){			  
				
				var tabla_movimientos_comision_medica_central = $('#tabla_movimientos_comision_medica_central').DataTable();				
				var id_consulta = $('#id_consulta_editar_movimiento_CMC').val();
				var id_movimiento_editar_movimiento_CMC = $('#id_movimiento_editar_movimiento_CMC').val();
				var fecha_nuevo_movimiento_editar_CMC = $('#fecha_nuevo_movimiento_editar_CMC').val();
				var editar_descripcion_CMC = $('#editar_descripcion_CMC').val();			
				
				var url = 'guarda_editar_movimiento_comision_medica_central_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,id_movimiento_editar_movimiento_CMC:id_movimiento_editar_movimiento_CMC,
						  fecha_nuevo_movimiento_editar_CMC:fecha_nuevo_movimiento_editar_CMC,
						  editar_descripcion_CMC:editar_descripcion_CMC},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								break;
						  case 1:
								document.getElementById('fecha_movimiento_original_CMC' + id_movimiento_editar_movimiento_CMC).value = fecha_nuevo_movimiento_editar_CMC;
								document.getElementById('fecha_movimiento_CMC' + id_movimiento_editar_movimiento_CMC).value = formato(fecha_nuevo_movimiento_editar_CMC);
								document.getElementById('detalle_movimiento_CMC' + id_movimiento_editar_movimiento_CMC).value = editar_descripcion_CMC;							
								
								document.getElementById('td_fecha_CMC_' + id_movimiento_editar_movimiento_CMC).innerHTML=(formato(fecha_nuevo_movimiento_editar_CMC));
								document.getElementById('td_detalle_CMC_' + id_movimiento_editar_movimiento_CMC).innerHTML=(editar_descripcion_CMC);
																		
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");							  
								$('#mensaje_abogado').html('La modificación del movimiento se guardó con éxito.');							
								break;
						  default:
						  		$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");	
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');	
																									
						}
						$('#modal_editar_movimiento_CMC').modal('toggle');										
						$('#modal_mensaje').modal('show');
						
					}
				});
			}
			
		});	
		$('#btn_eliminar_movimiento_CMC').click(function(){				
			
			var id_consulta = $('#id_consulta_eliminar_movimiento_CMC').val();
			var id_movimiento_eliminar_movimiento_CMC = $('#id_movimiento_eliminar_movimiento_CMC').val();
					
			var url = 'eliminar_movimiento_comision_medica_central_json';
			
			$.ajax({
				type:"POST",					
				url:url,
				data:{id_consulta:id_consulta,id_movimiento_eliminar_movimiento_CMC:id_movimiento_eliminar_movimiento_CMC},
				success:function(rta){					
					
					switch (parseInt(rta, 10)) {
						
					  case 0:
							$("#alerta_mensaje").removeClass("alert-success");
							$("#alerta_mensaje").addClass("alert-danger");							  
							$('#mensaje_abogado').html('Los datos no se pudieron borrar. Por favor, póngase en contacto con su administrador.');																	
							break;
					  case 1:								
							$("#fila_movimiento_CMC_" + id_movimiento_eliminar_movimiento_CMC).remove();
							$("#alerta_mensaje").removeClass("alert-danger");
							$("#alerta_mensaje").addClass("alert-success");							  
							$('#mensaje_abogado').html('El movimiento se eliminó con éxito.');							
							break;
					  default:
							$("#alerta_mensaje").removeClass("alert-success");
							$("#alerta_mensaje").addClass("alert-danger");	
							$('#mensaje_abogado').html('Los datos no se pudieron borrar. Por favor, póngase en contacto con su administrador.');	
																								
					}
					$('#modal_eliminar_movimiento_CMC').modal('toggle');										
					$('#modal_mensaje').modal('show');
					
				}
			});		
		
			
		});	
		$('#btn_eliminar_movimiento_JO').click(function(){				
										
			var id_consulta = $('#id_consulta_eliminar_movimiento_JO').val();
			var id_movimiento_eliminar_movimiento_JO = $('#id_movimiento_eliminar_movimiento_JO').val();
					
			var url = 'eliminar_movimiento_justicia_ordinaria_json';
			
			$.ajax({
				type:"POST",					
				url:url,
				data:{id_consulta:id_consulta,id_movimiento_eliminar_movimiento_JO:id_movimiento_eliminar_movimiento_JO},
				success:function(rta){					
					
					switch (parseInt(rta, 10)) {
						
					  case 0:
							$("#alerta_mensaje").removeClass("alert-success");
							$("#alerta_mensaje").addClass("alert-danger");							  
							$('#mensaje_abogado').html('Los datos no se pudieron borrar. Por favor, póngase en contacto con su administrador.');																	
							break;
					  case 1:
							$("#fila_movimiento_JO_" + id_movimiento_eliminar_movimiento_JO).remove();
							$("#alerta_mensaje").removeClass("alert-danger");
							$("#alerta_mensaje").addClass("alert-success");							  
							$('#mensaje_abogado').html('El movimiento se eliminó con éxito.');							
							break;
					  default:
							$("#alerta_mensaje").removeClass("alert-success");
							$("#alerta_mensaje").addClass("alert-danger");	
							$('#mensaje_abogado').html('Los datos no se pudieron borrar. Por favor, póngase en contacto con su administrador.');	
																								
					}
					$('#modal_eliminar_movimiento_JO').modal('toggle');										
					$('#modal_mensaje').modal('show');
					
				}
			});		
		
			
		});
		$('#btn_guardar_movimiento_editar_JO').click(function(){				
			
			if(validarEditarMovimientoJO()){
				
				var id_consulta = $('#id_consulta_editar_movimiento_JO').val();
				var id_movimiento_editar_movimiento_JO = $('#id_movimiento_editar_movimiento_JO').val();
				var fecha_nuevo_movimiento_editar_JO = $('#fecha_nuevo_movimiento_editar_JO').val();
				var editar_descripcion_JO = $('#editar_descripcion_JO').val();			
				
				var url = 'guarda_editar_movimiento_justicia_ordinaria_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,id_movimiento_editar_movimiento_JO:id_movimiento_editar_movimiento_JO,
						  fecha_nuevo_movimiento_editar_JO:fecha_nuevo_movimiento_editar_JO,
						  editar_descripcion_JO:editar_descripcion_JO},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								break;
						  case 1:
						  		document.getElementById('fecha_movimiento_original_JO' + id_movimiento_editar_movimiento_JO).value = fecha_nuevo_movimiento_editar_JO;
								document.getElementById('fecha_movimiento_JO' + id_movimiento_editar_movimiento_JO).value = formato(fecha_nuevo_movimiento_editar_JO);
								document.getElementById('detalle_movimiento_JO' + id_movimiento_editar_movimiento_JO).value = editar_descripcion_JO;							
								
								document.getElementById('td_fecha_JO_' + id_movimiento_editar_movimiento_JO).innerHTML=(formato(fecha_nuevo_movimiento_editar_JO));
								document.getElementById('td_detalle_JO_' + id_movimiento_editar_movimiento_JO).innerHTML=(editar_descripcion_JO);
								
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");							  
								$('#mensaje_abogado').html('La modificación del movimiento se guardó con éxito.');							
								break;
						  default:
						  		$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");	
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');	
																									
						}
						$('#modal_editar_movimiento_JO').modal('toggle');										
						$('#modal_mensaje').modal('show');
						
					}
				});		
			}
			
		});
		$('#btn_guardar_movimiento_CMC').click(function(){				
			
			if(validarNuevoMovimientoCMC()){			  
				
				var tabla_movimientos_comision_medica_central = $('#tabla_movimientos_comision_medica_central').DataTable();				
				var id_consulta = $('#id_consulta_global').val();
				var fecha_nuevo_movimiento_CMC = $('#fecha_nuevo_movimiento_CMC').val();
				var nuevo_movimiento_descripcion_CMC = $('#nuevo_movimiento_descripcion_CMC').val();
							
				
				var url = 'guarda_movimiento_comision_medica_central_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,fecha_nuevo_movimiento_CMC:fecha_nuevo_movimiento_CMC,
						  nuevo_movimiento_descripcion_CMC:nuevo_movimiento_descripcion_CMC},
					success:function(rta){					
						
						if ((parseInt(rta, 10)) == 0) {							
					
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								
						}else{		
								var id_movimiento = parseInt(rta, 10);
								
							    tabla_movimientos_comision_medica_central.row.add( [formato(fecha_nuevo_movimiento_CMC),
																					nuevo_movimiento_descripcion_CMC,
																					'<input type="hidden" name="id_movimiento_CMC'+id_movimiento+'" id="id_movimiento_CMC'+id_movimiento+'" value="'+id_movimiento+'">'+				 
																					'<input type="hidden" name="fecha_movimiento_CMC'+id_movimiento+'" id="fecha_movimiento_CMC'+id_movimiento+'" value="'+fecha_nuevo_movimiento_CMC+'">'+				 
																					'<input type="hidden" name="detalle_movimiento_CMC'+id_movimiento+'" id="detalle_movimiento_CMC'+id_movimiento+'" value="'+nuevo_movimiento_descripcion_CMC+'">'+				 
																					'<button style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_movimiento_CMC" id="'+id_movimiento+'" onclick="cargar_datos_movimiento_editar_CMC(this.id)">'+
																					'<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Editar">'+
																					'</button>'+
																					'<button style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar_movimiento_CMC" id="'+id_movimiento+'" onclick="cargar_datos_movimiento_eliminar_CMC(this.id)">'+
																					'<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="18" height="18" title="Eliminar">'+
																					'</button>']).draw( false );
								
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");							  
								$('#mensaje_abogado').html('El movimiento se guardó con éxito.');
								
						}
						$('#modal_agregar_movimiento_en_comision_medica_central').modal('toggle');										
						$('#modal_mensaje').modal('show');
						
					}
				});
			}
			
		});	
		$('#btn_guardar_movimiento_JO').click(function(){				
			
			if(validarNuevoMovimientoJO()){			  
				
				var tabla_movimientos_apelacion_justicia_ordinaria = $('#tabla_movimientos_apelacion_justicia_ordinaria').DataTable();
				var id_consulta = $('#id_consulta_global').val();
				var fecha_nuevo_movimiento_JO = $('#fecha_nuevo_movimiento_JO').val();
				var nuevo_movimiento_descripcion_JO = $('#nuevo_movimiento_descripcion_JO').val();
							
				
				var url = 'guarda_movimiento_justicia_ordinaria_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,fecha_nuevo_movimiento_JO:fecha_nuevo_movimiento_JO,
						  nuevo_movimiento_descripcion_JO:nuevo_movimiento_descripcion_JO},
					success:function(rta){												
						
						if ((parseInt(rta, 10)) == 0) {							
					
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								
						}else{		
								var id_movimiento = parseInt(rta, 10);
								
							    tabla_movimientos_apelacion_justicia_ordinaria.row.add( [formato(fecha_nuevo_movimiento_JO),
																						 nuevo_movimiento_descripcion_JO,
																						 '<input type="hidden" name="id_movimiento_JO'+id_movimiento+'" id="id_movimiento_JO'+id_movimiento+'" value="'+id_movimiento+'">'+				 
																						 '<input type="hidden" name="fecha_movimiento_JO'+id_movimiento+'" id="fecha_movimiento_JO'+id_movimiento+'" value="'+fecha_nuevo_movimiento_JO+'">'+				 
																						 '<input type="hidden" name="detalle_movimiento_JO'+id_movimiento+'" id="detalle_movimiento_JO'+id_movimiento+'" value="'+nuevo_movimiento_descripcion_JO+'">'+				 
																						 '<button style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_editar_movimiento_JO" id="'+id_movimiento+'" onclick="cargar_datos_movimiento_editar_JO(this.id)">'+
																						 '<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Editar">'+
																						 '</button>'+
																						 '<button style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar_movimiento_JO" id="'+id_movimiento+'" onclick="cargar_datos_movimiento_eliminar_JO(this.id)">'+
																						 '<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="18" height="18" title="Eliminar">'+
																						 '</button>']).draw( false );
								
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");							  
								$('#mensaje_abogado').html('El movimiento se guardó con éxito.');
								
						}
						$('#modal_agregar_movimiento_en_justicia_ordinaria').modal('toggle');										
						$('#modal_mensaje').modal('show');
						
					}
				});
			}
			
		});	
		$('#guardarmovimiento').click(function(){				
			
			if(validarMovimiento()){			  
				$("#formnuevomovimiento").attr("action","guardar_movimiento_consulta");	            
				$("#formnuevomovimiento").submit();	
			}
			
		});				
		$('#btn_guardar_datos_gestion_administrativa').click(function(){
			//console.log(validarNuevoAbogado());
							
				var id_consulta = $('#id_consulta_global').val();
				var tipoconsulta = $('#tipoconsulta').val();
				var fecha_incidente = $('#fecha_incidente').val();
				var fecha_audincia_con_aseguradora = $('#fecha_audincia_con_aseguradora').val();
				var fecha_entrevista_con_trabajador = $('#fecha_entrevista_con_trabajador').val();			
				var fecha_inicio_tramite = $('#fecha_inicio_tramite').val();
				var numero_expediente = $('#numero_expediente').val();
				//var solicitud_de_estudios_médicos_complementarios = $('#solicitud_de_estudios_médicos_complementarios').val();
				//var solicitud_de_documentacion_complementaria = $('#solicitud_de_documentacion_complementaria').val();				
				//var solicitud_de_prorroga = $('#solicitud_de_prorroga').val();				
				var fecha_audiencia_medica = $('#fecha_audiencia_medica').val();
				//var planteo_alegato = $('#planteo_alegato').val();
				var fecha_dictamen_medico = $('#fecha_dictamen_medico').val();
				var desplegable_motivo_finalizacion_tramite = $('#desplegable_motivo_finalizacion_tramite').val();
				var fecha_acto_clausura = $('#fecha_acto_clausura').val();
				var fecha_de_audiencia_de_acuerdo = $('#fecha_de_audiencia_de_acuerdo').val();
				//var resultado_de_la_audiencia_con_acuerdo = $('#resultado_de_la_audiencia_con_acuerdo').val();			
										
				if(document.getElementById('solicitud_de_estudios_médicos_complementarios_si').checked) {					
					var solicitud_de_estudios_médicos_complementarios = $('#solicitud_de_estudios_médicos_complementarios_si').val();				
				}else if(document.getElementById('solicitud_de_estudios_médicos_complementarios_no').checked){
					var solicitud_de_estudios_médicos_complementarios = $('#solicitud_de_estudios_médicos_complementarios_no').val();
				}				
				if(document.getElementById('solicitud_de_documentacion_complementaria_si').checked) {					
					var solicitud_de_documentacion_complementaria = $('#solicitud_de_documentacion_complementaria_si').val();				
				}else if(document.getElementById('solicitud_de_documentacion_complementaria_no').checked){
					var solicitud_de_documentacion_complementaria = $('#solicitud_de_documentacion_complementaria_no').val();
				}				
				if(document.getElementById('solicitud_de_prorroga_si').checked) {					
					var solicitud_de_prorroga = $('#solicitud_de_prorroga_si').val();				
				}else if(document.getElementById('solicitud_de_prorroga_no').checked){
					var solicitud_de_prorroga = $('#solicitud_de_prorroga_no').val();
				}				
				if(document.getElementById('planteo_alegato_si').checked) {					
					var planteo_alegato = $('#planteo_alegato_si').val();				
				}else if(document.getElementById('planteo_alegato_no').checked){
					var planteo_alegato = $('#planteo_alegato_no').val();
				}				
				if(document.getElementById('resultado_de_la_audiencia_con_acuerdo_si').checked) {					
					var resultado_de_la_audiencia_con_acuerdo = $('#resultado_de_la_audiencia_con_acuerdo_si').val();				
				}else if(document.getElementById('resultado_de_la_audiencia_con_acuerdo_no').checked){
					var resultado_de_la_audiencia_con_acuerdo = $('#resultado_de_la_audiencia_con_acuerdo_no').val();
				}							
				
				var url = 'guarda_datos_gestion_administrativa_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,tipoconsulta:tipoconsulta,fecha_incidente:fecha_incidente,fecha_audincia_con_aseguradora:fecha_audincia_con_aseguradora,fecha_entrevista_con_trabajador:fecha_entrevista_con_trabajador,
						  fecha_inicio_tramite:fecha_inicio_tramite,numero_expediente:numero_expediente,solicitud_de_estudios_médicos_complementarios:solicitud_de_estudios_médicos_complementarios,
						  solicitud_de_documentacion_complementaria:solicitud_de_documentacion_complementaria,solicitud_de_prorroga:solicitud_de_prorroga,fecha_audiencia_medica:fecha_audiencia_medica,
						  planteo_alegato:planteo_alegato,fecha_dictamen_medico:fecha_dictamen_medico,desplegable_motivo_finalizacion_tramite:desplegable_motivo_finalizacion_tramite,
						  fecha_acto_clausura:fecha_acto_clausura,fecha_de_audiencia_de_acuerdo:fecha_de_audiencia_de_acuerdo,resultado_de_la_audiencia_con_acuerdo:resultado_de_la_audiencia_con_acuerdo},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								break;
						  case 1:
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");							  
								$('#mensaje_abogado').html('Los datos de la gestión administrativa se guardaron con éxito.');							
								break;
						  default:
						  		$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");	
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');	
																									
						}
																
						$('#modal_mensaje').modal('show');
						
					}
				});				
			 							
		
		});			
		$('#btn_guardar_detalle_comision_medica_central').click(function(){
										
				var id_consulta = $('#id_consulta_global').val();
				var fecha_apelacion_comision_medica_central = $('#fecha_apelacion_comision_medica_central').val();
				var fecha_finalizacion_comision_medica_central = $('#fecha_finalizacion_comision_medica_central').val();
													
				if(document.getElementById('resultado_del_acuerdo_si').checked) {					
					var resultado_del_acuerdo = $('#resultado_del_acuerdo_si').val();				
				}else if(document.getElementById('resultado_del_acuerdo_no').checked){
					var resultado_del_acuerdo = $('#resultado_del_acuerdo_no').val();
				}				
				
				var url = 'guarda_datos_comision_medica_central_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,fecha_apelacion_comision_medica_central:fecha_apelacion_comision_medica_central,
						  fecha_finalizacion_comision_medica_central:fecha_finalizacion_comision_medica_central,
						  resultado_del_acuerdo:resultado_del_acuerdo},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								break;
						  case 1:
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");							  
								$('#mensaje_abogado').html('Los datos de la Comisión Médica Central se guardaron con éxito.');							
								break;
						  default:
						  		$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");	
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');	
																									
						}
																
						$('#modal_mensaje').modal('show');
						
					}
				});				
			 							
		
		});	
		$('#btn_guardar_detalle_justicia_ordinaria').click(function(){
										
				var id_consulta = $('#id_consulta_global').val();
				var numero_expediente_justicia_ordinaria = $('#numero_expediente_justicia_ordinaria').val();
				var fecha_apelacion_justicia_ordinaria = $('#fecha_apelacion_justicia_ordinaria').val();
				var juzgado_justicia_ordinaria = $('#juzgado_justicia_ordinaria').val();
				var caratula_justicia_ordinaria = $('#caratula_justicia_ordinaria').val();
				var fecha_sentencia_justicia_ordinaria = $('#fecha_sentencia_justicia_ordinaria').val();
				var fecha_resultado_del_acuerdo = $('#fecha_resultado_del_acuerdo').val();
				//var textarea_resultado_del_acuerdo = $('#textarea_resultado_del_acuerdo').val();
				var textarea_resultado_del_acuerdo = '';
													
				if(document.getElementById('resultado_del_acuerdo_justicia_ordinaria_si').checked) {					
					var resultado_del_acuerdo_justicia_ordinaria = $('#resultado_del_acuerdo_justicia_ordinaria_si').val();				
				}else if(document.getElementById('resultado_del_acuerdo_justicia_ordinaria_no').checked){
					var resultado_del_acuerdo_justicia_ordinaria = $('#resultado_del_acuerdo_justicia_ordinaria_no').val();
				}				
				
				var url = 'guarda_datos_justicia_ordinaria_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,numero_expediente_justicia_ordinaria:numero_expediente_justicia_ordinaria,fecha_apelacion_justicia_ordinaria:fecha_apelacion_justicia_ordinaria,
						  juzgado_justicia_ordinaria:juzgado_justicia_ordinaria,caratula_justicia_ordinaria:caratula_justicia_ordinaria,fecha_sentencia_justicia_ordinaria:fecha_sentencia_justicia_ordinaria,
						  fecha_resultado_del_acuerdo:fecha_resultado_del_acuerdo,textarea_resultado_del_acuerdo:textarea_resultado_del_acuerdo,
						  resultado_del_acuerdo_justicia_ordinaria:resultado_del_acuerdo_justicia_ordinaria},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								break;
						  case 1:
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");							  
								$('#mensaje_abogado').html('Los datos de la Justicia Ordinaria se guardaron con éxito.');							
								break;
						  default:
						  		$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");	
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');	
																									
						}
																
						$('#modal_mensaje').modal('show');
						
					}
				});				
			 							
		
		});	
		$('#guardareditartrabajador').click(function(){			
							
			var id_consulta = $('#id_consulta_editar_trabajador').val();
			var apellido = $('#editar_apellido').val();
			var nombre = $('#editar_nombre').val();
			var cuit = $('#editar_cuit').val();
			var telefono = $('#editar_telefono').val();
			var celular = $('#editar_telefono_celular').val();			
			var email = $('#editar_email').val();
			
			var url = 'guarda_datos_trabajador_json';
			
			if(validarTrabajador()){
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,apellido:apellido,nombre:nombre,
						  cuit:cuit,telefono:telefono,celular:celular,email:email},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								break;
						  case 1:
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");	

								$('#apellido_empleado').html('<strong>Apellido y Nombre:</strong> '+ $('#editar_apellido').val() +' '+ $('#editar_nombre').val());										
								$('#nombre_empleado').html('<strong>Cuit:</strong> '+ $('#editar_cuit').val());
								$('#telefono_empleado').html('<strong>Teléfono:</strong> '+ $('#editar_telefono').val());
								$('#celular_empleado').html('<strong>Celular:</strong> '+ $('#editar_telefono_celular').val());			
								$('#email_empleado').html('<strong>E-mail:</strong> '+ $('#editar_email').val());
								
								$('#mensaje_abogado').html('Los datos del trabajador se guardaron con éxito.');							
								break;
						  default:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");	
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');	
																									
						}
						$('#modal_editar_trabajador').modal('toggle');										
						$('#modal_mensaje').modal('show');
						
					}
				});	
				
			}
		});	
		$('#guardareditarempleador').click(function(){			
							
			var id_consulta = $('#id_consulta_editar_empleador').val();
			var razon_social = $('#editar_razon_social').val();			
			var cuit = $('#editar_cuit_empleador').val();
			var telefono = $('#editar_telefono_empleador').val();
			var celular = $('#editar_telefono_celular_empleador').val();			
			var email = $('#editar_email_empleador').val();
			
			var url = 'guarda_datos_empleador_json';
			
			if(validarEmpleador()){
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,razon_social:razon_social,
						  cuit:cuit,telefono:telefono,celular:celular,email:email},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								break;
						  case 1:
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");	
								
								$('#razon_social_empleador').html('<strong>Razón social:</strong> '+ $('#editar_razon_social').val());			
								$('#cuit_empleador').html('<strong>Cuit:</strong> '+ $('#editar_cuit_empleador').val());
								$('#telefono_empleador').html('<strong>Teléfono:</strong> '+ $('#editar_telefono_empleador').val());
								$('#celular_empleador').html('<strong>Celular:</strong> '+ $('#editar_telefono_celular_empleador').val());			
								$('#email_empleador').html('<strong>E-mail:</strong> '+ $('#editar_email_empleador').val());
								
								$('#mensaje_abogado').html('Los datos del empleador se guardaron con éxito.');							
								break;
						  default:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");	
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');	
																									
						}
						$('#modal_editar_empleador').modal('toggle');										
						$('#modal_mensaje').modal('show');
						
					}
				});					 							
			}
		});
		$('#btn_agregar_nota_modal').click(function(){			
							
			var id_consulta = $('#id_consulta_agregar_notas').val();
			var nota = $('#agregar_notas').val();			
						
			var url = 'guarda_notas_json';
			
			if(validarNota()){
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{id_consulta:id_consulta,nota:nota},
					success:function(rta){					
						
						switch (parseInt(rta, 10)) {
							
						  case 0:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");							  
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');																	
								break;
						  case 1:
								$("#alerta_mensaje").removeClass("alert-danger");
								$("#alerta_mensaje").addClass("alert-success");									
								buscar_notas_json(id_consulta);
								document.getElementById('agregar_notas').value = '';									
								$('#mensaje_abogado').html('Las notas se guardaron con éxito.');							
								break;
						  default:
								$("#alerta_mensaje").removeClass("alert-success");
								$("#alerta_mensaje").addClass("alert-danger");	
								$('#mensaje_abogado').html('Los datos no se pudieron guardar. Por favor, póngase en contacto con su administrador.');	
																									
						}
						$('#modal_agregar_nota').modal('toggle');										
						$('#modal_mensaje').modal('show');
						
					}
				});					 							
			}
		});			
	});
	
	function buscar_notas_json(id_consulta){
		
		var url = 'devolver_notas_json';
		$.ajax({
			type:"POST",					
			url:url,
			data:{id_consulta:id_consulta},
			success:function(rta){					
				
				$('#label_notas').html(rta);	
				
			}
		});
		
	}
	
	
	function cargar_datos_movimiento_editar_CMC(obj){
		
		$(".estilos-errores").remove();
		var id_movimiento_CMC = $("#id_movimiento_CMC"+obj).val();	
		var fecha_movimiento_CMC = $("#fecha_movimiento_original_CMC"+obj).val();	
		var detalle_movimiento_CMC = $("#detalle_movimiento_CMC"+obj).val();	
		
		document.getElementById('id_movimiento_editar_movimiento_CMC').value = id_movimiento_CMC;
		document.getElementById('fecha_nuevo_movimiento_editar_CMC').value = fecha_movimiento_CMC;		
		document.getElementById('editar_descripcion_CMC').value = detalle_movimiento_CMC;
		
	}	
	function cargar_datos_movimiento_editar_JO(obj){
		
		$(".estilos-errores").remove();
		var id_movimiento_JO = $("#id_movimiento_JO"+obj).val();	
		var fecha_movimiento_JO = $("#fecha_movimiento_original_JO"+obj).val();	
		var detalle_movimiento_JO = $("#detalle_movimiento_JO"+obj).val();	
			
		document.getElementById('id_movimiento_editar_movimiento_JO').value = id_movimiento_JO;
		document.getElementById('fecha_nuevo_movimiento_editar_JO').value = fecha_movimiento_JO;		
		document.getElementById('editar_descripcion_JO').value = detalle_movimiento_JO;
				
	}	
	function cargar_datos_movimiento_eliminar_CMC(obj){
					
		var fecha = $("#fecha_movimiento_CMC"+obj).val();	
		var detalle = $("#detalle_movimiento_CMC"+obj).val();
		
		document.getElementById('id_movimiento_eliminar_movimiento_CMC').value = obj;
		document.getElementById('fecha_ver_movimiento_CMC').innerHTML=("<strong>Fecha: </strong>" + fecha);
		document.getElementById('detalle_ver_movimiento_CMC').innerHTML=("<strong>Descripción: </strong>" + detalle);
		
	}
	function cargar_datos_movimiento_eliminar_JO(obj){
					
		var fecha = $("#fecha_movimiento_JO"+obj).val();	
		var detalle = $("#detalle_movimiento_JO"+obj).val();
		
		document.getElementById('id_movimiento_eliminar_movimiento_JO').value = obj;
		document.getElementById('fecha_ver_movimiento_JO').innerHTML=("<strong>Fecha: </strong>" + fecha);
		document.getElementById('detalle_ver_movimiento_JO').innerHTML=("<strong>Descripción: </strong>" + detalle);
		
	}
	function cagar_datos_finalizar(obj){	
			
		document.getElementById('id_consulta_finalizar').value = obj;
		document.getElementById('numero_causa_finalizar').innerHTML=(obj);		
	
	}	
	function cagar_datos_agregar_comision_medica(obj){	
			
		document.getElementById('id_consulta_guardar_comision_medica').value = obj;		
	
	}	
	function cagar_datos_editar_trabajador(obj){	
			
		document.getElementById('id_consulta_editar_trabajador').value = obj;		
	
	}	
	function cagar_datos_editar_empleador(obj){	
			
		document.getElementById('id_consulta_editar_empleador').value = obj;		
	
	}
	function formato(texto){
		return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3-$2-$1');
	}
	function formato_original(texto){
		return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$1-$2-$3');
	}
	function valida_cadena(event, el){//Validar nombre	
		//Obteniendo posicion del cursor 
		var val = el.value;//Valor de la caja de texto
		var pos = val.slice(0, el.selectionStart).length;
		
		var out = '';//Salida
		var filtro = '0123456789';
		var v = 0;//Contador de caracteres validos
		
		//Filtar solo los numeros
		for (var i=0; i<val.length; i++){
		   if (filtro.indexOf(val.charAt(i)) != -1){
			 v++;
			 out += val.charAt(i);		   
			 //Agregando un espacio cada 4 caracteres
			 //if((v==4) || (v==8) || (v==12))
				 //out+=' ';
		   }
		}
		//Reemplazando el valor
		el.value = out;
		
		//En caso de modificar un numero reposicionar el cursor
		//if(event.keyCode==8){//Tecla borrar precionada
			//el.selectionStart = pos;
			//el.selectionEnd = pos;
		//}
	}
	</script>
  </body>
</html>