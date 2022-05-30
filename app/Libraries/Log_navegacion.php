<?php
namespace App\Libraries;
use App\Models\Log_navegacion_sorteos_modelo;
use App\Models\Log_navegacion_registro_modelo;

class Log_navegacion{	

	public function guardar_navegante_de_sorteo($IdAbogado){		
		
		$logNavegacionSorteosModelo = new Log_navegacion_sorteos_modelo($db);	
		
		//Guardamos los datos de navegacion de quien hace el registro
		$datos_navegacion = $this->detect();
		
		$data = [								
			'IdUsuario' => $IdAbogado,														
			'Fecha' => date('y-m-d H:i:s'),														
			//'Ip' => $datos_navegacion['version'],														
			'Ip' => $this->obtener_ip(),														
			'SistemaOperativo' => $datos_navegacion['os'],														
			'Navegador' => $datos_navegacion['browser'],											
																														
		];
		$logNavegacionSorteosModelo->insert($data);
	
	}
	public function guardar_navegante_de_registro($IdAbogado,$POST_COMPLETO){		
		
		$logNavegacionRegistroModelo = new Log_navegacion_registro_modelo($db);	
		
		//Guardamos los datos de navegacion de quien hace el registro
		$datos_navegacion = $this->detect();
		
		$version = '';
		$os = '';
		$browser = '';
			
		if(!empty($datos_navegacion)){
			
			if(!empty($datos_navegacion['version'])){
				$version = $datos_navegacion['version'];
			}
			if(!empty($datos_navegacion['os'])){
				$os = $datos_navegacion['os'];
			}
			if(!empty($datos_navegacion['browser'])){
				$browser = $datos_navegacion['browser'];
			}
		}
		
		$data = [								
			'IdUsuario' => $IdAbogado,														
			'Fecha' => date('y-m-d H:i:s'),														
			'Ip' => $version,														
			'SistemaOperativo' => $os,														
			'Navegador' => $browser,
			'Apellido' => $POST_COMPLETO['apellidoAbogado'],
			'Nombre' => $POST_COMPLETO['nombreAbogado'],			
			'Cuit' => $POST_COMPLETO['cuitAbogado'],
			'IdColegio' => $POST_COMPLETO['colegioAbogado'],
			'Matricula' => $POST_COMPLETO['matriculaAbogado'],
			'Tomo' => $POST_COMPLETO['tomoAbogado'],							 									
			'Folio' => $POST_COMPLETO['folioAbogado'],
			'IdProvincia' => $POST_COMPLETO['provincia'],
			'IdPartido' => $POST_COMPLETO['partidoDomicilio'],
			'IdLocalidad' => $POST_COMPLETO['localidadDomicilio'],							 									
			'Calle' => $POST_COMPLETO['calleDomicilio'],
			'Numero' => $POST_COMPLETO['numeroDomicilio'],
			'Piso' => $POST_COMPLETO['pisoDomicilio'],									
			'Oficina' => $POST_COMPLETO['oficinaDomicilio'],
			'Email' => $POST_COMPLETO['emailEstudio'],							 
			'Telefono' => $POST_COMPLETO['telefonoEstudio'],
			'HorariosAtencion' => $POST_COMPLETO['horarioDomicilio'],				
																														
		];
		$logNavegacionRegistroModelo->insert($data);
		
	}
	function detect(){
		
		$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
		$os=array("WIN","MAC","LINUX");
	 
		# definimos unos valores por defecto para el navegador y el sistema operativo
		$info['browser'] = "OTHER";
		$info['os'] = "OTHER";
	 
		# buscamos el navegador con su sistema operativo
		foreach($browser as $parent)
		{
			$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
			$f = $s + strlen($parent);
			$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
			$version = preg_replace('/[^0-9,.]/','',$version);
			if ($s)
			{
				$info['browser'] = $parent;
				$info['version'] = $version;
			}
		}
	 
		# obtenemos el sistema operativo
		foreach($os as $val)
		{
			if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
				$info['os'] = $val;
		}
	 
		# devolvemos el array de valores
		return $info;
	}
	function obtener_ip(){
		
		$ip = '';
		
		if(isset($_SERVER['HTTP_CLIENT_IP'])){
			
			$ip = $_SERVER['HTTP_CLIENT_IP'];
			
		}else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
			
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			
		}else if(isset($_SERVER['HTTP_X_FORWARDED'])){
			
			$ip = $_SERVER['HTTP_X_FORWARDED'];
			
		}else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
			
			$ip = $_SERVER['HTTP_FORWARDED_FOR'];
			
		}else if(isset($_SERVER['HTTP_FORWARDED'])){
			
			$ip = $_SERVER['HTTP_FORWARDED'];
			
		}else if(isset($_SERVER['REMOTE_ADDR'])){
			
			$ip = $_SERVER['REMOTE_ADDR'];
			
		}
		return $ip;
	}	
}

?>