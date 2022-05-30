<br>
<div class="card">
	<div class="card-body">
		<table id="tabla-comisiones" class="table table-striped table-sm">
		  <thead>
			<tr>
			  <th >Comisión</th>
			  <th style='width:15%'>Domicilio</th>
			  <th style='width:10%'>Teléfono</th>
			  <th style='width:10%'>Provincia</th>
			  <th style='width:10%'>Acción</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($comisiones as $comision){?>				  
			<tr>
				<input type="hidden" name="nombre_comision<?php echo $comision['IdComisionMedica']?>" id="nombre_comision<?php echo $comision['IdComisionMedica']?>" value="<?php echo $comision['NombreComisionMedica']?>">
				<input type="hidden" name="direccion_comision<?php echo $comision['IdComisionMedica']?>" id="direccion_comision<?php echo $comision['IdComisionMedica']?>" value="<?php echo $comision['Domicilio']?>">
				<input type="hidden" name="telefono_comision<?php echo $comision['IdComisionMedica']?>" id="telefono_comision<?php echo $comision['IdComisionMedica']?>" value="<?php echo $comision['Telefono']?>">
				<input type="hidden" name="provincia_comision<?php echo $comision['IdComisionMedica']?>" id="provincia_comision<?php echo $comision['IdComisionMedica']?>" value="<?php echo $comision['IdProvincia']?>">
								
				<td><?php echo $comision['NombreComisionMedica']?></td>
				<td><?php echo $comision['Domicilio']?></td>											
				<td><?php echo $comision['Telefono']?></td>
				<td><?php echo $comision['NombreProvincia']?></td>			
				<td>				
						
					<button onclick="editar_comision(<?php echo $comision['IdComisionMedica']?>)"  style="margin-right:3px" type="button" class="btn btn-primary btn-sm">
						<img src="<?php echo base_url(); ?>/imagenes/editar_blanco.png" width="18" height="18" title="Editar">
					</button>
					
					
					<button style="margin-right:3px" type="button" class="btn btn-danger btn-sm" href="#myModal" data-toggle="modal" data-target="#modal_eliminar_comision" id="<?php echo $comision['IdComisionMedica']?>" onclick="cagar_comision_para_eliminar(<?php echo $comision['IdComisionMedica']?>)">
						<img src="<?php echo base_url(); ?>/imagenes/eliminar.png" width="18" height="18" title="Eliminar">
					</button>	
					</a>
			   </td>
			</tr>
			<?php }?>
		  </tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal_eliminar_comision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content ">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Mensaje para el usuario</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>			
		<div class="modal-body">		
								
			<div class="form-group">						
				<div class="alert alert-danger"  role="alert">					
					<div class="form-group">
						<h5>¡Atención!</h5>
						<div>¿Esta seguro que quiere eliminar la comisión <b><label id="nombre_comision_eliminar"></label></b></div>						
					</div>
				</div>										
			</div>
						
			<div class="modal-footer">
				<form class="form-inline" action="eliminar_comision" method="post" enctype="multipart/form-data" id="formeliminarcomision" name="formeliminarcomision">
					<input type="hidden" name="id_comision_eliminar" id="id_comision_eliminar" value="">
					<button type="submit" id="btn_eliminar_comision" class="btn btn-danger">Eliminar</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>									
							
		</div> 
	</div>
  </div>
</div>
<div class="modal fade" id="editar_comision_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Comisión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>		
		<form action=""  method="post" enctype="multipart/form-data" name="formEditarComision" id="formEditarComision"> 
			<input type="hidden" name="id_comision_editar" id="id_comision_editar" value="">	 	
				<div class="card">
					
					<div class="card-body">									
					
						 <div class="col-sm-12">
							<label>Nombre</label>
							<input name="nombre_comisionEditar" id="nombre_comisionEditar" type="text" class="form-control number required">							
						  </div>
						  <br>
						  <div class="col-sm-12">
							<label>Domicilio</label>
							<input name="domicilio_comisionEditar" id="domicilio_comisionEditar" type="text" class="form-control">							
						  </div>
						  <br>
						   <div class="col-sm-12">
							<label>Teléfono</label>
							<input name="telefono_comisionEditar" id="telefono_comisionEditar" type="text" class="form-control">							
						  </div>
						<br>
						 <div class="col-sm-12">
							<label>Provincia</label>
							<select class="form-control required" name="provincia_comisionEditar" id="provincia_comisionEditar" data-required="true">
								<option value="0">Seleccione una Provincia</option>												
								  <?php foreach ($provincias as $provincia){ ?>					
										<option  value="<?php echo $provincia['IdProvincia']?>"><?php echo $provincia['NombreProvincia']?></option>
								  <?php }?>
							</select>							
						  </div>
						  <br>										
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button id="btn_enviar_formulario" style="float:right;margin-right:0.5%" class="btn btn-primary" type="button">Guardar</button>									
												
						</div>
					</div>
				</div>	
			</form>	
	 
    </div>
  </div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		
		$('#btn_enviar_formulario').click(function(){
			if(validarEditarComision()){  
				$("#formEditarComision").attr("action","guardar_editar_comision");	            
				$("#formEditarComision").submit();							
			}
		});
		
		$('#tabla-comisiones').stacktable();
		$('#tabla-comisiones').DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			//"ordering": false,
			"order": [[ 0, "asc" ]],
			"paging": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"			
			}		
		});	
					
	});	
	function cagar_comision_para_eliminar(idcomision){		
		
		var nombre_comision = $("#nombre_comision"+idcomision).val();		
		document.getElementById('id_comision_eliminar').value = idcomision;
		document.getElementById('nombre_comision_eliminar').innerHTML=(nombre_comision + '?');	
		
	}	
	function editar_comision(idcomision){
		
		$(".estilos-errores").remove();		
			
		var nombre_comision = $("#nombre_comision"+idcomision).val();		
		var direccion_comision = $("#direccion_comision"+idcomision).val();	
		var telefono_comision = $("#telefono_comision"+idcomision).val();
		var provincia_comision = $("#provincia_comision"+idcomision).val();
		
		document.getElementById('id_comision_editar').value = idcomision;		
		document.getElementById('nombre_comisionEditar').value = nombre_comision;
		document.getElementById('domicilio_comisionEditar').value = direccion_comision;
		document.getElementById('telefono_comisionEditar').value = telefono_comision;
		document.getElementById('provincia_comisionEditar').value = provincia_comision;

		
		$('#editar_comision_modal').modal('show');		
		
	}
	function valida_cadena(event, el){//Validar nombre	
		//Obteniendo posicion del cursor 
		var val = el.value;//Valor de la caja de texto
		var pos = val.slice(0, el.selectionStart).length;
		
		var out = '';//Salida
		var filtro = '0123456789';
		var v = 0;//Contador de caracteres validos
		
		//Filtar solo los numeros
		for (var i=0; i<val.length; i++){
		   if (filtro.indexOf(val.charAt(i)) != -1){
			 v++;
			 out += val.charAt(i);		   
			 //Agregando un espacio cada 4 caracteres
			 //if((v==4) || (v==8) || (v==12))
				 //out+=' ';
		   }
		}
		//Reemplazando el valor
		el.value = out;
		
		//En caso de modificar un numero reposicionar el cursor
		//if(event.keyCode==8){//Tecla borrar precionada
			//el.selectionStart = pos;
			//el.selectionEnd = pos;
		//}
	}
	</script>
  </body>
</html>