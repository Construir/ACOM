<?php 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado de abogados incriptos por partidos.xls"');
header('Cache-Control: max-age=0');
?>
<style type="text/css">
	#tabla-incriptos {
		border-collapse: collapse;
	}
	th {background-color:blue;}
	#tabla-incriptos, th, td {
		border:  1px solid black;
	}
</style>
<?php if($reportes){?>
		<table class="table table-striped" id="tabla-incriptos">
			  <thead>
				<tr>									  
				
				  <th style="text-align:center;background-color:#00B4CE">Provincia</th>
				  <th style="text-align:center;background-color:#00B4CE">Partido</th>												 													  
				  <th style="text-align:center;background-color:#00B4CE">Inscriptos</th>
				  <th style="text-align:center;background-color:#00B4CE">Aprobados</th>
				  <th style="text-align:center;background-color:#00B4CE">Pendientes</th>													  
				 																	 
				</tr>
			  </thead>
			  <tbody>
				<?php foreach ($reportes as $reporte) {?>	
					<tr>		
					  	<td style="text-align:left"><?php echo utf8_decode(strtoupper($reporte['NombreProvincia']))?></td>											
						<td style="text-align:left"><?php echo utf8_decode(strtoupper($reporte['NombrePartido']))?></td>											
						<td style="text-align:center"><?php echo $reporte['REGISTRADOS']?></td>					
						<td style="text-align:center"><?php echo $reporte['APROBADOS']?></td>					
						<td style="text-align:center"><?php echo $reporte['PENDIENTES']?></td>						
					</tr>
				<?php }?>
					<tr>
						
						<td class="text-danger font-weight-bold" style="font-weight: bold;font-size:15px;text-align:left;color:red"><?php echo "TOTAL"?></td>											
						<td class="text-danger font-weight-bold" style="font-weight: bold;font-size:15px;text-align:center;color:red"></td>											
						<td class="text-danger font-weight-bold" style="font-weight: bold;font-size:15px;text-align:center;color:red"><?php echo $total_abogados_inscriptos?></td>					
						<td class="text-danger font-weight-bold" style="font-weight: bold;font-size:15px;text-align:center;color:red"><?php echo $total_abogados_aprobados?></td>					
						<td class="text-danger font-weight-bold" style="font-weight: bold;font-size:15px;text-align:center;color:red"><?php echo $total_abogados?></td>					
				
					</tr>
			  </tbody>
		</table>						
	<?php } ?>
  </body>
</html>
