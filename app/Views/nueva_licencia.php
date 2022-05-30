<h5 style="color:#016887;padding-top:5px">Licencias - Nueva licencia</h5>
		<div class="container">
		<br>
			<form action=""  method="post" enctype="multipart/form-data" name="formNuevaLicencia" id="formNuevaLicencia"> 
				<input type="hidden" name="cuit" id="cuit" value="<?php echo $cuit?>">
				<div class="card">
				  <h5 class="card-header ">Nueva Licencia</h5>
				  <div class="card-body">
						
						<div class="row form-group">
						 	<div class="col-sm-6">
								<label>Solicitar licencia en la matrícula</label>
								<select name="matriculacion" id="matriculacion" class="form-control required" data-required="true">
									<option value="0">Seleccione una matriculación</option>												
									  <?php foreach ($matriculaciones as $matriculacion){ ?>					
											<option  value="<?php echo $matriculacion['IdMatriculacion']?>"><?php echo $matriculacion['NombreDepartamento']?></option>
									  <?php }?>				
								</select>
							</div>
						</div>
						<div class="row form-group">
						  <div class="col-sm-6">
							<label>Fecha de Inicio</label>
							<input name="fechaInicio" id="fechaInicio" type="date" class="form-control" placeholder="Ingrese una Fecha de Inicio" min="<?php echo date('Y-m-d')?>" value="<?php echo date('Y-m-d')?>" >							
						   </div>
						  <div class="col-sm-6">
							<label>Fecha Fin</label>
							<input name="fechaFin" id="fechaFin" type="date" class="form-control" placeholder="Ingrese una Fecha de Fin." min="<?php echo date('Y-m-d')?>" value="" >						
						  </div>
						</div>
						
						<div class="row form-group">
						 	<div class="col-sm-12">
								<label>Motivo</label>
								<textarea name="motivo" id="motivo" type="text" rows="5" class="form-control" value=""></textarea>						
							</div>						    
						</div>				
						<button id="btn_enviar_licencia" style="float:right;margin-right:0.5%" class="btn btn-primary" type="button">Guardar</button>
				  </div>
				</div>		
				<br>				
			</form>					
			<br>		
		</div>
		<br>	
		<div class="text-center">
			<img style="width:30px;height:30px" class="img-fluid" alt="Responsive image" src="<?php echo base_url()?>/imagenes/Colproba_400x400.jpg"></img>
			<a href="https://colproba.org.ar/" class="btn btn-link">Colegio de Abogados de la Provincia de Buenos Aires</a><br>
			<small>© Copyright 2020 ColProBA </small><br>
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
<!-- Bootstrap core JavaScript================================================== -->

<script type="text/javascript">
	jQuery(document).ready(function() {
		
		$('#btn_enviar_licencia').click(function(){
			
			var fechaInicio = $('#fechaInicio').val();
			var fechaFin = $('#fechaFin').val();
			var motivo = $('#motivo').val();
			var matriculacion = $('#matriculacion').val();
			var cuit = $('#cuit').val();
						
			if(validarNuevaLicencia()){
			
				var url = 'guardar_licencia_json';
					
					$.ajax({
						type:"POST",					
						url:url,
						
						data:{fechaInicio:fechaInicio,fechaFin:fechaFin,motivo:motivo,matriculacion:matriculacion,cuit:cuit},
						success:function(rta){	
						
							if(parseInt(rta, 10) == 1){
								$('#mensaje').html('La Licencia se guardo con éxito.');																
							} else {
								$('#mensaje').html('Usted ya tiene una Licencia entre las fechas ingresadas. Verifique y vuelva a intentar.');
							}
							
							$('#modal_mensaje').modal('show');
							reset_form_nueva_licencia();
						}
					});	
			
			}
			
		});	
		
	});	
	function reset_form_nueva_licencia(){
		
		$("#formNuevaLicencia").trigger("reset");
		document.getElementById("fechaInicio").valueAsDate = new Date()		
		document.getElementById('fechaFin').value = '';
		document.getElementById('motivo').value = '';
		
	}
	</script>
  </body>
</html>