<?php 
namespace App\Controllers;

use App\Models\Usuario_modelo;
use App\Models\Comisiones_modelo;
use App\Models\Consultantes_modelo;
use App\Models\Consultas_modelo;
use App\Models\Abogados_modelo;
use App\Models\Provincias_modelo;
use App\Models\Partidos_modelo;
use App\Models\Municipios_modelo;
use App\Models\Localidades_modelo;
use App\Models\Domicilios_modelo;
use App\Models\Matriculaciones_modelo;
use App\Models\Departamentos_modelo;
use App\Models\Licencias_modelo;
use App\Models\Tipos_consultas_modelo;
use App\Models\Movimientos_consulta_modelo;
use App\Models\Movimientos_estados_consultas;
use App\Models\Requirentes_modelo;
use App\Models\Detalle_cambio_matricula_modelo;
use App\Models\Estado_matricula_modelo;
use App\Models\Estado_consultas_modelo;
use App\Models\Sorteos_modelo;
use App\Models\Tipo_estados_matricula_modelo;
use App\Models\Tipo_movimientos_causas_modelo;
use App\Models\Log_cambios_de_estados_localidades;
use App\Models\Motivos_excusacion_modelo;
use App\Models\Detalles_movimientos_causas_modelo;
use App\Models\Movimientos_justicia_ordinaria_modelo;
use App\Models\Movimientos_comision_medica_central_modelo;
use App\Models\Log_ejecucion_tares_programadas_modelo;

use App\Libraries\Formulario_incripcion as pdf;
use App\Libraries\Formulario_sorteo as pdf_sorteo;
use App\Libraries\Formulario_sorteo_sin_qr as pdf_sorteo_para_qr;
use App\Libraries\Enviar_mail as email;
use App\Libraries\Log_navegacion as navegacion;
use App\Models\Motivo_finalizacion_tramites_modelo;

use App\Libraries\Credencial as credencial_pdf;

class Acom extends BaseController{
	
	public $session = null;
		
	function credenciales(){
		
		$data = array('Nombre' => 'Claudio',
					  'Apellido' => 'Ialonardi',					
					  'Dni' => '25.062.614'
					);
					
		$pdf = new credencial_pdf();
		$pdf->imprimir($data);
		
	}
	function index($mensaje = null) {
		
		//INSTANCIA DE MODELOS
		$session = \Config\Services::session();
		$session->destroy();
		
		if(empty($mensaje)){
			$data = ['mensaje' => ''];
		}else{
			$data = ['mensaje' => $mensaje];
		}
		
		echo view('encabezado');			
		echo view('home',$data);

	}
	function mandar_mail(){		
		//$resultado = mail('ialonardiclaudio@gmail.com', 'Sistema ACOM', 'Estimado, le informamos que su solicitud fue APROBADA.<br> Atentamente. Soporte Sistema ACOM desarrollo@colproba.org.ar');			
		
		$direccion_email = 'ialonardiclaudio@gmail.com';					
		$asunto = 'Sistema ACOM';					
		$mensaje = 'Mail de prueba'. "<br>";
		//$mensaje .= 'Atentamente. Soporte Sistema ACOM acom@colproba.org.ar';
		
		$email = new email();
		
		$email->enviar_mail($direccion_email,$asunto,$mensaje);
		
	}
	/*
	function mandar_mail(){		
					
		$mail_abogado = 'ialonardiclaudio@gmail.com';					
		$asunto = 'Sistema ACOM';					
		$mensaje_abogado = 'Estimado, le informamos que su solicitud fue APROBADA.<br> Atentamente. Soporte Sistema ACOM desarrollo@colproba.org.ar';
		
		$email = new email();
		
		$email->enviar_mail($mail_abogado,'',$asunto,$mensaje_abogado);
	}*/
	function pagina_en_construccion(){		
	
		echo view('encabezado');			
		echo view('pagina_en_construccion');

	}
	function login_abogados($mensaje = null) {
		
		//INSTANCIA DE MODELOS
		$session = \Config\Services::session();
		$departamentoModelo = new Departamentos_modelo($db);
		$session->destroy();
		
		if(empty($mensaje)){
			$data = ['mensaje' => '',
					 'departamentos' => $departamentoModelo->devolver_departamentos_con_provincia(),
					];
		}else{
			$data = ['mensaje' => $mensaje,
					 'departamentos' => $departamentoModelo->devolver_departamentos_con_provincia(),
					];
		}
		
		echo view('encabezado');			
		echo view('login_vista_abogados',$data);

	}	
	function login_administracion($mensaje = null) {
		
		//INSTANCIA DE MODELOS
		$session = \Config\Services::session();
		$session->destroy();
		
		if(empty($mensaje)){
			$data = ['mensaje' => ''];
		}else{
			$data = ['mensaje' => $mensaje];
		}
		
		echo view('encabezado');			
		echo view('login_vista_administracion',$data);

	}
	function guardar_cambiar_contrasenia(){
		
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();
		$session = \Config\Services::session();	
		$abogadosModelo = new Abogados_modelo($db);
		$usuariosModelo = new Usuario_modelo($db);
		
		$idusuario_session = $session->get('idusuario');
		$idusuario_solicita = $request->getPostGet('idusuario');
		$passwordregistro = $request->getPostGet('pass1');
		$confirmarpassword = $request->getPostGet('pass2');
		
		if($passwordregistro == $confirmarpassword ){
			
			if($idusuario_session == $idusuario_solicita){
						
				if($session->get('idPerfil') == 1){					//es abogado
					$abogadosModelo->actualizar_contrasenia_abogados($session->get('idusuario'),$session->get('nombre_usuario'),$request->getPostGet('pass1'));
				}else{												//es de la administracion, colegio, sorteos o administrador
					$usuariosModelo->actualizar_contrasenia_usuarios($session->get('idusuario'),$session->get('nombre_usuario'),$request->getPostGet('pass1'));
				}
				echo true;
				
			}else{
				
				echo false;
			
			}			
			
		}else{	
		
			echo false;
			
		}	
	}
	function guardar_cambiar_datos_contacto(){
		
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();
		$session = \Config\Services::session();	
	
		$usuariosModelo = new Usuario_modelo($db);		
			
		if($session->get('idusuario') == $request->getPostGet('idusuario')){

			$usuario = $usuariosModelo->verifica_si_existe_otro_usuario_igual($session->get('idusuario'),$request->getPostGet('nombre_usuario'));
			
			if(empty($usuario)){
				
				$usuariosModelo->actualizar_datos_contacto_usuarios($session->get('idusuario'),$session->get('nombre_usuario'),$request->getPostGet('apellido'),
																	$request->getPostGet('nombre'),$request->getPostGet('email'),$request->getPostGet('nombre_usuario'),
																	$request->getPostGet('celular'),$request->getPostGet('telefono'));								
						
				$array = ['email' => $request->getPostGet('email'),										   
						  'apellidoUsuario' => $request->getPostGet('apellido'),
						  'nombreUsuario' => $request->getPostGet('nombre'),
						  'telefono' => $request->getPostGet('telefono'),
						  'celular' => $request->getPostGet('celular'),
						  'nombre_usuario' => $request->getPostGet('nombre_usuario'),					 						   
						  'nombreUsuarioCompleto' => $request->getPostGet('apellido').' '.$request->getPostGet('nombre'),						   
						  'actualizo_datos_personales' => date("Y-m-d h:i:s"),						   
				];
							   
				$session->set($array);
				
				echo '1';					//LO CAMBIO
				
			}else{
				
				echo '2';					//EXISTE UN USUARIO CON ESE NOMBRE
				
			}	
			
		}else{
			
			echo '0';						//EL QUE QUIERE CAMBIAR NO ES EL USUARIO DUEÑO DE LOS DATOS
		
		}			
	}	
	function valida_usuario(){
		
		//INSTANCIA DE MODELOS
		$usuariosModelo = new Usuario_modelo($db);		
		$abogadosModelo = new Abogados_modelo($db);
		$departamentoModelo = new Departamentos_modelo($db);
				
		$request = \Config\Services::request();
		$session = \Config\Services::session();	
		
		$usuario =  $request->getPostGet('usuario');
		$password = $request->getPostGet('password');
		$origen_login = $request->getPostGet('origen_login');
	
		if($origen_login == 6){
			$datosUsuario = $usuariosModelo->where('Usuario' , $request->getPostGet('usuario'))
										   ->where('Contrasenia' , $request->getPostGet('password'))
										   ->findAll();
		
		}else if ($origen_login == 1){
			$datosUsuario = $abogadosModelo->where('Usuario' , $request->getPostGet('usuario'))
										   ->where('Contrasenia' , $request->getPostGet('password'))
										   ->findAll();
			
		}else{
			$datosUsuario  = '';
		}
		//var_dump($datosUsuario[0]['ActualizoDatosPersonales']);		
		if(!empty($datosUsuario)){			
			
			switch($datosUsuario[0]['IdPerfil']){			
									
				case 1:				
						$nombreperfil = 'Adogado';
						$idusuario = $datosUsuario[0]['IdAbogado'];
						$nombre_usuario = $datosUsuario[0]['Usuario'];
						$celular = $datosUsuario[0]['Celular'];
						$telefono = $datosUsuario[0]['Telefono'];
						$cuit = $datosUsuario[0]['Cuit'];
						$actualizo_datos_personales = '';
						break;
				case 2:							
						$nombreperfil = 'Colegio';
						$idusuario = $datosUsuario[0]['IdUsuario'];
						$nombre_usuario = $datosUsuario[0]['Usuario'];
						$celular = $datosUsuario[0]['Celular'];
						$telefono = $datosUsuario[0]['Telefono'];						
						$cuit = '';
						$actualizo_datos_personales = $datosUsuario[0]['ActualizoDatosPersonales'];
						break;
				case 3:							
						$nombreperfil = 'Sorteo';
						$idusuario = $datosUsuario[0]['IdUsuario'];
						$nombre_usuario = $datosUsuario[0]['Usuario'];
						$celular = $datosUsuario[0]['Celular'];
						$telefono = $datosUsuario[0]['Telefono'];
						$cuit = '';
						$actualizo_datos_personales = $datosUsuario[0]['ActualizoDatosPersonales'];
						break;
				case 6:		
						$nombreperfil = 'Administrador';
						$idusuario = $datosUsuario[0]['IdUsuario'];	
						$nombre_usuario = $datosUsuario[0]['Usuario'];
						$celular = $datosUsuario[0]['Celular'];
						$telefono = $datosUsuario[0]['Telefono'];
						$cuit = '';	
						$actualizo_datos_personales = $datosUsuario[0]['ActualizoDatosPersonales'];						
						break;
				case 7:		
						$nombreperfil = 'Ministerio';
						$idusuario = $datosUsuario[0]['IdUsuario'];	
						$nombre_usuario = $datosUsuario[0]['Usuario'];
						$celular = '';
						$telefono = '';
						$cuit = '';	
						$actualizo_datos_personales = $datosUsuario[0]['ActualizoDatosPersonales'];						
						break;						
			}
			
			$array = ['idusuario' => $idusuario,
					  'nombreperfil' => $nombreperfil,						   
					  'email' => $datosUsuario[0]['Email'],						   
					  'cuit' => $cuit,						   
					  'nombre_usuario' => $nombre_usuario,						   
					  'celular' => $celular,						   
					  'telefono' => $telefono,						   
					  'apellidoUsuario' => $datosUsuario[0]['Apellido'],
					  'nombreUsuario' => $datosUsuario[0]['Nombre'],						   
					  'nombreUsuarioCompleto' => $datosUsuario[0]['Apellido'].' '.$datosUsuario[0]['Nombre'],						   
					  'idPerfil' => $datosUsuario[0]['IdPerfil'],					  
					  'idEntidad' => $datosUsuario[0]['IdEntidad'],					  
					  'idColegio' => $datosUsuario[0]['IdColegio'],					  
					  'actualizo_datos_personales' => $actualizo_datos_personales,					  
					  'login_ok' => TRUE];
					   
			$session->set($array);
			//if ($datosUsuario[0]['Estado'] == 1){				
				
				switch($datosUsuario[0]['IdPerfil']){	
				
					case 1:
						
						$data = ['UltimaLogueado' => date('Y-m-d H:i:s')];									
						$abogadosModelo->update($idusuario,$data);
						$this->sorteos();//ABOGADOS						
						break;
						
					case 2:
					
						$data = ['UltimaLogueado' => date('Y-m-d H:i:s')];									
						$usuariosModelo->update($idusuario,$data);
						$this->nuevos_inscriptos();//COLEGIOS
						//case 2:$this->pagina_en_construccion();//COLEGIOS						
						break;		
						
					case 3:
					
						$data = ['UltimaLogueado' => date('Y-m-d H:i:s')];									
						$usuariosModelo->update($idusuario,$data);
						$this->nuevo_sorteo();//PERSONAL DE SORTEOS							
						break;		
						
					case 6:
					
						$data = ['UltimaLogueado' => date('Y-m-d H:i:s')];									
						$usuariosModelo->update($idusuario,$data);
						$this->sorteos();//ADMINISTRADOR						
						break;
					
					case 7:
					
						$data = ['UltimaLogueado' => date('Y-m-d H:i:s')];									
						$usuariosModelo->update($idusuario,$data);
						//$this->reportes_ministerio();//Ministerio						
						$this->home();//Ministerio						
						break;
						
				}
			/*					
			}else{	
				$data = array('mensaje' => '¡Atención! Registro pendiente de aprobación por su colegio profesional.');
				echo view('encabezado');
				
				if($origen_login == 6){
					echo view('login_vista_administracion',$data);	
				}else if ($origen_login == 1){
					echo view('login_vista_abogados',$data);
				}
				
			}
			*/
		}else{
			$data = array('departamentos' => $departamentoModelo->devolver_departamentos_con_provincia(),
						  'mensaje' => 'Usuario inválido.');
			echo view('encabezado');
			
			if($origen_login == 6){
				echo view('login_vista_administracion',$data);	
			}else if ($origen_login == 1){
				echo view('login_vista_abogados',$data);
			}			
		}
			
	}
	function home(){	
		
		//INSTANCIA DE MODELOS
		$session = \Config\Services::session();
		$matriculacionesModelo = new Matriculaciones_modelo($db);		
		
		echo view('encabezado');
		echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
		echo view('colproba');	

	}
	function matriculas(){
		try{
			
			$session = \Config\Services::session();
			$permisos = array(1=>1,2=>2,3=>3,4=>6);			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método
			if($permiso_ok){				
				
				//INSTANCIA DE MODELOS
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				
				$data = array ('desde' => date('Y-m-d'),
							   'hasta' => date('Y-m-d'),
							   'domicilios' => $matriculacionesModelo->devolver_matriculaciones_x_abogado($session->get('cuit')),						  
				);				

				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('matriculas', $data);
				
			}else{
				$this->index('<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function matriculas_abogado(){
		try{		
		
			$session = \Config\Services::session();
			$permisos = array(1=>1,2=>2,3=>3,4=>6);			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método
			if($permiso_ok){				
				
				//INSTANCIA DE MODELOS
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				$provinciasModelo = new Provincias_modelo($db);	
				$partidosModelo = new Partidos_modelo($db);				
				
				$domicilio = $matriculacionesModelo->devolver_matriculaciones_x_abogado_x_cuit($session->get('cuit'));
				
				$data = array ('domicilios' => $matriculacionesModelo->devolver_matriculaciones_x_abogado_x_cuit($session->get('cuit')),
							   'partidos' => $partidosModelo->devolver_partidos_por_provincia($domicilio[0]['IdProvincia']),				
							  
				);			
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('matriculas_abogado', $data);
				
			}else{
				$this->index('<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function nueva_matricula(){
		try{
			
			//INSTANCIA DE MODELOS			
			$departamentoModelo = new Departamentos_modelo($db);			
			$provinciasModelo = new Provincias_modelo($db);			
			$partidosModelo = new Partidos_modelo($db);
			$municipiosModelo = new Municipios_modelo($db);
			$localidadesModelo = new Localidades_modelo($db);
			$abogadosModelo = new Abogados_modelo($db);
			$session = \Config\Services::session();
						
			$data = array ('provincias' => $provinciasModelo->devolver_provincias(),						 
						   'partidos' => $partidosModelo->devolver_partidos(),							  
						   'localidades' => $localidadesModelo->devolver_localidades(),							  
						   'departamentos' => $departamentoModelo->devolver_departamentos(),							  
						   'datos_abogado' => $abogadosModelo->where('Cuit', $session->get('cuit'))->findAll(),							  
			);
				
			echo view('encabezado');	
			echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());			
			echo view('nueva_matricula',$data);	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot');
		}
	}
	function licencias_abogado(){
		try{
			
			$session = \Config\Services::session();
			$permisos = array(1=>1,2=>2,3=>3,4=>6);			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método
			if($permiso_ok){				
				
				//INSTANCIA DE MODELOS
				$licenciaModelo = new Licencias_modelo($db);		
				
				$data = array ('licencias' => $licenciaModelo->devolver_licencias_x_abogado($session->get('cuit')));
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('licencias_abogado', $data);
				
			}else{
				$this->index('<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function nueva_licencia(){
		try{
			
			//INSTANCIA DE MODELOS	
			$session = \Config\Services::session();
			$matriculacionesModelo = new Matriculaciones_modelo($db);
						
			$data = array ('cuit' =>$session->get('cuit'),
						   'matriculaciones' => $matriculacionesModelo->devolver_colegios_x_abogado($session->get('cuit')),						  
							  
			);
				
			echo view('encabezado');	
			echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());			
			echo view('nueva_licencia',$data);	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	function nuevo_sorteo(){
		try{
			
			$session = \Config\Services::session();			
			
				
				//INSTANCIA DE MODELOS				
				$departamentosModelo = new Departamentos_modelo($db);			
				$provinciasModelo = new Provincias_modelo($db);			
				$partidosModelo = new Partidos_modelo($db);
				$municipiosModelo = new Municipios_modelo($db);
				$localidadesModelo = new Localidades_modelo($db);
				$tiposConsultasModelo = new Tipos_consultas_modelo($db);
				$matriculacionesModelo = new Matriculaciones_modelo($db);
					
				if(!empty($session->get('idusuario'))){
					$origen = 1; //usuarios para sorteos
				}else{
					$origen = 0; //publico
				}				
				
				$data = array ('provincias' => $provinciasModelo->devolver_provincias_con_abogados(),						 
							   'partidos' => $partidosModelo->devolver_partidos(),							  
							   'localidades' => $localidadesModelo->devolver_localidades(),							  
							   'departamentos' => $departamentosModelo->devolver_departamentos(),							  
							   'tiposconsulta' => $tiposConsultasModelo->where('Estado' , 1)->findAll(),
							   'origen' => $origen,							   
				);
				echo view('encabezado');
				
				if(!empty($session->get('idusuario'))){
					
					echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());	
					
				}
				
				echo view('nuevo_sorteo',$data);		
						
				
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	function reportes_ministerio(){
		try{
			
			$session = \Config\Services::session();			
			
				
				//INSTANCIA DE MODELOS				
				$departamentosModelo = new Departamentos_modelo($db);			
				$provinciasModelo = new Provincias_modelo($db);			
				$partidosModelo = new Partidos_modelo($db);
				$municipiosModelo = new Municipios_modelo($db);
				$localidadesModelo = new Localidades_modelo($db);
				$tiposConsultasModelo = new Tipos_consultas_modelo($db);
				$matriculacionesModelo = new Matriculaciones_modelo($db);
					
				if(!empty($session->get('idusuario'))){
					$origen = 1; //usuarios para sorteos
				}else{
					$origen = 0; //publico
				}				
				
				$data = array ('provincias' => $provinciasModelo->devolver_provincias(),						 
							   'partidos' => $partidosModelo->devolver_partidos(),							  
							   'localidades' => $localidadesModelo->devolver_localidades(),							  
							   'departamentos' => $departamentosModelo->devolver_departamentos(),							  
							   'tiposconsulta' => $tiposConsultasModelo->where('Estado' , 1)->findAll(),
							   'origen' => $origen,							   
				);
				echo view('encabezado');
				
				if(!empty($session->get('idusuario'))){
						
					echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());	
					
				}
				
				echo view('nuevo_sorteo',$data);		
						
				
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function nuevo_usuario(){
		try{
			
			$session = \Config\Services::session();			
			
				
				//INSTANCIA DE MODELOS				
				$departamentosModelo = new Departamentos_modelo($db);			
				$provinciasModelo = new Provincias_modelo($db);			
				$partidosModelo = new Partidos_modelo($db);
				$municipiosModelo = new Municipios_modelo($db);
				$localidadesModelo = new Localidades_modelo($db);
				$tiposConsultasModelo = new Tipos_consultas_modelo($db);
				$matriculacionesModelo = new Matriculaciones_modelo($db);
					
				if(!empty($session->get('idusuario'))){
					$origen = 1; //usuarios para sorteos
				}else{
					$origen = 0; //publico
				}				
				
				$data = array ('provincias' => $provinciasModelo->devolver_provincias(),						 
							   'partidos' => $partidosModelo->devolver_partidos(),							  
							   'localidades' => $localidadesModelo->devolver_localidades(),							  
							   'departamentos' => $departamentosModelo->devolver_departamentos(),							  
							   'tiposconsulta' => $tiposConsultasModelo->where('Estado' , 1)->findAll(),
							   'origen' => $origen,							   
				);
				echo view('encabezado');
				
				if(!empty($session->get('idusuario'))){
										
					echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());	
					
				}
				
				echo view('nuevo_usuario',$data);		
						
				
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	function inicio_administrador(){
		try{
			$permisos = array(4=>6);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método
						
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS				
				$causasModelo = new Usuario_modelo($db);
				
				$data = array ('desde' => date('Y-m-d'),
							   'hasta' => date('Y-m-d'),
							   'causas_sorteadas' => $causasModelo->where('IdUsuario', $session->get('idusuario'))->findAll(),						  
				);
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('inicio_administrador', $data);	
								
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	function sorteos(){
		try{
			$permisos = array(1=>1,2=>2,3=>3,4=>6,5=>7);		
			$session = \Config\Services::session();	
						
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$consultasModelo = new Consultas_modelo($db);
				$matriculacionesModelo = new Matriculaciones_modelo($db);				
				$estadoConsultasModelo = new Estado_consultas_modelo($db);
				$motivosExcusacionModelo = new Motivos_excusacion_modelo($db);
				$usuariosModelo = new Usuario_modelo($db);
				$request = \Config\Services::request();							
				
				//var_dump($request->getPostGet('fechadesde'),$request->getPostGet('fechafin'),$request->getPostGet('desplegableestadoconsulta'),$request->getPostGet('numerosorteo'));
				
				$desde = date('Y-m-d', strtotime('-30 day'));
				$hasta = date("Y-m-d 23:59:59");
				$estado_sorteos = 0;				
				$numerosorteo = '';				
				$estado_actual = 4;//Sin Respuesta
				
				//sirve si entra por primera vez o si viene desde consultar sorteos
				if((empty($request->getPostGet('fechadesde'))) and (empty($request->getPostGet('fechafin'))) and (empty($request->getPostGet('numerosorteo')))){	//entra por primera vez
					$desde = date('Y-m-d', strtotime('-30 day'));
					$hasta = date("Y-m-d 23:59:59");
					$estado_sorteos = 4;
				}else{																							//viene desde consultar sorteos
					
					if(empty($request->getPostGet('numerosorteo'))){											//si esta vacio, es que consulta por fecha y tipo
											
						$desde = date("Y-m-d 00:00:01",strtotime($request->getPostGet('fechadesde')));
						$hasta = date("Y-m-d 23:59:59",strtotime($request->getPostGet('fechafin')));
						$estado_sorteos = $request->getPostGet('desplegableestadoconsultafiltro');
					
					}else{
						//var_dump($session->get('idColegio'),$numerosorteo);
						$numerosorteo = $request->getPostGet('numerosorteo');
						
					}
					
				}					
				
				if(!empty($request->getPostGet('desplegableestadoconsultafiltro'))){
					
					$estado_actual = $request->getPostGet('desplegableestadoconsultafiltro');
				
				}
				
				if($session->get('idPerfil') == 1){								    				//es un abogado
				
					$sorteos = $consultasModelo->devolver_consultas_por_abogado($session->get('idusuario'));
					
				}else if($session->get('idPerfil') == 2){											//es un colegio
					
					if(empty($numerosorteo)){	//consulto por fechas y tipo
						
						$sorteos = $consultasModelo->devolver_consultas_por_colegio($session->get('idColegio'),$desde,$hasta,$estado_sorteos);
						
					}else{						//consulto por numero
						
						$sorteos = $consultasModelo->devolver_consultas_por_numero($session->get('idColegio'),$numerosorteo);
						
					}
					
				}else{																				//es el administrador
				
					if(empty($numerosorteo)){	//consulto por fechas y tipo
					
						$sorteos = $consultasModelo->devolver_consultas_para_administrador($desde,$hasta,$estado_sorteos);
						
					}else{
						
						$sorteos = $consultasModelo->devolver_consultas_por_numero_administrador($numerosorteo);
						
					}
				}
				//verificamos que haya cambiado la contraseña
				if($session->get('idPerfil') == 1){	
				
					$cuit_igual_password_ok = $usuariosModelo->devolver_cuit_igual_password($session->get('cuit'));
					
					if(!empty($cuit_igual_password_ok)){
						$mensaje_cambiar_contrasena = true;
					}else{
						$mensaje_cambiar_contrasena = false;
					}
				}else{
					$mensaje_cambiar_contrasena = false;
				}
				
				$data = array( 'causas_sorteadas' => $sorteos,
							   'fechadesde' => date("Y-m-d",strtotime($desde)),
							   'fechahasta' => date("Y-m-d",strtotime($hasta)),
							   //'estado_consultas' => $estadoConsultasModelo->orderBy('NombreEstadoConsulta', 'asc')->findAll(),
							   'estado_consultas' => $estadoConsultasModelo->devolver_estados_consultas_por_usuario($session->get('idPerfil')),
							   'estado_consultas_filtro' => $estadoConsultasModelo->findAll(),
							   'motivos_excusaciones' => $motivosExcusacionModelo->findAll(),
							   'perfil_usuario' => $session->get('idPerfil'),							   
							   'estado_actual' => $estado_actual,
							   'mensaje_cambiar_contrasena' => $mensaje_cambiar_contrasena,
							 );
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				
				if($session->get('idPerfil') == 1){//es un abogado
					echo view('sorteos_abogados', $data);
				}else{
					echo view('sorteos_colegios', $data);//es un colegio o el administrador
				}
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function recusaciones(){
		try{
			$permisos = array(1=>2,2=>3,4=>6,5=>7);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){				
				
				//INSTANCIA DE MODELOS
				$causasModelo = new Usuario_modelo($db);
				
				$data = array ('desde' => date('Y-m-d'),
							   'hasta' => date('Y-m-d'),
							   'causas_sorteadas' => $causasModelo->where('IdUsuario', $session->get('idusuario'))->findAll(),						  
				);
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('recusaciones', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function desahilitar_localidad(){	
		try{
			$permisos = array(1=>2,2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();				
				
				$localidadesModelo = new Localidades_modelo($db);									
				$logcambiosdeestadoslocalidadesModelo = new Log_cambios_de_estados_localidades($db);									
						
				$localidadesModelo->deshabilitar_localidad($request->getPostGet('id_localiadad_deshabilitar'));					
				
				$data = ['IdUsuario' => $session->get('idusuario'),	
						 'IdLocalidad' => $request->getPostGet('id_localiadad_deshabilitar'),
						 'NuevoEstado' => 0,					
				];
				
				$logcambiosdeestadoslocalidadesModelo->insert($data);				
				
				$this->localidades_por_colegio($request->getPostGet('id_partido'),$request->getPostGet('id_provincia'));
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}
	function habilitar_localidad(){	
		try{
			$permisos = array(1=>2,2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();				
				
				$localidadesModelo = new Localidades_modelo($db);
				$logcambiosdeestadoslocalidadesModelo = new Log_cambios_de_estados_localidades($db);				
											
				$localidadesModelo->habilitar_localidad($request->getPostGet('id_localiadad_habilitar'));
								
				$data = ['IdUsuario' => $session->get('idusuario'),	
						 'IdLocalidad' => $request->getPostGet('id_localiadad_habilitar'),
						 'NuevoEstado' => 1,						
				];
				
				$logcambiosdeestadoslocalidadesModelo->insert($data);
				
				$this->localidades_por_colegio($request->getPostGet('id_partido'),$request->getPostGet('id_provincia'));
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}
	function localidades_por_colegio($id_partido = null,$id_provincia = null){
		try{
			$permisos = array(1=>2,2=>6);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$localidadesModelo = new Localidades_modelo($db);
				$partidosModelo = new Partidos_modelo($db);
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				$provinciasModelo = new Provincias_modelo($db);
				$request = \Config\Services::request();				
			
				if(empty($id_partido)){
					
					if((empty($request->getPostGet('desplegablepartidos'))) and (empty($request->getPostGet('desplegablepartidosadmin')))){
						//es la primera vez que entra
						$partido_actual = 0;
						$provincia_actual = 0;
						
					}else{
						
						if(!empty($request->getPostGet('desplegablepartidosadmin'))){		//es el administrador
							$partido_actual = $request->getPostGet('desplegablepartidosadmin');
							$provincia_actual = $request->getPostGet('desplegableprovinciasadmin');
						}else if(!empty($request->getPostGet('desplegablepartidos'))){		//es un colegio
							$partido_actual = $request->getPostGet('desplegablepartidos');
							$provincia_actual = 0;
						}
					}
				}else{
					
					$partido_actual = $id_partido;		//viene de un modificar
					$provincia_actual = $id_provincia;		//viene de un modificar
					
				}
				$data = array ('provincias' => $provinciasModelo->devolver_provincias(),
							   'partidos' => $partidosModelo->devolver_partidos_por_provincia_por_colegio($session->get('idColegio')),
							   'partido_actual' => $partido_actual,
							   'provincia_actual' => $provincia_actual,
							   'localidades' => $localidadesModelo->devolver_localidades_por_partido($partido_actual),
							   
				);
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('localidades_por_colegio', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	/*
	function ver_movimientos_de_consulta($id_consulta = null){
		try{
			$permisos = array(1=>2,2=>6,3=>1);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$consultasModelo = new Consultas_modelo($db);
				$comisionesModelo = new Comisiones_modelo($db);	
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				$request = \Config\Services::request();				
				
				if(empty($id_consulta)){
					$idconsulta = $request->getPostGet('id_consulta_ver_movimientos');
				}else{
					$idconsulta = $id_consulta;
				}
				
				$data = array ('consulta' => $consultasModelo->devolver_consulta($idconsulta),
							   'comisiones' => $comisionesModelo->devolver_comisiones_medicas(),
							   'movimientos' => $consultasModelo->devolver_movimientos_causa($idconsulta));
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('movimientos_consulta', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}

	function guardar_movimiento_consulta(){
		
		//INSTANCIA DE MODELOS			
		$movimientosConsultaModelo = new Movimientos_consulta_modelo($db);
		
		$request = \Config\Services::request();
		
		$movimiento = $movimientosConsultaModelo->where('IdConsulta' , $request->getPostGet('id_consulta_guardar'))
											    ->where('Titulo' , $request->getPostGet('titulo'))
											    ->where('Detalle' , $request->getPostGet('descripcion'))
											    ->findAll();
		
		if(empty($movimiento)){
		
			$data = [														
				'IdConsulta' => $request->getPostGet('id_consulta_guardar'),
				'IdComisionMedica' => $request->getPostGet('desplegable_comision_medica'),				
				'Titulo' => $request->getPostGet('titulo'),					
				'Detalle' => $request->getPostGet('descripcion'), 		
			];	
			$movimientosConsultaModelo->insert($data);
		
		}		
		$this->ver_movimientos_de_consulta($request->getPostGet('id_consulta_guardar'));
		
	}
	*/
	function devolver_sorteos_por_partidos_json(){
		
		//INSTANCIA DE MODELOS
		$consultasModelo = new Consultas_modelo($db);
		$request = \Config\Services::request();		
		
		$consultas = $consultasModelo->devolver_sorteos_por_partidos($request->getPostGet('id_provincia'));				
		
		if(!empty($consultas)){
			
			echo '[["Partidos", "Sorteos"],["General Pueyrredon",60],["Morón",16]]';
			//['City', 'Sorteos',],
		//[arrayJS[0]['NombreProvincia'],parseInt(arrayJS[0]['cantidad_sorteos'])],
			//[arrayJS[1]['NombreProvincia'],parseInt(arrayJS[1]['cantidad_sorteos'])]
			//echo '<option value="0">Seleccione un motivo de finalización</option>';
			/*
			foreach($consultas as $consulta){
				echo '<option value="'.$consulta["NombrePartido"].'">'.$consulta["cantidad_por_partido"].'</option>';
			}
			*/
		}else{
			echo 'error';
		}
	}
	function devolver_motivos_finalizacion_tramites_json(){
		
		//INSTANCIA DE MODELOS
		$motivoFinalizacionTramitesModelo = new Motivo_finalizacion_tramites_modelo($db);
		$request = \Config\Services::request();
		
		$tipoconsulta = $request->getPostGet('tipoconsulta');		
		
		$tipo_de_finalizacion = $motivoFinalizacionTramitesModelo->devolver_motivos_de_finalizacion($request->getPostGet('tipoconsulta'));				
		
		if(!empty($tipo_de_finalizacion)){
			
			echo '<option value="0">Seleccione un motivo de finalización</option>';
			
			foreach($tipo_de_finalizacion as $tipos){
				echo '<option value="'.$tipos["IdMotivoFinalizacion"].'">'.$tipos["NombreMotivoFinalizacion"].'</option>';
			}
			
		}else{
			echo '0';
		}
	}	
	function verifica_si_tiene_causas_para_baja_json(){
		
		//INSTANCIA DE MODELOS		
		$consultasModelo = new Consultas_modelo($db);
		$estadoMatriculaModelo = new Estado_matricula_modelo($db);
		$request = \Config\Services::request();	
		
		//NOS FIJAMOS SI TIENE CONSULTAS SIN CERRAR
		$consultas = $consultasModelo->devolver_causas_sin_cerrar($request->getPostGet('id_matricula'));	
		//NOS FIJAMOS SI EL ULTIMO ESTADO ES UNA LICENCIA SIN FECHA DE FIN
		$estado = $estadoMatriculaModelo->devolver_ultimo_estado_matricula($request->getPostGet('id_matricula'));				
		
		if((empty($consultas)) and (empty($estado))){
			
			echo '1';
						
		}else{
			echo '0';
		}
		
	}
	function guardar_darme_de_baja(){
		
		//INSTANCIA DE MODELOS		
		$request = \Config\Services::request();
		$session = \Config\Services::session();		
				
		$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);		
		$estadoMatriculaModelo = new Estado_matricula_modelo($db);
		
		$fecha_desde = date("Y-m-d h:i:s");
		$fecha_hasta = '';
		$motivo = 'Baja solicitada por el Abogado';		
		
		$id_estado_matricula = $estadoMatriculaModelo->guardar_estado_matricula($request->getPostGet('id_matricula_dame_de_baja'),$fecha_desde,$session->get('idusuario'),5,$motivo);	
		//detalle_cambio_matricula
		$data = [				
			'IdMatricula' => $request->getPostGet('id_matricula_dame_de_baja'),
			'IdEstadoMatricula' => $id_estado_matricula,				
			'FechaRegistro' => date('Y-m-d H:i:s'),						
			'FechaDesde' => $fecha_desde,
			'FechaHasta' => $fecha_hasta,
			'IdTipoEstado' => 5,		//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado						
			'DetalleMotivo' => $motivo,				
		];		
		
		$datalleCambioMatriculaModelo->insert($data);			
		
		$this->matriculas_abogado();
	}
	function ver_movimientos_de_consulta($id_consulta = null){
		try{
			$permisos = array(1=>2,2=>6,3=>1);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$consultasModelo = new Consultas_modelo($db);
				$comisionesModelo = new Comisiones_modelo($db);	
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				$tipoMovimientosCausasModelo = new Tipo_movimientos_causas_modelo($db);
				$tiposConsultasModelo = new Tipos_consultas_modelo($db);
				$motivoFinalizacionTramitesModelo = new Motivo_finalizacion_tramites_modelo($db);
				$detallesMovimientosCausasModelo = new Detalles_movimientos_causas_modelo($db);
				$movimientoJusticiaOrdinaria = new Movimientos_justicia_ordinaria_modelo($db);
				$movimientoComisionMedicaCentral = new Movimientos_comision_medica_central_modelo($db);
				$request = \Config\Services::request();				
				
				if(empty($id_consulta)){
					$idconsulta = $request->getPostGet('id_consulta_ver_movimientos');
				}else{
					$idconsulta = $id_consulta;
				}
				
				//$idconsulta = $_GET['id_consulta'];
		
				$data = array ('consulta' => $consultasModelo->devolver_consulta($idconsulta), 
							   'detalles_movimiento' => $detallesMovimientosCausasModelo->where('IdConsulta',$idconsulta)->findAll(),
							   'movimientos_comision_medica_central' => $movimientoComisionMedicaCentral->where('IdConsulta',$idconsulta)->findAll(),
							   'movimientos_justicia_ordinaria' => $movimientoJusticiaOrdinaria->where('IdConsulta',$idconsulta)->findAll(),
							   'comisiones' => $comisionesModelo->devolver_comisiones_medicas(),
							   'tiposconsulta' => $tiposConsultasModelo->where('Estado' , 1)->findAll(),
							   'motivos_fin_tramite' => $motivoFinalizacionTramitesModelo->where('Estado' , 1)->findAll(),
							   'tipos_movimientos' => $tipoMovimientosCausasModelo->findAll(),
							   'movimientos' => $consultasModelo->devolver_movimientos_causa($idconsulta)
				);				
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				//echo view('movimientos_consulta_test', $data);		
				echo view('movimientos_consulta', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	/*function ver_movimientos_de_consulta($id_consulta = null){
		try{
			$permisos = array(1=>2,2=>6,3=>1);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$consultasModelo = new Consultas_modelo($db);
				$comisionesModelo = new Comisiones_modelo($db);	
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				$tipoMovimientosCausasModelo = new Tipo_movimientos_causas_modelo($db);
				$request = \Config\Services::request();				
				
				if(empty($id_consulta)){
					$idconsulta = $request->getPostGet('id_consulta_ver_movimientos');
				}else{
					$idconsulta = $id_consulta;
				}
				
				$data = array ('consulta' => $consultasModelo->devolver_consulta($idconsulta),
							   'comisiones' => $comisionesModelo->devolver_comisiones_medicas(),
							   'tipos_movimientos' => $tipoMovimientosCausasModelo->findAll(),
							   'movimientos' => $consultasModelo->devolver_movimientos_causa($idconsulta)
				);
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('movimientos_consulta', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}*/
	function guardar_comision_medica(){
		
		//INSTANCIA DE MODELOS			
		$movimientosConsultaModelo = new Movimientos_consulta_modelo($db);
		$consultasModelo = new Consultas_modelo($db);
		
		$request = \Config\Services::request();
		$session = \Config\Services::session();		
		
		$consulta = $consultasModelo->where('IdConsulta' , $request->getPostGet('id_consulta_guardar_comision_medica'))
									->where('IdAbogado' , $session->get('idusuario'))											  
									->findAll();
		
		if(!empty($consulta)){
		
			$data = ['IdComisionMedica' => $request->getPostGet('desplegable_comision_medica')];	
			$consultasModelo->update($request->getPostGet('id_consulta_guardar_comision_medica'),$data);
		
		}		
		$this->ver_movimientos_de_consulta($request->getPostGet('id_consulta_guardar_comision_medica'));
		
	}
	function guardar_editar_movimiento(){
		
		//INSTANCIA DE MODELOS			
		$movimientosConsultaModelo = new Movimientos_consulta_modelo($db);
		
		$request = \Config\Services::request();
		
		$movimiento = $movimientosConsultaModelo->where('IdMovimientoConsulta' , $request->getPostGet('id_movimiento_editar_movimiento'))->findAll();
		
		if(!empty($movimiento)){
		
			$data = [									
				'IdTipoMovimiento' => $request->getPostGet('desplegable_tipo_movimiento_editar'),					
				'FechaMovimiento' => $request->getPostGet('fecha_nuevo_movimiento_editar'),					
				'Titulo' => $request->getPostGet('editar_titulo'),					
				'Detalle' => $request->getPostGet('editar_descripcion'), 		
			];	
			$movimientosConsultaModelo->update($request->getPostGet('id_movimiento_editar_movimiento'),$data);
		
		}		
		$this->ver_movimientos_de_consulta($request->getPostGet('id_consulta_editar_movimiento'));
		
	}
	function guardar_movimiento_consulta(){
		
		//INSTANCIA DE MODELOS			
		$movimientosConsultaModelo = new Movimientos_consulta_modelo($db);
		
		$request = \Config\Services::request();
		
		$movimiento = $movimientosConsultaModelo->where('IdConsulta' , $request->getPostGet('id_consulta_guardar'))
											    ->where('Titulo' , $request->getPostGet('titulo'))
											    ->where('Detalle' , $request->getPostGet('descripcion'))
											    ->findAll();
		
		if(empty($movimiento)){
		
			$data = [														
				'IdConsulta' => $request->getPostGet('id_consulta_guardar'),					
				'IdTipoMovimiento' => $request->getPostGet('desplegable_tipo_movimiento'),					
				'FechaMovimiento' => $request->getPostGet('fecha_nuevo_movimiento'),					
				'Titulo' => $request->getPostGet('titulo'),					
				'Detalle' => $request->getPostGet('descripcion'), 		
			];	
			$movimientosConsultaModelo->insert($data);
		
		}		
		$this->ver_movimientos_de_consulta($request->getPostGet('id_consulta_guardar'));
		
	}
	function eliminar_movimiento(){
		try{
			
			//INSTANCIA DE MODELOS	
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$movimientosConsultaModelo = new Movimientos_consulta_modelo($db);
								  
			$movimientosConsultaModelo->where('IdMovimientoConsulta', $request->getPostGet('id_movimiento_eliminar_movimiento'))->delete();
			
			$this->ver_movimientos_de_consulta($request->getPostGet('id_consulta_eliminar_movimiento'));	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function guarda_datos_gestion_administrativa_json(){
						  
		//INSTANCIA DE MODELOS			
		$detallesMovimientosCausasModelo = new Detalles_movimientos_causas_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$detalle_consulta = $detallesMovimientosCausasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($detalle_consulta)){
			
			echo '0';
		
		}else{
				
		$data = [														
				'IdTipoTramite' => $request->getPostGet('tipoconsulta'),					
				'FechaIncidente' => $request->getPostGet('fecha_incidente'),					
				'FechaAudienciaConAseguradora' => $request->getPostGet('fecha_audincia_con_aseguradora'), 		
				'FechaEntrevistaConTrabajador' => $request->getPostGet('fecha_entrevista_con_trabajador'), 		
				'FechaInicioTramite' => $request->getPostGet('fecha_inicio_tramite'), 		
				'NumeroExpediente' => $request->getPostGet('numero_expediente'), 		
				'EstudioComplementarios' => $request->getPostGet('solicitud_de_estudios_médicos_complementarios'), 		
				'DocumentacionComplementaria' => $request->getPostGet('solicitud_de_documentacion_complementaria'), 		
				'SolicitudProrroga' => $request->getPostGet('solicitud_de_prorroga'), 				
				'FechaAudienciaMedica' => $request->getPostGet('fecha_audiencia_medica'), 				
				'PlanteoAlegato' => $request->getPostGet('planteo_alegato'), 				
				'FechaDictamenMedico' => $request->getPostGet('fecha_dictamen_medico'), 				
				'IdMotivoFinalizacionTramite' => $request->getPostGet('desplegable_motivo_finalizacion_tramite'), 				
				'FechaActoClausura' => $request->getPostGet('fecha_acto_clausura'), 				
				'FechaAudienciaAcuerdo' => $request->getPostGet('fecha_de_audiencia_de_acuerdo'), 				
				'ResultadoAudiencia' => $request->getPostGet('resultado_de_la_audiencia_con_acuerdo'), 				
		];	
		$detallesMovimientosCausasModelo->update($detalle_consulta[0]['IdDetalleMovimiento'], $data);
		
			echo '1';
			
		}				 
					
	}
	function guarda_datos_comision_medica_central_json(){
						  
		//INSTANCIA DE MODELOS			
		$detallesMovimientosCausasModelo = new Detalles_movimientos_causas_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$detalle_consulta = $detallesMovimientosCausasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($detalle_consulta)){
			
			echo '0';
		
		}else{
			
		$data = [														
				'FechaApelacionComisionMedicaCentral' => $request->getPostGet('fecha_apelacion_comision_medica_central'),					
				'FechaFinalizacionComisionMedicaCentral' => $request->getPostGet('fecha_finalizacion_comision_medica_central'),					
				'ResultadoComisionMedicaCentral' => $request->getPostGet('resultado_del_acuerdo'),						
				'ApeloComisionMedicaCentral' => 1,//bandera para saber si abro la seccion						
		];	
		$detallesMovimientosCausasModelo->update($detalle_consulta[0]['IdDetalleMovimiento'], $data);
		
			echo '1';
			
		}				 
					
	}
	function guarda_movimiento_comision_medica_central_json(){
						  
		//INSTANCIA DE MODELOS			
		$movimientosComisionMedicaCentralModelo = new Movimientos_comision_medica_central_modelo($db);
		$consultasModelo = new Consultas_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$consulta = $consultasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($consulta)){
			
			echo '0';
		
		}else{
			
			$data = [														
					'IdConsulta' => $request->getPostGet('id_consulta'),					
					'FechaMovimiento' => $request->getPostGet('fecha_nuevo_movimiento_CMC'),					
					'Detalle' => $request->getPostGet('nuevo_movimiento_descripcion_CMC')					
										
			];	
			$id = $movimientosComisionMedicaCentralModelo->insert($data);
		
			echo $id;
			
		}				 
					
	}	
	function guarda_movimiento_justicia_ordinaria_json(){
						  
		//INSTANCIA DE MODELOS			
		$movimientosJusticiaOrdinariaModelo = new Movimientos_justicia_ordinaria_modelo($db);
		$consultasModelo = new Consultas_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$consulta = $consultasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($consulta)){
			
			echo '0';
		
		}else{
			
			$data = [
					'IdConsulta' => $request->getPostGet('id_consulta'),			
					'FechaMovimiento' => $request->getPostGet('fecha_nuevo_movimiento_JO'),					
					'Detalle' => $request->getPostGet('nuevo_movimiento_descripcion_JO')					
										
			];	
			$movimientosJusticiaOrdinariaModelo->insert($data);
		
			echo '1';
			
		}				 
					
	}
	function guarda_editar_movimiento_justicia_ordinaria_json(){
						  
		//INSTANCIA DE MODELOS			
		$movimientosJusticiaOrdinariaModelo = new Movimientos_justicia_ordinaria_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$movimiento = $movimientosJusticiaOrdinariaModelo->where('IdMovimiento' , $request->getPostGet('id_movimiento_editar_movimiento_JO'))->findAll();		
		
		if(empty($movimiento)){
			
			echo '0';
		
		}else{
			
		$data = [														
				'FechaMovimiento' => $request->getPostGet('fecha_nuevo_movimiento_editar_JO'),					
				'Detalle' => $request->getPostGet('editar_descripcion_JO')					
									
		];	
		$movimientosJusticiaOrdinariaModelo->update($request->getPostGet('id_movimiento_editar_movimiento_JO'), $data);
		
			echo '1';
			
		}				 
					
	}
	function guarda_comision_medica_json(){
						  
		//INSTANCIA DE MODELOS			
		$consultasModelo = new Consultas_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$consulta = $consultasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($consulta)){
			
			echo '0';
		
		}else{
			
		$data = [														
				'IdComisionMedica' => $request->getPostGet('id_comision_medica'),									
		];	
		$consultasModelo->update($request->getPostGet('id_consulta'), $data);
		
			echo '1';
			
		}				 
					
	}
	function eliminar_movimiento_comision_medica_central_json(){
						  
		//INSTANCIA DE MODELOS			
		$movimientosComisionMedicaCentralModelo = new Movimientos_comision_medica_central_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$movimiento = $movimientosComisionMedicaCentralModelo->where('IdMovimiento' , $request->getPostGet('id_movimiento_eliminar_movimiento_CMC'))->findAll();		
		
		if(empty($movimiento)){
			
			echo '0';
		
		}else{
			
			$movimientosComisionMedicaCentralModelo->eliminar_movimiento_comision_medica_central($request->getPostGet('id_consulta'),$request->getPostGet('id_movimiento_eliminar_movimiento_CMC'));
		
			echo '1';
			
		}				 
					
	}
	function eliminar_movimiento_justicia_ordinaria_json(){
						  
		//INSTANCIA DE MODELOS			
		$movimientosJusticiaOrdinariaModelo = new Movimientos_justicia_ordinaria_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$movimiento = $movimientosJusticiaOrdinariaModelo->where('IdMovimiento' , $request->getPostGet('id_movimiento_eliminar_movimiento_JO'))->findAll();		
		
		if(empty($movimiento)){
			
			echo '0';
		
		}else{
			
			$movimientosJusticiaOrdinariaModelo->eliminar_movimiento_justicia_ordinaria($request->getPostGet('id_consulta'),$request->getPostGet('id_movimiento_eliminar_movimiento_JO'));
		
			echo '1';
			
		}				 
					
	}
	function guarda_editar_movimiento_comision_medica_central_json(){
						  
		//INSTANCIA DE MODELOS			
		$movimientosComisionMedicaCentralModelo = new Movimientos_comision_medica_central_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$movimiento = $movimientosComisionMedicaCentralModelo->where('IdMovimiento' , $request->getPostGet('id_movimiento_editar_movimiento_CMC'))->findAll();		
		
		if(empty($movimiento)){
			
			echo '0';
		
		}else{
			
		$data = [														
				'FechaMovimiento' => $request->getPostGet('fecha_nuevo_movimiento_editar_CMC'),					
				'Detalle' => $request->getPostGet('editar_descripcion_CMC')					
									
		];	
		$movimientosComisionMedicaCentralModelo->update($request->getPostGet('id_movimiento_editar_movimiento_CMC'), $data);
		
			echo '1';
			
		}				 
					
	}
	function guarda_datos_justicia_ordinaria_json(){
						  
		//INSTANCIA DE MODELOS			
		$detallesMovimientosCausasModelo = new Detalles_movimientos_causas_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$detalle_consulta = $detallesMovimientosCausasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($detalle_consulta)){
			
			echo '0';
		
		}else{

		$data = [														
				'FechaApelacionJusticiaOrdinaria' => $request->getPostGet('fecha_apelacion_justicia_ordinaria'),					
				'Juzgado' => $request->getPostGet('juzgado_justicia_ordinaria'),					
				'NumeroExpedienteJusticiaOrdinaria' => $request->getPostGet('numero_expediente_justicia_ordinaria'),					
				'Caratula' => $request->getPostGet('caratula_justicia_ordinaria'),					
				'FechaSentenciaJusticiaOrdinaria' => $request->getPostGet('fecha_sentencia_justicia_ordinaria'),						
				'FechaResultadoSentenciaJusticiaOrdinaria' => $request->getPostGet('fecha_resultado_del_acuerdo'),						
				'ResultadoJusticiaOrdinaria' => $request->getPostGet('textarea_resultado_del_acuerdo'),						
				'ResultadoSentenciaJusticiaOrdinaria' => $request->getPostGet('resultado_del_acuerdo_justicia_ordinaria'),						
				'ApeloJusticiaOrdinaria' => 1,//bandera para saber si abro la seccion						
		];	
		$detallesMovimientosCausasModelo->update($detalle_consulta[0]['IdDetalleMovimiento'], $data);
		
			echo '1';
			
		}				 
					
	}
	function guarda_datos_trabajador_json(){
						  
		//INSTANCIA DE MODELOS			
		$consultasModelo = new Consultas_modelo($db);
		$consultantesModelo = new Consultantes_modelo($db);		
		
		$request = \Config\Services::request();				  
		
		$consulta = $consultasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($consulta)){
			
			echo '0';
		
		}else{	
		
			$data = [														
					'Apellido' => $request->getPostGet('apellido'),					
					'Nombre' => $request->getPostGet('nombre'),					
					'Cuit' => $request->getPostGet('cuit'), 		
					'Telefono' => $request->getPostGet('telefono'), 		
					'Celular' => $request->getPostGet('celular'), 		
					'Email' => $request->getPostGet('email'), 		
									
			];	
			$consultantesModelo->update($consulta[0]['IdConsultante'], $data);
		
			echo '1';
			
		}				 
					
	}	
	function guarda_datos_empleador_json(){
						  
		//INSTANCIA DE MODELOS			
		$detallesMovimientosCausasModelo = new Detalles_movimientos_causas_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$detalle_consulta = $detallesMovimientosCausasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($detalle_consulta)){
			
			echo '0';
		
		}else{	
		
			$data = [														
					'RazonSocialEmpleador' => $request->getPostGet('razon_social'),									
					'CuitEmpleador' => $request->getPostGet('cuit'), 		
					'TelefonoEmpleador' => $request->getPostGet('telefono'), 		
					'CelularEmpleador' => $request->getPostGet('celular'), 		
					'EmailEmpleador' => $request->getPostGet('email'),									
			];	
			$detallesMovimientosCausasModelo->update($detalle_consulta[0]['IdDetalleMovimiento'], $data);
		
			echo '1';
			
		}				 
					
	}
	function guarda_notas_json(){
						  
		//INSTANCIA DE MODELOS			
		$detallesMovimientosCausasModelo = new Detalles_movimientos_causas_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$detalle_consulta = $detallesMovimientosCausasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($detalle_consulta)){
			
			echo '0';
		
		}else{	
		
			$data = [														
					'Notas' => $detalle_consulta[0]['Notas'].date("d-m-Y").': '.$request->getPostGet('nota').'<br>',								
			];	
			$detallesMovimientosCausasModelo->update($detalle_consulta[0]['IdDetalleMovimiento'], $data);
		
			echo '1';
			
		}				 
					
	}
	function devolver_notas_json(){
						  
		//INSTANCIA DE MODELOS			
		$detallesMovimientosCausasModelo = new Detalles_movimientos_causas_modelo($db);
		
		$request = \Config\Services::request();				  
		
		$detalle_consulta = $detallesMovimientosCausasModelo->where('IdConsulta' , $request->getPostGet('id_consulta'))->findAll();		
		
		if(empty($detalle_consulta)){
			
			echo '';
			
		}else{
			
			echo $detalle_consulta[0]['Notas'];
			
		}	 
					
	}
	function guardar_nuevo_usuario_json(){
		
		//INSTANCIA DE MODELOS			
		$usuariosModelo = new Usuario_modelo($db);
		
		$request = \Config\Services::request();
		
		$usuario = $usuariosModelo->where('Apellido' , $request->getPostGet('apellidoUsuario'))
								  ->where('Usuario' , $request->getPostGet('usuario'))
								  ->where('Contrasenia' , $request->getPostGet('contrasenia'))
								  ->findAll();
	
		if(empty($usuario)){
		
			$data = [														
				'Nombre' => $request->getPostGet('nombreUsuario'),					
				'Apellido' => $request->getPostGet('apellidoUsuario'),					
				'Email' => $request->getPostGet('emailUsuario'), 		
				'Cuit' => $request->getPostGet('cuitUsuario'), 		
				'Telefono' => $request->getPostGet('telefonoUsuario'), 		
				'Celular' => $request->getPostGet('celularUsuario'), 		
				'IdColegio' => $request->getPostGet('colegioAbogado'), 		
				'Usuario' => $request->getPostGet('usuario'), 		
				'Contrasenia' => $request->getPostGet('contrasenia'), 		
				'IdPerfil' => 2, 		
				'Estado' => 1, 		
			];	
			$usuariosModelo->insert($data);
			
			echo '1';
		
		}else{
			echo '0';
		}			
	}
	function resetear_contrasenia_json(){
		
		//INSTANCIA DE MODELOS			
		$abogadosModelo = new Abogados_modelo($db);
		
		$request = \Config\Services::request();
		
		$abogado = $abogadosModelo->where('Cuit' , $request->getPostGet('cuit'))->findAll();
	
		if(!empty($abogado)){
		
			$abogadosModelo->resetear_contrasenia($request->getPostGet('cuit'));;
			
			echo '1';
		
		}else{
			echo '0';
		}			
	}
	function usuarios(){
		try{
			$permisos = array(1=>2,2=>6);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
							
				//INSTANCIA DE MODELOS
				$usuariosModelo = new Usuario_modelo($db);
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				$departamentosModelo = new Departamentos_modelo($db);				

				//$usuario = $usuariosModelo->devolver_usuario_x_colegio(84);
				//var_dump($usuario[0]['Email']);				
				//$this->enviar_email_registro_a_colegio($usuario[0]['Email']);				
				
				$data = array ('desde' => date('Y-m-d'),
							   'hasta' => date('Y-m-d'),
							   'departamentos' => $departamentosModelo->devolver_departamentos(),
							   'usuarios' => $usuariosModelo->devolver_usuarios($session->get('idusuario'),$session->get('idPerfil'),$session->get('idColegio')),						  
				);				

				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('usuarios', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function guardar_editar_usuario(){
		
		//INSTANCIA DE MODELOS			
		$usuariosModelo = new Usuario_modelo($db);
		$session = \Config\Services::session();	
		$request = \Config\Services::request();
		
		$usuario = $usuariosModelo->where('IdUsuario' , $request->getPostGet('id_usuario_editar'))->findAll();
	
		if(!empty($usuario)){
		
			$data = [														
				'Nombre' => $request->getPostGet('nombre_usuarioEditar'),					
				'Apellido' => $request->getPostGet('apellido_usuarioEditar'),					
				'Email' => $request->getPostGet('email_usuarioEditar'), 		
				'Cuit' => $request->getPostGet('cuit_usuarioEditar'), 		
				'Telefono' => $request->getPostGet('telefono_usuarioEditar'), 		
				'Celular' => $request->getPostGet('celular_usuarioEditar'), 		
				'IdColegio' => $request->getPostGet('departamento_usuarioEditar'), 		
				'Usuario' => $request->getPostGet('nombre_usuario_de_usuarioEditar'), 		
				'Contrasenia' => $request->getPostGet('contrasenia_usuarioEditar'), 				
			];	
			$usuariosModelo->update($request->getPostGet('id_usuario_editar'), $data);
					
		}

		$this->usuarios();
		
	}	
	function eliminar_usuario(){	
		try{
			$permisos = array(2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();
				$usuariosModelo = new Usuario_modelo($db);
						
				$usuariosModelo->where('IdUsuario', $request->getPostGet('id_usurio_eliminar'))->delete();
																		
				$this->usuarios();
																														
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}
	function nueva_comision(){
		try{
			
			$session = \Config\Services::session();			
				
				//INSTANCIA DE MODELOS				
						
				$provinciasModelo = new Provincias_modelo($db);				
				$matriculacionesModelo = new Matriculaciones_modelo($db);							
				
				$data = array ('provincias' => $provinciasModelo->devolver_provincias()							   						   
				);
				echo view('encabezado');
				
				if(!empty($session->get('idusuario'))){
					
					echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());	
					
				}
				
				echo view('nueva_comision',$data);		
						
				
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function comisiones(){
		try{
			$permisos = array(2=>6);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
							
				//INSTANCIA DE MODELOS
				$usuariosModelo = new Usuario_modelo($db);
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				$departamentosModelo = new Departamentos_modelo($db);	
				$comisionesModelo = new Comisiones_modelo($db);	
				$provinciasModelo = new Provincias_modelo($db);			
				
				$data = array ('provincias' => $provinciasModelo->devolver_provincias(),
							   'comisiones' => $comisionesModelo->devolver_comisiones_medicas(),						  
				);				
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('comisiones', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function guardar_nueva_comision_json(){
		
		//INSTANCIA DE MODELOS			
		$comisionesModelo = new Comisiones_modelo($db);		
		$request = \Config\Services::request();
		
		$comision = $comisionesModelo->where('NombreComisionMedica' , $request->getPostGet('nombreComision'))
									 ->where('IdProvincia' , $request->getPostGet('provincia_comision'))								 
								     ->findAll();
	
		if(empty($comision)){
		
			$data = [														
				'NombreComisionMedica' => $request->getPostGet('nombreComision'),					
				'Domicilio' => $request->getPostGet('domicilioComision'),					
				'Telefono' => $request->getPostGet('telefonoComision'), 		
				'IdProvincia' => $request->getPostGet('provincia_comision'), 		
					
			];	
			$comisionesModelo->insert($data);
			
			echo '1';
		
		}else{
			echo '0';
		}			
		
	}
	function guardar_editar_comision(){
		
		//INSTANCIA DE MODELOS			
		$comisionesModelo = new Comisiones_modelo($db);
		$session = \Config\Services::session();	
		$request = \Config\Services::request();
		
		$comision = $comisionesModelo->where('IdComisionMedica' , $request->getPostGet('id_comision_editar'))->findAll();
	
		if(!empty($comision)){
		
			$data = [														
				'NombreComisionMedica' => $request->getPostGet('nombre_comisionEditar'),					
				'Domicilio' => $request->getPostGet('domicilio_comisionEditar'),					
				'Telefono' => $request->getPostGet('telefono_comisionEditar'), 		
				'IdProvincia' => $request->getPostGet('provincia_comisionEditar'), 								
			];	
			$comisionesModelo->update($request->getPostGet('id_comision_editar'), $data);
					
		}

		$this->comisiones();
		
	}	
	function eliminar_comision(){	
		try{
			$permisos = array(2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();
				$comisionesModelo = new Comisiones_modelo($db);	
						
				$comisionesModelo->where('IdComisionMedica', $request->getPostGet('id_comision_eliminar'))->delete();
																		
				$this->comisiones();
																														
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}
	function matriculaciones(){
		try{
			$permisos = array(1=>2,2=>6);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$matriculacionesModelo = new Matriculaciones_modelo($db);	
				$tipoEstadosMatriculaModelo = new Tipo_estados_matricula_modelo($db);
				$departamentoModelo = new Departamentos_modelo($db);
				$request = \Config\Services::request();				
				
				$colegio_actual = '';
				$estado_actual = '';
				$matriculaciones = array();
				
				if($session->get('idPerfil') == 2){//ES UN COLEGIO
					
					$matriculaciones = $matriculacionesModelo->devolver_matriculaciones($session->get('idPerfil'),$session->get('idColegio'));
					
				}else{//ES EL ADMINISTRADOR
				
					if((!empty($request->getPostGet('numerocuit'))) or ((!empty($request->getPostGet('desplegablecolegio')))and(!empty($request->getPostGet('desplegableestadomatriculacion'))))){
						
						if(!empty($request->getPostGet('numerocuit'))){	
						
							$matriculaciones = $matriculacionesModelo->devolver_matriculacion_cuit($request->getPostGet('numerocuit'));
							
						}else if((!empty($request->getPostGet('desplegablecolegio'))) and (!empty($request->getPostGet('desplegableestadomatriculacion')))){
							
							$matriculaciones = $matriculacionesModelo->devolver_matriculaciones_colegio_estado($request->getPostGet('desplegablecolegio'),$request->getPostGet('desplegableestadomatriculacion'));
							
							$colegio_actual = $request->getPostGet('desplegablecolegio');
							$estado_actual = $request->getPostGet('desplegableestadomatriculacion');
						
						}
						
					}
					
				}
				$data = array ('desde' => date('Y-m-d'),
							   'hasta' => date('Y-m-d'),
							   'idPerfil_session' => $session->get('idPerfil'),							  
							   'estados_matriculas' => $tipoEstadosMatriculaModelo->orderBy('NombreTipoEstado', 'asc')->findAll(),
							   'matriculaciones' => $matriculaciones,						  
							   'colegios' => $departamentoModelo->orderBy('NombreDepartamento', 'asc')->findAll(),						  
							   'estados_matriculacion' => $matriculaciones,						  
							   'estado_actual' => $estado_actual,						  
							   'colegio_actual' => $colegio_actual,						  
				);
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('matriculaciones', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function sanciones(){
		try{
			$permisos = array(1=>2,2=>6);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$matriculacionesModelo = new Matriculaciones_modelo($db);	
				$tipoEstadosMatriculaModelo = new Tipo_estados_matricula_modelo($db);
				$departamentoModelo = new Departamentos_modelo($db);
				$detalleCambioMatriculaModelo = new Detalle_cambio_matricula_modelo($db);
				$request = \Config\Services::request();				
				
				$colegio_actual = '';
				$estado_actual = '';
				$matriculaciones = array();
				
				if($session->get('idPerfil') == 2){//ES UN COLEGIO
					
					$matriculaciones = $detalleCambioMatriculaModelo->devolver_sanciones($session->get('idPerfil'),$session->get('idColegio'));
					
				}else{//ES EL ADMINISTRADOR
				
					if((!empty($request->getPostGet('numerocuit'))) or (!empty($request->getPostGet('desplegablecolegio')))){
						
						if(!empty($request->getPostGet('numerocuit'))){	
						
							$matriculaciones = $detalleCambioMatriculaModelo->devolver_sanciones_cuit($request->getPostGet('numerocuit'));
							
						}else if(!empty($request->getPostGet('desplegablecolegio'))){
							
							$matriculaciones = $detalleCambioMatriculaModelo->devolver_sanciones($session->get('idPerfil'),$request->getPostGet('desplegablecolegio'));
							
							$colegio_actual = $request->getPostGet('desplegablecolegio');
							//$estado_actual = $request->getPostGet('desplegableestadomatriculacion');
						
						}
						
					}
					
				}
				$data = array ('idPerfil_session' => $session->get('idPerfil'),						   
							   'matriculaciones' => $matriculaciones,						  
							   'colegios' => $departamentoModelo->orderBy('NombreDepartamento', 'asc')->findAll(),						   												  
							   'colegio_actual' => $colegio_actual,						  
				);
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('sanciones', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	function buscar_sanciones_por_matricula_json(){
		
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();	
		$detalleCambioMatriculaModelo = new Detalle_cambio_matricula_modelo($db);
		
		$sanciones = $detalleCambioMatriculaModelo->buscar_sanciones_por_matricula($request->getPostGet('id_matriculacion'));
		
		foreach($sanciones as $sancion){
			
			echo '<u><b>Sanción del '. date('d-m-Y',strtotime($sancion['FechaRegistro'])).'</b></u><br>';
			echo 'Sancionado desde: '. date('d-m-Y',strtotime($sancion['FechaDesde'])).'<br>';
			echo 'Sancionado hasta: '. date('d-m-Y',strtotime($sancion['FechaHasta'])).'<br>';
			echo 'Motivo de la Sanción: '. $sancion['DetalleMotivo'].'<br><br>';
		
		}
		
	}
	function nuevos_inscriptos(){
		try{
			$permisos = array(1=>2,2=>6);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$matriculacionesModelo = new Matriculaciones_modelo($db);	
				
				$data = array ('desde' => date('Y-m-d'),
							   'hasta' => date('Y-m-d'),
							   'idPerfil_session' => $session->get('idPerfil'),							   
							   'matriculaciones' => $matriculacionesModelo->devolver_matriculaciones_pendientes($session->get('idPerfil'),$session->get('idColegio')),						  
				);

				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('nuevos_inscriptos', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function domicilios_por_aprobar(){
		try{
			$permisos = array(1=>2,2=>6);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$matriculacionesModelo = new Matriculaciones_modelo($db);	
				
				$data = array ('desde' => date('Y-m-d'),
							   'hasta' => date('Y-m-d'),
							   'idPerfil_session' => $session->get('idPerfil'),							  
							   'matriculaciones' => $matriculacionesModelo->devolver_nuevos_domicilios_pendientes($session->get('idPerfil'),$session->get('idColegio')),						  
				);

				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('domicilios_por_aprobar', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function registro(){
		try{
			
			//INSTANCIA DE MODELOS			
			$departamentoModel = new Departamentos_modelo($db);			
			$provinciasModel = new Provincias_modelo($db);			
			$partidosModel = new Partidos_modelo($db);
			$municipiosModel = new Municipios_modelo($db);
			$session = \Config\Services::session();
						
			$data = array ('provincias' => $provinciasModel->devolver_provincias_inscripcion(),						 
						   'partidos' => $partidosModel->devolver_partidos(),							  
						   'localidades' => $municipiosModel->devolver_municipios(),							  
						   'departamentos' => $departamentoModel->devolver_departamentos(),							  
			);
		
			echo view('encabezado');			
			echo view('registro',$data);	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function realizar_nuevo_sorteo_json(){

		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$requirentesModelo = new Requirentes_modelo($db);
		$sorteosModelo = new Sorteos_modelo($db);
		$consultasModelo = new Consultas_modelo($db);
		$navegation_detect = new navegacion();			
	
		$sorteo = $sorteosModelo->devolver_sorteo($request->getPostGet('cuitRequirente'));
	
		if(empty($sorteo)){
			
			if(!empty($session->get('idusuario'))){			//si es un usuario del sistema
				$idusuario = $session->get('idusuario');
			}else{											//sino, es un sorteo externo
				$idusuario = false;
			}
						  
			$sorteo_actual = $sorteosModelo->sortear_abogado($request->getPostGet('cuitRequirente'),
															 $request->getPostGet('apellidoRequirente'),
															 $request->getPostGet('nombreRequirente'),
															 $request->getPostGet('telefonoRequirente'),
															 $request->getPostGet('celularRequirente'),
															 $request->getPostGet('emailRequirente'),
															 $request->getPostGet('provincia'),
															 $request->getPostGet('partidoDomicilio'),
															 $request->getPostGet('localidadDomicilio'),
															 $request->getPostGet('calleDomicilio'),
															 $request->getPostGet('numeroDomicilio'),
															 $request->getPostGet('pisoDomicilio'),
															 $request->getPostGet('departamentoDomicilio'),
															 $request->getPostGet('detalle'),
															 $request->getPostGet('tipoconsulta'),
															 $idusuario);
		
			if($sorteo_actual <> 0){
				
				$consulta = $consultasModelo->devolver_consulta($sorteo_actual);
				
				$domicilio =  $consulta[0]['calle_estudio'].' - '.$consulta[0]['numero_estudio'];
				if(!empty($consulta[0]['piso_estudio'])){
					$domicilio .= ' Piso: '.$consulta[0]['piso_estudio'];
				}
				if(!empty($consulta[0]['oficina_estudio'])){
					$domicilio .=  ' Oficina: '.$consulta[0]['oficina_estudio'];
				}
			
				//Enviamos Mail al requirente
				$mail_abogado = $consulta[0]['email_estudio'];
				$mail_requirente = $request->getPostGet('emailRequirente');
				$asunto_abogado = 'Nuevo patrocinio Sistema - ACOM';
				$asunto_consultante = 'Sorteo de Abogado Sistema - ACOM';
				
				$mensaje_requirente = 'Estimado, le informamos que se ha sorteado un profesional letrado en el sistema Acom para que usted realice su consulta.'. "<br>";
				$mensaje_requirente .= 'Contacte al profesional sorteado para acordar una reunión y poder realizar su consulta.'. "<br><br>";
				//$mensaje_requirente .= 'Cuando concurra al estudio, recuerde llevar el comprobante que se le entrego al momento del sorteo.'. "<br>" . "<br>";
				$mensaje_requirente .= 'Apellido y Nombre: '.strtoupper($consulta[0]['apellido_abogado'].', '.$consulta[0]['nombre_abogado']). "<br>";
				$mensaje_requirente .= 'Domicilio del estudio: '.$domicilio. "<br>";
				$mensaje_requirente .= 'Localidad: '.$consulta[0]['NombreLocalidad']. "<br>";
				$mensaje_requirente .= 'E-mail: '.$consulta[0]['email_estudio']. "<br>";
				$mensaje_requirente .= 'Teléfono: '.$consulta[0]['telefono_estudio']. "<br>";
				$mensaje_requirente .= 'Horario de atención: '.$consulta[0]['HorariosAtencion']. "<br>";
				
				//Enviamos Mail al abogado
				$mensaje_abogado = 'Estimado, usted ha sido sorteado por el sistema ACOM para representar a:'. "<br>". "<br>";
				
				$mensaje_abogado .= 'Sr/a: '. $consulta[0]['Apellido'].', '.$consulta[0]['Nombre']. "<br>";
				$mensaje_abogado .= 'Cuit: '. $consulta[0]['Cuit']. "<br>";
				$mensaje_abogado .= 'Celular: '. $consulta[0]['Celular']. "<br>";
				$mensaje_abogado .= 'Email: '. $consulta[0]['Email']. "<br>";
				$mensaje_abogado .= 'Consulta: '. $consulta[0]['Descripcion']. "<br>";
				$mensaje_abogado .= 'Fecha de sorteo: '. date('d-m-Y H:i:s',strtotime($consulta[0]['FechaSorteo'])). "<br>". "<br>";			
				
				$mensaje_abogado .= 'Por favor, antes de aceptar el caso comuníquese con el trabajador para interiorizarse sobre el mismo.'. "<br>";
				$mensaje_abogado .= 'Luego, ingrese al sistema ACOM y acepte o excuse su patrocinio.'. "<br>";
				$mensaje_abogado .= "Acceda al manual de usuario del Sistema ACOM disponible <a href='https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub' class='btn btn-link'>aquí</a>"."<br>";
								
				$email = new email();
				
				$email->enviar_mail($mail_abogado,$asunto_abogado,$mensaje_abogado);
				$email->enviar_mail($mail_requirente,$asunto_consultante,$mensaje_requirente);
			}
									
			if($sorteo_actual <> 0 ){
				
				//Guardamos los datos de navegacion de quien hace el sorteo
				$navegation_detect->guardar_navegante_de_sorteo($sorteo_actual);
				$mensaje_sorteo_ok = '';
				
				$mensaje_sorteo_ok = 'Informamos que se ha sorteado un profesional letrado en el sistema Acom para que usted realice su consulta.';
				$mensaje_sorteo_ok .= 'Contacte al profesional sorteado para acordar una reunión y poder realizar su consulta.'.'<br><br>';
				//$mensaje_sorteo_ok .= 'Cuando concurra al estudio, recuerde llevar el comprobante que se le entrego al momento del sorteo.<br><br>';
				$mensaje_sorteo_ok .= 'Profesional letrado Dra/Dr: '.strtoupper($consulta[0]['apellido_abogado'].', '.$consulta[0]['nombre_abogado']).'<br>';
				$mensaje_sorteo_ok .= 'Domicilio del estudio: '.$domicilio.'<br>';
				$mensaje_sorteo_ok .= 'Teléfono: '.$consulta[0]['telefono_estudio'].'<br>';
				$mensaje_sorteo_ok .= 'Horario de atención: '.$consulta[0]['HorariosAtencion'].'<br>';
				
				echo '{"estado" : "1","idConsulta" : '.$sorteo_actual.',"mensaje" : "El sorteo se realizó con éxito.<br>'.$mensaje_sorteo_ok.'"}';
				
			}else{
				
				echo '{"estado" : "0","idConsulta" : '.$sorteo_actual.',"mensaje" : "No se pudo realizar el sorteo. Por favor, póngase en contacto con su administrador."}';
			
			}
			
		}else{
			
			echo '{"estado" : "2","idConsulta" : '.$sorteo[0]['IdConsulta'].',"mensaje" : "Se ha detectado que ya tiene un profesional asignado. Cualquier inconveniente debe comunicarse a los contactos que figuran en el pie del formulario."}';		
		
		}		
	}	
	function devolver_tipos_de_excusaciones_json(){
		
		//INSTANCIA DE MODELOS
		$consultasModelo = new Consultas_modelo($db);
		$estadoConsultasModelo = new Estado_consultas_modelo($db);
		$request = \Config\Services::request();
	
		$consulta = $consultasModelo->devolver_consulta($request->getPostGet('idConsulta'));	
						
		//$fecha_sorteo = date($consulta[0]['FechaSorteo'], strtotime('+7 day'));
		$fecha_sorteo = date("Y-m-d",strtotime('+7 day',strtotime($consulta[0]['FechaSorteo'])));
		$fecha_actual = date("Y-m-d");	
		
		if($fecha_sorteo <= $fecha_actual){
			$estado_consulta = $estadoConsultasModelo->devolver_estados_consultas_sin_filtro_tiempo();	
		}else{
			$estado_consulta = $estadoConsultasModelo->devolver_estados_consultas_con_filtro_tiempo();	
		}
		
		if(!empty($estado_consulta)){
			
			echo '<option value="0">Seleccione un tipo</option>';
			
			foreach($estado_consulta as $estado){
				echo '<option value="'.$estado['IdEstadoConsulta'].'">'.$estado['NombreEstadoConsulta'].'</option>';
			}
			
		}else{
			echo '0';
		}
	}
	function devolver_partidos_json(){
		
		//INSTANCIA DE MODELOS
		$partidosModelo = new Partidos_modelo($db);
		$request = \Config\Services::request();

		$partidos = $partidosModelo->devolver_partidos_con_abogados_aprobados($request->getPostGet('provincia'));				
		
		if(!empty($partidos)){
			
			echo '<option value="0">Seleccione un partido</option>';
			
			foreach($partidos as $partido){
				echo '<option value="'.$partido["Id"].'">'.$partido["NombrePartido"].'</option>';
			}
			
		}else{
			echo '0';
		}
	}	
	function devolver_partidos_registro_json(){
		
		//INSTANCIA DE MODELOS
		$partidosModelo = new Partidos_modelo($db);
		$request = \Config\Services::request();

		$partidos = $partidosModelo->devolver_partidos_por_provincia($request->getPostGet('provincia'));		
		//$partidos = $partidosModelo->where('IdProvincia', $request->getPostGet('provincia'))->orderBy('NombrePartido', 'asc')->findAll();		
		
		if(!empty($partidos)){
			
			echo '<option value="0">Seleccione un partido</option>';
			
			foreach($partidos as $partido){
				echo '<option value="'.$partido["Id"].'">'.$partido["NombrePartido"].'</option>';
			}
			
		}else{
			echo '0';
		}
	}	
	function devolver_localidades_json(){
		
		//INSTANCIA DE MODELOS
		$localidadesModelo = new Localidades_modelo($db);
		$request = \Config\Services::request();
		
		$partido = $request->getPostGet('partido');			
		
		$localidades = 	$localidadesModelo->devolver_localidades_x_partido($partido);
				   
		echo '<option value="0">Seleccione una localidad</option>';
		
		foreach($localidades as $localidad){
			echo '<option value="'.$localidad["IdLocalidad"].'">'.$localidad["NombreLocalidad"].'</option>';
		}
	}	
	function devolver_departamento_judicial_json(){
		
		//INSTANCIA DE MODELOS
		$departamentosModelo = new Departamentos_modelo($db);
		$request = \Config\Services::request();
		
		$departamentos = $departamentosModelo->devolver_departamentos_x_provincia($request->getPostGet('provincia'));
				   
		echo '<option value="0">Seleccione un colegio</option>';
		
		foreach($departamentos as $departamento){
			echo '<option value="'.$departamento["IdDepartamento"].'">'.$departamento["NombreDepartamento"].'</option>';
		}
		
	}
	function confirmar_matricula_en_provincia_json(){
		
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$departamentosModelo = new Departamentos_modelo($db);
		$matriculacionesModelo = new Matriculaciones_modelo($db);		
		
		$matricula_en_provincia = $matriculacionesModelo->devolver_matricula_en_provincia_x_abogado($session->get('idusuario'), $request->getPostGet('provincia'));
				   
		if(!empty($matricula_en_provincia)){
			echo '0';//SI tiene matricula en esta provincia
		}else{
			echo '1';//NO tiene matricula en esta provincia
		}	
		
	}
	function devolver_tipo_de_matricula_json(){
		
		//INSTANCIA DE MODELOS
		$provincias = new Provincias_modelo($db);
		$request = \Config\Services::request();
		
		$provincia = $provincias->where('IdProvincia', $request->getPostGet('provincia'))->findAll();
	
		if($provincia[0]['IdTipoMatricula'] == 1){		
			echo '1';
		}else{
			echo '0';
		}
		
	}
	function devolver_domicilios_json() {
		try{
			$permisos = array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6);				
			$session = \Config\Services::session();	
			$request = \Config\Services::request();
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS			
				$domiciliosModelos = new Domicilios_modelo($db);			
										
				$domicilios = $domiciliosModelos->devolver_domicilios_x_matriculacion($request->getPostGet('idmatriculacion'));						
		
				if(!empty($domicilios)){
					$cadena = '';
					$cadena .='<table class="table stacktable" id="tabla_domicilios" style="font-size:80%">';
						$cadena .='<thead>';
							$cadena .='<tr>';
																									
								$cadena .='<th style="text-align:center">Calle</th>';
								$cadena .='<th style="text-align:center">Número</th>';
								$cadena .='<th style="text-align:center">Piso</th>';
								$cadena .='<th style="text-align:center">Oficina</th>';	
								$cadena .='<th style="text-align:center">E-mail</th>';	
								$cadena .='<th style="text-align:center">Telefono</th>';							
								$cadena .='<th style="text-align:center">Horarios de Atención</th>';																
								$cadena .='<th style="text-align:center">Estado</th>';
								$cadena .='<th style="text-align:center">Acciones</th>';
								/*
								if($session->get('idPerfil') == 1){
									$cadena .='<th style="text-align:center" style="width:3%">Acciones</th>';									
								}	
								*/
							$cadena .='</tr>';
						$cadena .='</thead>';
						$cadena .='<tbody>';
							//$contador = 0;
							$primero = 0;
							foreach ($domicilios as $domicilio){
								
								if(($domicilio['Estado'] == 1) and ($primero == 0)){
									$cadena .='<tr class="table-success">';
									$primero = 1;
								}else{
									$cadena .='<tr>';
								}
								
									$cadena .='<td name="calle'.$request->getPostGet('idmatriculacion').'" id="calle'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['Calle'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Calle'].'</td>';
									$cadena .='<td name="numero'.$request->getPostGet('idmatriculacion').'" id="numero'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['Numero'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Numero'].'</td>';
									$cadena .='<td name="piso'.$request->getPostGet('idmatriculacion').'" id="piso'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['Piso'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Piso'].'</td>';
									$cadena .='<td name="oficina'.$request->getPostGet('idmatriculacion').'" id="oficina'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['Oficina'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Oficina'].'</td>';
									$cadena .='<td name="email'.$request->getPostGet('idmatriculacion').'" id="email'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['Email'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Email'].'</td>';
									$cadena .='<td name="telefono'.$request->getPostGet('idmatriculacion').'" id="telefono'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['Telefono'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Telefono'].'</td>';
									$cadena .='<td name="horariosatencios'.$request->getPostGet('idmatriculacion').'" id="horariosatencios'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['HorariosAtencion'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['HorariosAtencion'].'</td>';	
								
								    if($domicilio['Estado'] == 1){
										$cadena .='<td name="aprobado'.$request->getPostGet('idmatriculacion').'" id="aprobado'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['HorariosAtencion'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">Aprobado</td>';	
									}else if($domicilio['Estado'] == 2){
										$cadena .='<td class="text-danger" name="aprobado'.$request->getPostGet('idmatriculacion').'" id="aprobado'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['HorariosAtencion'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">Desaprobado</td>';	
									}else{
										$cadena .='<td class="text-danger" name="aprobado'.$request->getPostGet('idmatriculacion').'" id="aprobado'.$request->getPostGet('idmatriculacion').'" value="'.$domicilio['HorariosAtencion'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">Pendiente</td>';	
									}
									$cadena .='<td>';
									$cadena .='<form action="imprimir_comprobante_inscripcion_viejo_domicilio" method="post" enctype="multipart/form-data" id="descargarpdfdomicilioviejo" name="descargarpdfdomicilioviejo">';
									$cadena .='<input type="hidden" name="id_matriculacion_domicilio_viejo" id="id_matriculacion_domicilio_viejo" value="'.$domicilio['IdMatriculacion'].'">';
									$cadena .='<input type="hidden" name="id_domicilio_viejo" id="id_domicilio_viejo" value="'.$domicilio['IdDomicilio'].'">';
									$cadena .='<button type="submit" class="btn btn-secondary btn-sm" style="margin-right:3px">';
									$cadena .='<img src="'.base_url().'/imagenes/impresora_blanca.png" width="18" height="18" title="Imprimir">';
									$cadena .='</button>';					
									$cadena .='</form>';
									$cadena .='</td>';
									/*
									if($session->get('idPerfil') == 1){
									$cadena .='<td style="padding-top: 3px !important;padding-bottom: 3px !important">';
										if($contador == 0){
											
											$cadena .='<button type="bottom" onclick="editar_domicilio('.$domicilio['IdDomicilio'].')" id="btn_editar_domicilio" name="btn_editar_domicilio" class="btn btn-primary btn-sm">';
											$cadena .='<img src="'.base_url().'/imagenes/editar_blanco.png" width="18" height="18" title="Editar">';
											$cadena .='</button>';					
											
										}else{
										
											$cadena .='<button disabled type="bottom" onclick="editar_domicilio('.$domicilio['IdDomicilio'].')" id="btn_editar_domicilio" name="btn_editar_domicilio" class="btn btn-primary btn-sm">';
											$cadena .='<img src="'.base_url().'/imagenes/editar_blanco.png" width="18" height="18" title="Solo se puede editar el domicilio actual">';
											$cadena .='</button>';					
											
										}
									$cadena .='</td>';	
									}
									$contador++;
									*/
								$cadena .='</tr>';	
							}							
							
						$cadena .='</tbody>';									  
					$cadena .='</table>';
					$cadena .= '<br>';
					$cadena .='<div class="modal-footer">';
					$cadena .='<button type="button" id="cerrar_modal_agregar_articulo" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>';
					//$cadena .='<button type="button" onclick="cargararticuloalista()" id="botonguardararticulo" value="botonguardararticulo" class="btn btn-primary btn-sm">Agregar al Carrito</button>';
					$cadena .='</div>';
					
					echo $cadena;
				}else{
					$cadena = '';
									
					$cadena .='<div class="bs-callout bs-callout-danger" >';
					$cadena .='<h4>¡Atención!</h4>';
					$cadena .='<div><label><strong style="color:#f0ad4e;font-size:16px"></strong><strong> No existen domicilios para la matriculación seleccionada.</strong></label></div>';										
					$cadena .='</div>';					
					$cadena .='<div class="modal-footer">';
					$cadena .='<button type="button" id="cerrar_modal_agregar_articulo" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>';
					$cadena .='</div>';
					echo $cadena;
				}	
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);		
			}				
			
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','');
		}	
	}	
	function procesar_mail_recuperar_contrasenia($email) {
		
		$dominio = '';
		$resto = '';
		$primeras_tres_letras = '';
		$mail_final = '';
		
		$dominio = substr($email,0,strpos($email,'@'));
		$resto = substr($email,strpos($email,'@'),strlen($email));
		$primeras_tres_letras = substr($dominio,0,3);
		
		$mail_final .= $primeras_tres_letras;
		$mail_final .='__________________';
		$mail_final .= $resto;
		
		return $mail_final;
	}
	function validacion_final_recuperar_contrasenia_json(){
	
		//INSTANCIA DE MODELOS			
		$session = \Config\Services::session();	
		$request = \Config\Services::request();
		$abogadosModelo = new Abogados_modelo($db);
		$matriculacionesModelo = new Matriculaciones_modelo($db);			
		
		$matricula = $matriculacionesModelo->validar_final_cambio_contrsenia($request->getPostGet('emailcompletar'),$request->getPostGet('checkDomicilio'));	
			
		if(!empty($matricula)){
			$abogadosModelo->resetear_contraseña($matricula[0]['IdAbogado'],$matricula[0]['Cuit']);
			echo '1';			//si coincide devolvemos
		}else{
			echo '0';			//si NO coincide devolvemos
		}
		
	}
	function devolver_domicilios_recuperar_contrasenia_json() {
		try{						
			$session = \Config\Services::session();	
			$request = \Config\Services::request();			
				
			//INSTANCIA DE MODELOS			
			$matriculacionesModelo = new Matriculaciones_modelo($db);			
			
			$mail_cortado = '';
			
			$domicilios = $matriculacionesModelo->validar_matriculacion($request->getPostGet('cuit'),$request->getPostGet('tomo'),$request->getPostGet('folio'),$request->getPostGet('matricula'),$request->getPostGet('departamento'));
			
			if(!empty($domicilios)){
				$mail_cortado = $this->procesar_mail_recuperar_contrasenia($domicilios[0]['Email']);
			}
			
			$esta = false;
			foreach ($domicilios as $domicilio){
				
				if($request->getPostGet('cuit') == $domicilio['Cuit']){					
					$esta = true;					
				}
			}
			
			shuffle($domicilios);//igual a random, mezcla el array
			
			if((!empty($domicilios)) and (!empty($mail_cortado)) and ($esta)){
				$cadena = '';
					$cadena .= '<div class="alert alert-danger" role="alert">';
					$cadena .= 'Seleccione el último domicilio aprobado por su colegio profesional.';
					$cadena .= '</div>';
					$cadena .='<table class="table table-striped stacktable" id="tabla_domicilios" style="font-size:100%">';
						$cadena .='<thead>';
							$cadena .='<tr>';
								$cadena .='<th style="text-align:center;width:8%">#</th>';
								$cadena .='<th style="text-align:center">Calle</th>';																																	 
								$cadena .='<th style="text-align:center">Número</th>';																																	 
								$cadena .='<th style="text-align:center">Piso</th>';																																	 
								$cadena .='<th style="text-align:center">Oficina</th>';																																	 
							$cadena .='</tr>';
						$cadena .='</thead>';
						$cadena .='<tbody>';
							
							foreach ($domicilios as $domicilio){
								
								$cadena .='<tr>';
								   
									$cadena .='<td style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:1%;padding-right:0.2%">';
									
										$cadena .='<div class="form-check">';	
										  $cadena .='<input class="form-check-input" type="radio" name="checkDomicilio" id="checkDomicilio" value="'.$domicilio['ultimoDom'].'">';										
										$cadena .='</div>';	
										
									$cadena .='</td>';
									
										$cadena .='<td name="calledomicilio'.$domicilio['ultimoDom'].'" id="calledomicilio'.$domicilio['ultimoDom'].'" value="'.$domicilio['Calle'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Calle'].'</td>';
										$cadena .='<td name="numerodomicilio'.$domicilio['ultimoDom'].'" id="numerodomicilio'.$domicilio['ultimoDom'].'" value="'.$domicilio['Numero'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Numero'].'</td>';
										$cadena .='<td name="pisodomicilio'.$domicilio['ultimoDom'].'" id="pisodomicilio'.$domicilio['ultimoDom'].'" value="'.$domicilio['Piso'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Piso'].'</td>';
										$cadena .='<td name="oficinadomicilio'.$domicilio['ultimoDom'].'" id="oficinadomicilio'.$domicilio['ultimoDom'].'" value="'.$domicilio['Oficina'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$domicilio['Oficina'].'</td>';
																																														
								$cadena .='</tr>';
							}
							
						$cadena .='</tbody>';									  
					$cadena .='</table>';
					
					$cadena .= '<div id="div_selecciones_domicilio" style="display:none"></div>';
					$cadena .= '<br><br>';
					
					$cadena .= '<div class="alert alert-primary" role="alert">';
					
					$cadena .= 'Este es su correo electrónico registrado <a href="#" class="alert-link">'.$mail_cortado.'</a>';
					$cadena .= '</div>';
					
					$cadena .= '<br>';
					$cadena .= '  <div class="form-group row">';
					$cadena .= '	<label for="inputEmail3" class="col-sm-5 col-form-label">Ecriba su correo electrónico completo</label>';
					$cadena .= '	<div class="col-sm-7">';
					$cadena .= '	  <input type="email" class="form-control" placeholder="Escriba su E-mail aquí" id="emailcompletar">';
					$cadena .= '	</div>';
					$cadena .= '  </div>';
					
					$cadena .= '<br>';
					
					$cadena .='<div class="modal-footer">';
					$cadena .='<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>';
					$cadena .='<button type="button" onclick="validacion_final()" id="btn_verificar" name="btn_verificar" class="btn btn-primary btn-sm">Verificar</button>';
					$cadena .='</div>';
					
					echo $cadena;
			}else{
				$cadena = '';
								
				$cadena .='<div class="alert alert-danger" role="alert">';
				$cadena .='<h4>¡Atención!</h4>';
				$cadena .='<div><label><strong style="color:#f0ad4e;font-size:16px"></strong><strong> No es posible identificarlo, verifique haber ingresado los datos correctamente. Si el error persiste, contacte a desarrollo@colproba.org.ar indicando Tomo, Folio, Colegio y CUIT.</strong></label></div>';										
				$cadena .='</div>';					
				$cadena .='<div class="modal-footer">';
				$cadena .='<button type="button" id="cerrar_modal_agregar_articulo" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>';
				$cadena .='</div>';
				echo $cadena;
			}					
			
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','');
		}	
	}
	function devolver_sorteos_json() {
		try{
			$permisos = array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6);				
			$session = \Config\Services::session();	
			$request = \Config\Services::request();
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS			
				$consultasModelo = new Consultas_modelo($db);			
										
				$sorteos = $consultasModelo->devolver_consultas_por_abogado($request->getPostGet('idabogado'));						
		
				if(!empty($sorteos)){
					$cadena = '';
					$cadena .='<table class="table table-striped stacktable" id="tabla_sorteos" style="font-size:80%">';
						$cadena .='<thead>';
							$cadena .='<tr>';
																									
								$cadena .='<th style="text-align:center">Nro. Sorteo</th>';
								$cadena .='<th style="text-align:center">Fecha</th>';
								$cadena .='<th style="text-align:center">Apellido y Nombre</th>';
								$cadena .='<th style="text-align:center">Cuit</th>';
								$cadena .='<th style="text-align:center">Telefono</th>';								
								$cadena .='<th style="text-align:center">E-mail</th>';																		
								$cadena .='<th style="text-align:center">Estado</th>';									
																																									 
							$cadena .='</tr>';
						$cadena .='</thead>';
						$cadena .='<tbody>';
							
							foreach ($sorteos as $sorteo){
								
								$cadena .='<tr>';		   							
						
									$cadena .='<td name="idconsulta'.$request->getPostGet('idmatriculacion').'" id="idconsulta'.$request->getPostGet('idmatriculacion').'" value="'.$sorteo['IdConsulta'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$sorteo['IdConsulta'].'</td>';
									$cadena .='<td name="fechasorteo'.$request->getPostGet('idmatriculacion').'" id="fechasorteo'.$request->getPostGet('idmatriculacion').'" value="'.$sorteo['FechaSorteo'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$sorteo['FechaSorteo'].'</td>';
									$cadena .='<td name="apellidoynombre'.$request->getPostGet('idmatriculacion').'" id="apellidoynombre'.$request->getPostGet('idmatriculacion').'" value="'.$sorteo['Apellido'].' '.$sorteo['Nombre'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$sorteo['Apellido'].' '.$sorteo['Nombre'].'</td>';
									$cadena .='<td name="cuit'.$request->getPostGet('idmatriculacion').'" id="cuit'.$request->getPostGet('idmatriculacion').'" value="'.$sorteo['Cuit'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$sorteo['Cuit'].'</td>';
									$cadena .='<td name="telefono'.$request->getPostGet('idmatriculacion').'" id="telefono'.$request->getPostGet('idmatriculacion').'" value="'.$sorteo['Telefono'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$sorteo['Telefono'].'</td>';
									$cadena .='<td name="email'.$request->getPostGet('idmatriculacion').'" id="email'.$request->getPostGet('idmatriculacion').'" value="'.$sorteo['Email'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$sorteo['Email'].'</td>';
									$cadena .='<td name="estadoconsulta'.$request->getPostGet('idmatriculacion').'" id="estadoconsulta'.$request->getPostGet('idmatriculacion').'" value="'.$sorteo['NombreEstadoConsulta'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$sorteo['NombreEstadoConsulta'].'</td>';	
																								
								$cadena .='</tr>';
							}
						$cadena .='</tbody>';									  
					$cadena .='</table>';
					$cadena .= '<br>';
					$cadena .='<div class="modal-footer">';
					$cadena .='<button type="button" id="cerrar_modal_agregar_articulo" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>';
					//$cadena .='<button type="button" onclick="cargararticuloalista()" id="botonguardararticulo" value="botonguardararticulo" class="btn btn-primary btn-sm">Agregar al Carrito</button>';
					$cadena .='</div>';
					
					echo $cadena;
				}else{
					$cadena = '';
									
					$cadena .='<div class="bs-callout bs-callout-danger" >';					
					$cadena .='<div><label><strong style="color:#f0ad4e;font-size:16px"></strong><strong> No existen sorteos para el abogado seleccionado.</strong></label></div>';										
					$cadena .='</div>';					
					$cadena .='<div class="modal-footer">';
					$cadena .='<button type="button" id="cerrar_modal_agregar_articulo" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>';
					$cadena .='</div>';
					echo $cadena;
				}	
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);		
			}				
			
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','');
		}	
	}
	function devolver_movimiento_matricula_json() {
		try{
							
			$session = \Config\Services::session();	
			$request = \Config\Services::request();			
				
			//INSTANCIA DE MODELOS			
			//$detalleCambioMatriculaModelo = new Detalle_cambio_matricula_modelo($db);										
			$estadoMatriculaModelo = new Estado_matricula_modelo($db);										
						
			//$movimientos = $detalleCambioMatriculaModelo->devolver_movimiento_matricula($request->getPostGet('idmatriculacion'));		
			$movimientos = $estadoMatriculaModelo->devolver_movimiento_matricula($request->getPostGet('idmatriculacion'));		
			
	
			if(!empty($movimientos)){
				$cadena = '';
				$cadena .='<table class="table table-striped stacktable" id="tabla_movimientos" style="font-size:80%">';
					$cadena .='<thead>';
						$cadena .='<tr>';
																								
							$cadena .='<th style="text-align:center">Fecha de Inicio</th>';
							//$cadena .='<th style="text-align:center">Desde</th>';
							//$cadena .='<th style="text-align:center">Hasta</th>';
							$cadena .='<th style="text-align:center">Estado</th>';
							//$cadena .='<th style="text-align:center">Detalle</th>';															
																																								 
						$cadena .='</tr>';
					$cadena .='</thead>';
					$cadena .='<tbody>';
						
						foreach ($movimientos as $movimiento){
							
							$cadena .='<tr>';		   							
					
								$cadena .='<td name="FechaInicio'.$request->getPostGet('idmatriculacion').'" id="FechaInicio'.$request->getPostGet('idmatriculacion').'" value="'.$movimiento['FechaInicio'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%"><span style="display:none">'.$movimiento['FechaInicio'].'</span>'.$movimiento['FechaInicio'].'</td>';
								//$cadena .='<td name="FechaDesde'.$request->getPostGet('idmatriculacion').'" id="FechaDesde'.$request->getPostGet('idmatriculacion').'" value="'.$movimiento['FechaDesde'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.date("d-m-Y H:i:s",strtotime($movimiento['FechaDesde'])).'</td>';
								//if(!empty($movimiento['FechaHasta'])){
									//$cadena .='<td name="FechaHasta'.$request->getPostGet('idmatriculacion').'" id="FechaHasta'.$request->getPostGet('idmatriculacion').'" value="'.$movimiento['FechaHasta'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.date("d-m-Y H:i:s",strtotime($movimiento['FechaHasta'])).'</td>';
								//}else{
									//$cadena .='<td name="FechaHasta'.$request->getPostGet('idmatriculacion').'" id="FechaHasta'.$request->getPostGet('idmatriculacion').'" value="'.$movimiento['FechaHasta'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%"></td>';
								//}
								$cadena .='<td name="EstadoMatricula'.$request->getPostGet('idmatriculacion').'" id="EstadoMatricula'.$request->getPostGet('idmatriculacion').'" value="'.$movimiento['NombreTipoEstado'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$movimiento['NombreTipoEstado'].'</td>';
								//$cadena .='<td name="DetalleMotivo'.$request->getPostGet('idmatriculacion').'" id="DetalleMotivo'.$request->getPostGet('idmatriculacion').'" value="'.$movimiento['DetalleMotivo'].'" style="padding-top: 3px !important;padding-bottom: 3px !important;text-align:center;padding-left:0.2%;padding-right:0.2%">'.$movimiento['DetalleMotivo'].'</td>';
																						
							$cadena .='</tr>';
							
						}
					$cadena .='</tbody>';									  
				$cadena .='</table>';
				$cadena .= '<br>';
				
				
				echo $cadena;
			}else{
				$cadena = '';
								
				$cadena .='<div class="bs-callout bs-callout-danger" >';
				$cadena .='<h4>¡Atención!</h4>';
				$cadena .='<div><label><strong style="color:#f0ad4e;font-size:16px"></strong><strong> No existen movimientos para la matrícula seleccionada.</strong></label></div>';										
				$cadena .='</div>';					
			
				echo $cadena;
			}					
			
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','');
		}	
	}	
	function devolver_sanciones_matricula_json(){
		try{
							
			$session = \Config\Services::session();	
			$request = \Config\Services::request();			
				
			//INSTANCIA DE MODELOS													
			$detalleCambioMatriculaModelo = new Detalle_cambio_matricula_modelo($db);										
						
			$sanciones = $detalleCambioMatriculaModelo->where('IdMatricula' , $request->getPostGet('idmatriculacion'))
													  ->where('IdTipoEstado' , 4)
													  ->findAll();				
	
			if(!empty($sanciones)){
				$cadena = '';
				$cadena .='';
				foreach ($sanciones as $sancion){	
					
					$cadena .= '<strong>Fecha desde: </strong>'.date('d-m-Y',strtotime($sancion['FechaDesde']));
					$cadena .= '<br>';
					$cadena .= '<strong>Fecha hasta: </strong>'.date('d-m-Y',strtotime($sancion['FechaHasta']));
					$cadena .= '<br>';
					if(!empty($sancion['DetalleMotivo'])){
						$cadena .= '<strong>Motivo: </strong>'.$sancion['DetalleMotivo'];
					}else{
						$cadena .= '<strong>Motivo: </strong> No se registró el motivo';
					}
					$cadena .= '<br>';
					$cadena .= '<hr>';
				}
				
				echo $cadena;
			}else{
				$cadena = '';
								
				$cadena .='<div class="bs-callout bs-callout-danger" >';
				$cadena .='<h4>¡Atención!</h4>';
				$cadena .='<div><label><strong style="color:#f0ad4e;font-size:16px"></strong><strong> No existen sanciones para la matrícula seleccionada.</strong></label></div>';										
				$cadena .='</div>';					
			
				echo $cadena;
			}					
			
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','');
		}	
	}
	function devolver_consulta_json() {
		try{
			//INSTANCIA DE MODELOS					
			$session = \Config\Services::session();	
			$request = \Config\Services::request();	
			$consultasModelo = new Consultas_modelo($db);				
					
			$consulta = $consultasModelo->devolver_consulta($request->getPostGet('idconsulta'));		
		
			$domicilio =  $consulta[0]['calle_estudio'].' - '.$consulta[0]['numero_estudio'];
			if(!empty($consulta[0]['piso_estudio'])){
				$domicilio .= ' Piso: '.$consulta[0]['piso_estudio'];
			}
			if(!empty($consulta[0]['oficina_estudio'])){
				$domicilio .=  ' Oficina: '.$consulta[0]['oficina_estudio'];
			}
			
			$matriculacion =  '';
			if(!empty($consulta[0]['Matricula'])){
				$matriculacion = '<strong>Matrícula:</strong>  '.$consulta[0]["Matricula"]." ".$consulta[0]["nombre_colegio"];
			}
			if(!empty($consulta[0]['Tomo'])){
				$matriculacion =  '<strong>Tomo:</strong>  '.$consulta[0]["Tomo"].' <strong>Folio:</strong>  '.$consulta[0]["Folio"]." ".$consulta[0]["nombre_colegio"];
			}
			
			$data = [
					'NombreyApellidoAbogado' => $consulta[0]['apellido_abogado'].', '.$consulta[0]['nombre_abogado'],																				
					'Colegio' => $consulta[0]['nombre_colegio'],										
					'Domicilio' => $domicilio,										
					'EmailEstudio' => $consulta[0]['email_estudio'],						
					'HorariosAtencion' => $consulta[0]['HorariosAtencion'],				
					'TelefonoEstudio' => $consulta[0]['telefono_estudio'],
					'Tomo' => $consulta[0]['Tomo'],							 									
					'Folio' => $consulta[0]['Folio'],
					'Matricula' => $consulta[0]['Matricula'],
					'Matriculacion' => $matriculacion,
					'NombreyApellidoConsultante' => $consulta[0]['Apellido'].', '.$consulta[0]['Nombre'],
					'Cuit' => $consulta[0]['Cuit'],																								 
					'Telefono' => $consulta[0]['Telefono'],
					'Celular' => $consulta[0]['Celular'],																						 
					'Email' => $consulta[0]['Email'],																						 
					'Descripcion' => $consulta[0]['Descripcion'],																						 
					'FechaSorteo' => date('d-m-Y H:i:s',strtotime($consulta[0]['FechaSorteo'])), 
			];						
	
			if(!empty($consulta)){
				$cadena = '';
				$cadena .='<label><strong>Fecha de sorteo:</strong> '.$data["FechaSorteo"].'</label><br><br>
					
					<div class="card">
					  <h4 class="card-header" style="margin-top:0px">Detalles del profesional sorteado</h4>
					  
					  <div class="card-body">
						<table>
							<tr>
								<td>
																
									<label><strong>Apellido y Nombre:</strong> '.$data["NombreyApellidoAbogado"].'</label><br>
									<label>'.$data["Matriculacion"].'</label><br><br>
																	
									<label><strong>Datos del estudio</strong></label><br>
									<label><strong>E-mail:</strong> '.$data["EmailEstudio"].'</label><br>
									<label><strong>Dirección:</strong> '.$data["Domicilio"].'</label><br>
									<label><strong>Teléfono:</strong> '.$data["TelefonoEstudio"].'</label><br>
									<label><strong>Horario de atención:</strong> '.$data["HorariosAtencion"].'</label><br>
									
								</td>									
							</tr>
						</table>
					 </div>
					</div>
					<br>				
					
					<div class="card">
						<h4 class="card-header" style="margin-top:0px">Datos del consultante</h4>
						<div class="card-body">
																				 
							<label><strong>Apellido y Nombre:</strong> '.$data["NombreyApellidoConsultante"].'</label><br>
							<label><strong>Cuit:</strong> '.$data["Cuit"].'</label><br>
							<label><strong>Teléfono:</strong> '.$data["Telefono"].'</label><br>
							<label><strong>Celular:</strong> '.$data["Celular"].'</label><br>
							<label><strong>E-mail</strong>  '.$data["Email"].'</label><br>
							
												
						</div>
					</div>
					<br>
					
					<div class="card">
						<h4 class="card-header" style="margin-top:0px">Detalles del caso</h4>
						<div class="card-body">
																				 
							<label><strong>Descripción:</strong> '.$data["Descripcion"].'</label><br>
							
						</div>
					</div>
					<br>';
				
				
				echo $cadena;
			}else{
				$cadena = '';
								
				$cadena .='<div class="bs-callout bs-callout-danger" >';
				$cadena .='<h4>¡Atención!</h4>';
				$cadena .='<div><label><strong style="color:#f0ad4e;font-size:16px"></strong><strong> No existen datos para el sorteo seleccionado.</strong></label></div>';										
				$cadena .='</div>';					
			
				echo $cadena;
			}					
			
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','');
		}	
	}
	function devolver_matricula_domicilio_completo_json() {
		try{
			//INSTANCIA DE MODELOS
			$request = \Config\Services::request();		
			$matriculacionesModelo = new Matriculaciones_modelo($db);	
			$provinciaModelo = new Provincias_modelo($db);	
			$partidoModelo = new Partidos_modelo($db);	
			$localidadModelo = new Municipios_modelo($db);	
			$colegioModelo = new Departamentos_modelo($db);
			$domiciliosModelos = new Domicilios_modelo($db);			
			
			$id_inscripcion = $request->getPostGet('idmatriculacion');	
			
			if($request->getPostGet('origen') == 1){															//1 = vienen de nuevos matriculados
				$matriculacion = $matriculacionesModelo->devolver_matriculacion($id_inscripcion);		
			}else{																										//2 = viene de domicilios
				$matriculacion = $matriculacionesModelo->devolver_matriculacion_domicilio_pendiente($id_inscripcion);
			}
			$provincia = $provinciaModelo->where('IdProvincia', $matriculacion[0]['IdProvincia'])->findAll();
			$partido = $partidoModelo->where('Id', intval($matriculacion[0]['IdPartido']))->findAll();
			$localidad = $localidadModelo->where('IdMunicipio', $matriculacion[0]['IdLocalidad'])->findAll();
			$colegio = $colegioModelo->where('IdDepartamento', $matriculacion[0]['IdColegio'])->findAll();
			$domicilio_completo = $domiciliosModelos->where('IdDomicilio', $request->getPostGet('IdDomicilio'))->findAll();
					
			$domicilio =  $domicilio_completo[0]['Calle'].' - '.$domicilio_completo[0]['Numero'];
			if(!empty($domicilio_completo[0]['Piso'])){
				$domicilio .= ' Piso: '.$domicilio_completo[0]['Piso'];
			}
			if(!empty($domicilio_completo[0]['Oficina'])){
				$domicilio .=  ' Oficina: '.$domicilio_completo[0]['Oficina'];
			}
					
			$data = [
					'Apellidoynombre' => $matriculacion[0]['Apellido'].', '.$matriculacion[0]['Nombre'],										
					'ApellidoynombreFirma' => strtoupper($matriculacion[0]['Apellido'].', '.$matriculacion[0]['Nombre']),										
					'Colegio' => $colegio[0]['NombreDepartamento'],										
					'Domicilio' => $domicilio,										
					'Email' => $matriculacion[0]['Email'],						
					'Cuit' => $matriculacion[0]['Cuit'],									
					'Celular' => $matriculacion[0]['Celular'],
					'Telefono' => $matriculacion[0]['Telefono'],
					'Tomo' => $matriculacion[0]['Tomo'],							 									
					'Folio' => $matriculacion[0]['Folio'],				
					'Matricula' => $matriculacion[0]['Matricula'],
					'Localidadypartido' => $localidad[0]['NombreMunicipio'].', '.$partido[0]['NombrePartido'],																								 
					'Provincia' => $provincia[0]['NombreProvincia'],
					'HorariosAtencion' => $matriculacion[0]['HorariosAtencion'],																						 
			];						
	
			if(!empty($matriculacion)){
				$cadena = '';
				$cadena .='
					
					<div class="card">
					  <h4 class="card-header" style="margin-top:0px">Datos del Abogado</h4>
					  <div class="card-body">
						<label><strong>Apellido y Nombre:</strong> '.$data["Apellidoynombre"].'</label><br>
						<label><strong>Tomo:</strong>  '.$data["Tomo"].' <strong>Folio:</strong>  '.$data["Folio"].'</label><br>
						<label><strong>Colegio:</strong> '.$data["Colegio"].'</label><br>
						<label><strong>Cuit:</strong> '.$data["Cuit"].'</label><br>
						<label><strong>Email:</strong> '.$data["Email"].'</label>
					  </div>
					</div>
					<br>				
					
					<div class="card">
						<h4 class="card-header" style="margin-top:0px">Domicilio Constituido</h4>
						<div class="card-body">
						
							<table>
								<tr>
									<td>						
										<label><strong>Provincia:</strong>  '.$data["Provincia"].'</label><br>
										<label><strong>Localidad:</strong>  '.$data["Localidadypartido"].'</label><br>
										<label><strong>Calle:</strong> '.$data["Domicilio"].'</label><br>
										<label><strong>Teléfono:</strong> '.$data["Telefono"].'</label><br>
										<label><strong>Celular:</strong> '.$data["Celular"].'</label><br>							
										<label><strong>Horario</strong>  '.$data["HorariosAtencion"].'</label><br>
									</td>					

								</tr>
							</table>
						
						</div>
					</div>
					<br>
				';	
				
				echo $cadena;
			}else{
				$cadena = '';
								
				$cadena .='<div class="bs-callout bs-callout-danger" >';
				$cadena .='<h4>¡Atención!</h4>';
				$cadena .='<div><label><strong style="color:#f0ad4e;font-size:16px"></strong><strong> No existen datos para la matricula seleccionada.</strong></label></div>';										
				$cadena .='</div>';					
			
				echo $cadena;
			}					
			
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','');
		}	
	}
	function devolver_matricula_json() {
		try{
			//INSTANCIA DE MODELOS
			$request = \Config\Services::request();		
			$matriculacionesModelo = new Matriculaciones_modelo($db);	
			$provinciaModelo = new Provincias_modelo($db);	
			$partidoModelo = new Partidos_modelo($db);	
			$localidadModelo = new Municipios_modelo($db);	
			$colegioModelo = new Departamentos_modelo($db);	
			
			$id_inscripcion = $request->getPostGet('idmatriculacion');	
			
			if($request->getPostGet('origen') == 1){															//1 = vienen de nuevos matriculados
				$matriculacion = $matriculacionesModelo->devolver_matriculacion($id_inscripcion);		
			}else{																										//2 = viene de domicilios
				$matriculacion = $matriculacionesModelo->devolver_matriculacion_domicilio_pendiente($id_inscripcion);
			}
			$provincia = $provinciaModelo->where('IdProvincia', $matriculacion[0]['IdProvincia'])->findAll();
			$partido = $partidoModelo->where('Id', intval($matriculacion[0]['IdPartido']))->findAll();
			$localidad = $localidadModelo->where('IdMunicipio', $matriculacion[0]['IdLocalidad'])->findAll();
			$colegio = $colegioModelo->where('IdDepartamento', $matriculacion[0]['IdColegio'])->findAll();
					
			$domicilio =  $matriculacion[0]['Calle'].' - '.$matriculacion[0]['Numero'];
			if(!empty($matriculacion[0]['Piso'])){
				$domicilio .= ' Piso: '.$matriculacion[0]['Piso'];
			}
			if(!empty($matriculacion[0]['Oficina'])){
				$domicilio .=  ' Oficina: '.$matriculacion[0]['Oficina'];
			}
			
			
			if(!empty($matriculacion[0]['Tomo'])){
				$numero_matricula = '';
				$numero_matricula = ' <strong> Tomo:</strong>  '.$matriculacion[0]['Tomo'].' <strong> Folio:</strong>  '.$matriculacion[0]['Folio'];
			}
			
			if(!empty($matriculacion[0]['Matricula'])){
				$numero_matricula = '';
				$numero_matricula =  '<strong>  Matrícula: </strong> '.$matriculacion[0]['Matricula'];
			}
			
			$data = [
					'Apellidoynombre' => $matriculacion[0]['Apellido'].', '.$matriculacion[0]['Nombre'],										
					'ApellidoynombreFirma' => strtoupper($matriculacion[0]['Apellido'].', '.$matriculacion[0]['Nombre']),										
					'Colegio' => $colegio[0]['NombreDepartamento'],										
					'Domicilio' => $domicilio,										
					'Email' => $matriculacion[0]['Email'],						
					'Cuit' => $matriculacion[0]['Cuit'],									
					'Celular' => $matriculacion[0]['Celular'],
					'Telefono' => $matriculacion[0]['Telefono'],
					'Tomo' => $matriculacion[0]['Tomo'],							 									
					'Folio' => $matriculacion[0]['Folio'],				
					'Matricula' => $matriculacion[0]['Matricula'],
					'Numeromatricula' => $numero_matricula,
					'Localidadypartido' => $matriculacion[0]['NombreLocalidad'].', '.$matriculacion[0]['NombreMunicipio'],																								 
					'Provincia' => $provincia[0]['NombreProvincia'],
					'HorariosAtencion' => $matriculacion[0]['HorariosAtencion'],																						 
			];						
	
			if(!empty($matriculacion)){
				$cadena = '';
				$cadena .='
					
					<div class="card">
					  <h4 class="card-header" style="margin-top:0px">Datos del Abogado</h4>
					  <div class="card-body">
						<label><strong>Apellido y Nombre:</strong> '.$data["Apellidoynombre"].'</label><br>
						<label>'.$data["Numeromatricula"].'</label><br>
						<label><strong>Colegio:</strong> '.$data["Colegio"].'</label><br>
						<label><strong>Cuit:</strong> '.$data["Cuit"].'</label><br>
						<label><strong>Email:</strong> '.$data["Email"].'</label>
					  </div>
					</div>
					<br>				
					
					<div class="card">
						<h4 class="card-header" style="margin-top:0px">Domicilio Constituido</h4>
						<div class="card-body">
						
							<table>
								<tr>
									<td>						
										<label><strong>Provincia:</strong>  '.$data["Provincia"].'</label><br>
										<label><strong>Localidad:</strong>  '.$data["Localidadypartido"].'</label><br>
										<label><strong>Calle:</strong> '.$data["Domicilio"].'</label><br>
										<label><strong>Teléfono:</strong> '.$data["Telefono"].'</label><br>
										<label><strong>Celular:</strong> '.$data["Celular"].'</label><br>							
										<label><strong>Horario</strong>  '.$data["HorariosAtencion"].'</label><br>
									</td>					

								</tr>
							</table>
						
						</div>
					</div>
					<br>
				';	
				
				echo $cadena;
			}else{
				$cadena = '';
								
				$cadena .='<div class="bs-callout bs-callout-danger" >';
				$cadena .='<h4>¡Atención!</h4>';
				$cadena .='<div><label><strong style="color:#f0ad4e;font-size:16px"></strong><strong> No existen datos para la matricula seleccionada.</strong></label></div>';										
				$cadena .='</div>';					
			
				echo $cadena;
			}					
			
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','');
		}	
	}	
	function guardar_excusacion(){
		try{
			
			//INSTANCIA DE MODELOS	
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$consultasModelo = new Consultas_modelo($db);
			$motivosExcusacionModelo = new Motivos_excusacion_modelo($db);
			
			$motivo = '';
			if($request->getPostGet('desplegablemotivoexcusacion') <> 0){
				$motivo_completo = $motivosExcusacionModelo->where('IdMotivoExcusacion',$request->getPostGet('desplegablemotivoexcusacion'))->findAll();
				$motivo = $motivo_completo[0]['NombreMotivoExcusacion'];
			}			
			
			$consultasModelo->guardar_excusarse_de_causa($request->getPostGet('desplegableestadoconsulta'),$motivo,$request->getPostGet('id_consulta_excusarme'),$session->get('idColegio'),$session->get('idusuario'));				
			
			$consulta = $consultasModelo->devolver_consulta($request->getPostGet('id_consulta_excusarme'));
					
			$direccion_email = $consulta[0]['Email'];					
			$asunto = 'Sistema ACOM';					
			$mensaje = 'Estimado, le informamos que el profesional letrado sorteado en el sistema Acom para su patrocinio se ha EXCUSADO.'. "<br>";
			$mensaje .= 'Por favor, ingrese al Sistema ACOM y realice un nuevo sorteo para que le sea asignado un nuevo Abogado.'. "<br>";
						
			$email = new email();			
			$email->enviar_mail($direccion_email,$asunto,$mensaje);
			
			$this->sorteos();	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function finalizar_causa(){
		try{
			
			//INSTANCIA DE MODELOS	
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$consultasModelo = new Consultas_modelo($db);
			
			$consultasModelo->guardar_finalizar_causa($request->getPostGet('id_consulta_finalizar'),$session->get('idColegio'),$session->get('idusuario'));						  
							
			$this->sorteos();	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	function guardar_recusacion(){
		try{
			
			//INSTANCIA DE MODELOS	
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$consultasModelo = new Consultas_modelo($db);
			
			$consultasModelo->guardar_recusar_abogado($request->getPostGet('desplegableestadoconsulta'),$request->getPostGet('motivo'),$request->getPostGet('id_consulta_recusar'),$session->get('idColegio'),$session->get('idusuario'));
			
			$consulta = $consultasModelo->devolver_consulta($request->getPostGet('id_consulta_recusar'));
					
			$direccion_email = $consulta[0]['Email'];					
			$asunto = 'Sistema ACOM';					
			$mensaje = 'Estimado, le informamos que el profesional letrado sorteado en el sistema Acom para su patrocinio se ha EXCUSADO.'. "<br>";
			$mensaje .= 'Por favor, ingrese al Sistema ACOM y realice un nuevo sorteo para que le sea asignado un nuevo Abogado.'. "<br>";
						
			$email = new email();			
			$email->enviar_mail($direccion_email,$asunto,$mensaje);
			
			$this->sorteos();	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function volver_sorteo_a_estado_pendiente(){
		try{
			
			//INSTANCIA DE MODELOS	
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$consultasModelo = new Consultas_modelo($db);
			
			$consultasModelo->guardar_cambiar_estado_a_pendiente($request->getPostGet('id_consulta_cambiar_a_estado_pendiente'),$session->get('idusuario'));
						
			$this->sorteos();	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	function aceptar_consulta(){
		try{
			
			//INSTANCIA DE MODELOS	
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$consultasModelo = new Consultas_modelo($db);
			
			$consultasModelo->guardar_aceptar_causa($request->getPostGet('id_aceptar_consulta'),$session->get('idusuario'));						  
							
			$this->sorteos();	
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function agregar_nuevo_domicilio_json(){
		
		//INSTANCIA DE MODELOS		
		$domiciliosModelos = new Domicilios_modelo($db);		
		$request = \Config\Services::request();
		$session = \Config\Services::session();	

		$domicilio = $domiciliosModelos->where('IdMatriculacion' , $request->getPostGet('id_matricula'))
									   ->where('Calle' , $request->getPostGet('calleDomicilio'))
									   ->where('Numero' , $request->getPostGet('numeroDomicilio'))
									   ->findAll();		
		
		if(empty($domicilio)){				
			
			//$domiciliosModelos->desactivar_domicilios_anteriores($request->getPostGet('id_matricula'));
			
			$domicilio = $domiciliosModelos->where('IdMatriculacion' , $request->getPostGet('id_matricula'))->findAll();	
		
			$data = ['IdMatriculacion' => $request->getPostGet('id_matricula'),	
					 'Cuit' => $domicilio[0]['Cuit'],
					 'IdProvincia' => $domicilio[0]['IdProvincia'],
					 'IdPartido' => $request->getPostGet('partidoDomicilio'),
					 'IdLocalidad' => $request->getPostGet('localidadDomicilio'),			
					 'Calle' => $request->getPostGet('calleDomicilio'),
					 'Numero' => $request->getPostGet('numeroDomicilio'),
					 'Piso' => $request->getPostGet('pisoDomicilio'),									
					 'Oficina' => $request->getPostGet('oficinaDomicilio'),
					 'Email' => $request->getPostGet('emailEstudio'),							 
					 'Telefono' => $request->getPostGet('telefonoEstudio'),								
					 'HorariosAtencion' => $request->getPostGet('horarioDomicilio'),
					 'Estado' => 0,
			];
			
			$domiciliosModelos->insert($data);
			$nuevo_domicilio = $domiciliosModelos->where('IdMatriculacion' , $request->getPostGet('id_matricula'))
												 ->where('Calle' , $request->getPostGet('calleDomicilio'))
												 ->where('Numero' , $request->getPostGet('numeroDomicilio'))
												 ->findAll();
			
			if(!empty($nuevo_domicilio)){	//si se agrego
				echo '0';
			}else{							//sino devuelve codigo de error
				echo '99';
			}
			
		}else{
			echo '1';						//ya existe
		}
	
	}	
	function guardar_licencia_json(){
		
		//INSTANCIA DE MODELOS	
		$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);
		$estadoMatriculaModelo = new Estado_matricula_modelo($db);		
		$licenciasModelo = new Licencias_modelo($db);
		$matriculacionesModelo = new Matriculaciones_modelo($db);		
		$request = \Config\Services::request();
		$session = \Config\Services::session();

		$fecha_desde = $request->getPostGet('fechaInicio');
		$fecha_hasta = $request->getPostGet('fechaFin');
		$tipo_movimiento = 6;// 1 = pedida por el abogado	y  2 = otorgada por colegio					
		$motivo = $request->getPostGet('motivo');
		$id_matricula = $request->getPostGet('matriculacion');
		$cuit = $request->getPostGet('cuit');
		
		//$licencia = $licenciasModelo->devolver_licencia($fecha_desde,$fecha_hasta,$request->getPostGet('matriculacion'));
		//DEVUELVE SI EL ESTADO ACTUAL ES UNA LICENCIA
		$licencia = $estadoMatriculaModelo->devolver_ultimo_estado_de_licencia($fecha_desde,$fecha_hasta,$request->getPostGet('matriculacion'));
		
		if(empty($licencia)){
			
			$id_estado_matricula = $estadoMatriculaModelo->guardar_estado_matricula($id_matricula,$fecha_desde,$session->get('idusuario'),6,$motivo);
			
			if(!empty($fecha_hasta)){
				
				//2 = aprobado por colegio
				//INSERTAMOS LA FECHA HASTA COMO FECHA DESDE Y EL ESTADO APROBADA PARA QUE A PARTIR DE AHI YA SE HABILITE LA MATRICULA AUTOMATICAMENTE
				$id_estado_matricula_alta = $estadoMatriculaModelo->guardar_estado_matricula($id_matricula,$fecha_hasta,$session->get('idusuario'),2,$motivo);
			
			}
			
			//guardamos en la tabla Licencias
			$data = [			
				'IdMatriculacion' => $id_matricula,						
				'IdTipoLicencia' => 1,// 1 = pedida por el abogado, 2 = cargada por colegio						
				'Cuit' => $cuit,						
				'FechaRegistro' => date('Y-m-d H:i:s'),
				'FechaInicio' => $fecha_desde,
				'FechaFin' => $fecha_hasta,			
				'DetalleMotivo' => $motivo,
				'Estado' => 1,
			];			
			$licenciasModelo->insert($data);
			
			//guarda en detalle_cambio_matricula
			$data = [				
				'IdMatricula' => $id_matricula,
				'IdEstadoMatricula' => $id_estado_matricula,				
				'FechaRegistro' => date('Y-m-d H:i:s'),						
				'FechaDesde' => $fecha_desde,
				'FechaHasta' => $fecha_hasta,
				'IdTipoEstado' => $tipo_movimiento,			
				'DetalleMotivo' => $motivo,				//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado					
			];		
			
			$datalleCambioMatriculaModelo->insert($data);
			
			
			echo '1';
			
		}else{
			echo '0';
		}	
		
	}
	function finalizar_licencia(){
		
		//INSTANCIA DE MODELOS	

		$estadoMatriculaModelo = new Estado_matricula_modelo($db);			
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		$estado_matricula = $estadoMatriculaModelo->where('IdEstadoMatricula', $request->getPostGet('id_estado_matricula'))->findAll();
			
		if(!empty($estado_matricula)){

			$data = [				
				'FechaInicio' => date("Y-m-d h:i:s"),			
				'IdTipoEstado' => 2,			
				'Motivo' => 'Finalizar licencia. Pedido por abogado desde perfil abogado',			
			];		
			
			$estadoMatriculaModelo->update($request->getPostGet('id_estado_matricula'), $data);
						
		}
		$this->matriculas_abogado();
	}
	function guardar_nueva_sancion(){
		
		//INSTANCIA DE MODELOS		
		$request = \Config\Services::request();
		$session = \Config\Services::session();			
		
		$estadoMatriculaModelo = new Estado_matricula_modelo($db);
		$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);
		
		$fecha_desde = $request->getPostGet('fechaInicioSancion');
		$fecha_hasta = $request->getPostGet('fechaFinSancion');
		$motivo = $request->getPostGet('motivoSancion');
		$id_matricula = $request->getPostGet('id_matricula_sancion');
		
		$id_estado_matricula = $estadoMatriculaModelo->guardar_estado_matricula($request->getPostGet('id_matricula_sancion'),$fecha_desde,$session->get('idusuario'),4,$motivo);	
		//detalle_cambio_matricula
		$data = [				
			'IdMatricula' => $request->getPostGet('id_matricula_sancion'),
			'IdEstadoMatricula' => $id_estado_matricula,				
			'FechaRegistro' => date('Y-m-d H:i:s'),						
			'FechaDesde' => $fecha_desde,
			'FechaHasta' => $fecha_hasta,
			'IdTipoEstado' => 4,		//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado						
			'DetalleMotivo' => $motivo,				
		];		
		
		$datalleCambioMatriculaModelo->insert($data);
			
		$this->matriculaciones();
		
	}
	function guardar_nueva_suspencion(){
		
		//INSTANCIA DE MODELOS			
				
		$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);		
		$estadoMatriculaModelo = new Estado_matricula_modelo($db);
		$matriculacionesModelo = new Matriculaciones_modelo($db);
		
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		$fecha_desde = $request->getPostGet('fechaInicioSancion');
		$fecha_hasta = $request->getPostGet('fechaFinSancion');
		$motivo = $request->getPostGet('motivoSancion');
		$id_matricula = $request->getPostGet('id_matricula_sancion');
						
		//detalle_cambio_matricula
		$data = [				
			'IdMatricula' => $id_matricula,						
			'FechaRegistro' => date('Y-m-d H:i:s'),						
			'FechaDesde' => $fecha_desde,
			'IdTipoEstado' => 5,	//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado/7 = Eliminado							
			'DetalleMotivo' => $motivo,				
		];		
		
		$datalleCambioMatriculaModelo->insert($data);	
		
		//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado
		// estado_matriculas
		$data = [				
			'FechaInicio' => date('Y-m-d H:i:s'),													
			'IdTipoEstado' => 5,								
			'IdUsuario' => $session->get('idusuario'), 			
			'IdMatricula' => $request->getPostGet('id_matricula_suspender'),
			'Motivo' => 'Suspendido por colegio',
		];	
		$estadoMatriculaModelo->insert($data);
			
		$this->matriculaciones();
		
	}
	function guardar_editar_domicilio(){
		
		//INSTANCIA DE MODELOS			
				
			
		$request = \Config\Services::request();		
		$domiciliosModelos = new Domicilios_modelo($db);				
		
		$domicilio_completo = $domiciliosModelos->where('IdDomicilio', $request->getPostGet('id_domicilio_editar'))->findAll();
		
		$data = [				
			'IdMatriculacion' => $domicilio_completo[0]['IdMatriculacion'],						
			'Cuit' => $domicilio_completo[0]['Cuit'],						
			'IdProvincia' => $domicilio_completo[0]['IdProvincia'],						
			'IdPartido' => $domicilio_completo[0]['IdPartido'],						
			'IdLocalidad' => $domicilio_completo[0]['IdLocalidad'],						
			'Calle' => $domicilio_completo[0]['Calle'],						
			'Numero' => $domicilio_completo[0]['Numero'],						
			'Piso' => $domicilio_completo[0]['Piso'],						
			'Oficina' => $domicilio_completo[0]['Oficina'],						
			'Email' => $request->getPostGet('emailEstudioEditar'),						
			'Telefono' => $request->getPostGet('telefonoEstudioEditar'),						
			'HorariosAtencion' => $request->getPostGet('horarioDomicilioEditar'),
			'Estado' => $domicilio_completo[0]['Estado'],				
		];				
		$domiciliosModelos->insert($data);				
				
		$this->matriculas_abogado();
		
	}
	function guardar_nuevo_movimiento(){
		
		//INSTANCIA DE MODELOS			
				
		$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);		
		$estadoMatriculaModelo = new Estado_matricula_modelo($db);
		$matriculacionesModelo = new Matriculaciones_modelo($db);
		$domiciliosModelos = new Domicilios_modelo($db);
		$sorteosModelo = new Sorteos_modelo($db);
		$abogadosModelo = new Abogados_modelo($db);	
		$licenciasModelo = new Licencias_modelo($db);	
		
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		$fecha_desde = $request->getPostGet('fechaInicioMovimiento');
		$fecha_hasta = $request->getPostGet('fechaFinMovimiento');
		$tipo_movimiento = $request->getPostGet('tipo_movimiento');
		$motivo = $request->getPostGet('motivoMovimiento');
		$id_matricula = $request->getPostGet('id_matricula_nuevo_movimiento');
		$cuit = $request->getPostGet('cuit_nuevo_movimiento');
			
		$movimiento = $datalleCambioMatriculaModelo->where('FechaDesde' , $request->getPostGet('fechaInicioMovimiento'))
												   ->where('FechaHasta' , $request->getPostGet('fechaFinMovimiento'))
												   ->where('IdTipoEstado' , $request->getPostGet('tipo_movimiento'))
												   ->where('IdMatricula' , $request->getPostGet('id_matricula_nuevo_movimiento'))
												   ->findAll();

		if(empty($movimiento)){
			
			//4 = Suspendido por colegio/ 5 = Suspendido a pedido del abogado/ 6 = Licencia
			if(($tipo_movimiento == 4) or ($tipo_movimiento == 5) or ($tipo_movimiento == 6)){
				
				$id_estado_matricula = $estadoMatriculaModelo->guardar_estado_matricula($id_matricula,$fecha_desde,$session->get('idusuario'),$tipo_movimiento,$motivo);
				
				if(!empty($fecha_hasta)){
					
					//2 = aprobado por colegio
					$id_estado_matricula_alta = $estadoMatriculaModelo->guardar_estado_matricula($id_matricula,$fecha_hasta,$session->get('idusuario'),2,$motivo);
				
				}
				
				//guardamos en la tabla Licencias
				$data = [			
					'IdMatriculacion' => $id_matricula,						
					'IdTipoLicencia' => 2,// 1 = pedida por el abogado, 2 = cargada por colegio							
					'Cuit' => $cuit,						
					'FechaRegistro' => date('Y-m-d H:i:s'),
					'FechaInicio' => $fecha_desde,
					'FechaFin' => $fecha_hasta,			
					'DetalleMotivo' => $motivo,
					'Estado' => 1,
				];		
				
				$licenciasModelo->insert($data);
				
			}else if($tipo_movimiento == 7){//7 = eliminar
				
				$sorteos = $sorteosModelo->devolver_sorteos_x_matricula($id_matricula);
				
				if(empty($sorteos)){//si no tiene sorteos lo borra
					
					$abogado = $abogadosModelo->devolver_abogado_x_matricula($id_matricula);
				
					//$abogadosModelo->where('IdAbogado', $abogado[0]['IdAbogado'])->delete();
					$datalleCambioMatriculaModelo->where('IdMatricula', $id_matricula)->delete();
					$estadoMatriculaModelo->where('IdMatricula', $id_matricula)->delete();
					$domiciliosModelos->where('IdMatriculacion', $id_matricula)->delete();
					$matriculacionesModelo->where('IdMatriculacion', $id_matricula)->delete();
					
					$id_estado_matricula = $estadoMatriculaModelo->guardar_estado_matricula($id_matricula,$fecha_desde,$session->get('idusuario'),7,$motivo);
				}
			
			}else{
				
				$id_estado_matricula = $estadoMatriculaModelo->guardar_estado_matricula($id_matricula,$fecha_desde,$session->get('idusuario'),$tipo_movimiento,$motivo);
			
			}
			
			//detalle_cambio_matricula
			$data = [				
				'IdMatricula' => $id_matricula,
				'IdEstadoMatricula' => $id_estado_matricula,				
				'FechaRegistro' => date('Y-m-d H:i:s'),						
				'FechaDesde' => $fecha_desde,
				'FechaHasta' => $fecha_hasta,
				'IdTipoEstado' => $tipo_movimiento,			
				'DetalleMotivo' => $motivo,				//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado					
			];		
			
			$datalleCambioMatriculaModelo->insert($data);		

			if(!empty($fecha_hasta)){//guardamos otro por el estado a futuro
				//detalle_cambio_matricula
				$data = [				
					'IdMatricula' => $id_matricula,						
					'IdEstadoMatricula' => $id_estado_matricula_alta,						
					'FechaRegistro' => date('Y-m-d H:i:s'),						
					'FechaDesde' => $fecha_hasta,
					'FechaHasta' => '',
					'IdTipoEstado' => 2,			
					'DetalleMotivo' => $motivo,				//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado					
				];		
				
				$datalleCambioMatriculaModelo->insert($data);
				
			}
			
		}
		
		$this->matriculaciones();
		
	}
	function guarda_nuevo_abogado_json(){
		
		//INSTANCIA DE MODELOS
		$abogadosModelo = new Abogados_modelo($db);
		$matriculacionesModelo = new Matriculaciones_modelo($db);
		$usuariosModelo = new Usuario_modelo($db);		
		$request = \Config\Services::request();
		$navegation_detect = new navegacion();
		
		$origen = $request->getPostGet('origen'); //1 = Registro y 2 = Agreagar Domicilio desde Abogados		
		$abogado = $abogadosModelo->where('Cuit' , $request->getPostGet('cuitAbogado'))->findAll();
		
		
		if((empty($abogado)) and ($origen == 1)){// es un nuevo abogado y viene desde registro		
			//echo 'es un nuevo abogado y viene desde registro';
			$IdAbogado = $this->guardar_abogado();
			
			if($IdAbogado > 0){
				
				$navegation_detect->guardar_navegante_de_registro($IdAbogado,$_POST);
				
				$idMatriculacion = $this->guardo_nuevo_domicilio_abogado($IdAbogado);					
			
				$array_matricula = $this->arma_json_matricula_completa();
				
				//$usuario = $usuariosModelo->devolver_usuario_x_colegio($request->getPostGet('colegioAbogado'));
								
				//$this->enviar_email_registro_a_colegio($usuario[0]['Email']);
				$this->enviar_email_registro($request->getPostGet('emailEstudio'));
				
				echo '{"estado" : "1",'.$array_matricula.',"idMatriculacion" : '.$idMatriculacion.',"mensaje" : "Sus datos se registraron correctamente. Por favor, ingrese con su cuit como usuario y contraseña."}';// abogado se guardo con exito
			
			}else{
				$array_matricula = '';
				echo '{"estado" : "0",'.$array_matricula.',"idMatriculacion" : "0","mensaje" : "Usted ya está registrado. Por favor, ingrese con su Cuit y Contraseña al login Abogados (Botón Acceso Abogados)."}';// ya existe
				//echo '{"estado" : "0","idMatriculacion" : "0","mensaje" : "Usted ya esta registrado. Por favor, ingrese con su Cuit y Contraseña en el login Abogados (Botón Acceso Abogados)."}';// ya existe
			
			}
			
		}else if((!empty($abogado)) and ($origen == 1)){// existe abogado y viene desde registro			
					
			$navegation_detect->guardar_navegante_de_registro($abogado[0]['IdAbogado'],$_POST);
			
			//nos fijamos si tiene una maticulacion para ese colegio
			$matriculacion = $matriculacionesModelo->devolver_matriculacion_x_cuit_colegio($request->getPostGet('cuitAbogado'),$request->getPostGet('colegioAbogado'));		
			
			if(empty($matriculacion)){											//si no tiene una matricula para ese colegio 
				$idMatriculacion = $this->guardo_nuevo_domicilio_abogado($abogado[0]['IdAbogado']);				//guardamos la matricula y el domicilio
				
				$array_matricula = $this->arma_json_matricula_y_domicilio($abogado[0]['IdAbogado']);
				//$this->enviar_email_registro_a_colegio();
				echo '{"estado" : "1",'.$array_matricula.',"idMatriculacion" : '.$idMatriculacion.',"mensaje" : "La matrícula y el domicilio se guardaron con éxito."}';// abogado se guardo con exito
			}else{
				$this->guardo_domicilio_registro($abogado[0]['IdAbogado'],$matriculacion[0]['IdMatriculacion']);	//guardamos el domicilio para la matricula existente
				
				$array_matricula = $this->arma_json_domicilio($abogado[0]['IdAbogado'],$matriculacion[0]['IdMatriculacion']);
			
				echo  '{"estado" : "1",'.$array_matricula.',"idMatriculacion" : '.$matriculacion[0]['IdMatriculacion'].',"mensaje" : "Usted ya tiene una marticula en este departamento. Se guardo el nuevo domicilio para la matrícula."}';// abogado se guardo con exito
			
			}
			
			$this->enviar_email_registro($request->getPostGet('emailEstudio'));			
				
			
		}else if((!empty($abogado)) and ($origen == 2)){//viene desde agregar matricula ya logueado
			
			$navegation_detect->guardar_navegante_de_registro($abogado[0]['IdAbogado'],$_POST);
			
			$matriculacion = $matriculacionesModelo->devolver_matriculacion_x_cuit_colegio($request->getPostGet('cuitAbogado'),$request->getPostGet('colegioAbogado'));	
			
			if(!empty($matriculacion)){//si ya esta matriculado en ese colegio, lo mando a cargar domicilio
				//echo '{"estado" : "0","idMatriculacion" : '.$matriculacion[0]['IdMatriculacion'].',"mensaje" : "Usted ya tiene una matricula para este colegio profesional."}';// ya existe
				
				$array_matricula = '';
				echo '{"estado" : "0",'.$array_matricula.',"idMatriculacion" : '.$matriculacion[0]['IdMatriculacion'].',"mensaje" : "Usted ya tiene una matricula para este colegio profesional. Para agregar un nuevo domicilio puede hacerlo desde Mis Datos->Domicilios->Botón Agregar Domicilio"}';// ya existe
				
			}else{//si no esta matriculado, cargamos matricula y domicilio
				//$idMatriculacion = $this->guardo_nuevo_domicilio_abogado($abogado[0]['IdAbogado']);
				//echo '{"estado" : "1","idMatriculacion" : '.$idMatriculacion.',"mensaje" : "La matriculación se guardo con éxito."}';
				
				$idMatriculacion = $this->guardo_nuevo_domicilio_abogado($abogado[0]['IdAbogado']);
				$array_matricula = $this->arma_json_matricula_y_domicilio($abogado[0]['IdAbogado']);
				//$this->enviar_email_registro_a_colegio();
				$this->enviar_email_registro($request->getPostGet('emailEstudio'));
				echo '{"estado" : "1",'.$array_matricula.',"idMatriculacion" : '.$idMatriculacion.',"mensaje" : "La matriculación se guardo con éxito."}';
				
			}			
								
		}		
		
	}
	function enviar_email_registro_a_colegio($email_destino){
		
		$request = \Config\Services::request();												  
	
		$direccion_email = $email_destino;					
		$asunto = 'Nueva Inscripción a Sistema ACOM';					
		$mensaje = 'Estimado, le informamos que hay una nueva solicitud de inscripción al Sistema ACOM para su colegio profesional.'. "<br>". "<br>";		
	
		$email2 = new email();		
		$email2->enviar_mail($direccion_email,$asunto,$mensaje);
		
	}
	function test_enviar_email_claudio(){
			
		$mensaje = '';
		$direccion_email = 'ialonardiclaudio@gmail.com';					
		$asunto = 'Prueba mail';					
		$mensaje = 'Este es un texto de prueba. <br><br>';				
		$mensaje .= 'Datos del profesional inscripto.<br><br>';	
		$mensaje .= "Acceda al manual de usuario del Sistema ACOM disponible <a href='https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub' class='btn btn-link'>aquí</a>";
		
		$email2 = new email();
		
		$email2->enviar_mail($direccion_email,$asunto,$mensaje);
		
	}
	protected function enviar_email_registro($email_destino){
		
		//Enviamos Mail al abogado
		$direccion_email = $email_destino;					
		$asunto = 'Sistema ACOM';					
		$mensaje = 'Estimado, le informamos que su solicitud de inscripción al Sistema ACOM fue recepcionada por su colegio profesional.'. "<br>";		
		$mensaje .= 'Sera informado por este medio en cuanto el colegio apruebe su solicitud.'. "<br><br>";		
		$mensaje .= "Acceda al manual de usuario del Sistema ACOM disponible <a href='https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub' class='btn btn-link'>aquí</a>";
		
		$email = new email();
		
		$email->enviar_mail($direccion_email,$asunto,$mensaje);
		
	}
	protected function arma_json_matricula_completa(){
	
		$request = \Config\Services::request();
		$provinciaModelo = new Provincias_modelo($db);	
		$partidoModelo = new Partidos_modelo($db);	
		$localidadModelo = new Localidades_modelo($db);	
		$colegioModelo = new Departamentos_modelo($db);	

		$provincia = $provinciaModelo->where('IdProvincia', $request->getPostGet('provincia'))->findAll();
		$partido = $partidoModelo->where('Id', $request->getPostGet('partidoDomicilio'))->findAll();
		$localidad = $localidadModelo->where('IdLocalidad', $request->getPostGet('localidadDomicilio'))->findAll();
		$colegio = $colegioModelo->where('IdDepartamento', $request->getPostGet('colegioAbogado'))->findAll();		
							
		return '
				"Nombre" : "'.$request->getPostGet('nombreAbogado').'",
				"Apellido" : "'.$request->getPostGet('apellidoAbogado').'",
				"Tomo" : "'.$request->getPostGet('tomoAbogado').'",
				"Folio" : "'.$request->getPostGet('folioAbogado').'",
				"Matricula" : "'.$request->getPostGet('matriculaAbogado').'",
				"IdColegio" : "'.$colegio[0]['NombreDepartamento'].'",
				"Email" : "'.$request->getPostGet('emailEstudio').'",
				"Cuit" : "'.$request->getPostGet('cuitAbogado').'",			
				"Calle" : "'.$request->getPostGet('calleDomicilio').'",
				"Numero" : "'.$request->getPostGet('numeroDomicilio').'",
				"Piso" : "'.$request->getPostGet('pisoDomicilio').'",
				"Oficina" : "'.$request->getPostGet('oficinaDomicilio').'",
				"Localidad" : "'.$localidad[0]['NombreLocalidad'].'",
				"Partido" : "'.$partido[0]['NombrePartido'].'",
				"Provincia" : "'.$provincia[0]['NombreProvincia'].'",
				"Horarios" : "'.$request->getPostGet('horarioDomicilio').'",
				"Telefono" : "'.$request->getPostGet('telefonoEstudio').'"
							 
				';
		
	}	
	protected function arma_json_matricula_y_domicilio($IdAbogado){
	
		$request = \Config\Services::request();			
		$abogadosModelo = new Abogados_modelo($db);
		$provinciaModelo = new Provincias_modelo($db);	
		$partidoModelo = new Partidos_modelo($db);	
		$localidadModelo = new Localidades_modelo($db);	
		$colegioModelo = new Departamentos_modelo($db);	
		
		$abogado = $abogadosModelo->where('IdAbogado' , $IdAbogado)->findAll();
		$provincia = $provinciaModelo->where('IdProvincia', $request->getPostGet('provincia'))->findAll();
		$partido = $partidoModelo->where('Id', $request->getPostGet('partidoDomicilio'))->findAll();
		$localidad = $localidadModelo->where('IdLocalidad', $request->getPostGet('localidadDomicilio'))->findAll();
		$colegio = $colegioModelo->where('IdDepartamento', $request->getPostGet('colegioAbogado'))->findAll();
		
		return '
				"Nombre" : "'.$abogado[0]['Nombre'].'",
				"Apellido" : "'.$abogado[0]['Apellido'].'",
				"Cuit" : "'.$abogado[0]['Cuit'].'",
				
				"Tomo" : "'.$request->getPostGet('tomoAbogado').'",
				"Folio" : "'.$request->getPostGet('folioAbogado').'",
				"Matricula" : "'.$request->getPostGet('matriculaAbogado').'",
				"IdColegio" : "'.$colegio[0]['NombreDepartamento'].'",
				"Email" : "'.$request->getPostGet('emailEstudio').'",							
				"Calle" : "'.$request->getPostGet('calleDomicilio').'",
				"Numero" : "'.$request->getPostGet('numeroDomicilio').'",
				"Piso" : "'.$request->getPostGet('pisoDomicilio').'",
				"Oficina" : "'.$request->getPostGet('oficinaDomicilio').'",
				"Localidad" : "'.$localidad[0]['NombreLocalidad'].'",
				"Partido" : "'.$partido[0]['NombrePartido'].'",
				"Provincia" : "'.$provincia[0]['NombreProvincia'].'",
				"Horarios" : "'.$request->getPostGet('horarioDomicilio').'",
				"Telefono" : "'.$request->getPostGet('telefonoEstudio').'"
							 
				';
		
	}	
	protected function arma_json_domicilio($IdAbogado,$IdMatriculacion){
	
		$request = \Config\Services::request();			
		$abogadosModelo = new Abogados_modelo($db);
		$matriculacionesModelo = new Matriculaciones_modelo($db);
		$provinciaModelo = new Provincias_modelo($db);	
		$partidoModelo = new Partidos_modelo($db);	
		$localidadModelo = new Localidades_modelo($db);	
		$colegioModelo = new Departamentos_modelo($db);	
		
		$abogado = $abogadosModelo->where('IdAbogado' , $IdAbogado)->findAll();
		$matriculacion = $matriculacionesModelo->where('IdMatriculacion' , $IdMatriculacion)->findAll();
		$provincia = $provinciaModelo->where('IdProvincia', $request->getPostGet('provincia'))->findAll();
		$partido = $partidoModelo->where('Id', $request->getPostGet('partidoDomicilio'))->findAll();
		$localidad = $localidadModelo->where('IdLocalidad', $request->getPostGet('localidadDomicilio'))->findAll();
		$colegio = $colegioModelo->where('IdDepartamento', $request->getPostGet('colegioAbogado'))->findAll();		
		
		return '
				"Nombre" : "'.$abogado[0]['Nombre'].'",
				"Apellido" : "'.$abogado[0]['Apellido'].'",
				"Cuit" : "'.$abogado[0]['Cuit'].'",
				
				"Tomo" : "'.$matriculacion[0]['Tomo'].'",
				"Folio" : "'.$matriculacion[0]['Folio'].'",
				"Matricula" : "'.$matriculacion[0]['Matricula'].'",
				"IdColegio" : "'.$colegio[0]['NombreDepartamento'].'",
				
				"Email" : "'.$request->getPostGet('emailEstudio').'",						
				"Calle" : "'.$request->getPostGet('calleDomicilio').'",
				"Numero" : "'.$request->getPostGet('numeroDomicilio').'",
				"Piso" : "'.$request->getPostGet('pisoDomicilio').'",
				"Oficina" : "'.$request->getPostGet('oficinaDomicilio').'",
				"Localidad" : "'.$localidad[0]['NombreLocalidad'].'",
				"Partido" : "'.$partido[0]['NombrePartido'].'",
				"Provincia" : "'.$provincia[0]['NombreProvincia'].'",
				"Horarios" : "'.$request->getPostGet('horarioDomicilio').'",
				"Telefono" : "'.$request->getPostGet('telefonoEstudio').'"
							 
				'; 			  
		
	}
	protected function guardar_abogado(){
		
		//INSTANCIA DE MODELOS
		$abogadosModelo = new Abogados_modelo($db);		
		$request = \Config\Services::request();
	
		$usuario = $abogadosModelo->guardar_nuevo_abogado($request->getPostGet('nombreAbogado'),
														  $request->getPostGet('apellidoAbogado'),						
														  $request->getPostGet('emailEstudio'),						
														  $request->getPostGet('cuitAbogado'),
														  $request->getPostGet('colegioAbogado'),				
														  $request->getPostGet('celular'),
														  $request->getPostGet('telefono'));
						
		return $usuario;
		
	}
	protected function guardo_nuevo_domicilio_abogado($IdAbogado){
		
		//INSTANCIA DE MODELOS
		$abogadosModelo = new Abogados_modelo($db);
		$domiciliosModelos = new Domicilios_modelo($db);
		$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);		
		$estadoMatriculaModelo = new Estado_matricula_modelo($db);		
		$matriculacionesModelo = new Matriculaciones_modelo($db);		
		$request = \Config\Services::request();
		$session = \Config\Services::session();
									   
		$matriculacion = $matriculacionesModelo->guardar_nueva_matricula($IdAbogado,
																		 $request->getPostGet('cuitAbogado'),
																		 $request->getPostGet('colegioAbogado'),
																		 $request->getPostGet('matriculaAbogado'),
																		 $request->getPostGet('tomoAbogado'),							 									
																		 $request->getPostGet('folioAbogado'));
		
		$datalleCambioMatriculaModelo->guardar_detalle_cambio_matricula($matriculacion,'Inscripción');
		
				
		$estadoMatriculaModelo->guardar_estado_matricula($matriculacion,date('Y-m-d H:i:s'),$IdAbogado,1,'Inscripto');
		
		$domiciliosModelos->guardar_nuevo_domicilio($matriculacion,$request->getPostGet('cuitAbogado'),$request->getPostGet('provincia'),
													$request->getPostGet('partidoDomicilio'),$request->getPostGet('localidadDomicilio'),$request->getPostGet('calleDomicilio'),$request->getPostGet('numeroDomicilio'),
												    $request->getPostGet('pisoDomicilio'),$request->getPostGet('oficinaDomicilio'),$request->getPostGet('emailEstudio'),							 
												    $request->getPostGet('telefonoEstudio'),$request->getPostGet('horarioDomicilio'),0);
				  

		return $matriculacion;
	}
	protected function guardo_domicilio_registro($IdAbogado,$IdMatriculacion){
		
		//INSTANCIA DE MODELOS
		$abogadosModelo = new Abogados_modelo($db);
		$domiciliosModelos = new Domicilios_modelo($db);
		$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);		
		$estadoMatriculaModelo = new Estado_matricula_modelo($db);		
		$matriculacionesModelo = new Matriculaciones_modelo($db);		
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		//guardamos el domicilio
		$data = ['IdMatriculacion' => $IdMatriculacion,			  
				  'Cuit' => $request->getPostGet('cuitAbogado'),
				  'IdProvincia' => $request->getPostGet('provincia'),
				  'IdPartido' => $request->getPostGet('partidoDomicilio'),
				  'IdLocalidad' => $request->getPostGet('localidadDomicilio'),							 									
				  'Calle' => $request->getPostGet('calleDomicilio'),
				  'Numero' => $request->getPostGet('numeroDomicilio'),
				  'Piso' => $request->getPostGet('pisoDomicilio'),									
				  'Oficina' => $request->getPostGet('oficinaDomicilio'),
				  'Email' => $request->getPostGet('emailEstudio'),							 
				  'Telefono' => $request->getPostGet('telefonoEstudio'),								
				  'HorariosAtencion' => $request->getPostGet('horarioDomicilio'),															 
				  'Estado' => 0,															 
		];
		$domiciliosModelos->insert($data);	
		
		//guardamos el detalle_cambio_matricula
		//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado	
		$data = [				
			'IdMatricula' => $IdMatriculacion,
			'IdTipoEstado' => 0,			
			'FechaRegistro' => date('Y-m-d H:i:s'),						
			'FechaDesde' => date('Y-m-d H:i:s'),
			'DetalleMotivo' => 'Se agrego un nuevo domicilio desde el registro',
																
		];		
		
		$datalleCambioMatriculaModelo->insert($data);
					
	}	
	protected function confirmar_permiso($PERMISOS,$perfil_usuario){
		
		$permiso_ok = false;
		
		$respuesta = array_search($perfil_usuario, $PERMISOS);	//Busca en el Array si existe el permiso (0 == NO ENCONTRO PERMISO)
	
		if($respuesta > 0){
			$permiso_ok = true;
		}
		
		return $permiso_ok ;
		
	}
	function imprimir_comprobante_inscripcion(){
		
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();
		
		$domicilio =  $request->getPostGet('calle_imprimir').' - '.$request->getPostGet('numero_imprimir');
		if(!empty($request->getPostGet('piso_imprimir'))){
			$domicilio .= ' Piso: '.$request->getPostGet('piso_imprimir');
		}
		if(!empty($request->getPostGet('oficina_imprimir'))){
			$domicilio .=  ' Oficina: '.$request->getPostGet('oficina_imprimir');
		}
		
		$data = [
				'Apellidoynombre' => $request->getPostGet('apellido_imprimir').', '.$request->getPostGet('nombre_imprimir'),										
				'ApellidoynombreFirma' => strtoupper($request->getPostGet('apellido_imprimir').', '.$request->getPostGet('nombre_imprimir')),										
				'Colegio' => $request->getPostGet('colegio_imprimir'),										
				'Domicilio' => $domicilio,										
				'Email' => $request->getPostGet('email_imprimir'),						
				'Cuit' => $request->getPostGet('cuit_imprimir'),									
				'Celular' => $request->getPostGet('celular_imprimir'),
				'Telefono' => $request->getPostGet('telefono_imprimir'),
				'Tomo' => $request->getPostGet('tomo_imprimir'),							 									
				'Folio' => $request->getPostGet('folio_imprimir'),				
				'Matricula' => $request->getPostGet('matricula_imprimir'),
				'Localidadypartido' => $request->getPostGet('localidad_imprimir').', '.$request->getPostGet('partido_imprimir'),																								 
				'Provincia' => $request->getPostGet('provincia_imprimir'),
				'HorariosAtencion' => $request->getPostGet('horarios_imprimir'),	
				'Telefono' => $request->getPostGet('telefono_imprimir'),																			 
		];
		
		$pdf = new pdf();
		$pdf->imprimir($data);		
		
	}
	function imprimir_comprobante_inscripcion_viejo_domicilio(){
		
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();		
		$matriculacionesModelo = new Matriculaciones_modelo($db);	
		$domicilioModelo = new Domicilios_modelo($db);	
		$provinciaModelo = new Provincias_modelo($db);	
		$partidoModelo = new Partidos_modelo($db);	
		$localidadModelo = new Localidades_modelo($db);	
		$colegioModelo = new Departamentos_modelo($db);	
		$municipioModelo = new Municipios_modelo($db);			
	
		$id_inscripcion = $request->getPostGet('id_matriculacion_domicilio_viejo');	
		$id_domicilio = $request->getPostGet('id_domicilio_viejo');			
		
		$matriculacion = $matriculacionesModelo->devolver_matriculacion_imprimir_viejo($id_inscripcion);			
		$domicilio_viejo = $domicilioModelo->where('IdDomicilio', $id_domicilio)->findAll();		
		$provincia = $provinciaModelo->where('IdProvincia', $matriculacion[0]['IdProvincia'])->findAll();
		$partido = $partidoModelo->where('Id', intval($matriculacion[0]['IdPartido']))->findAll();		
		$localidad = $localidadModelo->where('IdLocalidad', $matriculacion[0]['IdLocalidad'])->findAll();
		$colegio = $colegioModelo->where('IdDepartamento', $matriculacion[0]['IdColegio'])->findAll();
		
		$domicilio = '';
		$domicilio =  $domicilio_viejo[0]['Calle'].' - '.$domicilio_viejo[0]['Numero'];
		if(!empty($domicilio_viejo[0]['Piso'])){
			$domicilio .= ' Piso: '.$domicilio_viejo[0]['Piso'];
		}
		if(!empty($domicilio_viejo[0]['Oficina'])){
			$domicilio .=  ' Oficina: '.$domicilio_viejo[0]['Oficina'];
		}
				
		$data = [
				'Apellidoynombre' => $matriculacion[0]['Apellido'].', '.$matriculacion[0]['Nombre'],										
				'ApellidoynombreFirma' => strtoupper($matriculacion[0]['Apellido'].', '.$matriculacion[0]['Nombre']),										
				'Colegio' => $colegio[0]['NombreDepartamento'],										
				'Domicilio' => $domicilio,										
				'Email' => $domicilio_viejo[0]['Email'],						
				'Cuit' => $matriculacion[0]['Cuit'],									
				'Celular' => $matriculacion[0]['Celular'],
				'Telefono' => $domicilio_viejo[0]['Telefono'],
				'Tomo' => $matriculacion[0]['Tomo'],							 									
				'Folio' => $matriculacion[0]['Folio'],				
				'Matricula' => $matriculacion[0]['Matricula'],
				'Localidadypartido' => $localidad[0]['NombreLocalidad'].', '.$partido[0]['NombrePartido'],																								 
				'Provincia' => $provincia[0]['NombreProvincia'],
				'HorariosAtencion' => $domicilio_viejo[0]['HorariosAtencion'],																						 
		];
		
		$pdf = new pdf();
		$pdf->imprimir($data);	
	}
	function reimprimir_comprobante_inscripcion($id_comprobante = null){
		
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();		
		$matriculacionesModelo = new Matriculaciones_modelo($db);	
		$provinciaModelo = new Provincias_modelo($db);	
		$partidoModelo = new Partidos_modelo($db);	
		$localidadModelo = new Localidades_modelo($db);	
		$colegioModelo = new Departamentos_modelo($db);	
		$municipioModelo = new Municipios_modelo($db);	
		
		if($id_comprobante == null){
			$id_inscripcion = $request->getPostGet('id_matriculacion');	
		}else{
			$id_inscripcion = $id_comprobante;	
		}
		
		$matriculacion = $matriculacionesModelo->devolver_matriculacion_inscripto($id_inscripcion);		
		$provincia = $provinciaModelo->where('IdProvincia', $matriculacion[0]['IdProvincia'])->findAll();
		$partido = $partidoModelo->where('Id', intval($matriculacion[0]['IdPartido']))->findAll();
		//$municipio = $municipioModelo->where('Id', intval($matriculacion[0]['IdMunicipio']))->findAll();
		$localidad = $localidadModelo->where('IdLocalidad', $matriculacion[0]['IdLocalidad'])->findAll();
		$colegio = $colegioModelo->where('IdDepartamento', $matriculacion[0]['IdColegio'])->findAll();
				
		$domicilio =  $matriculacion[0]['Calle'].' - '.$matriculacion[0]['Numero'];
		if(!empty($matriculacion[0]['Piso'])){
			$domicilio .= ' Piso: '.$matriculacion[0]['Piso'];
		}
		if(!empty($matriculacion[0]['Oficina'])){
			$domicilio .=  ' Oficina: '.$matriculacion[0]['Oficina'];
		}
				
		$data = [
				'Apellidoynombre' => $matriculacion[0]['Apellido'].', '.$matriculacion[0]['Nombre'],										
				'ApellidoynombreFirma' => strtoupper($matriculacion[0]['Apellido'].', '.$matriculacion[0]['Nombre']),										
				'Colegio' => $colegio[0]['NombreDepartamento'],										
				'Domicilio' => $domicilio,										
				'Email' => $matriculacion[0]['Email'],						
				'Cuit' => $matriculacion[0]['Cuit'],									
				'Celular' => $matriculacion[0]['Celular'],
				'Telefono' => $matriculacion[0]['Telefono'],
				'Tomo' => $matriculacion[0]['Tomo'],							 									
				'Folio' => $matriculacion[0]['Folio'],				
				'Matricula' => $matriculacion[0]['Matricula'],
				'Localidadypartido' => $localidad[0]['NombreLocalidad'].', '.$partido[0]['NombrePartido'],																								 
				'Provincia' => $provincia[0]['NombreProvincia'],
				'HorariosAtencion' => $matriculacion[0]['HorariosAtencion'],																						 
		];
		
		$pdf = new pdf();
		$pdf->imprimir($data);	
	}
	function ver_comprobante_sorteo($id_consulta = null){
		
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();		
		$consultasModelo = new Consultas_modelo($db);	
		
		$matriculacionesModelo = new Matriculaciones_modelo($db);	
		$provinciaModelo = new Provincias_modelo($db);	
		$partidoModelo = new Partidos_modelo($db);	
		$localidadModelo = new Municipios_modelo($db);	
		$colegioModelo = new Departamentos_modelo($db);	
		
		if($id_consulta == null){
			$id_consulta = $request->getPostGet('id_consulta');	
		}else{
			$id_consulta = $id_comprobante;	
		}
		
		$consulta = $consultasModelo->devolver_consulta($id_consulta);		
		
		$domicilio =  $consulta[0]['calle_estudio'].' - '.$consulta[0]['numero_estudio'];
		if(!empty($consulta[0]['piso_estudio'])){
			$domicilio .= ' Piso: '.$consulta[0]['piso_estudio'];
		}
		if(!empty($consulta[0]['oficina_estudio'])){
			$domicilio .=  ' Oficina: '.$consulta[0]['oficina_estudio'];
		}
		
		$datos_matricula = '';
		
		if(empty($consulta[0]['Matricula'])){
			
			$datos_matricula =	'<strong>Tomo: </strong>'.$consulta[0]['Tomo']. '<strong> Folio: </strong>'  .$consulta[0]['Folio'].' '.$consulta[0]['Acronimo'];
			
		}else{
			
			$datos_matricula =	'<strong>Matrícula:</strong>'.' '.$consulta[0]['Matricula'].' '.$consulta[0]['nombre_colegio'];
			
		}
		
		$data = [
				'NombreyApellidoAbogado' => $consulta[0]['apellido_abogado'].', '.$consulta[0]['nombre_abogado'],												
				'Colegio' => $consulta[0]['nombre_colegio'],										
				'Domicilio' => $domicilio,										
				'EmailEstudio' => $consulta[0]['email_estudio'],						
				'HorariosAtencion' => $consulta[0]['HorariosAtencion'],				
				'TelefonoEstudio' => $consulta[0]['telefono_estudio'],
				'Tomo' => $consulta[0]['Tomo'],							 									
				'Folio' => $consulta[0]['Folio'],
				'Matricula' => $consulta[0]['Matricula'],
				'Datos_matricula' => $datos_matricula,
				'NombreyApellidoConsultante' => $consulta[0]['Apellido'].', '.$consulta[0]['Nombre'],
				'Cuit' => $consulta[0]['Cuit'],																								 
				'Telefono' => $consulta[0]['Telefono'],
				'Celular' => $consulta[0]['Celular'],																						 
				'Email' => $consulta[0]['Email'],																						 
				'FechaSorteo' => date('d-m-Y H:i:s',strtotime($consulta[0]['FechaSorteo'])),
				'IdConsulta' => $consulta[0]['IdConsulta'],					
		];		
		
		echo view('formulario_sorteo_sin_qr',$data);		
	}
	function reimprimir_comprobante_sorteo($id_consulta = null){
		
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();		
		$consultasModelo = new Consultas_modelo($db);	
		
		$matriculacionesModelo = new Matriculaciones_modelo($db);	
		$provinciaModelo = new Provincias_modelo($db);	
		$partidoModelo = new Partidos_modelo($db);	
		$localidadModelo = new Municipios_modelo($db);	
		$colegioModelo = new Departamentos_modelo($db);	
		
		if($id_consulta == null){
			$id_consulta = $request->getPostGet('id_consulta');	
		}else{
			$id_consulta = $id_comprobante;	
		}
		
		$consulta = $consultasModelo->devolver_consulta($id_consulta);		
		
		$domicilio =  $consulta[0]['calle_estudio'].' - '.$consulta[0]['numero_estudio'];
		if(!empty($consulta[0]['piso_estudio'])){
			$domicilio .= ' Piso: '.$consulta[0]['piso_estudio'];
		}
		if(!empty($consulta[0]['oficina_estudio'])){
			$domicilio .=  ' Oficina: '.$consulta[0]['oficina_estudio'];
		}
		
		$datos_matricula = '';
		
		if(empty($consulta[0]['Matricula'])){
			
			$datos_matricula =	'<strong>Tomo: </strong>'. $consulta[0]['Tomo']. '<strong> Folio: </strong>'  .$consulta[0]['Folio'].' '.$consulta[0]['Acronimo'];
			
		}else{
			
			$datos_matricula =	'<strong>Matrícula:</strong>'.' '.$consulta[0]['Matricula'].' '.$consulta[0]['nombre_colegio'];
			
		}
		
		$data = [
				'NombreyApellidoAbogado' => $consulta[0]['apellido_abogado'].', '.$consulta[0]['nombre_abogado'],												
				'Colegio' => $consulta[0]['nombre_colegio'],										
				'Domicilio' => $domicilio,										
				'Localidad' => $consulta[0]['NombreLocalidad'],						
				'EmailEstudio' => $consulta[0]['email_estudio'],						
				'HorariosAtencion' => $consulta[0]['HorariosAtencion'],				
				'TelefonoEstudio' => $consulta[0]['telefono_estudio'],
				'Tomo' => $consulta[0]['Tomo'],							 									
				'Folio' => $consulta[0]['Folio'],
				'Matricula' => $consulta[0]['Matricula'],
				'Datos_matricula' => $datos_matricula,
				'NombreyApellidoConsultante' => $consulta[0]['Apellido'].', '.$consulta[0]['Nombre'],
				'Cuit' => $consulta[0]['Cuit'],																								 
				'Telefono' => $consulta[0]['Telefono'],
				'Celular' => $consulta[0]['Celular'],																						 
				'Email' => $consulta[0]['Email'],																						 
				'FechaSorteo' => date('d-m-Y H:i:s',strtotime($consulta[0]['FechaSorteo'])),
				'IdConsulta' => $consulta[0]['IdConsulta'],					
		];
		
		$pdf = new pdf_sorteo();
		$pdf->imprimir($data);	
	}
	function aprobar_matricula_json(){	
						
		//INSTANCIA DE MODELOS
		$request = \Config\Services::request();
		$session = \Config\Services::session();	
		$domiciliosModelos = new Domicilios_modelo($db);
		$matriculacionesModelo = new Matriculaciones_modelo($db);
		$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);		
		$estadoMatriculaModelo = new Estado_matricula_modelo($db);				
		$abogadosModelo = new Abogados_modelo($db);													
		
		//detalle_cambio_matricula
		//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado	
		$data = [				
			'IdMatricula' => $request->getPostGet('id_matriculacion'),
			'IdTipoEstado' => 2,
			'FechaRegistro' => date('Y-m-d H:i:s'),						
			'FechaDesde' => date('Y-m-d H:i:s'),
			'DetalleMotivo' => 'Matricula aprobada por colegio',																		
		];
		$datalleCambioMatriculaModelo->insert($data);
		
		// estado_matriculas
		//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado				
		$data = [				
			'FechaInicio' => date('Y-m-d H:i:s'),													
			'IdTipoEstado' => 2,					
			'IdUsuario' => $session->get('idusuario'), 			
			'IdMatricula' => $request->getPostGet('id_matriculacion'), 			
			'Motivo' => 'Aprobado', 			
		];	
		$estadoMatriculaModelo->insert($data);		
		
		//Aprobamos el domicilio tambien
		
		$domicilio = $domiciliosModelos->devolver_domicilios_x_matriculacion($request->getPostGet('id_matriculacion'));			
		//var_dump($request->getPostGet('id_matriculacion'));				
		//var_dump($domicilio);				
		$data = ['Estado' => 1];
				
		$domiciliosModelos->update($domicilio[0]['IdDomicilio'],$data);
		
		$matriculacion = $matriculacionesModelo->where('IdMatriculacion' ,$request->getPostGet('id_matriculacion'))->findAll();
		
		//habilitamos al abogado para que pueda entrar, si ya tenia otra matricula, solo pisa el campo
		$data = ['Estado' => 1]; //activo				
		$abogadosModelo->update($matriculacion[0]['IdAbogado'],$data);
		
		//Enviamos Mail al abogado
		$direccion_email = $domicilio[0]['Email'];					
		$asunto = 'Sistema ACOM';					
		$mensaje = 'Estimado, le informamos que su solicitud de inscripción al Sistema ACOM fue APROBADA por su colegio profesional.'. "<br>";
		$mensaje .= 'Lo invitamos a ingresar al sistema con su cuit como contraseña.'. "<br><br>";
		$mensaje .= "Acceda al manual de usuario del Sistema ACOM disponible <a href='https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub' class='btn btn-link'>aquí</a>";
		
		$email = new email();
		
		$email->enviar_mail($direccion_email,$asunto,$mensaje);
	
		echo '1';				

	}
	function desaprobar_matriculacion(){	
		try{
			$permisos = array(1=>2,2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);		
				$estadoMatriculaModelo = new Estado_matricula_modelo($db);
				$domiciliosModelos = new Domicilios_modelo($db);				
								
				//$matriculacion = $matriculacionesModelo->where('IdMatriculacion' ,$request->getPostGet('id_matricula_rechazar'))->findAll();
				$matriculacion = $matriculacionesModelo->devolver_matriculacion($request->getPostGet('id_matricula_rechazar'));
				
				//guardamos el detalle_cambio_matricula
				//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado	
				$data = [				
					'IdMatricula' => $request->getPostGet('id_matricula_rechazar'),
					'IdTipoEstado' => 3,			
					'FechaRegistro' => date('Y-m-d H:i:s'),						
					'FechaDesde' => date('Y-m-d H:i:s'),
					'DetalleMotivo' => 'Desaprobado por colegio profesional',																		
				];		
				
				$datalleCambioMatriculaModelo->insert($data);			
			
				// estado_matriculas
				//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado/7 = Eliminado	
						
				$data = [				
					'FechaInicio' => date('Y-m-d H:i:s'),													
					'IdTipoEstado' => 3,					
					'Motivo' => $request->getPostGet('motivo'),					
					'IdUsuario' => $session->get('idusuario'), 			
					'IdMatricula' => $request->getPostGet('id_matricula_rechazar'),
					'Motivo' => 'Desaprobado',					
				];	
				$estadoMatriculaModelo->insert($data);
		
				//$estadoMatriculaModelo->desaprobar_matricula($request->getPostGet('id_matricula_rechazar'),$session->get('idusuario'),$request->getPostGet('motivo'));
				$domiciliosModelos->desaprobar_domicilio($request->getPostGet('id_matricula_rechazar'));
				/*
				//Enviamos Mail al abogado
				$direccion_email = $domicilio[0]['Email'];					
				$asunto = 'Sistema ACOM';					
				$mensaje = 'Estimado, le informamos que su solicitud de inscripción fue DESAPROBADA'. "<br>";
				$mensaje .= 'Atentamente. Soporte Sistema ACOM desarrollo@colproba.org.ar';
				
				$email = new email();
				
				$email->enviar_mail($direccion_email,$asunto,$mensaje);
				*/
				$this->nuevos_inscriptos();
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}
	function verifica_posee_sorteos_json(){
		
		//INSTANCIA DE MODELOS			
		$sorteosModelo = new Sorteos_modelo($db);		
		$request = \Config\Services::request();
		
		$sorteos = $sorteosModelo->devolver_sorteos_x_matricula($request->getPostGet('matriculacion'));
	
		if(empty($sorteos)){
			
			echo '1';		
			
		}else{
			
			echo '0';
			
		}			
	}
	function eliminar_matriculacion(){	
		try{
			$permisos = array(1=>2,2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();
				$matriculacionesModelo = new Matriculaciones_modelo($db);
				$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);		
				$estadoMatriculaModelo = new Estado_matricula_modelo($db);
				$domiciliosModelos = new Domicilios_modelo($db);
				$sorteosModelo = new Sorteos_modelo($db);
				$abogadosModelo = new Abogados_modelo($db);				
							
				$domicilio = $domiciliosModelos->devolver_ultimo_domicilio($request->getPostGet('id_matricula_eliminar'));
				$sorteos = $sorteosModelo->devolver_sorteos_x_matricula($request->getPostGet('id_matricula_eliminar'));
				
				if(empty($sorteos)){
					
					$abogado = $abogadosModelo->devolver_abogado_x_matricula($request->getPostGet('id_matricula_eliminar'));
				
					//$abogadosModelo->where('IdAbogado', $abogado[0]['IdAbogado'])->delete();
					$datalleCambioMatriculaModelo->where('IdMatricula', $request->getPostGet('id_matricula_eliminar'))->delete();
					$estadoMatriculaModelo->where('IdMatricula', $request->getPostGet('id_matricula_eliminar'))->delete();
					$domiciliosModelos->where('IdMatriculacion', $request->getPostGet('id_matricula_eliminar'))->delete();
					$matriculacionesModelo->where('IdMatriculacion', $request->getPostGet('id_matricula_eliminar'))->delete();
										
					// estado_matriculas
					//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado/7 = Eliminado	
				
					$data = [				
						'FechaInicio' => date('Y-m-d H:i:s'),													
						'IdTipoEstado' => 7,					
						'Motivo' => '',					
						'IdUsuario' => $session->get('idusuario'), 			
						'IdMatricula' => $request->getPostGet('id_matricula_eliminar'), 
						'Motivo' => 'Eliminado',						
					];	
					$estadoMatriculaModelo->insert($data);
				
				}
				
				//Enviamos Mail al abogado
				$direccion_email = $domicilio[0]['Email'];					
				$asunto = 'Sistema ACOM';					
				$mensaje = 'Estimado, le informamos que su solicitud de inscripción al Sistema ACOM fue RECHAZADA.'. "<br>";
				$mensaje .= 'Por favor, comuníquese con su colegio profesional para conocer los motivos.'. "<br>";
				//$mensaje .= "Acceda al manual de usuario del Sistema ACOM disponible <a href='https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub' class='btn btn-link'>aquí</a>";
				
				$email = new email();
				
				$email->enviar_mail($direccion_email,$asunto,$mensaje);
				
				if($request->getPostGet('origen') == 1){		//1 = viene de matriculaciones
					$this->matriculaciones();
				}else{														//2 = viene de nuevos inscriptos
					$this->nuevos_inscriptos();
				}
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}
	function desaprobar_domicilio(){	
		try{
			$permisos = array(1=>2,2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();				
				
				$domiciliosModelos = new Domicilios_modelo($db);									
				
				$domicilio = $domiciliosModelos->where("IdDomicilio",$request->getPostGet('id_domicilio_desaprobar'))->findAll();
				
				$domiciliosModelos->desaprobar_domicilios($request->getPostGet('id_domicilio_desaprobar'),$session->get('idusuario'));
				
				//Enviamos Mail al abogado
				$direccion_email = $domicilio[0]['Email'];					
				$asunto = 'Sistema ACOM';					
				$mensaje = 'Estimado, le informamos que su solicitud de registro de un nuevo domicilio al Sistema ACOM fue RECHAZADA.'. "<br>";
				$mensaje .= 'Por favor, comuníquese con su colegio profesional para conocer los motivos.'. "<br>";
				//$mensaje .= "Acceda al manual de usuario del Sistema ACOM disponible <a href='https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub' class='btn btn-link'>aquí</a>";
				
				$email = new email();
				
				$email->enviar_mail($direccion_email,$asunto,$mensaje);
				
				$this->domicilios_por_aprobar();
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}	
	function aprobar_domicilio(){	
		try{
			$permisos = array(1=>2,2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();				
				
				$domiciliosModelos = new Domicilios_modelo($db);									
			
				$domiciliosModelos->aprobar_domicilios($request->getPostGet('id_domicilio_aprobar'),$session->get('idusuario'));
				
				$this->domicilios_por_aprobar();
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}
	function habilitar_matriculacion(){	
		try{
			$permisos = array(1=>2,2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();
				$estadoMatriculaModelo = new Estado_matricula_modelo($db);
				$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);
				
				$id_estado_matricula = $estadoMatriculaModelo->guardar_estado_matricula($request->getPostGet('id_matricula_habilitar'),date('Y-m-d H:i:s'),$session->get('idusuario'),2,'');	
				//detalle_cambio_matricula
				$data = [				
					'IdMatricula' => $request->getPostGet('id_matricula_habilitar'),
					'IdEstadoMatricula' => $id_estado_matricula,				
					'FechaRegistro' => date('Y-m-d H:i:s'),						
					'FechaDesde' => date('Y-m-d H:i:s'),
					'FechaHasta' => '',
					'IdTipoEstado' => 2,		//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado						
					'DetalleMotivo' => '',				
				];		
				
				$datalleCambioMatriculaModelo->insert($data);
				
				//$matriculacionesModelo = new Matriculaciones_modelo($db);				
				//$matriculacionesModelo->cambiar_estado_matricula($request->getPostGet('estado_actual_habilitar'),$session->get('id_matricula_habilitar'));
				
				$this->matriculaciones();
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}
	function deshabilitar_matriculacion(){	
		try{
			$permisos = array(1=>2,2=>6);				
			$session = \Config\Services::session();	
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método	
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();
				$estadoMatriculaModelo = new Estado_matricula_modelo($db);
				$datalleCambioMatriculaModelo = new Detalle_Cambio_Matricula_modelo($db);
				
				$id_estado_matricula = $estadoMatriculaModelo->guardar_estado_matricula($request->getPostGet('id_matricula_deshabilitar'),date('Y-m-d H:i:s'),$session->get('idusuario'),4,'');	
				//detalle_cambio_matricula
				$data = [				
					'IdMatricula' => $request->getPostGet('id_matricula_deshabilitar'),
					'IdEstadoMatricula' => $id_estado_matricula,				
					'FechaRegistro' => date('Y-m-d H:i:s'),						
					'FechaDesde' => date('Y-m-d H:i:s'),
					'FechaHasta' => '',
					'IdTipoEstado' => 4,		//1 = Inscripto/2 = Aprobado por Colegio/3 = Desaprobado por Colegio/4 = Suspendido por Colegio/5 = Suspendido por pedido Abogado/6 = Licencia/7 = Eliminado						
					'DetalleMotivo' => '',				
				];		
				
				$datalleCambioMatriculaModelo->insert($data);
				
				//$matriculacionesModelo = new Matriculaciones_modelo($db);				
				//$matriculacionesModelo->cambiar_estado_matricula($request->getPostGet('estado_actual_habilitar'),$session->get('id_matricula_habilitar'));
				
				$this->matriculaciones();
																											
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				$this->load->view('login_vista_administracion',$data);
			}				
		}catch ( Customexception $e ) {
			$e->show_error_vista('Varios','');
		}
	}
	function reporte_abogados_activos_por_provincias(){
			
		//INSTANCIA DE MODELOS
		$session = \Config\Services::session();
		
		$abogadosModelo = new Abogados_modelo($db);
		
		$total_abogados = 0;
		$abogados_por_provincia = $abogadosModelo->devolver_abogados_por_provincias();
		
		foreach($abogados_por_provincia as $provincia){
			$total_abogados = $total_abogados + $provincia['APROBADOS'];
		}
		
		$data = array('reportes' => $abogadosModelo->devolver_abogados_por_provincias(),
					  'total_abogados' => $total_abogados,
		);
	
		echo view('encabezado');
		echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
		echo view('reporte_abogados_activos_por_provincias',$data);
			
	}
	function reporte_abogados_inscriptos_por_colegio(){
			
		//INSTANCIA DE MODELOS
		$session = \Config\Services::session();
		$matriculacionesModelo = new Matriculaciones_modelo($db);
		$abogadosModelo = new Abogados_modelo($db);
		
		$total_abogados_inscriptos = 0;
		$total_abogados_aprobados = 0;
		$total_abogados = 0;
		
		$abogados_por_colegio = $abogadosModelo->devolver_vista_abogados_por_colegio();
		
		foreach($abogados_por_colegio as $colegio){
			$total_abogados_inscriptos = $total_abogados_inscriptos + $colegio['REGISTRADOS'];
			$total_abogados_aprobados = $total_abogados_aprobados + $colegio['APROBADOS'];
			$total_abogados = $total_abogados + ($colegio['REGISTRADOS'] - $colegio['APROBADOS']);
		}
		
		$data = array('reportes' => $abogadosModelo->devolver_vista_abogados_por_colegio(),
					  'total_abogados_inscriptos' => $total_abogados_inscriptos,
					  'total_abogados_aprobados' => $total_abogados_aprobados,
					  'total_abogados' => $total_abogados,
		);
	
		echo view('encabezado');
		echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
		echo view('reporte_abogados_inscriptos_por_colegio',$data);
			
	}	
	function reporte_abogados_inscriptos_por_partido(){
			
		//INSTANCIA DE MODELOS-
		$session = \Config\Services::session();
		$matriculacionesModelo = new Matriculaciones_modelo($db);
		$abogadosModelo = new Abogados_modelo($db);
		
		$total_abogados_inscriptos = 0;
		$total_abogados_aprobados = 0;
		$total_abogados = 0;
		
		$abogados_por_colegio = $abogadosModelo->devolver_vista_abogados_por_partido();
		
		foreach($abogados_por_colegio as $colegio){
			$total_abogados_inscriptos = $total_abogados_inscriptos + $colegio['REGISTRADOS'];
			$total_abogados_aprobados = $total_abogados_aprobados + $colegio['APROBADOS'];
			$total_abogados = $total_abogados + ($colegio['REGISTRADOS'] - $colegio['APROBADOS']);
		}
		
		$data = array('reportes' => $abogadosModelo->devolver_vista_abogados_por_partido(),
					  'total_abogados_inscriptos' => $total_abogados_inscriptos,
					  'total_abogados_aprobados' => $total_abogados_aprobados,
					  'total_abogados' => $total_abogados,
		);
		
		echo view('encabezado');
		echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
		echo view('reporte_abogados_inscriptos_por_partido',$data);
			
	}
	function reporte_sorteos_por_provincias(){
			
		//INSTANCIA DE MODELOS-
		$session = \Config\Services::session();
		
		$consultasModelo = new Consultas_modelo($db);
		$matriculacionesModelo = new Matriculaciones_modelo($db);		
		
		$total_sorteos = 0;
		
		$consultas_por_provincias = $consultasModelo->devolver_sorteos_por_provincias();
		
		foreach($consultas_por_provincias as $consultas){
			
			$total_sorteos = $total_sorteos + $consultas['cantidad_sorteos'];
						
		}
		
		$data = array('reportes' => $consultasModelo->devolver_sorteos_por_provincias(),
					  'buenos_aires' => $consultasModelo->devolver_sorteos_por_partidos(1),					  
					  'catamarca' => $consultasModelo->devolver_sorteos_por_partidos(2),					  
					  'chaco' => $consultasModelo->devolver_sorteos_por_partidos(3),					  
					  'chubut' => $consultasModelo->devolver_sorteos_por_partidos(4),					  
					  'ciudad_de_buenos_aires' => $consultasModelo->devolver_sorteos_por_partidos(5),					  
					  'cordoba' => $consultasModelo->devolver_sorteos_por_partidos(6),					  
					  'corrientes' => $consultasModelo->devolver_sorteos_por_partidos(7),					  
					  'entre_rios' => $consultasModelo->devolver_sorteos_por_partidos(8),					  
					  'formosa' => $consultasModelo->devolver_sorteos_por_partidos(9),					  
					  'jujuy' => $consultasModelo->devolver_sorteos_por_partidos(10),					  
					  'la_pampa' => $consultasModelo->devolver_sorteos_por_partidos(11),					  
					  'la_rioja' => $consultasModelo->devolver_sorteos_por_partidos(12),					  
					  'mendoza' => $consultasModelo->devolver_sorteos_por_partidos(13),					  
					  'misiones' => $consultasModelo->devolver_sorteos_por_partidos(14),					  
					  'neuquen' => $consultasModelo->devolver_sorteos_por_partidos(15),					  
					  'rio_negro' => $consultasModelo->devolver_sorteos_por_partidos(16),					  
					  'salta' => $consultasModelo->devolver_sorteos_por_partidos(17),					  
					  'san_juan' => $consultasModelo->devolver_sorteos_por_partidos(18),					  
					  'san_luis' => $consultasModelo->devolver_sorteos_por_partidos(19),					  
					  'santa_cruz' => $consultasModelo->devolver_sorteos_por_partidos(20),					  
					  'santa_fe' => $consultasModelo->devolver_sorteos_por_partidos(21),					  
					  'santiago_del_Estero' => $consultasModelo->devolver_sorteos_por_partidos(22),					  
					  'tierrar_del_fuego' => $consultasModelo->devolver_sorteos_por_partidos(23),					  
					  'tucuman' => $consultasModelo->devolver_sorteos_por_partidos(24),					  
					  'total_sorteos' => $total_sorteos,					  
		);

		echo view('encabezado');
		echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
		echo view('reporte_sorteos_por_provincias',$data);
			
	}
	function reporte_abogados_sorteados_por_partido_movimiento(){
		try{
			$permisos = array(1=>2,2=>6,3=>7);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$provinciasModelo = new Provincias_modelo($db);			
				
				$sorteos = array();
				$data = array ('provincias' => $provinciasModelo->devolver_provincias(),
							   'provincia_actual' => 0,				
							   'partido_actual' => 0,				
							   'sorteos' => $sorteos,
							   'desde' => '',
							   'hasta' => '',
							   
				);
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('reporte_abogados_sorteados_por_partido_movimiento', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}	
	function buscar_abogados_sorteados_por_partido_movimiento(){
		try{
			$permisos = array(1=>2,2=>6,3=>7);
			$session = \Config\Services::session();			
			$permiso_ok = $this->confirmar_permiso($permisos,$session->get('idPerfil')); //Confirma que tenga permiso para este Método			
			
			if($permiso_ok){
				
				//INSTANCIA DE MODELOS
				$request = \Config\Services::request();
				$provinciasModelo = new Provincias_modelo($db);
				$consultasModelo = new Consultas_modelo($db);				
				
				$sorteos = $consultasModelo->devolver_abogados_sorteados_por_partido_movimiento_fechas($request->getPostGet('desplegableprovincia'),$request->getPostGet('desplegablepartidosadmin'),$request->getPostGet('fechadesde'),$request->getPostGet('fechahasta'));
				$data = array ('provincias' => $provinciasModelo->devolver_provincias(),
							   'provincia_actual' => $request->getPostGet('desplegableprovincia'),				
							   'partido_actual' => $request->getPostGet('desplegablepartidosadmin'),				
							   'sorteos' => $sorteos,
							   'desde' => $request->getPostGet('fechadesde'),
							   'hasta' => $request->getPostGet('fechahasta'),
							   
				);
				
				echo view('encabezado');
				echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
				echo view('reporte_abogados_sorteados_por_partido_movimiento', $data);		
				
			}else{
				$session->destroy();
				$data = array('mensaje' => '<strong>¡Atención! </strong>Usted NO tiene permiso para esta operación.');
				echo view('encabezado');
				echo view('login_vista_administracion',$data);	
			}
		}
		catch ( Customexception $e ) {
			$e->show_error_vista('Usuarios','', 'adminroot/home/');
		}
	}
	function reporte_sorteos_por_partido_por_provincias_entre_fechas(){
			
		//INSTANCIA DE MODELOS-
		$session = \Config\Services::session();
		
		$provinciasModelo = new Provincias_modelo($db);		
		$sorteos = array();
		$data = array ('provincias' => $provinciasModelo->devolver_provincias(),
					   'provincia_actual' => 0,
					   'desde' => '',
					   'hasta' => '',
					   'mostrar_grafico' => false,
					   'reportes' => $sorteos,
					   'total_provincia' => 0,
					   );

		echo view('encabezado');
		echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
		echo view('reporte_sorteos_por_partido_por_provincias_entre_fechas',$data);
			
	}		
	function buscar_sorteos_por_partido_por_provincias_entre_fechas(){
			
		//INSTANCIA DE MODELOS-
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		
		$provinciasModelo = new Provincias_modelo($db);	
		$consultasModelo = new Consultas_modelo($db);					
		
		$total_sorteos = 0;
		
		$sorteos = $consultasModelo->devolver_sorteos_por_partidos_fechas($request->getPostGet('desplegableprovincia'),$request->getPostGet('fechadesde'),$request->getPostGet('fechahasta'));
		
		foreach($sorteos as $sorteo){
			
			$total_sorteos = $total_sorteos + $sorteo['cantidad_por_partido'];
						
		}
		
		$data = array ('provincias' => $provinciasModelo->devolver_provincias(),
					   'provincia_actual' => $request->getPostGet('desplegableprovincia'),					   
					   'desde' => $request->getPostGet('fechadesde'),
					   'hasta' => $request->getPostGet('fechahasta'),
					   'mostrar_grafico' => true,
					   'reportes' => $sorteos,
					   'total_provincia' => $total_sorteos,
					   );

		echo view('encabezado');
		echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
		echo view('reporte_sorteos_por_partido_por_provincias_entre_fechas',$data);
			
	}	
	function descargar_reporte_abogados_por_partido(){
			
		//INSTANCIA DE MODELOS-
		$session = \Config\Services::session();
		$matriculacionesModelo = new Matriculaciones_modelo($db);
		$abogadosModelo = new Abogados_modelo($db);
		
		$total_abogados_inscriptos = 0;
		$total_abogados_aprobados = 0;
		$total_abogados = 0;
		
		$abogados_por_colegio = $abogadosModelo->devolver_vista_abogados_por_partido();
		
		foreach($abogados_por_colegio as $colegio){
			
			$total_abogados_inscriptos = $total_abogados_inscriptos + $colegio['REGISTRADOS'];
			$total_abogados_aprobados = $total_abogados_aprobados + $colegio['APROBADOS'];
			$total_abogados = $total_abogados + ($colegio['REGISTRADOS'] - $colegio['APROBADOS']);
			
		}
		
		$data = array('reportes' => $abogadosModelo->devolver_vista_abogados_por_partido(),
					  'total_abogados_inscriptos' => $total_abogados_inscriptos,
					  'total_abogados_aprobados' => $total_abogados_aprobados,
					  'total_abogados' => $total_abogados,
		);

		echo view('descargar_reporte_abogados_inscriptos_por_partido_excel', $data);
					
	}
	function descargar_reporte_abogados_por_colegio(){
			
		//INSTANCIA DE MODELOS-
		$session = \Config\Services::session();
		$matriculacionesModelo = new Matriculaciones_modelo($db);
		$abogadosModelo = new Abogados_modelo($db);
		
		$total_abogados_inscriptos = 0;
		$total_abogados_aprobados = 0;
		$total_abogados = 0;
		
		$abogados_por_colegio = $abogadosModelo->devolver_vista_abogados_por_colegio();
		
		foreach($abogados_por_colegio as $colegio){
			
			$total_abogados_inscriptos = $total_abogados_inscriptos + $colegio['REGISTRADOS'];
			$total_abogados_aprobados = $total_abogados_aprobados + $colegio['APROBADOS'];
			$total_abogados = $total_abogados + ($colegio['REGISTRADOS'] - $colegio['APROBADOS']);
		
		}
		
		$data = array('reportes' => $abogadosModelo->devolver_vista_abogados_por_colegio(),
					  'total_abogados_inscriptos' => $total_abogados_inscriptos,
					  'total_abogados_aprobados' => $total_abogados_aprobados,
					  'total_abogados' => $total_abogados,
		);

		echo view('descargar_reporte_abogados_inscriptos_por_colegio_excel', $data);
					
	}
	function reporte_sorteos_por_tipo_de_tramite(){
			
		//INSTANCIA DE MODELOS
		$session = \Config\Services::session();	
		$matriculacionesModelo = new Matriculaciones_modelo($db);		
		$consultasModelo = new Consultas_modelo($db);
					
		$data = array('reportes' => $consultasModelo->devolver_sorteos_por_comisiones_medicas());

		echo view('encabezado');
		echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
		echo view('reporte_sorteos_por_tipo_de_tramite',$data);
			
	}	
	function reporte_causas_por_comisiones_medicas(){
			
		//INSTANCIA DE MODELOS
		$session = \Config\Services::session();	
		$matriculacionesModelo = new Matriculaciones_modelo($db);		
		$consultasModelo = new Consultas_modelo($db);
		
		$total_causas = 0;
		$causas = $consultasModelo->devolver_causas_por_comisiones_medicas();
		
		foreach($causas as $sorteo){
			
			$total_causas = $total_causas + $sorteo['total_comision'];
						
		}
			
		$data = array('reportes' => $causas,
					  'total_causas' => $total_causas,
		);

		echo view('encabezado');
		echo view($this->barra_navegacion_por_permiso($session->get('idPerfil')),$this->armar_datos_desesion());
		echo view('reporte_causas_por_comisiones_medicas',$data);
			
	}
	protected function armar_datos_desesion(){
		
		$session = \Config\Services::session();
		$matriculacionesModelo = new Matriculaciones_modelo($db);		
		
		if(!is_null($session->get('actualizo_datos_personales'))){
			
			if(date("Y-m-d",strtotime($session->get('actualizo_datos_personales')."+ 90 day")) < date("Y-m-d")){
				
				$actualizar_datos_personales = true;
				
			}else{
				
				$actualizar_datos_personales = false;
				
			}
			
		}else{
			
			$actualizar_datos_personales = true;
			
		}
		
		$datosUsuario = array ('nombreusuario' => $session->get('nombreUsuarioCompleto'),
							   'nombre' => $session->get('nombreUsuario'),	
							   'apellidoUsuario' => $session->get('apellidoUsuario'),	
							   'email' => $session->get('email'),
							   'nombre_usuario' => $session->get('nombre_usuario'),			
							   'celular' => $session->get('celular'),			
							   'telefono' => $session->get('telefono'),							   
							   'nombreperfil' => $session->get('nombreperfil'),	
							   'idusuario' => $session->get('idusuario'),
							   'idPerfil' => $session->get('idPerfil'),
							   'actualizar_datos_personales' => $actualizar_datos_personales,
							   'cantidad_domicilios_pendientes' => count($matriculacionesModelo->devolver_nuevos_domicilios_pendientes($session->get('idPerfil'),$session->get('idColegio'))),		
							   'cantidad_matriculas_pendientes' => count($matriculacionesModelo->devolver_matriculaciones_pendientes($session->get('idPerfil'),$session->get('idColegio'))),							   
		);
		return $datosUsuario;
	}
	protected function barra_navegacion_por_permiso($permiso){
		
		switch($permiso){	
		
			case 1:
					return ('barra_navegacion_abogado');
					break;
			case 2:
					return ('barra_navegacion_colegio');
					break;
			case 3:
					return ('barra_navegacion_sorteo');
					break;
			case 6:
					return ('barra_navegacion_administrador');
					break;
			case 7:
					return ('barra_navegacion_ministerio');
					break;					
		}
		
	}
	function ejecutar_tareas_programadas(){
		
		$this->enviar_email();
		$this->cerrar_cauda_por_falta_de_respuesta();

	}
	function enviar_email(){
				
		$consultasModelo = new Consultas_modelo($db);
		$logEjecucionTaresProgramadasModelo = new Log_ejecucion_tares_programadas_modelo($db);
		
		$tarea = $logEjecucionTaresProgramadasModelo->devolver_tarea_de_hoy(1);//1 = ES LA TAREA ENVIAR MAIL
		
		if(empty($tarea)){
			
			$consultas_en_estado_pendiente = $consultasModelo->devolver_consultas_pendientes_por_mas_de_siete_dias();
			
			foreach($consultas_en_estado_pendiente as $consulta){				
				
				$mail_abogado = $consulta['email_estudio'];
				$asunto_abogado = 'Patrocinio Sistema - ACOM';			
				
				$mensaje_abogado = 'Estimado, usted ha sido sorteado por el sistema ACOM para representar a:'. "<br>". "<br>";
					
				$mensaje_abogado .= 'Sr/a: '. $consulta['Apellido'].', '.$consulta['Nombre']. "<br>";
				$mensaje_abogado .= 'Cuit: '. $consulta['Cuit']. "<br>";
				$mensaje_abogado .= 'Celular: '. $consulta['Celular']. "<br>";
				$mensaje_abogado .= 'Email: '. $consulta['Email']. "<br>";
				$mensaje_abogado .= 'Consulta: '. $consulta['Descripcion']. "<br>";
				$mensaje_abogado .= 'Fecha de sorteo: '. date('d-m-Y H:i:s',strtotime($consulta['FechaSorteo'])). "<br>". "<br>";				
				
				$mensaje_abogado .= 'Por favor, ingrese al Sistema y acepte o excuse su patrocinio.'. "<br>";
				$mensaje_abogado .= 'En caso que no haya podido comunicarse con el Cliente, usted puede seleccionar la opción "EL CLIENTE NO SE PRESENTO" y así volver a la lista para salir sorteado nuevamente.'. "<br>";
				$mensaje_abogado .= "Acceda al manual de usuario del Sistema ACOM disponible <a href='https://docs.google.com/document/d/e/2PACX-1vRGMoDNpAVDVTZFI4FtJOJ3t6kDv9xQeN-8t_sdMH1-bbVSk-zAcW_pSpSueOx4OZbTjRUWsgoKldL1/pub' class='btn btn-link'>aquí</a>"."<br>";
								
				$email = new email();
				
				$email->enviar_mail($mail_abogado,$asunto_abogado,$mensaje_abogado);
							
			}
			
			//GUARDAMOS EN EL LOG CUANDO SE EJECUTO ESTA TAREA
			$data = ['IdTipoTarea' => 1,	
					 'NombreTarea' => 'Enviar email por CONSULTAS PENDIENTES al 7° día.',									
					 'FechaEjecucion' => date("Y-m-d"),									
			];
			
			$logEjecucionTaresProgramadasModelo->insert($data);
			
		}
	}
	function cerrar_cauda_por_falta_de_respuesta(){
				
		$consultasModelo = new Consultas_modelo($db);
		$logEjecucionTaresProgramadasModelo = new Log_ejecucion_tares_programadas_modelo($db);
		
		$tarea = $logEjecucionTaresProgramadasModelo->devolver_tarea_de_hoy(2);// 2 = ES LA TAREA CERRAR CAUSAS
		
		if(empty($tarea)){
			
			$consultas_en_estado_pendiente = $consultasModelo->devolver_consultas_pendientes_por_mas_de_quince_dias();
			
			foreach($consultas_en_estado_pendiente as $consulta){				
				
				$consultasModelo->guardar_finalizar_causa_por_paso_del_tiempo($consulta['IdConsulta']);	
				/*			
				$mail_abogado = $consulta['Email'];
								
				$asunto = 'Sistema ACOM';					
				$mensaje = 'Estimado, le informamos que el profesional letrado sorteado en el sistema Acom para su patrocinio no ha brindado información de la causa ni aceptado la misma.'. "<br>";
				$mensaje .= 'Por favor, ingrese al Sistema ACOM y realice un nuevo sorteo para que le sea asignado un nuevo Abogado.'. "<br>";
						
				$email = new email();			
				$email->enviar_mail($mail_abogado,$asunto,$mensaje);
				*/			
			}
			
			//GUARDAMOS EN EL LOG CUANDO SE EJECUTO ESTA TAREA
			$data = ['IdTipoTarea' => 2,	
					 'NombreTarea' => 'Cerrar Causa por falta de respuesta del abogado después de 15 días.',									
					 'FechaEjecucion' => date("Y-m-d"),									
			];
			
			$logEjecucionTaresProgramadasModelo->insert($data);
			
		}
	}
	
}	
?>