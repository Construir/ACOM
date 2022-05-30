<h5 style="color:#016887;padding-top:5px">Reporte Sorteos sin Información - Trabajador no se Presentó o Sin Movimientos</h5>
<div class="alert alert-secondary">
	<form action=""  method="post" enctype="multipart/form-data" name="formFiltro" id="formFiltro"> 
	  <div class="row">
		
		<div  class="col-sm-3 col-md-3 col-lg-3 col-xl-3">		
			<label for="fechahasta">Seleccione un Colegio</label>					
			<select  style="margin-top:3px;margin-botom:3px" name="desplegablecolegio" id="desplegablecolegio" class="form-control">
															
				<?php foreach ($colegios as $colegio){ ?>						
												
					<?php if($colegio['IdDepartamento'] == $colegio_actual){?>														
							<option selected value="<?php echo $colegio['IdDepartamento']?>"><?php echo $colegio['NombreDepartamento']?></option>
					<?php }else{?>
							<option  value="<?php echo $colegio['IdDepartamento']?>"><?php echo $colegio['NombreDepartamento']?></option>
					<?php }?>																  
												  
				<?php }?>	
				<?php if(9999 == $colegio_actual){?>														
						<option selected value="9999" >Todos</option>
				<?php }else{?>
						<option value="9999" >Todos</option>
				<?php }?>
										  
			</select>
			
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
			  <th scope="col" style="">Sorteo</th>			  
			  <th scope="col" style="">Abogado</th>			  
			  <th scope="col" style="">Cuit Abogado</th>			  
			  <th scope="col" style="">Cliente</th>			  
			  <th scope="col" style="">Cuit Cliente</th>			  
			  <th scope="col" style="">Estado</th>			  
			  <th scope="col" style="">Fecha</th>			  

			</tr>
		  </thead>
		  <tbody>
			<?php foreach ($sorteos as $sorteo){?>				  
			<tr>
				<td><?php echo date("d-m-Y", strtotime($sorteo['FechaSorteo']))?></td>				
				<td><?php echo $sorteo['apellido_abogado'].', '.$sorteo['nombre_abogado']?></td>				
				<td><?php echo $sorteo['cuit_abogado']?></td>				
				<td><?php echo $sorteo['Apellido'].', '.$sorteo['Nombre']?></td>				
				<td><?php echo $sorteo['Cuit']?></td>				
				<td>
				<?php 
					if($sorteo['IdEstadoConsulta'] == 5){
						
						echo "El trabajador no se presentó";							
						
					}elseif($sorteo['IdEstadoConsulta'] == 8){
						
						echo "Finaliza causa automática por paso del tiempo.";
						
					}
				
				?>				
				</td>				
				<td><?php echo date("d-m-Y", strtotime($sorteo['fechaFinalizacion']))?></td>	
				
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
				
				$("#formFiltro").attr("action","reporte_sorteos_trabajador_no_se_presento");	            
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
					
	});
	function validaFiltro(){

		var validadoOK = true;
		
		var desplegablecolegio = $("#desplegablecolegio").val();
	
		if(desplegablecolegio == 0){			
			
			if (desplegablecolegio == 0){agregaMensajeValidacion($("#desplegablecolegio"), "Debe seleccionar un colegio")};	
				
							
			validadoOK = false;		
	
		}		

		return validadoOK;
		
	}
	</script>
  </body>
</html>