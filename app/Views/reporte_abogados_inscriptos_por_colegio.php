<div class="row">
	<div class="col-3" style="font-size:75%;padding-right:0;height:1200px;padding-top:1%">
		<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<table id="tabla-matriculaciones" style="font-size:90%" class="table table-striped table-sm">
			  <thead>
				<tr>
				  <th>Colegio Profesional</th>
				  <th>Provincia</th>
				  <th>Inscriptos</th>			 
				  <th>Aprobados</th>			 
				  <th>Pendientes</th>			 
				</tr>
			  </thead>
			  <tbody>
			 
				<?php foreach ($reportes as $reporte){?>				  
				<tr>
					
					<td><?php echo $reporte['Colegio']?></td>											
					<td><?php echo $reporte['Provincia']?></td>											
					<td><?php echo $reporte['REGISTRADOS']?></td>					
					<td><?php echo $reporte['APROBADOS']?></td>					
					<td><?php echo $reporte['PENDIENTES']?></td>					
			
				</tr>
				<?php }?>
				<tr>
					
					<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo "TOTAL"?></td>											
					<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo $total_abogados_inscriptos?></td>					
					<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo $total_abogados_aprobados?></td>					
					<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo $total_abogados?></td>					
			
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
			<div class="tab-pane fade" id="v-pills-ventas" role="tabpanel" aria-labelledby="v-pills-ventas-tab">VENTAS</div>
			<div class="tab-pane fade" id="v-pills-mesas" role="tabpanel" aria-labelledby="v-pills-mesas-tab">MENSAS</div>
			<div class="tab-pane fade" id="v-pills-productos" role="tabpanel" aria-labelledby="v-pills-productos-tab">PRODUCTOS</div>	
						
		</div>
		<div style="float:right;padding-right:2%;padding-top:1%;margin-top:2%">																				
							
			<form action="descargar_reporte_abogados_por_colegio" method="post" enctype="multipart/form-data" name="formdescargarbonos" id="formdescargarbonos">
						
				<button type="submit" id="exportaraxcel" name="exportaraxcel"  class="btn btn-success btn-sm" >Exportar a Excel</button>				
			
			</form>						
			
		</div>
	</div>
</div>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
	  
	var arrayJS=<?php echo json_encode($reportes);?>;
	// Mostramos los valores del array
    for(var i=0;i<arrayJS.length;i++){
        //console.log("<br>"+arrayJS[i]['Colegio']+' '+arrayJS[i]['APROBADOS']);
    }
	var data = google.visualization.arrayToDataTable([
		['Task', 'Hours per Day'],       
		[arrayJS[0]['Colegio'],parseInt(arrayJS[0]['APROBADOS'])],
		[arrayJS[1]['Colegio'],parseInt(arrayJS[1]['APROBADOS'])],
		[arrayJS[2]['Colegio'],parseInt(arrayJS[2]['APROBADOS'])],
		[arrayJS[3]['Colegio'],parseInt(arrayJS[3]['APROBADOS'])],
		[arrayJS[4]['Colegio'],parseInt(arrayJS[4]['APROBADOS'])],
		[arrayJS[5]['Colegio'],parseInt(arrayJS[5]['APROBADOS'])],
		[arrayJS[6]['Colegio'],parseInt(arrayJS[6]['APROBADOS'])],
		[arrayJS[7]['Colegio'],parseInt(arrayJS[7]['APROBADOS'])],
		[arrayJS[8]['Colegio'],parseInt(arrayJS[8]['APROBADOS'])],
		[arrayJS[9]['Colegio'],parseInt(arrayJS[9]['APROBADOS'])],
		[arrayJS[10]['Colegio'],parseInt(arrayJS[10]['APROBADOS'])],
		[arrayJS[11]['Colegio'],parseInt(arrayJS[11]['APROBADOS'])],
		[arrayJS[12]['Colegio'],parseInt(arrayJS[12]['APROBADOS'])],
		[arrayJS[13]['Colegio'],parseInt(arrayJS[13]['APROBADOS'])],
		[arrayJS[14]['Colegio'],parseInt(arrayJS[14]['APROBADOS'])],
		[arrayJS[15]['Colegio'],parseInt(arrayJS[15]['APROBADOS'])],
		[arrayJS[16]['Colegio'],parseInt(arrayJS[16]['APROBADOS'])],
		[arrayJS[17]['Colegio'],parseInt(arrayJS[17]['APROBADOS'])],
		[arrayJS[18]['Colegio'],parseInt(arrayJS[18]['APROBADOS'])],
		[arrayJS[19]['Colegio'],parseInt(arrayJS[19]['APROBADOS'])],
		[arrayJS[20]['Colegio'],parseInt(arrayJS[20]['APROBADOS'])],
		[arrayJS[21]['Colegio'],parseInt(arrayJS[21]['APROBADOS'])],
		[arrayJS[22]['Colegio'],parseInt(arrayJS[22]['APROBADOS'])],
		[arrayJS[23]['Colegio'],parseInt(arrayJS[23]['APROBADOS'])],		
		[arrayJS[24]['Colegio'],parseInt(arrayJS[24]['APROBADOS'])],		
		[arrayJS[25]['Colegio'],parseInt(arrayJS[25]['APROBADOS'])],		
		[arrayJS[26]['Colegio'],parseInt(arrayJS[26]['APROBADOS'])],		
		[arrayJS[27]['Colegio'],parseInt(arrayJS[27]['APROBADOS'])],		
		[arrayJS[28]['Colegio'],parseInt(arrayJS[28]['APROBADOS'])],		
		[arrayJS[29]['Colegio'],parseInt(arrayJS[29]['APROBADOS'])],		
		[arrayJS[30]['Colegio'],parseInt(arrayJS[30]['APROBADOS'])],		
		[arrayJS[31]['Colegio'],parseInt(arrayJS[31]['APROBADOS'])],		
		[arrayJS[32]['Colegio'],parseInt(arrayJS[32]['APROBADOS'])],		
		[arrayJS[33]['Colegio'],parseInt(arrayJS[33]['APROBADOS'])],		
		[arrayJS[34]['Colegio'],parseInt(arrayJS[34]['APROBADOS'])],		
		[arrayJS[35]['Colegio'],parseInt(arrayJS[35]['APROBADOS'])],		
		[arrayJS[36]['Colegio'],parseInt(arrayJS[36]['APROBADOS'])],		
		[arrayJS[37]['Colegio'],parseInt(arrayJS[37]['APROBADOS'])],		
		[arrayJS[38]['Colegio'],parseInt(arrayJS[38]['APROBADOS'])],		
		[arrayJS[39]['Colegio'],parseInt(arrayJS[39]['APROBADOS'])],		
		[arrayJS[40]['Colegio'],parseInt(arrayJS[40]['APROBADOS'])],		
		[arrayJS[41]['Colegio'],parseInt(arrayJS[41]['APROBADOS'])],		
		[arrayJS[42]['Colegio'],parseInt(arrayJS[42]['APROBADOS'])],		
		[arrayJS[43]['Colegio'],parseInt(arrayJS[43]['APROBADOS'])],		
		[arrayJS[44]['Colegio'],parseInt(arrayJS[44]['APROBADOS'])],		
		[arrayJS[45]['Colegio'],parseInt(arrayJS[45]['APROBADOS'])],		
		[arrayJS[46]['Colegio'],parseInt(arrayJS[46]['APROBADOS'])],		
		[arrayJS[47]['Colegio'],parseInt(arrayJS[47]['APROBADOS'])],		
		[arrayJS[48]['Colegio'],parseInt(arrayJS[48]['APROBADOS'])],		
		[arrayJS[49]['Colegio'],parseInt(arrayJS[49]['APROBADOS'])],		
		[arrayJS[50]['Colegio'],parseInt(arrayJS[50]['APROBADOS'])],		
		[arrayJS[51]['Colegio'],parseInt(arrayJS[51]['APROBADOS'])],		
		[arrayJS[52]['Colegio'],parseInt(arrayJS[52]['APROBADOS'])],		
		[arrayJS[53]['Colegio'],parseInt(arrayJS[53]['APROBADOS'])],		
			
		
		
		
	]);

	var options = {
	  title: 'Aprobados por Colegio Profesional'
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);
  }
</script>

