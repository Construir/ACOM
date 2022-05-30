
<center>
<div class="col-12">
	<div class="tab-content" id="v-pills-tabContent">
		
		<div class="tab-pane fade show active" id="v-pills-balance" role="tabpanel" aria-labelledby="v-pills-balance-tab">

			<br>					
			<div id="piechart" style="width: 1300px; height: 500px;"></div>
		</div>				
					
	</div>
	
</div>
</center>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
	  
	var arrayJS=<?php echo json_encode($reportes);?>;
	var data = google.visualization.arrayToDataTable([
		['Task', 'Hours per Day'],       
		[arrayJS[0]['NombreTipoConsulta'],parseInt(arrayJS[0]['cantidad_por_consulta'])],
		[arrayJS[1]['NombreTipoConsulta'],parseInt(arrayJS[1]['cantidad_por_consulta'])],
		[arrayJS[2]['NombreTipoConsulta'],parseInt(arrayJS[2]['cantidad_por_consulta'])],
		[arrayJS[3]['NombreTipoConsulta'],parseInt(arrayJS[3]['cantidad_por_consulta'])],		
	]);

	var options = {
	  title: 'Sorteos por comisiones médicas'
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);
  }
</script>

