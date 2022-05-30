<h5 style="color:#016887;padding-top:5px">Sorteos</h5>
<div class="card">
	<div class="card-body">
		<table id="tabla-sorteos" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th scope="col">Nro. Sorteo</th>
			  <th>Fecha</th>
			  <th>Solicitantes</th>	
			  <th>Cuit</th>
			  <th>Teléfono</th>
			  <th>E-mail</th>
			  <th>Partido</th>
			  <th>Estado</th>
			  <th style='width:18%'>Acción</th>			  
			</tr>
		  </thead>
		  <tbody>
		
		<?php foreach ($causas_sorteadas as $sorteos){?>		  
			<tr>			
				<td><?php echo $sorteos['IdConsulta']?></td>											
				<td><?php echo date("d-m-Y",strtotime($sorteos['FechaSorteo']))?></td>											
				<td><?php echo $sorteos['Apellido'],', '.$sorteos['Nombre']?></td>
				<td><?php echo $sorteos['Cuit']?></td>																
				<td><?php echo $sorteos['Telefono']?></td>																
				<td><?php echo $sorteos['Email']?></td>																
				<td><?php echo $sorteos['NombrePartido']?></td>																
				<td><?php echo $sorteos['NombreEstadoConsulta']?></td>																
				<td>
					<div class="form-inline">
										 
						<button style="margin-right:3px" type="button" class="btn btn-primary btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_ver_sorteo" id="<?php echo $sorteos['IdConsulta']?>" onclick="cargar_datos_sorteo(this.id)">
							<img src="<?php echo base_url(); ?>/imagenes/ver.png" width="18" height="18" title="Ver Sorteo">
						</button>
						
						<?php if($sorteos['IdEstadoConsulta'] == 4){?>
						<!--
						<form class="form-inline" action="aceptar_consulta" method="post" enctype="multipart/form-data" id="formaceptarconsulta" name="formaceptarconsulta">
							<input type="hidden" name="id_aceptar_consulta" id="id_aceptar_consulta" value="<?php //echo $sorteos['IdConsulta']?> ">
							<button style="margin-right:3px" type="submit" class="btn btn-success btn-sm">
								<img src="<?php //echo base_url(); ?>/imagenes/aceptar.png" width="18" height="18" title="Aceptar">
							</button>					
						</form>
						-->
						<button style="margin-right:3px" type="button" class="btn btn-success btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_aceptar_causa" id="<?php echo $sorteos['IdConsulta']?>" onclick="cagar_datos_aceptar(this.id)">
							<img src="<?php echo base_url(); ?>/imagenes/aceptar.png" width="18" height="18" title="Aceptar">
						</button>	
						<?php }?>
						
						<?php //if(($sorteos['IdEstadoConsulta'] == 7) or ($sorteos['IdEstadoConsulta'] == 8)){?>
						<?php if(($sorteos['IdEstadoConsulta'] == 8) or (($sorteos['Aplica'] <> "I") or ($sorteos['Aplica'] <> "C")) and ($sorteos['IdEstadoConsulta'] == 7)){?>	
						<form class="form-inline" action="ver_movimientos_de_consulta" method="post" enctype="multipart/form-data" id="formvermovimientos" name="formvermovimientos">
							<input type="hidden" name="id_consulta_ver_movimientos" id="id_consulta_ver_movimientos" value="<?php echo $sorteos['IdConsulta']?> ">
							<button style="margin-right:3px" type="submit" class="btn btn-info btn-sm">
								<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Gestión de la causa">
							</button>
						</form>
						<?php }?>
						
						<?php //if(($sorteos['IdEstadoConsulta'] <> 8) and ($sorteos['IdEstadoConsulta'] <> 1) and ($sorteos['IdEstadoConsulta'] <> 2) and ($sorteos['IdEstadoConsulta'] <> 3) and ($sorteos['IdEstadoConsulta'] <> 5)){?>
						<?php //if($sorteos['Aplica'] == "I"){?>	
						
						<?php if($sorteos['IdEstadoConsulta'] == 4){?>	
							<button style="margin-right:3px" type="button" class="btn btn-warning btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_mensaje_excusarme" id="<?php echo $sorteos['IdConsulta']?>" onclick="cagar_suspencion(this.id)">
								<img src="<?php echo base_url(); ?>/imagenes/excusarme_blanco.png" width="18" height="18" title="Excusarme">
							</button>						
							<?php if(date("Y-m-d",strtotime('+7 day',strtotime($sorteos['FechaSorteo']))) <= date("Y-m-d")){?>
								<button style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_mensaje_excusarme" id="<?php echo $sorteos['IdConsulta']?>" onclick="cagar_datos_el_trabajador_no_se_presento(this.id)">
									<img src="<?php echo base_url(); ?>/imagenes/tiempo_fuera.png" width="18" height="18" title="El trabajador no se presentó">
								</button>	
							<?php }?>
						<?php }?>
						<!--
						<form class="form-inline" action="reimprimir_comprobante_sorteo" method="post" enctype="multipart/form-data" id="descargarpdf" name="descargarpdf">
							<input type="hidden" name="id_consulta" id="id_consulta" value="<?php //echo $sorteos['IdConsulta']?> ">
							<button style="margin-right:3px" type="submit" class="btn btn-secondary btn-sm">
								<img src="<?php //echo base_url(); ?>/imagenes/impresora_blanca.png" width="18" height="18" title="Imprimir Sorteo">
							</button>
						</form>
						-->
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
<div class="modal fade" id="modal_mensaje_excusarme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
			<form class="" action="" method="post" enctype="multipart/form-data" id="formexcusarme" name="formexcusarme">					
				<input type="hidden" name="id_consulta_excusarme" id="id_consulta_excusarme" value="">
				<div class="form-group">						
									
					<div class="form-group">
						
						<div style="color:red">¿Esta seguro que quiere <b>EXCUSARSE</b> del sorteo <b><label id="datos_sorteo"></label></b>?</div>						
					</div>
					<div class="form-group">
						<label>Tipo de excusación</label>
						<select name="desplegableestadoconsulta" id="desplegableestadoconsulta" class="form-control required" data-required="true">
							<option value="0">Seleccione un tipo</option>						  				
						</select>						
					</div>
					<div class="form-group" id="motivo_excusacion">
						<label>Motivo de excusación</label>
						<select name="desplegablemotivoexcusacion" id="desplegablemotivoexcusacion" class="form-control required" data-required="true">							
							<option value="0">Seleccione un motivo</option>						  				
							<?php foreach ($motivos_excusaciones as $motivos){?>
								<option  value="<?php echo $motivos['IdMotivoExcusacion']?>"><?php echo $motivos['NombreMotivoExcusacion']?></option>
							<?php }?>
						</select>						
					</div>
					
					<!--
					<div class="row form-group">
						<div class="col-sm-12">
							<label>Motivo</label>
							<textarea name="motivo" id="motivo" type="text" rows="7" class="form-control" value=""></textarea>						
						</div>						    
					</div>
					-->									
				</div>
						
				<div class="modal-footer">					
					<button type="button" id="btn_excusame" class="btn btn-danger">Excusarme</button>				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
						<div style="color:red">¿Esta seguro que quiere <b>FINALIZAR</b> la causa <b><label id="numero_causa_finalizar"></label></b>?</div>						
					</div>
					
				</div>
						
				<div class="modal-footer">					
					<button type="submit" id="btn_finalizar" class="btn btn-danger">Finalizar causa</button>				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				</div>									
			</form>				
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="modal_aceptar_causa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
			<form class="" action="aceptar_consulta" method="post" enctype="multipart/form-data" id="formaceptarcausa" name="formaceptarcausa">					
				<input type="hidden" name="id_aceptar_consulta" id="id_aceptar_consulta" value="">
				<div class="form-group">						
									
					<div class="form-group">						
						<div>
							Usted esta a punto de <b>ACEPTAR</b> la causa <b><label id="numero_causa_aceptar"></b>.</label>
							
							<label>Antes de aceptar el caso comuníquese con el trabajador para interiorizarse sobre el mismo.</label>
							<label>
							Ante cualquier duda sobre el funcionamiento del Sistema ACOM 
							usted podrá consultar el <a href='https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub'>manual de usuario</a> desde <a href='https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub'>aquí</a>. 
							
							</label>
					
						</div>
						<br>
						<label> ¿Está seguro que quiere patrocinar esta causa?</label>
						
					</div>
					
				</div>
						
				<div class="modal-footer">					
					<button type="submit" id="btn_finalizar" class="btn btn-success">Aceptar causa</button>				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
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
<!-- Modal modal cambiar contrasena-->
<div class="modal fade" id="modal_cambiar_contrasena" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Administración de Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	 	<div class="modal-body">
			<div class="alert alert-warning" role="alert">
			 <label><strong> <h5>¡Atención!</h5> Recomendamos cambiar su Contraseña.<br> Para cambiar su contraseña, diríjase al menú desplegable con su nombre y seleccione <br>"Cambiar contraseña".</strong></label>
			</div>
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
		
		var mensaje_cambiar_contrasena = '<?php echo $mensaje_cambiar_contrasena?>';
		if(mensaje_cambiar_contrasena){
			$('#modal_cambiar_contrasena').modal('show');	
		}	
		
		$('#btn_excusame').click(function(){	
						
			if(validarExcusacion()){	
				$("#formexcusarme").attr("action","guardar_excusacion");	            
				$("#formexcusarme").submit();	
			}
			
		});
		
		$('#tabla-sorteos').stacktable();
		$('#tabla-sorteos').DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			"ordering": false,
			//"order": [[ 7, "asc" ]],
			"paging": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});
		$("#desplegableestadoconsulta").change(function(){
			var estadoconsulta = $('#desplegableestadoconsulta').val();			
			
			if(estadoconsulta == 5){
				document.getElementById('desplegablemotivoexcusacion').value = 0;
				document.getElementById('motivo_excusacion').style.display = 'none';
			}else{
				$("#motivo_excusacion").show();
			}
				
		
		});			
					
	});
	function cargar_datos_sorteo(obj){
		console.log(obj);
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
	function cagar_datos_el_trabajador_no_se_presento(obj){	
		
		document.getElementById('motivo_excusacion').style.display = 'none';
		document.getElementById('id_consulta_excusarme').value = obj;
		document.getElementById('datos_sorteo').innerHTML=(obj);
		
		var url = 'devolver_tipos_de_excusaciones_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			
			data:{idConsulta:obj},
			success:function(rta){	
				console.log(rta);		
				$('#desplegableestadoconsulta').html(rta).fadeIn();								
				document.getElementById('desplegableestadoconsulta').value = 5;	
				
			}
		});
	
	}	
	function cagar_suspencion(obj){	
		
		$("#motivo_excusacion").show();	
		document.getElementById('id_consulta_excusarme').value = obj;
		document.getElementById('datos_sorteo').innerHTML=(obj);
		
		var url = 'devolver_tipos_de_excusaciones_json';
		
		$.ajax({
			type:"POST",					
			url:url,
			
			data:{idConsulta:obj},
			success:function(rta){	
						
				$('#desplegableestadoconsulta').html(rta).fadeIn();								
				document.getElementById('desplegableestadoconsulta').value = 1;	
				
			}
		});
		
	
	}
	function cagar_datos_finalizar(obj){	
			
		document.getElementById('id_consulta_finalizar').value = obj;
		document.getElementById('numero_causa_finalizar').innerHTML=(obj);		
	
	}	
	function cagar_datos_aceptar(obj){	
			
		document.getElementById('id_aceptar_consulta').value = obj;
		document.getElementById('numero_causa_aceptar').innerHTML=(obj);		
	
	}	
	</script>
  </body>
</html>