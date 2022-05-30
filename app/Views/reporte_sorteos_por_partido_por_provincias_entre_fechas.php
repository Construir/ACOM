
<div class="container">
<h5 style="color:#016887;padding-top:10px">Reporte de Sorteos por Partidos y Provincia</h5>
	<form action=""  method="post" enctype="multipart/form-data" name="formfiltro" id="formFiltro"> 
	  <div class="row alert alert-secondary">
	
		<div  class="col-sm-3 col-md-3 col-lg-3 col-xl-3">	
			<div class="form-group">
				<label for="desplegableprovincia">Provincia</label>					
				<select  style="margin-top:3px;margin-botom:3px" name="desplegableprovincia" id="desplegableprovincia" class="form-control">
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
		</div>	 
			
		<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">				
								
			<div class="form-group">
				<label for="fechadesde">Desde</label>
				<input type="date" class="form-control" id="fechadesde" name="fechadesde" value="<?php echo $desde?>">				
			</div>			
			
		</div>		
		<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">		
								
			<div class="form-group">
				<label for="fechahasta">Hasta</label>
				<input type="date" class="form-control" id="fechahasta" name="fechahasta" value="<?php echo $hasta?>">				
			</div>
			
		</div>		
		<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">		
								
			<div class="form-group">	
				<label class="invisible" for="btn_buscar">Buscar</label>			
				<button type="button" id="btn_buscar" class="btn btn-primary form-control">Buscar</button>				
			</div>
			
		</div>
		
	  </div>
	</form>
	
	<?php if($mostrar_grafico){?>
		<div class="row">
			<div class="col-3" style="font-size:75%;padding-right:0;height:1200px;padding-top:1%">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<table id="tabla-matriculaciones" style="font-size:90%" class="table table-striped table-sm">
					  	<thead>
							<tr>
							  <th>Partido</th>
							  <th>Total Sorteos</th>			 
							</tr>
						</thead>
						<tbody>
						 
							<?php foreach ($reportes as $reporte){?>				  
							<tr>
								
								<td><?php echo $reporte['NombrePartido']?></td>											
								<td><?php echo $reporte['cantidad_por_partido']?></td>					
						
							</tr>
							<?php }?>
							<tr>
								
								<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo "TOTAL"?></td>											
								<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo $total_provincia?></td>					
						
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-7">
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="v-pills-balance" role="tabpanel" aria-labelledby="v-pills-balance-tab">

						<br>					
						<div id="piechart" style="width: 900px; height: 500px;"></div>
					
					</div>					
								
				</div>
				<!--
				<div style="float:right;padding-right:2%;padding-top:1%;margin-top:2%">																				
									
					<form action="descargar_reporte_abogados_por_colegio" method="post" enctype="multipart/form-data" name="formdescargarbonos" id="formdescargarbonos">
								
						<button type="submit" id="exportaraxcel" name="exportaraxcel"  class="btn btn-success btn-sm" >Exportar a Excel</button>				
					
					</form>						
					
				</div>
				-->
			</div>
		</div>	
	<?php }?>
</div>
<br>

<script type="text/javascript">
jQuery(document).ready(function() {	

	$('#btn_buscar').on('click', function() {
		
		if(validaFiltro()){
			
			$("#formFiltro").attr("action","buscar_sorteos_por_partido_por_provincias_entre_fechas");	            
			$("#formFiltro").submit();	
			
		}
		
	});	
	
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	
});
	function validaFiltro(){

		var validadoOK = true;
		
		var desplegableprovincia = $("#desplegableprovincia").val();
		var fechadesde = $("#fechadesde").val();
		var fechahasta = $("#fechahasta").val();		
			
		if((desplegableprovincia == 0) || (fechadesde.length == 0) || (fechahasta.length == 0)){			
			
			if (desplegableprovincia == 0){agregaMensajeValidacion($("#desplegableprovincia"), "Debe seleccionar una provincia")};	
			if (fechadesde.length == 0){agregaMensajeValidacion($("#fechadesde"), "Debe seleccionar una fecha")};	
			if (fechahasta.length == 0){agregaMensajeValidacion($("#fechahasta"), "Debe seleccionar una fecha")};	
							
			validadoOK = false;		
	
		}		

		return validadoOK;
		
	}
	function drawChart() {
	  
		var arrayJS=<?php echo json_encode($reportes);?>;
		var cantidad = <?php echo count($reportes);?>;
		
		
		var array_sorteos = '[["Partido", "Sorteos"]'+',';
	
		var total = cantidad-1;
		
		for (var i = 0; i < total; i++) {
			
			array_sorteos = array_sorteos + '["'+arrayJS[i]['NombrePartido']+'",'+parseInt(arrayJS[i]['cantidad_por_partido'])+']'+',';
		
		}
		array_sorteos = array_sorteos + '["'+arrayJS[total]['NombrePartido']+'",'+parseInt(arrayJS[total]['cantidad_por_partido'])+']';
		array_sorteos = array_sorteos + ']';
	
		var data = google.visualization.arrayToDataTable(JSON.parse(array_sorteos));
	

		var options = {
		  title: 'Sorteos por Partidos'
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart'));

		chart.draw(data, options);
	}
</script>
  </body>
</html>