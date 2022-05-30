<h5 style="color:#016887;padding-top:5px">Matrícula</h5>
<div class="container">
	<div class="card-body">
		<table id="tabla-sorteos" class="table">
			<thead style="display:none">
			<tr>
			<!--
			  <th scope="col">Provincia</th>
			  <th scope="col">Colegio</th>
			 -->
			  <th scope="col"></th>
			  <th scope="col">Datos</th>				
			  <th scope="col" style='width:12%'>Acción</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($domicilios as $domicilio){?>				  
			<tr>
						
				<input type="hidden" name="desc_matriculacion<?php echo $domicilio['IdMatriculacion']?>" id="desc_matriculacion<?php echo $domicilio['IdMatriculacion']?>" value="<?php echo $domicilio['Apellido'].' '.$domicilio['Nombre']?>">
				
				<input type="hidden" name="calle<?php echo $domicilio['IdDomicilio']?>" id="calle<?php echo $domicilio['IdDomicilio']?>" value="<?php echo $domicilio['Calle']?>">
				<input type="hidden" name="numero<?php echo $domicilio['IdDomicilio']?>" id="numero<?php echo $domicilio['IdDomicilio']?>" value="<?php echo $domicilio['Numero']?>">
				<input type="hidden" name="piso<?php echo $domicilio['IdDomicilio']?>" id="piso<?php echo $domicilio['IdDomicilio']?>" value="<?php echo $domicilio['Piso']?>">
				<input type="hidden" name="oficina<?php echo $domicilio['IdDomicilio']?>" id="oficina<?php echo $domicilio['IdDomicilio']?>" value="<?php echo $domicilio['Oficina']?>">
				<input type="hidden" name="email<?php echo $domicilio['IdDomicilio']?>" id="email<?php echo $domicilio['IdDomicilio']?>" value="<?php echo $domicilio['Email']?>">
				<input type="hidden" name="telefono<?php echo $domicilio['IdDomicilio']?>" id="telefono<?php echo $domicilio['IdDomicilio']?>" value="<?php echo $domicilio['Telefono']?>">
				<input type="hidden" name="horariosdeatencion<?php echo $domicilio['IdDomicilio']?>" id="horariosdeatencion<?php echo $domicilio['IdDomicilio']?>" value="<?php echo $domicilio['HorariosAtencion']?>">				
				<input type="hidden" name="nombre_colegio<?php echo $domicilio['IdMatriculacion']?>" id="nombre_colegio<?php echo $domicilio['IdMatriculacion']?>" value="<?php echo $domicilio['NombreDepartamento']?>">
				<input type="hidden" name="id_estado_matricula<?php echo $domicilio['IdMatriculacion']?>" id="id_estado_matricula<?php echo $domicilio['IdMatriculacion']?>" value="<?php echo $domicilio['IdEstadoMatricula']?>">
				
				<td>-</td>
				<td>
				<?php if(!empty($domicilio['NombreDepartamento'])){ echo '<strong>Colegio de Abogados:</strong> '.$domicilio['NombreDepartamento'];}?><br>
				<?php if(!empty($domicilio['Tomo'])){ echo ' <strong>Tomo:</strong> ' .$domicilio['Tomo'];}?>
				<?php if(!empty($domicilio['Folio'])){ echo '<strong>Folio:</strong> ' .$domicilio['Folio'].'<br>';}?>
				<?php if(!empty($domicilio['Matricula'])){echo '<strong>Matrícula:</strong> ' .$domicilio['Matricula'].'<br>';}?>
		
				<?php echo '<strong>Partido:</strong> ' .$domicilio['NombrePartido'];?><br>
				<?php echo '<strong>Localidad:</strong> ' .$domicilio['NombreLocalidad'];?><br>
				<?php echo '<strong>Calle:</strong> ' .$domicilio['Calle'].' '.$domicilio['Numero'];?><br>
				<?php if(!empty($domicilio['Piso'])){ echo '<strong>Piso:</strong> '.$domicilio['Piso'];}?>
				<?php if(!empty($domicilio['Oficina'])){ echo '<strong>Oficina:</strong> ' .$domicilio['Oficina'];}?>	<br>							
				<?php echo '<strong>E-mail:</strong> ' .$domicilio['Email']?>			<br>
				<?php echo '<strong>Teléfono:</strong> ' .$domicilio['Telefono']?><br>
											
				<?php echo '<strong>Horarios de atención:</strong> ' .$domicilio['HorariosAtencion']?>		<br>														
				<?php echo '<strong>Estado:</strong> ' .$domicilio['NombreTipoEstado']?>		<br>														
				</td>														
				<td style="width:10%">										
				
				  <div class="form-inline">
				  	
					<button type="button" id="<?php echo $domicilio['IdMatriculacion']?>" onclick="ver_domicilios(this.id)" class="btn btn-info btn-sm col-md-11" style="margin-right:3px;margin-top:3px" >
						Domicilios <img src="<?php echo base_url(); ?>/public/imagenes/lista_blanco.png" width="20" height="20" title="Mis domicilios">
					</button>
					<?php if(($domicilio['EstadoMatriculacion'] == 1) or ($domicilio['EstadoMatriculacion'] == 2)){?>
					
						<button href="#myModal" data-toggle="modal" data-target="#agegar_domicilio_modal" type="button" id="<?php echo $domicilio['IdMatriculacion']?>" onclick="cargar_matricula_domicilios(this.id)" class="btn btn-success btn-sm col-md-11" style="margin-right:3px;margin-top:3px" id="agegar_domicilio">
							Nuevo domicilio <img src="<?php echo base_url(); ?>/public/imagenes/agregar.png" width="20" height="20" title="Nuevo domicilio">
						</button>
						
						<button type="bottom" onclick="editar_domicilio(<?php echo $domicilio['IdDomicilio']?>)" id="btn_editar_domicilio" name="btn_editar_domicilio" class="btn btn-primary btn-sm col-md-11" style="margin-right:3px;margin-top:3px" >
							Actualizar datos de contacto <img src="<?php echo base_url(); ?>/public/imagenes/editar_blanco.png" width="20" height="20" title="Editar domicilio">
						</button>					
						
						<button type="bottom" onclick="darme_de_baja(<?php echo $domicilio['IdMatriculacion']?>)" id="btn_darme_de_baja" name="btn_darme_de_baja" class="btn btn-danger btn-sm col-md-11" style="margin-right:3px;margin-top:3px" >
							Darme de baja <img src="<?php echo base_url(); ?>/public/imagenes/salir.png" width="20" height="20" title="Darme de baja de ACOM">
						</button>
					<?php }?>
					
					<?php if($domicilio['EstadoMatriculacion'] == 2){?>
					
						<form style="width:250px" action="reimprimir_comprobante_inscripcion" method="post" enctype="multipart/form-data" id="descargarpdf" name="descargarpdf">
							<input type="hidden" name="id_matriculacion" id="id_matriculacion" value="<?php echo $domicilio['IdMatriculacion']?> ">
							<button type="submit" class="btn btn-secondary btn-sm  col-md-11" style="margin-right:3px;margin-top:3px">
								Imprimir <img src="<?php echo base_url(); ?>/public/imagenes/impresora_blanca.png" width="20" height="20" title="Imprimir">
							</button>					
						</form>						
					
					<?php }?>							
							
					<?php if($domicilio['EstadoMatriculacion'] == 6){?>
							
						<button style="margin-right:3px;margin-top:3px" type="submit" class="btn btn-warning btn-sm col-md-11" onclick="cargar_finalizar_licencia(<?php echo $domicilio['IdMatriculacion']?>)" style="margin-right:3px;margin-top:3px;color:#FFFF">
							Finalizar licencia <img src="<?php echo base_url(); ?>/public/imagenes/adelantar.png" width="20" height="20" title="Finalizar Licencia">
						</button>
							
					<?php }?>

				  </div>				
					<!--
					<button type="button" class="btn btn-secondary btn-sm">Imprimir</button>
					<button type="button" class="btn btn-primary btn-sm">Aceptar</button>
					<button type="button" class="btn btn-danger btn-sm">Eliminar</button>
					-->
			   </td>
			</tr>
			<?php }?>
		  </tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="ver_domicilios_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Domicilios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>		
	  <div class="modal-body"></div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>		
	  </div>
    </div>
  </div>
</div>
<div class="modal fade" id="agegar_domicilio_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar domicilio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>		
		<div class="modal-body">
							
			<input type="hidden" name="id_matricula_domicilio" id="id_matricula_domicilio" value="">
			<div class="row form-group">
			
				<div class="col-sm-6">
					<label>Partido</label>
					<select name="partidoDomicilio" id="partidoDomicilio" class="form-control required" data-required="true">
						<option value="0">Seleccione un partido</option>												
						  <?php foreach ($partidos as $partido){ ?>					
								<option  value="<?php echo $partido['Id']?>"><?php echo $partido['NombrePartido']?></option>
						  <?php }?>				
					</select>						
				</div>
				<div class="col-sm-6">
					<label>Localidad</label>
					<select class="form-control required" name="localidadDomicilio" id="localidadDomicilio" data-required="true" disabled>
						<option value="0">Seleccione una localidad</option>
					</select>							
				</div>
				
			</div>			
			<div class="row form-group">
			
				<div class="col-sm-6">
					<label>Calle</label>
					<input name="calleDomicilio" id="calleDomicilio" type="text" class="form-control required" placeholder="Ingrese la calle del inmueble">							
				</div>
				<div class="col-sm-6">
					<label>N&uacute;mero</label>
					<input name="numeroDomicilio" id="numeroDomicilio" type="text" class="form-control number required" placeholder="Ingrese el nro del inmueble">							
				</div>
				
			</div>
			<div class="row form-group">
			
				<div class="col-sm-6">
					<label>Piso</label>
					<input name="pisoDomicilio" id="pisoDomicilio" type="text" class="form-control" placeholder="Ingrese el piso del inmueble">							
				</div>
				 <div class="col-sm-6">
					<label>Oficina</label>
					<input name="oficinaDomicilio" id="oficinaDomicilio" type="text" class="form-control" placeholder="Ingrese la oficina del inmueble">							
				</div>
			
			</div>

			<div class="row form-group">
			 
				<div class="col-sm-6">
					<label>Email</label>
					<input name="emailEstudio" id="emailEstudio" type="text" class="form-control required email" placeholder="Ingrese su direcci&oacute;n de email">
				</div>
				<div class="col-sm-6">
					<label>Telefono</label>
					<input name="telefonoEstudio" id="telefonoEstudio" type="text" class="form-control number" placeholder="Ingrese su nro. de tel&eacute;fono">				
				</div>
				
			</div>			

			<div class="row form-group">	 	
				
				<div class="col-sm-6">
					<label>D&iacute;as y horario de atenci&oacute;n</label>
					<input name="horarioDomicilio" id="horarioDomicilio" type="text" class="form-control required" placeholder="Ingrese los d&iacute;as y horarios de atenci&oacute;n">
				</div>
				
			</div>
			<div style="color:red !important" class="form-check form-check-inline">
			  <label style="font-size:15px" ><strong>¡Atención!</strong> Luego de la carga de un nuevo domicilio, deberá esperar la aprobación de su colegio profesional.</label>
			  
			</div>	

			<div class="modal-footer">
				<button type="button" id="btn_guardar_nuevo_domicilio" class="btn btn-success btn-sm" >Guardar</button>		<!--data-dismiss="modal"-->
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Salir</button>		
			</div>
			  
		</div>
	 
    </div>
  </div>
</div>
<div class="modal fade" id="editar_domicilio_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar domicilio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>		
		<div class="modal-body">
			<form action=""  method="post" enctype="multipart/form-data" name="formEditarDomicilio" id="formEditarDomicilio"> 	
			
				<input type="hidden" name="id_domicilio_editar" id="id_domicilio_editar" value="">	  
				<div class="row form-group">
				
					<div class="col-sm-6">
						<label>Calle</label>
						<input name="calleDomicilioEditar" id="calleDomicilioEditar" type="text" class="form-control" disabled>							
					</div>
					<div class="col-sm-6">
						<label>N&uacute;mero</label>
						<input name="numeroDomicilioEditar" id="numeroDomicilioEditar" type="text" class="form-control number" disabled>							
					</div>
					
				</div>
				<div class="row form-group">
				
					<div class="col-sm-6">
						<label>Piso</label>
						<input name="pisoDomicilioEditar" id="pisoDomicilioEditar" type="text" class="form-control" disabled>							
					</div>
					 <div class="col-sm-6">
						<label>Oficina</label>
						<input name="oficinaDomicilioEditar" id="oficinaDomicilioEditar" type="text" class="form-control" disabled>							
					</div>
				
				</div>

				<div class="row form-group">
				 
					<div class="col-sm-6">
						<label>Email</label>
						<input name="emailEstudioEditar" id="emailEstudioEditar" type="text" class="form-control required email" placeholder="Ingrese su direcci&oacute;n de email">
					</div>
					<div class="col-sm-6">
						<label>Telefono</label>
						<input name="telefonoEstudioEditar" id="telefonoEstudioEditar" type="text" class="form-control number" placeholder="Ingrese su nro. de tel&eacute;fono">				
					</div>
					
				</div>			

				<div class="row form-group">	 	
					
					<div class="col-sm-6">
						<label>D&iacute;as y horario de atenci&oacute;n</label>
						<input name="horarioDomicilioEditar" id="horarioDomicilioEditar" type="text" class="form-control required" placeholder="Ingrese los d&iacute;as y horarios de atenci&oacute;n">
					</div>
					
				</div>
				<div style="color:red !important" class="form-check form-check-inline">
				  <label style="font-size:15px" ><strong>¡Atención!</strong> Solo puede editar los campos permitidos. Si necesita editar el resto de la información, debe crear un nuevo domicilio el cual deberá ser aprobado por su colegio profesional.</label>
				</div>	
				<div class="modal-footer">
					<button type="button" id="btn_guardar_editar_domicilio" name="btn_guardar_editar_domicilio" class="btn btn-success btn-sm" >Guardar</button>
					<button type="button" id="cerrar_editar" name="cerrar_editar" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>		
				</div>
			  
			</form>
		</div>
	 
    </div>
  </div>
</div>
<div class="modal fade" id="modalseleccionardomicilio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="max-width: 1150px !important;" role="document">
		<div class="modal-content" >
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel2">Domicilios</h5>
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
<div class="modal fade" id="modal_baja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content" >
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel2">Mensaje para el Usuario</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>		  
			</button>								
		  </div>
			<form action=""  method="post" enctype="multipart/form-data" name="formdarmedebaja" id="formdarmedebaja"> 	
			
				<input type="hidden" name="id_matricula_dame_de_baja" id="id_matricula_dame_de_baja" value="">		  
					<div class="modal-body">
						<div class="alert alert-danger"  role="alert">			
							<h5>¡Atención!</h5>	
							<label>¿Esta seguro que quiere darse de baja?</label>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="btn_darme_de_baja_confirma" name="btn_darme_de_baja_confirma" class="btn btn-danger btn-sm" >Darme de baja</button>
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>		
					</div>
			</form>
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
			<div class="alert alert-danger"  role="alert">					
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
<div class="modal fade" id="modal_finalizar_licencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel"><b><label style="color:red">¡Atención!</label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		
		<div class="modal-body">	
			<div class="alert alert-danger" role="alert">	
				<div id="mensaje_fin_licencia"></div>				
			</div>
		</div>
		
		<div class="modal-footer">
			<form class="form-inline" action="finalizar_licencia" method="post" enctype="multipart/form-data" id="formfinlicencia" name="formfinlicencia">								
				<input type="hidden" name="id_estado_matricula" id="id_estado_matricula" value="">
				<button type="submit" id="btn_fin_licencia" class="btn btn-danger">Finalizar</button>
			</form>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		</div>		
	</div>
  </div>
</div> 
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		//$('#ver_domicilios').click(function(){				
			//$('#ver_domicilios_modal').modal('show');			
		//});
		/*
		$('#agegar_domicilio').click(function(){				
			$('#agegar_domicilio_modal').modal('show');			
		});
		*/
		$("#partidoDomicilio").change(function(){
			
			var partido = $('#partidoDomicilio').val();
			if(partido == 0){
				
				document.getElementById('localidadDomicilio').value = 0;
				document.getElementById("localidadDomicilio").disabled = true;

				
			} else {	
				var url = 'devolver_localidades_json';
				//console.log(partido);
				$.ajax({
					type:"POST",					
					url:url,
					
					data:{partido:partido},
					success:function(rta){	
					//console.log(rta);
						document.getElementById("localidadDomicilio").disabled = false;			
						$('#localidadDomicilio').html(rta).fadeIn();								
						
					}
				});	
			}
		});
		$('#btn_darme_de_baja_confirma').click(function(){
			
			$("#formdarmedebaja").attr("action","guardar_darme_de_baja");	            
			$("#formdarmedebaja").submit();	
			
		});		
		$('#btn_guardar_editar_domicilio').click(function(){
			
			if(validarEditarDomicilio()){
				
				$("#formEditarDomicilio").attr("action","guardar_editar_domicilio");	            
				$("#formEditarDomicilio").submit();	
					
			} 
			
		});
		$('#btn_guardar_nuevo_domicilio').click(function(){
			
			if(validarDomicilio()){
				
				var id_matricula_domicilio = $('#id_matricula_domicilio').val();
				var partidoDomicilio = $('#partidoDomicilio').val();
				var localidadDomicilio = $('#localidadDomicilio').val();				
				var calleDomicilio = $('#calleDomicilio').val();
				var numeroDomicilio = $('#numeroDomicilio').val();
				var pisoDomicilio = $('#pisoDomicilio').val();
				var oficinaDomicilio = $('#oficinaDomicilio').val();
				var emailEstudio = $('#emailEstudio').val();			
				var telefonoEstudio = $('#telefonoEstudio').val();
				var horarioDomicilio = $('#horarioDomicilio').val();
					
				$("#agegar_domicilio_modal").modal('hide');	
					var url = 'agregar_nuevo_domicilio_json';
										
					$.ajax({
						type:"POST",					
						url:url,
						data:{id_matricula:id_matricula_domicilio,partidoDomicilio:partidoDomicilio,localidadDomicilio:localidadDomicilio,
							  calleDomicilio:calleDomicilio,numeroDomicilio:numeroDomicilio,pisoDomicilio:pisoDomicilio,
							  oficinaDomicilio:oficinaDomicilio,emailEstudio:emailEstudio,
							  telefonoEstudio:telefonoEstudio,horarioDomicilio:horarioDomicilio},
						success:function(rta){	
										
							switch (rta) {
							  case '0':								
									$('#mensaje').html('El domicilio se guardo con éxito.');
									break;
							  case '1':								
									$('#mensaje').html('El domicilio ya existe, verifique y vuelva a intentar.');
									break;								
							  default:
									$('#mensaje').html('El domicilio no se pudo guardar. Por favor, póngase en contacto con su administrador.');	
							}
							//location.reload();
							reset_form_nuevo_abogado();						
							$('#modal_mensaje').modal('show');
							
						}
					});
			} else {
				
				window.scrollTo(500, 0);
				
			}
			
		});	
		$('#tabla-sorteos').stacktable();
		$('#tabla-sorteos').DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 0, "asc" ]],
			"info": false,
			"paging": false,
			"searching": false,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});		
					
	});
	function cargar_finalizar_licencia(obj){		
		
		var nombre_colegio = $("#nombre_colegio"+obj).val();		
		var id_estado_matricula = $("#id_estado_matricula"+obj).val();		
				
		document.getElementById('id_estado_matricula').value = id_estado_matricula;
		document.getElementById('mensaje_fin_licencia').innerHTML=('¿Está seguro que quiere finalizar la Licencia que tiene en el Colegio '+ nombre_colegio +'?');		
		$('#modal_finalizar_licencia').modal('show');	
		
	}
	function editar_domicilio(iddomicilio){
			
		$("#modalseleccionardomicilio").modal('hide');

		var calle = $("#calle"+iddomicilio).val();		
		var numero = $("#numero"+iddomicilio).val();		
		var piso = $("#piso"+iddomicilio).val();		
		var oficina = $("#oficina"+iddomicilio).val();		
		var email = $("#email"+iddomicilio).val();		
		var telefono = $("#telefono"+iddomicilio).val();				
		var horariosdeatencion = $("#horariosdeatencion"+iddomicilio).val();	
		
		document.getElementById('id_domicilio_editar').value = iddomicilio;
		document.getElementById('calleDomicilioEditar').value = calle;
		document.getElementById('numeroDomicilioEditar').value = numero;
		document.getElementById('pisoDomicilioEditar').value = piso;
		document.getElementById('oficinaDomicilioEditar').value = oficina;
		document.getElementById('emailEstudioEditar').value = email;
		document.getElementById('telefonoEstudioEditar').value = telefono;
		document.getElementById('horarioDomicilioEditar').value = horariosdeatencion;
		
		$('#editar_domicilio_modal').modal('show');		
		
	}
	function ver_domicilios(obj){

		var url = 'devolver_domicilios_json';
		$.ajax({
			type:"POST",
			url:url,
			data:{idmatriculacion:obj},
			success:function(rta){				
				$('#lista_domicilios').html(rta);					
				$('#modalseleccionardomicilio').modal('show');
				
				$('#tabla_domicilios').stacktable();
				$('#tabla_domicilios').DataTable({	
					"lengthMenu": [[50, -1], [50, "Todos"]],
					"info":     true,		
					"ordering":false,			
					"paging": true,		
					"language": {
						"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
					}	
				});
			}
		});
		
	}	
	function darme_de_baja(obj){			
	
		var url = 'verifica_si_tiene_causas_para_baja_json';
		$.ajax({
			type:"POST",
			url:url,
			data:{id_matricula:obj},				
						
			success:function(rta){	
							
				switch (parseInt(rta, 10)) {
				  case 0:								
						$('#mensaje').html('Estimado profesional. Para darse de baja primero debe solicitar a su colegio profesional la licencia correspondiente para no participar en nuevos sorteos y cerrar todas las causas en las que tiene patrocinio.');
						$('#modal_mensaje').modal('show');
						break;
				  case 1:	
						document.getElementById('id_matricula_dame_de_baja').value = obj;				  
						$('#modal_baja').modal('show');
						break;								
				  default:							
						$('#mensaje').html('Estimado profesional. No se pudo darle de baja. Por favor, póngase en contacto con su colegio profesional.');
						$('#modal_mensaje').modal('show');							
				}				
				
			}						
			
		});	
			
	}
	/*
	function nuevo_domicilios(obj){	
		
		var nombreexpediente1 = $("#nombrecaso"+obj).attr('value');
		var url = 'devolver_domicilios_json';
		$.ajax({
			type:"POST",
			url:url,
			data:{quien_busca:quien_busca},
			success:function(rta){				
				$('#lista_articulos').html(rta);					
				$('#modalseleccionararticulos').modal('show');
				
				$('#tabla_articulos').stacktable();
				$('#tabla_articulos').DataTable({	
					"lengthMenu": [[50, -1], [50, "Todos"]],
					"info":     true,		
					"ordering":false,			
					"paging": true,		
					"language": {
						"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
					}	
				});
			}
		});	
			
	}
	*/
	function cargar_matricula_domicilios(obj){				
		
		document.getElementById('id_matricula_domicilio').value = obj;	
		
		$(".estilos-errores").remove();
		document.getElementById('partidoDomicilio').value = 0;		
		document.getElementById('localidadDomicilio').value = 0;
		document.getElementById("localidadDomicilio").disabled = true;	
		document.getElementById('calleDomicilio').value = '';
		document.getElementById('numeroDomicilio').value = '';
		document.getElementById('pisoDomicilio').value = '';
		document.getElementById('oficinaDomicilio').value = '';
		document.getElementById('emailEstudio').value = '';
		document.getElementById('telefonoEstudio').value = '';
		document.getElementById('horarioDomicilio').value = '';	
	
	}	
	function reset_form_nuevo_abogado(){
		
		document.getElementById('partidoDomicilio').value = 0;		
		document.getElementById('localidadDomicilio').value = 0;
		document.getElementById("localidadDomicilio").disabled = true;	
		document.getElementById('calleDomicilio').value = '';
		document.getElementById('numeroDomicilio').value = '';
		document.getElementById('pisoDomicilio').value = '';
		document.getElementById('oficinaDomicilio').value = '';
		document.getElementById('emailEstudio').value = '';
		document.getElementById('telefonoEstudio').value = '';
		document.getElementById('horarioDomicilio').value = '';
		
	}	
	</script>
  </body>
</html>