<div class="row">
		<div class="col-3" style="font-size:75%;padding-right:0;height:1200px;padding-top:1%">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<table id="tabla-matriculaciones" style="font-size:90%" class="table table-striped table-sm">
				  <thead>
					<tr>
					  <th>Provincia</th>
					  <th>Partido</th>
					  <th>Inscriptos</th>			 
					  <th>Aprobados</th>			 
					  <th>Pendientes</th>			 
					</tr>
				  </thead>
				  <tbody>
				 
					<?php foreach ($reportes as $reporte){?>				  
					<tr>
						
						<td><?php echo $reporte['NombreProvincia']?></td>											
						<td><?php echo $reporte['NombrePartido']?></td>											
						<td><?php echo $reporte['REGISTRADOS']?></td>					
						<td><?php echo $reporte['APROBADOS']?></td>					
						<td><?php echo $reporte['PENDIENTES']?></td>					
				
					</tr>
					<?php }?>
					<tr>
						
						<td class="text-danger font-weight-bold" style="font-size:15px"><?php echo "TOTAL"?></td>											
						<td class="text-danger font-weight-bold" style="font-size:15px"></td>											
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
								
				<form action="descargar_reporte_abogados_por_partido" method="post" enctype="multipart/form-data" name="formdescargarbonos" id="formdescargarbonos">
							
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
        //console.log("<br>"+arrayJS[i]['NombrePartido']+' '+arrayJS[i]['APROBADOS']);
    }
	
	var data = google.visualization.arrayToDataTable([
		['Task', 'Hours per Day'],       
		[arrayJS[0]['NombrePartido'],parseInt(arrayJS[0]['APROBADOS'])],
		[arrayJS[1]['NombrePartido'],parseInt(arrayJS[1]['APROBADOS'])],
		[arrayJS[2]['NombrePartido'],parseInt(arrayJS[2]['APROBADOS'])],
		[arrayJS[3]['NombrePartido'],parseInt(arrayJS[3]['APROBADOS'])],
		[arrayJS[4]['NombrePartido'],parseInt(arrayJS[4]['APROBADOS'])],
		[arrayJS[5]['NombrePartido'],parseInt(arrayJS[5]['APROBADOS'])],
		[arrayJS[6]['NombrePartido'],parseInt(arrayJS[6]['APROBADOS'])],
		[arrayJS[7]['NombrePartido'],parseInt(arrayJS[7]['APROBADOS'])],
		[arrayJS[8]['NombrePartido'],parseInt(arrayJS[8]['APROBADOS'])],
		[arrayJS[9]['NombrePartido'],parseInt(arrayJS[9]['APROBADOS'])],
		[arrayJS[10]['NombrePartido'],parseInt(arrayJS[10]['APROBADOS'])],
		[arrayJS[11]['NombrePartido'],parseInt(arrayJS[11]['APROBADOS'])],
		[arrayJS[12]['NombrePartido'],parseInt(arrayJS[12]['APROBADOS'])],
		[arrayJS[13]['NombrePartido'],parseInt(arrayJS[13]['APROBADOS'])],
		[arrayJS[14]['NombrePartido'],parseInt(arrayJS[14]['APROBADOS'])],
		[arrayJS[15]['NombrePartido'],parseInt(arrayJS[15]['APROBADOS'])],
		[arrayJS[16]['NombrePartido'],parseInt(arrayJS[16]['APROBADOS'])],
		[arrayJS[17]['NombrePartido'],parseInt(arrayJS[17]['APROBADOS'])],
		[arrayJS[18]['NombrePartido'],parseInt(arrayJS[18]['APROBADOS'])],
		[arrayJS[19]['NombrePartido'],parseInt(arrayJS[19]['APROBADOS'])],
		[arrayJS[20]['NombrePartido'],parseInt(arrayJS[20]['APROBADOS'])],
		[arrayJS[21]['NombrePartido'],parseInt(arrayJS[21]['APROBADOS'])],
		[arrayJS[22]['NombrePartido'],parseInt(arrayJS[22]['APROBADOS'])],
		[arrayJS[23]['NombrePartido'],parseInt(arrayJS[23]['APROBADOS'])],		
		[arrayJS[24]['NombrePartido'],parseInt(arrayJS[24]['APROBADOS'])],		
		[arrayJS[25]['NombrePartido'],parseInt(arrayJS[25]['APROBADOS'])],		
		[arrayJS[26]['NombrePartido'],parseInt(arrayJS[26]['APROBADOS'])],		
		[arrayJS[27]['NombrePartido'],parseInt(arrayJS[27]['APROBADOS'])],		
		[arrayJS[28]['NombrePartido'],parseInt(arrayJS[28]['APROBADOS'])],		
		[arrayJS[29]['NombrePartido'],parseInt(arrayJS[29]['APROBADOS'])],		
		[arrayJS[30]['NombrePartido'],parseInt(arrayJS[30]['APROBADOS'])],		
		[arrayJS[31]['NombrePartido'],parseInt(arrayJS[31]['APROBADOS'])],		
		[arrayJS[32]['NombrePartido'],parseInt(arrayJS[32]['APROBADOS'])],		
		[arrayJS[33]['NombrePartido'],parseInt(arrayJS[33]['APROBADOS'])],		
		[arrayJS[34]['NombrePartido'],parseInt(arrayJS[34]['APROBADOS'])],		
		[arrayJS[35]['NombrePartido'],parseInt(arrayJS[35]['APROBADOS'])],		
		[arrayJS[36]['NombrePartido'],parseInt(arrayJS[36]['APROBADOS'])],		
		[arrayJS[37]['NombrePartido'],parseInt(arrayJS[37]['APROBADOS'])],		
		[arrayJS[38]['NombrePartido'],parseInt(arrayJS[38]['APROBADOS'])],		
		[arrayJS[39]['NombrePartido'],parseInt(arrayJS[39]['APROBADOS'])],		
		[arrayJS[40]['NombrePartido'],parseInt(arrayJS[40]['APROBADOS'])],		
		[arrayJS[41]['NombrePartido'],parseInt(arrayJS[41]['APROBADOS'])],		
		[arrayJS[42]['NombrePartido'],parseInt(arrayJS[42]['APROBADOS'])],		
		[arrayJS[43]['NombrePartido'],parseInt(arrayJS[43]['APROBADOS'])],		
		[arrayJS[44]['NombrePartido'],parseInt(arrayJS[44]['APROBADOS'])],		
		[arrayJS[45]['NombrePartido'],parseInt(arrayJS[45]['APROBADOS'])],		
		[arrayJS[46]['NombrePartido'],parseInt(arrayJS[46]['APROBADOS'])],		
		[arrayJS[47]['NombrePartido'],parseInt(arrayJS[47]['APROBADOS'])],		
		[arrayJS[48]['NombrePartido'],parseInt(arrayJS[48]['APROBADOS'])],		
		[arrayJS[49]['NombrePartido'],parseInt(arrayJS[49]['APROBADOS'])],		
		[arrayJS[50]['NombrePartido'],parseInt(arrayJS[50]['APROBADOS'])],		
		[arrayJS[51]['NombrePartido'],parseInt(arrayJS[51]['APROBADOS'])],		
		[arrayJS[52]['NombrePartido'],parseInt(arrayJS[52]['APROBADOS'])],		
		[arrayJS[53]['NombrePartido'],parseInt(arrayJS[53]['APROBADOS'])],
		[arrayJS[54]['NombrePartido'],parseInt(arrayJS[54]['APROBADOS'])],
		[arrayJS[55]['NombrePartido'],parseInt(arrayJS[55]['APROBADOS'])],		
		[arrayJS[56]['NombrePartido'],parseInt(arrayJS[56]['APROBADOS'])],		
		[arrayJS[57]['NombrePartido'],parseInt(arrayJS[57]['APROBADOS'])],		
		[arrayJS[58]['NombrePartido'],parseInt(arrayJS[58]['APROBADOS'])],		
		[arrayJS[59]['NombrePartido'],parseInt(arrayJS[59]['APROBADOS'])],		
		[arrayJS[60]['NombrePartido'],parseInt(arrayJS[60]['APROBADOS'])],		
		[arrayJS[61]['NombrePartido'],parseInt(arrayJS[61]['APROBADOS'])],		
		[arrayJS[62]['NombrePartido'],parseInt(arrayJS[62]['APROBADOS'])],		
		[arrayJS[63]['NombrePartido'],parseInt(arrayJS[63]['APROBADOS'])],		
		[arrayJS[64]['NombrePartido'],parseInt(arrayJS[64]['APROBADOS'])],		
		[arrayJS[65]['NombrePartido'],parseInt(arrayJS[65]['APROBADOS'])],		
		[arrayJS[66]['NombrePartido'],parseInt(arrayJS[66]['APROBADOS'])],		
		[arrayJS[67]['NombrePartido'],parseInt(arrayJS[67]['APROBADOS'])],		
		[arrayJS[68]['NombrePartido'],parseInt(arrayJS[68]['APROBADOS'])],		
		[arrayJS[69]['NombrePartido'],parseInt(arrayJS[69]['APROBADOS'])],		
		[arrayJS[70]['NombrePartido'],parseInt(arrayJS[70]['APROBADOS'])],		
		[arrayJS[71]['NombrePartido'],parseInt(arrayJS[71]['APROBADOS'])],		
		[arrayJS[72]['NombrePartido'],parseInt(arrayJS[72]['APROBADOS'])],		
		[arrayJS[73]['NombrePartido'],parseInt(arrayJS[73]['APROBADOS'])],		
		[arrayJS[74]['NombrePartido'],parseInt(arrayJS[74]['APROBADOS'])],		
		[arrayJS[75]['NombrePartido'],parseInt(arrayJS[75]['APROBADOS'])],		
		[arrayJS[76]['NombrePartido'],parseInt(arrayJS[76]['APROBADOS'])],		
		[arrayJS[77]['NombrePartido'],parseInt(arrayJS[77]['APROBADOS'])],		
		[arrayJS[78]['NombrePartido'],parseInt(arrayJS[78]['APROBADOS'])],		
		[arrayJS[79]['NombrePartido'],parseInt(arrayJS[79]['APROBADOS'])],		
		[arrayJS[80]['NombrePartido'],parseInt(arrayJS[80]['APROBADOS'])],		
		[arrayJS[81]['NombrePartido'],parseInt(arrayJS[81]['APROBADOS'])],		
		[arrayJS[82]['NombrePartido'],parseInt(arrayJS[82]['APROBADOS'])],		
		[arrayJS[83]['NombrePartido'],parseInt(arrayJS[83]['APROBADOS'])],		
		[arrayJS[84]['NombrePartido'],parseInt(arrayJS[84]['APROBADOS'])],		
		[arrayJS[85]['NombrePartido'],parseInt(arrayJS[85]['APROBADOS'])],		
		[arrayJS[86]['NombrePartido'],parseInt(arrayJS[86]['APROBADOS'])],		
		[arrayJS[87]['NombrePartido'],parseInt(arrayJS[87]['APROBADOS'])],		
		[arrayJS[88]['NombrePartido'],parseInt(arrayJS[88]['APROBADOS'])],		
		[arrayJS[89]['NombrePartido'],parseInt(arrayJS[89]['APROBADOS'])],		
		[arrayJS[90]['NombrePartido'],parseInt(arrayJS[90]['APROBADOS'])],		
		[arrayJS[91]['NombrePartido'],parseInt(arrayJS[91]['APROBADOS'])],		
		[arrayJS[92]['NombrePartido'],parseInt(arrayJS[92]['APROBADOS'])],		
		[arrayJS[93]['NombrePartido'],parseInt(arrayJS[93]['APROBADOS'])],		
		[arrayJS[94]['NombrePartido'],parseInt(arrayJS[94]['APROBADOS'])],		
		[arrayJS[95]['NombrePartido'],parseInt(arrayJS[95]['APROBADOS'])],		
		[arrayJS[96]['NombrePartido'],parseInt(arrayJS[96]['APROBADOS'])],		
		[arrayJS[97]['NombrePartido'],parseInt(arrayJS[97]['APROBADOS'])],		
		[arrayJS[98]['NombrePartido'],parseInt(arrayJS[98]['APROBADOS'])],		
		[arrayJS[99]['NombrePartido'],parseInt(arrayJS[99]['APROBADOS'])],		
		[arrayJS[100]['NombrePartido'],parseInt(arrayJS[100]['APROBADOS'])],		
		[arrayJS[101]['NombrePartido'],parseInt(arrayJS[101]['APROBADOS'])],		
		[arrayJS[102]['NombrePartido'],parseInt(arrayJS[102]['APROBADOS'])],		
		[arrayJS[103]['NombrePartido'],parseInt(arrayJS[103]['APROBADOS'])],		
		[arrayJS[104]['NombrePartido'],parseInt(arrayJS[104]['APROBADOS'])],		
		[arrayJS[105]['NombrePartido'],parseInt(arrayJS[105]['APROBADOS'])],		
		[arrayJS[106]['NombrePartido'],parseInt(arrayJS[106]['APROBADOS'])],		
		[arrayJS[107]['NombrePartido'],parseInt(arrayJS[107]['APROBADOS'])],		
		[arrayJS[108]['NombrePartido'],parseInt(arrayJS[108]['APROBADOS'])],		
		[arrayJS[109]['NombrePartido'],parseInt(arrayJS[109]['APROBADOS'])],		
		[arrayJS[110]['NombrePartido'],parseInt(arrayJS[110]['APROBADOS'])],		
		[arrayJS[111]['NombrePartido'],parseInt(arrayJS[111]['APROBADOS'])],		
		[arrayJS[112]['NombrePartido'],parseInt(arrayJS[112]['APROBADOS'])],		
		[arrayJS[113]['NombrePartido'],parseInt(arrayJS[113]['APROBADOS'])],		
		[arrayJS[114]['NombrePartido'],parseInt(arrayJS[114]['APROBADOS'])],		
		[arrayJS[115]['NombrePartido'],parseInt(arrayJS[115]['APROBADOS'])],		
		[arrayJS[116]['NombrePartido'],parseInt(arrayJS[116]['APROBADOS'])],		
		[arrayJS[117]['NombrePartido'],parseInt(arrayJS[117]['APROBADOS'])],		
		[arrayJS[118]['NombrePartido'],parseInt(arrayJS[118]['APROBADOS'])],		
		[arrayJS[119]['NombrePartido'],parseInt(arrayJS[119]['APROBADOS'])],		
		[arrayJS[120]['NombrePartido'],parseInt(arrayJS[120]['APROBADOS'])],		
		[arrayJS[121]['NombrePartido'],parseInt(arrayJS[121]['APROBADOS'])],		
		[arrayJS[122]['NombrePartido'],parseInt(arrayJS[122]['APROBADOS'])],		
		[arrayJS[123]['NombrePartido'],parseInt(arrayJS[123]['APROBADOS'])],		
		[arrayJS[124]['NombrePartido'],parseInt(arrayJS[124]['APROBADOS'])],		
		[arrayJS[125]['NombrePartido'],parseInt(arrayJS[125]['APROBADOS'])],		
		[arrayJS[126]['NombrePartido'],parseInt(arrayJS[126]['APROBADOS'])],		
		[arrayJS[127]['NombrePartido'],parseInt(arrayJS[127]['APROBADOS'])],		
		[arrayJS[128]['NombrePartido'],parseInt(arrayJS[128]['APROBADOS'])],		
		[arrayJS[129]['NombrePartido'],parseInt(arrayJS[128]['APROBADOS'])],		
		[arrayJS[130]['NombrePartido'],parseInt(arrayJS[130]['APROBADOS'])],		
		[arrayJS[131]['NombrePartido'],parseInt(arrayJS[131]['APROBADOS'])],		
		[arrayJS[132]['NombrePartido'],parseInt(arrayJS[132]['APROBADOS'])],		
		[arrayJS[133]['NombrePartido'],parseInt(arrayJS[133]['APROBADOS'])],		
		[arrayJS[134]['NombrePartido'],parseInt(arrayJS[134]['APROBADOS'])],		
		[arrayJS[135]['NombrePartido'],parseInt(arrayJS[135]['APROBADOS'])],		
		[arrayJS[136]['NombrePartido'],parseInt(arrayJS[136]['APROBADOS'])],		
		[arrayJS[137]['NombrePartido'],parseInt(arrayJS[137]['APROBADOS'])],		
		[arrayJS[138]['NombrePartido'],parseInt(arrayJS[138]['APROBADOS'])],		
		[arrayJS[139]['NombrePartido'],parseInt(arrayJS[139]['APROBADOS'])],		
		[arrayJS[140]['NombrePartido'],parseInt(arrayJS[140]['APROBADOS'])],		
		[arrayJS[141]['NombrePartido'],parseInt(arrayJS[141]['APROBADOS'])],		
		[arrayJS[142]['NombrePartido'],parseInt(arrayJS[142]['APROBADOS'])],		
		[arrayJS[143]['NombrePartido'],parseInt(arrayJS[143]['APROBADOS'])],		
		[arrayJS[144]['NombrePartido'],parseInt(arrayJS[144]['APROBADOS'])],		
		[arrayJS[145]['NombrePartido'],parseInt(arrayJS[145]['APROBADOS'])],		
		[arrayJS[146]['NombrePartido'],parseInt(arrayJS[146]['APROBADOS'])],		
		[arrayJS[147]['NombrePartido'],parseInt(arrayJS[147]['APROBADOS'])],		
		[arrayJS[148]['NombrePartido'],parseInt(arrayJS[148]['APROBADOS'])],		
		[arrayJS[149]['NombrePartido'],parseInt(arrayJS[149]['APROBADOS'])],		
		[arrayJS[150]['NombrePartido'],parseInt(arrayJS[150]['APROBADOS'])],		
		[arrayJS[151]['NombrePartido'],parseInt(arrayJS[151]['APROBADOS'])],		
		[arrayJS[152]['NombrePartido'],parseInt(arrayJS[152]['APROBADOS'])],		
		[arrayJS[153]['NombrePartido'],parseInt(arrayJS[153]['APROBADOS'])],		
		[arrayJS[154]['NombrePartido'],parseInt(arrayJS[154]['APROBADOS'])],		
		[arrayJS[155]['NombrePartido'],parseInt(arrayJS[155]['APROBADOS'])],		
		[arrayJS[156]['NombrePartido'],parseInt(arrayJS[156]['APROBADOS'])],		
		[arrayJS[157]['NombrePartido'],parseInt(arrayJS[157]['APROBADOS'])],		
		[arrayJS[158]['NombrePartido'],parseInt(arrayJS[158]['APROBADOS'])],		
		[arrayJS[159]['NombrePartido'],parseInt(arrayJS[159]['APROBADOS'])],		
		[arrayJS[160]['NombrePartido'],parseInt(arrayJS[160]['APROBADOS'])],		
		[arrayJS[161]['NombrePartido'],parseInt(arrayJS[161]['APROBADOS'])],		
		[arrayJS[162]['NombrePartido'],parseInt(arrayJS[162]['APROBADOS'])],		
		[arrayJS[163]['NombrePartido'],parseInt(arrayJS[163]['APROBADOS'])],		
		[arrayJS[164]['NombrePartido'],parseInt(arrayJS[164]['APROBADOS'])],		
		[arrayJS[165]['NombrePartido'],parseInt(arrayJS[165]['APROBADOS'])],		
		[arrayJS[166]['NombrePartido'],parseInt(arrayJS[166]['APROBADOS'])],		
		[arrayJS[167]['NombrePartido'],parseInt(arrayJS[167]['APROBADOS'])],		
		[arrayJS[168]['NombrePartido'],parseInt(arrayJS[168]['APROBADOS'])],		
		[arrayJS[169]['NombrePartido'],parseInt(arrayJS[169]['APROBADOS'])],		
		[arrayJS[170]['NombrePartido'],parseInt(arrayJS[170]['APROBADOS'])],		
		[arrayJS[171]['NombrePartido'],parseInt(arrayJS[171]['APROBADOS'])],		
		[arrayJS[172]['NombrePartido'],parseInt(arrayJS[172]['APROBADOS'])],		
		[arrayJS[173]['NombrePartido'],parseInt(arrayJS[173]['APROBADOS'])],		
		[arrayJS[174]['NombrePartido'],parseInt(arrayJS[174]['APROBADOS'])],		
		[arrayJS[175]['NombrePartido'],parseInt(arrayJS[175]['APROBADOS'])],		
		[arrayJS[176]['NombrePartido'],parseInt(arrayJS[176]['APROBADOS'])],		
		[arrayJS[177]['NombrePartido'],parseInt(arrayJS[177]['APROBADOS'])],		
		[arrayJS[178]['NombrePartido'],parseInt(arrayJS[178]['APROBADOS'])],		
		[arrayJS[179]['NombrePartido'],parseInt(arrayJS[178]['APROBADOS'])],		
		[arrayJS[180]['NombrePartido'],parseInt(arrayJS[180]['APROBADOS'])],		
		[arrayJS[181]['NombrePartido'],parseInt(arrayJS[181]['APROBADOS'])],		
		[arrayJS[182]['NombrePartido'],parseInt(arrayJS[182]['APROBADOS'])],		
		[arrayJS[183]['NombrePartido'],parseInt(arrayJS[183]['APROBADOS'])],		
		[arrayJS[184]['NombrePartido'],parseInt(arrayJS[184]['APROBADOS'])],		
		[arrayJS[185]['NombrePartido'],parseInt(arrayJS[185]['APROBADOS'])],		
		[arrayJS[186]['NombrePartido'],parseInt(arrayJS[186]['APROBADOS'])],		
		[arrayJS[187]['NombrePartido'],parseInt(arrayJS[187]['APROBADOS'])],		
		[arrayJS[188]['NombrePartido'],parseInt(arrayJS[188]['APROBADOS'])],		
		[arrayJS[189]['NombrePartido'],parseInt(arrayJS[189]['APROBADOS'])],		
		[arrayJS[190]['NombrePartido'],parseInt(arrayJS[190]['APROBADOS'])],		
		[arrayJS[191]['NombrePartido'],parseInt(arrayJS[191]['APROBADOS'])],		
		[arrayJS[192]['NombrePartido'],parseInt(arrayJS[192]['APROBADOS'])],		
		[arrayJS[193]['NombrePartido'],parseInt(arrayJS[193]['APROBADOS'])],		
		[arrayJS[194]['NombrePartido'],parseInt(arrayJS[194]['APROBADOS'])],		
		[arrayJS[195]['NombrePartido'],parseInt(arrayJS[195]['APROBADOS'])],		
		[arrayJS[196]['NombrePartido'],parseInt(arrayJS[196]['APROBADOS'])],		
				
	]);

	var options = {
	  title: 'Aprobados por Partido'
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);
  }
</script>

