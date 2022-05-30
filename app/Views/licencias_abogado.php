<h5 style="color:#016887;padding-top:5px">Licencias</h5>
<div class="card">
	<div class="card-body">
		<table id="tabla-licencias" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th scope="col">Colegio</th>
			  <th scope="col">Fecha Solicitada</th>
			  <th scope="col">Fecha desde</th>
			  <th scope="col">Fecha hasta</th>
			  <th scope="col">Motivo</th>		 				
			  
			</tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($licencias as $licencia){?>				  
			<tr>
				<input type="hidden" name="nombre_colegio<?php echo $licencia['IdMatriculacion']?>" id="nombre_colegio<?php echo $licencia['IdMatriculacion']?>" value="<?php echo $licencia['NombreColegio']?>">
				<input type="hidden" name="fecha_fin_licencia<?php echo $licencia['IdMatriculacion']?>" id="fecha_fin_licencia<?php echo $licencia['IdMatriculacion']?>" value="<?php echo date("d-m-Y",strtotime($licencia['FechaFin']))?>">
												
				<td><?php echo $licencia['NombreColegio']?></td>			
				<td><?php echo date("d-m-Y h:i:s",strtotime($licencia['FechaRegistro']))?></td>
				<td><?php echo date("d-m-Y",strtotime($licencia['FechaInicio']))?></td>								
				<td><?php echo date("d-m-Y",strtotime($licencia['FechaFin']))?></td>
				<td><?php echo $licencia['DetalleMotivo']?></td>
			
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
		
		$('#tabla-licencias').stacktable();
		$('#tabla-licencias').DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 0, "desc" ]],
			"paging": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});	
					
	});	
	
	</script>
  </body>
</html>