<h5 style="color:#016887;padding-top:5px">Listado de Matriculados Sancionados</h5>
<?php if($idPerfil_session == 6){?>
	<div class="container">
		<form action=""  method="post" enctype="multipart/form-data" name="formFiltroColegios" id="formFiltroColegios"> 
		  <div class="row">	  
		  
			<div class="col-sm-12 col-md-12 col-lg-3 col-xl-4">		
									
				<select  style="margin-top:3px;margin-botom:3px" onclick="deshabilita_numerocuit()" name="desplegablecolegio" id="desplegablecolegio" class="form-control">
					<option value="0" selected>Seleccione un colegio</option>												
					  <?php foreach ($colegios as $colegio){ ?>						
													
							<?php if( $colegio['IdDepartamento'] == $colegio_actual){?>														
									<option selected value="<?php echo $colegio['IdDepartamento']?>"><?php echo strtoupper($colegio['NombreDepartamento'])?></option>
							<?php }else{?>
									<option  value="<?php echo $colegio['IdDepartamento']?>"><?php echo strtoupper($colegio['NombreDepartamento'])?></option>
							<?php }?>									  
													  
					  <?php }?>				
				</select>
				
			</div>	
			
			<div class="col-sm-12 col-md-12 col-lg-3 col-xl-4">
			  <input  style="margin-top:3px;margin-botom:3px" onclick="deshabilita_filtro_colegio_y_estado()" type="text" class="form-control" id="numerocuit" name="numerocuit" placeholder="Número de Cuit">
			</div>	
		
			<div class="col-sm-12 col-md-12 col-lg-3 col-xl-4">
			  <button style="margin-top:3px;margin-botom:3px" type="button" id="btn_buscar_sanciones" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 btn btn-primary">Buscar</button>
			</div>	
			
		  </div>
		</form>
		
	</div>
	
<?php }?>
<br>
<div class="card">
	<div class="card-body">
		<table id="tabla-matriculaciones" style="font-size:95%" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th >Apellido y Nombre</th>
			  <th >E-mail estudio</th>
			  <th >Cuit</th>
			  <th >Teléfono estudio</th>			 		
			  <th >Matriculación</th>			 			
			  <th style="width:5% !important">Acción</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($matriculaciones as $matriculacion){?>				  
			<tr>
				<input type="hidden" name="desc_matriculacion<?php echo $matriculacion['IdMatricula']?>" id="desc_matriculacion<?php echo $matriculacion['IdMatricula']?>" value="<?php echo $matriculacion['Apellido'].' '.$matriculacion['Nombre']?>">
				<input type="hidden" name="cuit<?php echo $matriculacion['IdMatricula']?>" id="cuit<?php echo $matriculacion['IdMatricula']?>" value="<?php echo $matriculacion['Cuit']?>">
				
				<td><?php echo $matriculacion['Apellido'].' '.$matriculacion['Nombre']?></td>
				<td><?php echo $matriculacion['Email']?></td>											
				<td><?php echo $matriculacion['Cuit']?></td>
				<td><?php echo $matriculacion['Telefono']?></td>
			
				<td>
				<?php if(empty($matriculacion['Matricula'])){
						echo 'Tomo: '.$matriculacion['Tomo'].' Folio: '.$matriculacion['Folio'];?>
				<?php } else {
						echo ' Matrícula: '.$matriculacion['Matricula'];
					  }				
				?>
				</td>	
				<td>											
				
					<div class="form-inline">	
						<button style="margin-right:3px;margin-top:3px" type="button" class="btn btn-primary btn-sm" onclick="cargar_sanciones(<?php echo $matriculacion['IdMatricula']?>)">
							<img src="<?php echo base_url(); ?>/imagenes/ver.png" width="20" height="20" title="Ver Sanciones">
						</button>									
					</div>							

			   </td>
			</tr>
			<?php }?>
		  </tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="modal_sanciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Sanciones de <b><label style="color:red" id="abogado_sancion"></label></b></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<div class="form-group">						
								
					<div id="div_mensaje_generico" class="alert alert-secondary" role="alert">					
						<label id="sanciones"></label>						
					</div>
													
			</div>
						
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		

		$('#tabla-matriculaciones').stacktable();
		$('#tabla-matriculaciones').DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 0, "asc" ]],
			"paging": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});	
		$('#btn_buscar_sanciones').on('click', function() {
			
			if(validaFiltro()){
				
				$("#formFiltroColegios").attr("action","sanciones");	            
				$("#formFiltroColegios").submit();	
				
			}
			
		});			
	});	
	function deshabilita_numerocuit(){				
		
		document.getElementById('numerocuit').disabled = true;		
		document.getElementById('desplegablecolegio').disabled = false;		
				
		document.getElementById('numerocuit').value = '';		
			
	}
	function deshabilita_filtro_colegio_y_estado(){	
			
		document.getElementById('desplegablecolegio').disabled = true;	
		document.getElementById('numerocuit').disabled = false;		
		
		document.getElementById('desplegablecolegio').value = 0;	
			
	}
	function validaFiltro(){

		var validadoOK = true;
		
		var desplegablecolegio = $("#desplegablecolegio").val();
		//var desplegableestadomatriculacion = $("#desplegableestadomatriculacion").val();
		
		var numerocuit = $("#numerocuit").val();	
			
		if($("#numerocuit").prop('disabled') == true){	
			
			if(desplegablecolegio == 0){			
				
				if (desplegablecolegio == 0){agregaMensajeValidacion($("#desplegablecolegio"), "Debe seleccionar un colegio")};	
				//if (desplegableestadomatriculacion == 0){agregaMensajeValidacion($("#desplegableestadomatriculacion"), "Debe seleccionar un estado")};	
								
				validadoOK = false;		
		
			}
		}
		
		if($("#numerocuit").prop('disabled') == false){			
				
			if(numerocuit.length == 0){
				
				agregaMensajeValidacion($("#numerocuit"), "Debe ingresar un número de cuit");
				
				validadoOK = false;	
			
			}					
			
		}
		return validadoOK;
		
	}
	function buscar_sanciones(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_deshabilitar').value = obj;
		document.getElementById('datos_matriculado_deshabilitar').innerHTML=(matriculacion);		
	
	}	
	function cagar_matriculado_habilitar(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('id_matricula_habilitar').value = obj;
		document.getElementById('datos_matriculado_habilitar').innerHTML=(matriculacion);		
	
	}
	function cargar_sanciones(obj){		
		
		var matriculacion = $("#desc_matriculacion"+obj).val();		
		document.getElementById('abogado_sancion').innerHTML=(matriculacion);	
		
		var url = 'buscar_sanciones_por_matricula_json';
					
		$.ajax({
			type:"POST",					
			url:url,
			data:{id_matriculacion:obj},
			success:function(rta){	
			
				document.getElementById('sanciones').innerHTML=(rta);
				$('#modal_sanciones').modal('show');			
				
			}
		});	
		
	
	}	
	
	</script>
  </body>
</html>