<h5 style="color:#016887;padding-top:5px">Sorteos</h5>
<div class="container">
	<form action=""  method="post" enctype="multipart/form-data" name="formFiltroSorteos" id="formFiltroSorteos"> 
	  <div class="row">
	  
		<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">				
			<input style="margin-top:3px;margin-botom:3px" onclick="deshabilita_numerosorteo()" type="date" class="form-control" placeholder="Fecha desde" id="fechadesde" name="fechadesde" value="<?php echo $fechadesde?>">
		</div>	
		
		<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">			
		  <input style="margin-top:3px;margin-botom:3px" onclick="deshabilita_numerosorteo()" type="date" class="form-control" placeholder="Fecha hasta" id="fechafin" name="fechafin" value="<?php echo $fechahasta?>">
		</div>
		
		<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">		
								
			<select  style="margin-top:3px;margin-botom:3px" onclick="deshabilita_numerosorteo()" name="desplegableestadoconsultafiltro" id="desplegableestadoconsultafiltro" class="form-control">
				<option value="0" selected>Seleccione un estado</option>												
				  <?php foreach ($estado_consultas_filtro as $estado){ ?>						
												
						<?php if( $estado['IdEstadoConsulta'] == $estado_actual){?>														
								<option selected value="<?php echo $estado['IdEstadoConsulta']?>"><?php echo $estado['NombreEstadoConsulta']?></option>
						<?php }else{?>
								<option  value="<?php echo $estado['IdEstadoConsulta']?>"><?php echo $estado['NombreEstadoConsulta']?></option>
						<?php }?>									  
												  
				  <?php }?>				
			</select>
			
		</div>
		
		<div class="col-sm-12 col-md-12 col-lg-3 col-xl-2">
		  <input  style="margin-top:3px;margin-botom:3px" onclick="deshabilita_filtro_fechas()" type="text" class="form-control" id="numerosorteo" name="numerosorteo" placeholder="Número de sorteo">
		</div>	
	
		<div class="col-sm-12 col-md-12 col-lg-3 col-xl-1">
		  <button  style="margin-top:3px;margin-botom:3px" type="button" id="btn_buscar_sorteos" class="btn btn-primary">Buscar</button>
		</div>	
		
	  </div>
	</form>
	
</div>
<br>
<div class="card">
	<div class="card-body">
		<table id="tabla-sorteos" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th scope="col">Nro. Sorteo</th>
			  <th>Fecha</th>
			  <th>Solicitantes</th>			 
			  <th>Cuit Consultante</th>			 
			  <th>Abogado</th>		
			  <th>Cuit Abogado</th>	
			  <th>Partido</th>
			  <th>Estado</th>
			  <th style='width:12%'>Acción</th>
			</tr>
		  </thead>
		  <tbody>
		
		<?php foreach ($causas_sorteadas as $sorteos){?>		  
			<tr>	
				<input type="hidden" name="abogado_consulta<?php echo $sorteos['IdConsulta']?>" id="abogado_consulta<?php echo $sorteos['IdConsulta']?>" value="<?php echo $sorteos['apellido_abogado'].' '.$sorteos['nombre_abogado']?>">
				<input type="hidden" name="motivo_recusado<?php echo $sorteos['IdConsulta']?>" id="motivo_recusado<?php echo $sorteos['IdConsulta']?>" value="<?php echo $sorteos['Motivo']?>">
				
				<td><?php echo $sorteos['IdConsulta']?></td>											
				<td><?php echo $sorteos['FechaSorteo']?></td>											
				<td><?php echo $sorteos['Apellido'],', '.$sorteos['Nombre']?></td>
				<td><?php echo $sorteos['Cuit']?></td>
				<td><?php echo $sorteos['apellido_abogado'],', '.$sorteos['nombre_abogado']?></td>
				<!--
				<td>
				<?php/*
					if(!empty($sorteos['tomo_abogado'])){
							echo 'Tomo: '.$sorteos['tomo_abogado'],', '.'Folio: '.$sorteos['folio_abogado'];
					}else{
						echo 'Matrícula: '.$sorteos['matricula_abogado'];
					}*/
				?>
				
				</td>
				-->
				<td><?php echo $sorteos['cuit_abogado']?></td>																								
				<td><?php echo $sorteos['NombrePartido']?></td>																
				<td  style="text-align:center">
					<?php 
					echo $sorteos['NombreEstadoConsulta'];
					
					if(($sorteos['IdEstadoConsulta'] == 2) or ($sorteos['IdEstadoConsulta'] == 3)){
					?>
						<button type="button" class="btn btn-outline-danger btn-sm" onclick="cargar_motivo_recusado(<?php echo $sorteos['IdConsulta']?>)">Motivo</button>
					<?php 
					}					
					?>
				
				</td>																
				<td>
					<div class="form-inline">
										 
						<button style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_ver_sorteo" id="<?php echo $sorteos['IdConsulta']?>" onclick="cargar_datos_sorteo(this.id)">
							<img src="<?php echo base_url(); ?>/imagenes/ver.png" width="18" height="18" title="Ver Sorteo">
						</button>
						<?php if($sorteos['Aplica'] == "I"){?>
						
							<button style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_recusar" id="<?php echo $sorteos['IdConsulta']?>" onclick="cagar_suspencion(this.id)">
								<img src="<?php echo base_url(); ?>/imagenes/excusarme_blanco.png" width="18" height="18" title="Recusar">
							</button>	
						
						<?php }?>
						<?php if($sorteos['Aplica'] <> "I"){?>
							
							<button style="margin-right:3px" type="button" class="btn btn-success btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_cambiar_sorteo_a_estado_pendiente" id="<?php echo $sorteos['IdConsulta']?>" onclick="cagar_sorteo_cambiar_estado(this.id)">
								<img src="<?php echo base_url(); ?>/imagenes/baseline_undo_white_24dp.png" width="18" height="18" title="Volver Sorteo a Estado Pendiente">
							</button>						
						
						<?php }?>						
						<?php if((($perfil_usuario == 2) or ($perfil_usuario == 6)) and ($sorteos['IdEstadoConsulta'] <> 4)){?>
						
								<form class="form-inline" action="ver_movimientos_de_consulta" method="post" enctype="multipart/form-data" id="formvermovimientos" name="formvermovimientos">
									<input type="hidden" name="id_consulta_ver_movimientos" id="id_consulta_ver_movimientos" value="<?php echo $sorteos['IdConsulta']?> ">
									<button style="margin-right:3px" type="submit" class="btn btn-warning btn-sm">
										<img src="<?php echo base_url(); ?>/imagenes/lista_blanco.png" width="18" height="18" title="Ver movimientos de la causa">
									</button>						
								</form>
								
						<?php }?>
						<form class="form-inline" action="reimprimir_comprobante_sorteo" method="post" enctype="multipart/form-data" id="descargarpdf" name="descargarpdf">
							<input type="hidden" name="id_consulta" id="id_consulta" value="<?php echo $sorteos['IdConsulta']?> ">
							<button style="margin-right:3px" type="submit" class="btn btn-secondary btn-sm">
								<img src="<?php echo base_url(); ?>/imagenes/impresora_blanca.png" width="18" height="18" title="Imprimir Sorteo">
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
<div class="modal fade" id="modal_ver_sorteo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Datos de sorteo <b><label style="color:red" id="Id_datos_sorteo"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">						
				<div id="datos_de_sorteo"></div>		
				<div class="modal-footer">				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>									
			</form>					
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_recusar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel" style="color:red">¡Atención!</h5>		
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>		
		</div>			
		<div class="modal-body">		
			<form action="" method="post" enctype="multipart/form-data" id="formrecusar" name="formrecusar">					
				<input type="hidden" name="id_consulta_recusar" id="id_consulta_recusar" value="">
				<div class="form-group">						
					<div style="color:red"> ¿Esta seguro que quiere <b>RECUSAR</b> al abogado <b><label id="abogado_recusar"></label></b>?</div>				
					<div class="form-group">						
						<div>Por favor, indique tipo de recusación y el motivo.</div>						
					</div>
					
					<div class="form-group">
						<!--
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="quiensolicita" id="faltadelabogado" value="1">
							  <label class="form-check-label" for="faltadelabogado">Por falta del abogado</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="quiensolicita" id="pedidoporelcliente" value="2">
							  <label class="form-check-label" for="pedidoporelcliente">Pedido por la persona solicitante</label>
							</div>
						-->
						
							<label>Tipo de recusación</label>
							<select name="desplegableestadoconsulta" id="desplegableestadoconsulta" class="form-control required" data-required="true">
								<option value="0">Seleccione un tipo</option>												
								  <?php foreach ($estado_consultas as $estado){ ?>					
										<option  value="<?php echo $estado['IdEstadoConsulta']?>"><?php echo $estado['NombreEstadoConsulta']?></option>
								  <?php }?>				
							</select>						
						
						
						<label id="mensaje_responsable" style="display:none;color:red"><b>Debe seleccionar por quien se recusa la causa</b></label>
					</div>	
					<div class="row form-group">
					
						<div class="col-sm-12">
							<label>Motivo</label>
							<textarea name="motivo" id="motivo" type="text" rows="5" class="form-control" value=""></textarea>						
						</div>						    
					</div>
														
				</div>
						
				<div class="modal-footer">					
					<button type="button" id="btn_recusar" class="btn btn-danger">Recusar</button>				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>									
			</form>				
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_cambiar_sorteo_a_estado_pendiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel" style="color:red">¡Atención!</h5>		
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>		
		</div>			
		<div class="modal-body">		
			<form action="" method="post" enctype="multipart/form-data" id="formcambiarestado" name="formcambiarestado">					
				<input type="hidden" name="id_consulta_cambiar_a_estado_pendiente" id="id_consulta_cambiar_a_estado_pendiente" value="">
				<div class="form-group">						
					<div style="color:red"> ¿Esta seguro que quiere cambiar el Sorteo <b><label id="numero_sorteo"></label></b> a estado <b>Pendiente</b>?</div>																
				</div>
						
				<div class="modal-footer">					
					<button type="button" id="btn_cambiar_estado" class="btn btn-danger">Cambiar estado</button>				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>									
			</form>				
		</div> 
	</div>
  </div>
</div>
<div class="modal fade " id="modal_mensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Mensaje para el Usuario</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">
			<div class="alert alert-success"  role="alert">					
				<div class="form-group">
					<h5>¡Atención!</h5>
					<div  id="mensaje"></div>						
				</div>
			</div>		
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>													
			</div>							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_ver_motivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Motivo Recusación de <b><label style="color:red" id="abogado_recusado"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">						
			<div id="div_motivo_recusado"></div>						
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		</div>			
	</div>
  </div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		
		$('#btn_buscar_sorteos').on('click', function() {
			
			if(validaFiltro()){
				
				$("#formFiltroSorteos").attr("action","sorteos");	            
				$("#formFiltroSorteos").submit();	
				
			}
			
		});
		$('#btn_cambiar_estado').click(function(){			
		
			$("#formcambiarestado").attr("action","volver_sorteo_a_estado_pendiente");	            
			$("#formcambiarestado").submit();	
		
		});	
		$('#btn_recusar').click(function(){
			
			if(validarRecusar()){
				$("#formrecusar").attr("action","guardar_recusacion");	            
				$("#formrecusar").submit();	
			}
		});	
		$('#tabla-sorteos').stacktable();
		$('#tabla-sorteos').DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 0, "asc" ]],
			"paging": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});	
					
	});
	function validarRecusar(){

		var validadoOK = true;
		
		var motivo = $("#motivo").val();		
		var desplegableestadoconsulta = $("#desplegableestadoconsulta").val();		
					
		if((motivo.length == 0) || (desplegableestadoconsulta == 0)){			
			
			if (motivo.length == 0){agregaMensajeValidacion($("#motivo"), "Debe ingresar un motivo")};	
			if (desplegableestadoconsulta == 0){agregaMensajeValidacion($("#desplegableestadoconsulta"), "Seleccione un estado")};				
			
			validadoOK = false;		
	
		}
		/*
		if((!document.getElementById('faltadelabogado').checked) && (!document.getElementById('pedidoporelcliente').checked)){			
			
			$("#mensaje_responsable").show();					
			
			validadoOK = false;		
	
		}
		*/		
		
		return validadoOK;
		
	}
	function validaFiltro(){

		var validadoOK = true;
		
		var fechadesde = $("#fechadesde").val();
		var fechafin = $("#fechafin").val();
		var desplegableestadoconsultafiltro = $("#desplegableestadoconsultafiltro").val();
		var numerosorteo = $("#numerosorteo").val();	
			
		if($("#numerosorteo").prop('disabled') == true){
			
			if(fechadesde > fechafin){
				
				agregaMensajeValidacion($("#fechadesde"), "La fecha de inicio debe ser mayor a la fecha fin");
				validadoOK = false;	
				
			}
			
			if((fechadesde.length == 0) || (fechafin.length == 0) || (desplegableestadoconsultafiltro == 0)){			
				
				if (fechadesde.length == 0){agregaMensajeValidacion($("#fechadesde"), "Seleccione una fecha")};	
				if (fechafin.length == 0){agregaMensajeValidacion($("#fechafin"), "Seleccione una fecha")};	
				if (desplegableestadoconsultafiltro == 0){agregaMensajeValidacion($("#desplegableestadoconsultafiltro"), "Seleccione un estado")};	
				
				validadoOK = false;		
		
			}
		}
		
		if($("#fechadesde").prop('disabled') == true){			
				
			if(numerosorteo.length == 0){
				
				agregaMensajeValidacion($("#numerosorteo"), "Debe ingresar un número de sorteo");
				validadoOK = false;	
			
			}					
			
		}
		return validadoOK;
		
	}
	function cargar_datos_sorteo(obj){
		
		var url = 'devolver_consulta_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			
			data:{idconsulta:obj},
			success:function(rta){
				
				$('#datos_de_sorteo').html(rta);					
				$('#modal_ver_sorteo').modal('show');		
				
			}
		});
	
	}
	function cagar_suspencion(obj){	
		
		$("#formrecusar").trigger("reset");
		$(".estilos-errores").remove();
		$("#faltadelabogado").prop("checked", false);
		$("#pedidoporelcliente").prop("checked", false);
		document.getElementById('mensaje_responsable').style.display = 'none';
		document.getElementById("motivo").value = "";
		document.getElementById('id_consulta_recusar').value = obj;
		document.getElementById('abogado_recusar').innerHTML=($('#abogado_consulta'+obj).val());		
	
	}	
	function cargar_motivo_recusado(obj){	
		
		var motivo_recusado = $("#motivo_recusado"+obj).val();
		document.getElementById('div_motivo_recusado').innerHTML=(motivo_recusado);	
		document.getElementById('abogado_recusado').innerHTML=($('#abogado_consulta'+obj).val());
		$('#modal_ver_motivo').modal('show');		
	
	}	
	function cagar_sorteo_cambiar_estado(obj){			

		$(".estilos-errores").remove();
		document.getElementById('id_consulta_cambiar_a_estado_pendiente').value = obj;
		document.getElementById('numero_sorteo').innerHTML=(obj);		
	
	}	
	function deshabilita_numerosorteo(){	
			
		document.getElementById('numerosorteo').disabled = true;
		document.getElementById('fechadesde').disabled = false;		
		document.getElementById('fechafin').disabled = false;		
		document.getElementById('desplegableestadoconsultafiltro').disabled = false;
		
		document.getElementById('numerosorteo').value = '';		
			
	}		
	function deshabilita_filtro_fechas(){	
			
		document.getElementById('numerosorteo').disabled = false;
		document.getElementById('fechadesde').disabled = true;		
		document.getElementById('fechafin').disabled = true;		
		document.getElementById('desplegableestadoconsultafiltro').disabled = true;

		document.getElementById('fechadesde').value = '';
		document.getElementById('fechafin').value = '';
		document.getElementById('desplegableestadoconsultafiltro').value = 0;		
	
	}	
	</script>
  </body>
</html>