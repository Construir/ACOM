<br>
<div class="card">
	<div class="card-body">
		<table id="tabla-sorteos" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th scope="col">Apellido y Nombre</th>
			  <th scope="col">E-mail</th>
			  <th scope="col">Cuit</th>
			  <th scope="col">Teléfono</th>
			  <th scope="col">Celular</th>			
			  <th scope="col">Matriculación</th>			
			  <th scope="col">Domicilio</th>			
			  <th scope="col">Horarios</th>			
			  <th scope="col" style='width:10%'>Acción</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($domicilios as $domicilio){?>				  
			<tr>
				<td><?php echo $domicilio['Apellido'].' '.$domicilio['Nombre']?></td>
				<td><?php echo $domicilio['Email']?></td>											
				<td><?php echo $domicilio['Cuit']?></td>
				<td><?php echo $domicilio['Telefono']?></td>
				<td><?php echo $domicilio['Celular']?></td>	
				<td><?php echo $domicilio['Tomo'].' '.$domicilio['Folio'].' '.$domicilio['Matricula']?></td>	
				<td><?php echo $domicilio['Calle'].' '.$domicilio['Numero'].' '.$domicilio['Piso'].' '.$domicilio['Oficina']?></td>				
				<td><?php echo $domicilio['HorariosAtencion']?></td>																
				<td>										
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
					 
					 <div class="btn-group mr-2" role="group" aria-label="First group">
						<button type="button" class="btn btn-secondary btn-sm">
						<img src="<?php echo base_url(); ?>/imagenes/impresora_blanca.png" width="18" height="18" title="Imprimir">
						</button>
						<button type="button" class="btn btn-primary btn-sm">
						<img src="<?php echo base_url(); ?>/imagenes/aceptar.png" width="18" height="18" title="Aceptar">
						</button>
						<button type="button" class="btn btn-danger btn-sm">
						<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="18" height="18" title="Eliminar">
						</button>					
					  </div>

					</div>						
			   </td>
			</tr>
			<?php }?>
		  </tbody>
		</table>
	</div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function(){		
		
		$('#tabla-sorteos').stacktable();
		$('#tabla-sorteos').DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 0, "asc" ]],
			"paging": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});	
					
	});		
	</script>
  </body>
</html>