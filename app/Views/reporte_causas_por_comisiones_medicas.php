<div class="container">
<h5 style="color:#016887;padding-top:10px">Reporte de Causas por Comisiones Médicas</h5>

	<div class="row">
		<div class="col-3" style="font-size:75%;padding-right:0;height:1200px;padding-top:1%">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<table id="tabla-matriculaciones" style="font-size:90%" class="table table-striped table-sm">
					<thead>
						<tr>
						  <th>Comisión Médica</th>
						  <th>Total</th>			 
						</tr>
					</thead>
					<tbody>
					 
						<?php foreach ($reportes as $reporte){?>				  
						<tr>
							
							<td><?php echo $reporte['NombreComisionMedica']?></td>											
							<td><?php echo $reporte['total_comision']?></td>					
					
						</tr>
						<?php }?>
						<tr>
							
							<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo "TOTAL"?></td>											
							<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo $total_causas?></td>					
					
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
		</div>
	</div>	

</div>
<br>

<script type="text/javascript">
jQuery(document).ready(function() {	
	
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	
});

	function drawChart() {
	  
		var arrayJS=<?php echo json_encode($reportes);?>;
		var cantidad = <?php echo count($reportes);?>;	
		
		var array_sorteos = '[["Comisión", "Causas"]'+',';
	
		var total = cantidad-1;
		
		for (var i = 0; i < total; i++) {
			
			array_sorteos = array_sorteos + '["'+arrayJS[i]['NombreComisionMedica']+'",'+parseInt(arrayJS[i]['total_comision'])+']'+',';
		
		}
		array_sorteos = array_sorteos + '["'+arrayJS[total]['NombreComisionMedica']+'",'+parseInt(arrayJS[total]['total_comision'])+']';
		array_sorteos = array_sorteos + ']';
	
		var data = google.visualization.arrayToDataTable(JSON.parse(array_sorteos));
	

		var options = {
		  title: 'Causas por Comisión Médica'
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart'));

		chart.draw(data, options);
	}
</script>
  </body>
</html>