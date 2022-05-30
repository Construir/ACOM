<br>
<div class="container col-12">
	<table id="tabla-sorteos" class="table table-striped table-sm">
	  <thead>
		<tr>
		  <th scope="col">Nro. Sorteo</th>
		  <th scope="col">Fecha</th>
		  <th scope="col">Nombre</th>
		  <th scope="col">Apellido</th>
		  <th scope="col">Dni</th>
		  <th scope="col">Teléfono</th>
		  <th scope="col">E-mail</th>
		  <th scope="col">Partido</th>
		  <th scope="col">Estado</th>
		  <th scope="col">Acción</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <th scope="row">1</th>
		  <td>21-3-2020</td>
		  <td>Mario Jose Alberto</td>
		  <td>Barrios</td>
		  <td>23654789</td>
		  <td>1540317702 / 60738172</td>
		  <td>mario@gmail.com</td>
		  <td>Gral. Pueyrredón</td>
		  <td>Pendiente</td>
		  <td>
			<div class="btn-group" style="float:right" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-danger btn-sm">Recusar</button>
			  <button type="button" class="btn btn-secondary  btn-sm">Sorteo</button>
			  <button type="button" class="btn btn-secondary  btn-sm">Consulta</button>
			</div>
		  </td>	  
		</tr>
			<tr>
		  <th scope="row">2</th>
		  <td>21-3-2020</td>
		  <td>Sabrina</td>
		  <td>Garcia</td>
		  <td>23654789</td>
		  <td>2281530475 / 2281530475</td>
		  <td>mario@gmail.com</td>
		  <td>Gral. Pueyrredón</td>
		  <td>Pendiente</td>
		  <td>
			<div class="btn-group" style="float:right" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-danger btn-sm">Recusar</button>
			  <button type="button" class="btn btn-secondary  btn-sm">Sorteo</button>
			  <button type="button" class="btn btn-secondary  btn-sm">Consulta</button>
			</div>
		  </td>	  
		</tr>
			<tr>
		  <th scope="row">3</th>
		  <td>21-3-2020</td>
		  <td>Federico Mariano</td>
		  <td>Alvear</td>
		  <td>23654789</td>
		  <td>456-7894</td>
		  <td>mario@gmail.com</td>
		  <td>Gral. Pueyrredón</td>
		  <td>Pendiente</td>
		  <td>
			<div class="btn-group" style="float:right" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-danger btn-sm">Recusar</button>
			  <button type="button" class="btn btn-secondary  btn-sm">Sorteo</button>
			  <button type="button" class="btn btn-secondary  btn-sm">Consulta</button>
			</div>
		  </td>	  
		</tr> 
	  </tbody>
	</table>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		
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