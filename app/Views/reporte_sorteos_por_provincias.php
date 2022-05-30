<br>
<div class="row">
  <div class="col-2">
    <div class="list-group" id="list-tab" role="tablist">
		
		<a style="padding-left: 0.1rem !important" class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Argentina <span class="badge badge-light"><?php echo $total_sorteos?></span></a>
		
		<?php foreach($reportes as $reporte){?>
			<a style="padding-left: 0.1rem !important" class="list-group-item list-group-item-action" id="<?php echo $reporte['IdProvincia']?>" onclick="cargar_partidos(this.id,<?php echo $reporte['cantidad_sorteos']?>)" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings"><?php echo $reporte['NombreProvincia']?> <span class="badge badge-light"><?php echo $reporte['cantidad_sorteos']?></span></a>
		<?php } ?>		
		
		
	</div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
	
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
	  
		<center>		 
			<div id="chart_div" style="height: 800px"></div>
		</center>  
		
	  </div> 
	  
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
	  
		<center>		 
			<div id="chart_div_partidos" style="height: 800px"></div>
		</center>	  
	  
	  </div>
    </div>
  </div>
</div> 

</ul>

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {
	
	var arrayJS=<?php echo json_encode($reportes);?>;
	var total_sorteos=<?php echo json_encode($total_sorteos);?>;	
	var cantidad = <?php echo count($reportes);?>;	
    
	var array_sorteos = '[["Provincias", "Sorteos"]'+',';
	
	var total = cantidad-1;
	
	for (var i = 0; i < total; i++) {
		
		array_sorteos = array_sorteos + '["'+arrayJS[i]['NombreProvincia']+'",'+parseInt(arrayJS[i]['cantidad_sorteos'])+']'+',';
	
	}
	
	array_sorteos = array_sorteos + '["'+arrayJS[total]['NombreProvincia']+'",'+parseInt(arrayJS[total]['cantidad_sorteos'])+']';
	array_sorteos = array_sorteos + ']';	
	
	var data = google.visualization.arrayToDataTable(JSON.parse(array_sorteos));

      var options = {
        title: 'Sorteos por Provincias',
        chartArea: {width: '50%', height: 700},
        hAxis: {
          title: 'Total Argentina: ' + total_sorteos,
          minValue: 0
        },
        vAxis: {
          title: 'Provincias'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
	function cargar_partidos(id_provincia,cantidad_sorteos){
			
		//google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawBasic_partidos(id_provincia,cantidad_sorteos));
		
	}
	function drawBasic_partidos(id_provincia,cantidad_sorteos) {	
		
		var cantidad = 0;
		
		switch (parseInt(id_provincia, 10)) {
			
			case 1:										
				var arrayJS = <?php echo json_encode($buenos_aires);?>;
				var cantidad = <?php echo count($buenos_aires);?>;									
				var nombre_provincia = 'Buenos Aires';									
				break;
			case 2:
				var arrayJS = <?php echo json_encode($catamarca);?>;
				var cantidad = <?php echo count($catamarca);?>;
				var nombre_provincia = 'Catamarca';									
				break;
			case 3:
				var arrayJS = <?php echo json_encode($chaco);?>;
				var cantidad = <?php echo count($chaco);?>;
				var nombre_provincia = 'Chaco';									
				break;
			case 4:
				var arrayJS = <?php echo json_encode($chubut);?>;
				var cantidad = <?php echo count($chubut);?>;
				var nombre_provincia = 'Chubut';									
				break;
			case 5:
				var arrayJS = <?php echo json_encode($ciudad_de_buenos_aires);?>;
				var cantidad = <?php echo count($ciudad_de_buenos_aires);?>;
				var nombre_provincia = 'Ciudad de Buenos Aires';									
				break;
			case 6:
				var arrayJS = <?php echo json_encode($cordoba);?>;
				var cantidad = <?php echo count($cordoba);?>;
				var nombre_provincia = 'Córdoba';									
				break;
			case 7:
				var arrayJS = <?php echo json_encode($corrientes);?>;
				var cantidad = <?php echo count($corrientes);?>;
				var nombre_provincia = 'Corrientes';									
				break;
			case 8:
				var arrayJS = <?php echo json_encode($entre_rios);?>;
				var cantidad = <?php echo count($entre_rios);?>;
				var nombre_provincia = 'Entre Ríos';									
				break;
			case 9:
				var arrayJS = <?php echo json_encode($formosa);?>;
				var cantidad = <?php echo count($formosa);?>;
				var nombre_provincia = 'Formosa';									
				break;
			case 10:
				var arrayJS = <?php echo json_encode($jujuy);?>;
				var cantidad = <?php echo count($jujuy);?>;
				var nombre_provincia = 'Jujuy';									
				break;
			case 11:
				var arrayJS = <?php echo json_encode($la_pampa);?>;
				var cantidad = <?php echo count($la_pampa);?>;
				var nombre_provincia = 'La Pampa';									
				break;
			case 12:
				var arrayJS = <?php echo json_encode($la_rioja);?>;
				var cantidad = <?php echo count($la_rioja);?>;
				var nombre_provincia = 'La Rioja';									
				break;
			case 13:
				var arrayJS = <?php echo json_encode($mendoza);?>;
				var cantidad = <?php echo count($mendoza);?>;
				var nombre_provincia = 'Mendoza';									
				break;
			case 14:
				var arrayJS = <?php echo json_encode($misiones);?>;
				var cantidad = <?php echo count($misiones);?>;
				var nombre_provincia = 'Misiones';									
				break;
			case 15:
				var arrayJS = <?php echo json_encode($neuquen);?>;
				var cantidad = <?php echo count($neuquen);?>;
				var nombre_provincia = 'Neuquén';									
				break;
			case 16:
				var arrayJS = <?php echo json_encode($rio_negro);?>;
				var cantidad = <?php echo count($rio_negro);?>;
				var nombre_provincia = 'Río Negro';									
				break;
			case 17:
				var arrayJS = <?php echo json_encode($salta);?>;
				var cantidad = <?php echo count($salta);?>;
				var nombre_provincia = 'Salta';									
				break;
			case 18:
				var arrayJS = <?php echo json_encode($san_juan);?>;
				var cantidad = <?php echo count($san_juan);?>;
				var nombre_provincia = 'San Juan';									
				break;
			case 19:
				var arrayJS = <?php echo json_encode($san_luis);?>;
				var cantidad = <?php echo count($san_luis);?>;
				var nombre_provincia = 'San Luis';									
				break;
			case 20:
				var arrayJS = <?php echo json_encode($santa_cruz);?>;
				var cantidad = <?php echo count($santa_cruz);?>;
				var nombre_provincia = 'Santa Cruz';									
				break;	
		  	case 21:
				var arrayJS = <?php echo json_encode($santa_fe);?>;
				var cantidad = <?php echo count($santa_fe);?>;
				var nombre_provincia = 'Santa Fe';									
				break;
			case 22:
				var arrayJS = <?php echo json_encode($santiago_del_Estero);?>;
				var cantidad = <?php echo count($santiago_del_Estero);?>;
				var nombre_provincia = 'Santiago del Estero';									
				break;
			case 23:
				var arrayJS = <?php echo json_encode($tierrar_del_fuego);?>;
				var cantidad = <?php echo count($tierrar_del_fuego);?>;
				var nombre_provincia = 'Tierra del Fuego';									
				break;				
			case 24:
				var arrayJS = <?php echo json_encode($tucuman);?>;
				var cantidad = <?php echo count($tucuman);?>;
				var nombre_provincia = 'Tucumán';									
				break;
		}
		

		var array_sorteos = '[["Partidos", "Sorteos"]'+',';
		
		var total = cantidad-1;
		
		for (var i = 0; i < total; i++) {
			array_sorteos = array_sorteos + '["'+arrayJS[i]['NombrePartido']+'",'+parseInt(arrayJS[i]['cantidad_por_partido'])+']'+',';
		}
		
		array_sorteos = array_sorteos + '["'+arrayJS[total]['NombrePartido']+'",'+parseInt(arrayJS[total]['cantidad_por_partido'])+']';
		array_sorteos = array_sorteos + ']';
		
	  var data = google.visualization.arrayToDataTable(JSON.parse(array_sorteos));

      var options = {
        title: 'Sorteos por Partidos',
        chartArea: {width: '50%', height: 700},
        hAxis: {
          title: 'Total '+nombre_provincia+': ' + cantidad_sorteos,
          minValue: 0
        },
        vAxis: {
          title: 'Partidos'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div_partidos'));

      chart.draw(data, options);
    }
</script>


