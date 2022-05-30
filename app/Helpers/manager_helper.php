<?php	
	
	function barra_navegacion_por_permiso($permiso){
		switch($permiso){			
			case 1:
					return ('barra_navegacion_administrador');
					break;
			case 2:
					return ('barra_navegacion_cajero');
					break;
			case 6:
					return ('barra_navegacion_mozo');
					break;
		}
	}
	function confirmar_permiso($PERMISOS,$perfil_usuario){
		
		$permiso_ok = false;
		
		$respuesta = array_search($perfil_usuario, $PERMISOS);	//Busca en el Array si existe el permiso (0 == NO ENCONTRO PERMISO)
	
		if($respuesta > 0){
			$permiso_ok = true;
		}
		
		return $permiso_ok ;
	}
?>