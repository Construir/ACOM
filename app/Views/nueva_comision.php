	<br>
	<div class="container">			
		<form action=""  method="post" enctype="multipart/form-data" name="formNuevaComision" id="formNuevaComision"> 
			
			<div class="card">
				<h5 class="card-header">Nueva Comisión Médica</h5>
				<div class="card-body">								
				
					<div class="col-sm-12">
						<label>Nombre<sup style="color:red"><strong>*</strong></sup></label>
						<input name="nombreComision" id="nombreComision" type="text" class="form-control required" placeholder="Ingrese un nombre">							
					</div>
					<br>
					<div class="col-sm-12">
						<label>Domicilio</label>
						<input name="domicilioComision" id="domicilioComision" type="text" class="form-control" placeholder="Ingrese un domicilio">							
					</div>
					<br>					
					<div class="col-sm-12">
						<label>Teléfono</label>
						<input name="telefonoComision" id="telefonoComision" type="text" class="form-control" placeholder="Ingrese un teléfono">							
					</div>
					<br>				
					<div class="col-sm-12">
						<label>Provincia<sup style="color:red"><strong>*</strong></sup></label>
							<select class="form-control required" name="provincia_comision" id="provincia_comision" data-required="true">
							<option value="0">Seleccione una Provincia</option>												
							  <?php foreach ($provincias as $provincia){ ?>					
									<option  value="<?php echo $provincia['IdProvincia']?>"><?php echo $provincia['NombreProvincia']?></option>
							  <?php }?>
							</select>							
					</div>					
					<br>						
					<div class="modal-footer">
						<button id="btn_enviar_formulario" style="float:right;margin-right:0.5%" class="btn btn-primary" type="button">Guardar</button>									
					</div>							
				</div>
			</div>	
		</form>					
		<br>		
	</div>
	<br>	

		
<!----------------------------------------------MODALES--------------------------------------------------------------------->		
		
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
			<div id="div_cartel" class="alert"  role="alert">					
				<div class="form-group">
					<h5>¡Atención!</h5>
					<div id="mensaje"></div>						
				</div>
			</div>		
			<div class="modal-footer">			
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>													
			</div>							
		</div> 
	</div>
  </div>
</div>
<!-- Bootstrap core JavaScript================================================== -->

<script type="text/javascript">
	jQuery(document).ready(function() {
		
		$('#btn_enviar_formulario').click(function(){			
			
			if(validarNuevaComision()){
				
				var nombreComision = $('#nombreComision').val();
				var domicilioComision = $('#domicilioComision').val();
				var telefonoComision = $('#telefonoComision').val();				
				var provincia_comision = $('#provincia_comision').val();	
											
				var url = 'guardar_nueva_comision_json';
				
				$.ajax({
					type:"POST",					
					url:url,
					data:{nombreComision:nombreComision,domicilioComision:domicilioComision,telefonoComision:telefonoComision,provincia_comision:provincia_comision},
					success:function(rta){								
						$('#div_cartel').removeClass('alert-success');
						$('#div_cartel').removeClass('alert-danger');						
						switch (parseInt(rta, 10)) {
							
						  case 0:								
								$("#div_cartel").addClass("alert-danger");
								$('#mensaje').html('No se pudo agregar la comisión. Ya existe una comisión con el mismo nombre en la provincia seleccionada. <br> Verifique y vuelva a intentar.');								  
								break;
						  case 1:								
								$("#div_cartel").addClass("alert-success");								
								$('#mensaje').html('La comisión se agrego con éxito.');
								break;
						  default:
								$('#mensaje').html('No se pudo agregar la comision.');																	
						}							
							
						reset_form_nueva_comision();										
						$('#modal_mensaje').modal('show');
						
					}
				});						
			 							
			}			
			
		});			
		
	});
	
	function reset_form_nueva_comision(){
		
		$("#formNuevaComision").trigger("reset");				
		document.getElementById('nombreComision').value = '';
		document.getElementById('domicilioComision').value = '';
		document.getElementById('telefonoComision').value = '';
		document.getElementById('provincia_comision').value = 0;		
		
	}

	</script>
  </body>
</html>