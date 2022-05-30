<h5 style="color:#016887;padding-top:5px">Reporte de Abogados Sorteados por Partido</h5>
<div class="alert alert-secondary">
	<form action=""  method="post" enctype="multipart/form-data" name="formFiltro" id="formFiltro"> 
	  <div class="row">
		
		<div  class="col-sm-3 col-md-3 col-lg-3 col-xl-3">		
			<label for="fechahasta">Provincia</label>					
			<select  style="margin-top:3px;margin-botom:3px" name="desplegableprovinciasadmin" id="desplegableprovinciasadmin" class="form-control">
				<option value="0" selected>Seleccione una provincia</option>												
				  <?php foreach ($provincias as $provincia){ ?>						
												
						<?php if($provincia['IdProvincia'] == $provincia_actual){?>														
								<option selected value="<?php echo $provincia['IdProvincia']?>"><?php echo $provincia['NombreProvincia']?></option>
						<?php }else{?>
								<option  value="<?php echo $provincia['IdProvincia']?>"><?php echo $provincia['NombreProvincia']?></option>
						<?php }?>																  
												  
				  <?php }?>				
			</select>
			
		</div>	 
				
		<div  class="col-sm-3 col-md-3 col-lg-3 col-xl-3">		
			<label for="fechahasta">Partido</label>					
			<select  disabled style="margin-top:3px;margin-botom:3px" name="desplegablepartidosadmin" id="desplegablepartidosadmin" class="form-control">
				<option value="0">Seleccione un patido</option>				
			</select>
			
		</div>
		
		<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">				
								
			<div class="form-group">
				<label for="fechadesde">Desde</label>
				<input type="date" class="form-control" id="fechadesde" name="fechadesde" value="<?php echo $desde?>">				
			</div>			
			
		</div>		
		<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">		
								
			<div class="form-group">
				<label for="fechahasta">Hasta</label>
				<input type="date" class="form-control" id="fechahasta" name="fechahasta" value="<?php echo $hasta?>">				
			</div>			
			
		</div>		
		<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">		
								
			<div class="form-group">	
				<label class="invisible"  for="btn_buscar">Buscar</label>			
				<button type="button" id="btn_buscar" class="btn btn-primary form-control">Buscar</button>				
			</div>
			
		</div>
	  </div>
	</form>
	
</div>

<div class="card">
	<div class="card-body">
		<table id="tabla-sorteos" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th scope="col" style="">Abogado</th>			  
			  <th scope="col" style="width:10%">Aceptados</th>
			  <th scope="col" style="width:10%">Recusado</th>
			  <th scope="col" style="width:10%">Excusado</th>
			  <th scope="col" style="width:15%">Cliente no se presentó</th>
			  <th scope="col" style="width:20%">Cerradas por paso del tiempo</th>
			  <th scope="col" style="width:10%">Total</th>
			</tr>
		  </thead>
		  <tbody>
			<?php foreach ($sorteos as $localidad){?>				  
			<tr>
				<td><?php echo $localidad['Apellido'].', '.$localidad['Nombre']?></td>					
				<td><?php echo $localidad['aceptada']?></td>	
				<td><?php echo $localidad['recusado_por_cliente'] + $localidad['recusado_por_colegio']?></td>	
				<td><?php echo $localidad['excusado']?></td>	
				<td><?php echo $localidad['nosepresento']?></td>	
				<td><?php echo $localidad['cerrado']?></td>
				<td><?php echo $localidad['totalsorteos']?></td>				
				
			</tr>
			<?php }?>
		  </tbody>
		</table>
	</div>
</div>

 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		
		$('#btn_buscar').on('click', function() {
		
			if(validaFiltro()){
				
				$("#formFiltro").attr("action","buscar_abogados_sorteados_por_partido_movimiento");	            
				$("#formFiltro").submit();	
				
			}
			
		});

		$('#tabla-sorteos').stacktable();
		$('#tabla-sorteos').DataTable( {
			"lengthMenu": [[25, 50, -1], [25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 0, "asc" ]],
			"paging": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});

		$("#desplegableprovinciasadmin").change(function(){
			var provincia = $('#desplegableprovinciasadmin').val();
			if(provincia == 0){
				
				document.getElementById('desplegablepartidosadmin').value = 0;
				document.getElementById("desplegablepartidosadmin").disabled = true;

				
			} else {	
				var url = 'devolver_partidos_registro_json';					
				$.ajax({
					type:"POST",					
					url:url,
					data:{provincia:provincia},
					success:function(rta){	
					
						document.getElementById("desplegablepartidosadmin").disabled = false;								
						$('#desplegablepartidosadmin').html(rta).fadeIn();								
						
					}
				});		
			}
		});		
					
	});
	function validaFiltro(){

		var validadoOK = true;
		
		var desplegableprovinciasadmin = $("#desplegableprovinciasadmin").val();
		var desplegablepartidosadmin = $("#desplegablepartidosadmin").val();
		var fechadesde = $("#fechadesde").val();
		var fechahasta = $("#fechahasta").val();		
			
		if((desplegableprovinciasadmin == 0) || (desplegablepartidosadmin == 0) || (fechadesde.length == 0) || (fechahasta.length == 0)){			
			
			if (desplegableprovinciasadmin == 0){agregaMensajeValidacion($("#desplegableprovinciasadmin"), "Debe seleccionar una provincia")};	
			if (desplegablepartidosadmin == 0){agregaMensajeValidacion($("#desplegablepartidosadmin"), "Debe seleccionar un partido")};	
			if (fechadesde.length == 0){agregaMensajeValidacion($("#fechadesde"), "Debe seleccionar una fecha")};	
			if (fechahasta.length == 0){agregaMensajeValidacion($("#fechahasta"), "Debe seleccionar una fecha")};	
							
			validadoOK = false;		
	
		}		

		return validadoOK;
		
	}
	</script>
  </body>
</html>