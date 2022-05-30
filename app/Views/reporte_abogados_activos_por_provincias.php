<div class="row">
		<div class="col-2" style="font-size:75%;padding-right:0;height:1200px;padding-top:1%">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<table id="tabla-matriculaciones" style="font-size:90%" class="table table-striped table-sm">
				  <thead>
					<tr>
					  <th>Provincia</th>
					  <th>Total Abogados</th>			 
					</tr>
				  </thead>
				  <tbody>
				 
					<?php foreach ($reportes as $reporte){?>				  
					<tr>
						
						<td><?php echo $reporte['NombreProvincia']?></td>											
						<td><?php echo $reporte['APROBADOS']?></td>					
				
					</tr>
					<?php }?>
					<tr>
						
						<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo "TOTAL"?></td>											
						<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo $total_abogados?></td>					
				
					</tr>
					
				  </tbody>
				</table>
			</div>
		</div>
		<div class="col-8">
			<div class="tab-content" id="v-pills-tabContent">
				<div class="tab-pane fade show active" id="v-pills-balance" role="tabpanel" aria-labelledby="v-pills-balance-tab">

					<br>					
					<div id="piechart" style="width: 900px; height: 500px;"></div>
				
				</div>
				<div class="tab-pane fade" id="v-pills-ventas" role="tabpanel" aria-labelledby="v-pills-ventas-tab">VENTAS</div>
				<div class="tab-pane fade" id="v-pills-mesas" role="tabpanel" aria-labelledby="v-pills-mesas-tab">MENSAS</div>
				<div class="tab-pane fade" id="v-pills-productos" role="tabpanel" aria-labelledby="v-pills-productos-tab">PRODUCTOS</div>	
							
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
        //console.log("<br>"+arrayJS[i]['NombreProvincia']+' '+arrayJS[i]['APROBADOS']);
    }
	var data = google.visualization.arrayToDataTable([
		['Task', 'Hours per Day'],       
		[arrayJS[0]['NombreProvincia'],parseInt(arrayJS[0]['APROBADOS'])],
		[arrayJS[1]['NombreProvincia'],parseInt(arrayJS[1]['APROBADOS'])],
		[arrayJS[2]['NombreProvincia'],parseInt(arrayJS[2]['APROBADOS'])],
		[arrayJS[3]['NombreProvincia'],parseInt(arrayJS[3]['APROBADOS'])],
		[arrayJS[4]['NombreProvincia'],parseInt(arrayJS[4]['APROBADOS'])],
		[arrayJS[5]['NombreProvincia'],parseInt(arrayJS[5]['APROBADOS'])],
		[arrayJS[6]['NombreProvincia'],parseInt(arrayJS[6]['APROBADOS'])],
		[arrayJS[7]['NombreProvincia'],parseInt(arrayJS[7]['APROBADOS'])],
		[arrayJS[8]['NombreProvincia'],parseInt(arrayJS[8]['APROBADOS'])],
		[arrayJS[9]['NombreProvincia'],parseInt(arrayJS[9]['APROBADOS'])],
		[arrayJS[10]['NombreProvincia'],parseInt(arrayJS[10]['APROBADOS'])],
		[arrayJS[11]['NombreProvincia'],parseInt(arrayJS[11]['APROBADOS'])],
		[arrayJS[12]['NombreProvincia'],parseInt(arrayJS[12]['APROBADOS'])],
		[arrayJS[13]['NombreProvincia'],parseInt(arrayJS[13]['APROBADOS'])],
		[arrayJS[14]['NombreProvincia'],parseInt(arrayJS[14]['APROBADOS'])],
		[arrayJS[15]['NombreProvincia'],parseInt(arrayJS[15]['APROBADOS'])],
		[arrayJS[16]['NombreProvincia'],parseInt(arrayJS[16]['APROBADOS'])],
		[arrayJS[17]['NombreProvincia'],parseInt(arrayJS[17]['APROBADOS'])],
		[arrayJS[18]['NombreProvincia'],parseInt(arrayJS[18]['APROBADOS'])],
		//[arrayJS[19]['NombreProvincia'],parseInt(arrayJS[19]['APROBADOS'])],
		//[arrayJS[20]['NombreProvincia'],parseInt(arrayJS[20]['APROBADOS'])],
		//[arrayJS[21]['NombreProvincia'],parseInt(arrayJS[21]['APROBADOS'])],
		//[arrayJS[22]['NombreProvincia'],parseInt(arrayJS[22]['APROBADOS'])],
		//[arrayJS[23]['NombreProvincia'],parseInt(arrayJS[23]['APROBADOS'])],		
		//[arrayJS[24]['NombreProvincia'],parseInt(arrayJS[24]['APROBADOS'])],		
	]);

	var options = {
	  title: 'Abogados activos por provincia'
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);
  }
</script>

