<?php namespace App\Models;

use CodeIgniter\Model;

class Matriculaciones_modelo extends Model{
	
        protected $table      = 'matriculaciones';
        protected $primaryKey = 'IdMatriculacion';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdAbogado', 'Cuit', 'IdEstadoMatricula', 'IdColegio', 'Matricula', 'Tomo', 'Folio', 'FueSorteado', 'DeudaSorteo', 'Estado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
		
		function guardar_nueva_matricula($IdAbogado,$cuitAbogado,$colegioAbogado,$matriculaAbogado,$tomoAbogado,$folioAbogado){					   
				
			$sql = "INSERT matriculaciones(IdAbogado,Cuit,IdColegio,Matricula,Tomo,Folio,created_at,updated_at)
			VALUES(?,?,?,?,?,?,?,?)";				
								 
			$query = $this->db->query($sql, array($IdAbogado,$cuitAbogado,$colegioAbogado,$matriculaAbogado,$tomoAbogado,$folioAbogado,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
										 
			return $this->db->insertID();		
		
		}
		function devolver_matriculaciones($idPerfil,$idColegio){
			
			$cadena = '';
			
			if($idPerfil == 2){///es un usuario de colegio
				$cadena = 'and m.IdColegio = '.$idColegio;
			}

			$query = $this->query("SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
								   m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
								   d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
								   depto.NombreDepartamento as NombreColegio,										
								   em.IdTipoEstado as EstadoMatriculacion,
								   lo.NombreLocalidad, lo.Municipio as NombreMunicipio, lo.Departamento as NombreDepartamento, lo.Provincia as NombreProvincia,
								   tem.NombreTipoEstado
								   
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado ".$cadena." 
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas where FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									join localidades as lo on lo.IdLocalidad = d.IdLocalidad
									where m.deleted_at is null and em.IdTipoEstado > 1
									order by Apellido, Nombre");
									
			return $query->getResultArray();											
																			
		}			
		function devolver_matriculaciones_colegio_estado($idcolegio,$idestadomatricula){			

			$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
								   m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
								   d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
								   depto.NombreDepartamento as NombreColegio,										
								   em.IdTipoEstado as EstadoMatriculacion,
								   lo.NombreLocalidad, lo.Municipio as NombreMunicipio, lo.Departamento as NombreDepartamento, lo.Provincia as NombreProvincia,
								   tem.NombreTipoEstado
								   
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas where FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									join localidades as lo on lo.IdLocalidad = d.IdLocalidad
									where m.IdColegio = ? and em.IdTipoEstado = ?
									order by Apellido, Nombre"; 
									
			$query = $this->db->query($sql, array($idcolegio,$idestadomatricula));
			return $query->getResultArray();
																					
		}
		function devolver_matriculacion_cuit($cuit){			
			
			$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
								   m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
								   d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
								   depto.NombreDepartamento as NombreColegio,										
								   em.IdTipoEstado as EstadoMatriculacion,
								   lo.NombreLocalidad, lo.Municipio as NombreMunicipio, lo.Departamento as NombreDepartamento, lo.Provincia as NombreProvincia,
								   tem.NombreTipoEstado
								   
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas where FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									join localidades as lo on lo.IdLocalidad = d.IdLocalidad
									where m.Cuit = ?
									order by Apellido, Nombre";
			
			$query = $this->db->query($sql, array($cuit));
			return $query->getResultArray();	
																					
		}
		function devolver_matriculaciones_pendientes($idPerfil,$idColegio){
			
			$cadena = '';
			
			if($idPerfil == 2){///es un usuario de colegio
				$cadena = 'and m.IdColegio = '.$idColegio;
			}
			$query = $this->query("SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
								   m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
								   d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
								   depto.NombreDepartamento as NombreColegio,										
								   em.IdTipoEstado as EstadoMatriculacion,em.IdEstadoMatricula,
								   lo.NombreLocalidad, lo.Municipio as NombreMunicipio, lo.Departamento as NombreDepartamento, lo.Provincia as NombreProvincia
								   
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado ".$cadena."
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas where FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									join localidades as lo on lo.IdLocalidad = d.IdLocalidad
									where m.deleted_at is null and em.IdTipoEstado = 1
									order by Apellido, Nombre");				
							   
			return $query->getResultArray();
			
		}		
		function devolver_matriculacion_domicilio_pendiente($idmatricula){
			
			$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
										  m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
										  d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
										  depto.NombreDepartamento,
										  p.NombrePartido,
										  prov.NombreProvincia,
										  muni.NombreMunicipio,
										  em.IdTipoEstado as EstadoMatriculacion
										  
								   FROM abogados as a 
								   join matriculaciones as m on a.IdAbogado = m.IdAbogado
								   left join estado_matriculas as em on em.IdEstadoMatricula = m.IdEstadoMatricula
								   join domicilios as d on d.IdMatriculacion = m.IdMatriculacion and d.Estado = 0
								   join departamentos as depto on depto.IdDepartamento = m.IdColegio
								   left join municipios as muni on muni.IdMunicipio = d.IdLocalidad
								   left join partidos as p on p.Id = d.IdPartido
								   left join provincias as prov on prov.IdProvincia = d.IdProvincia
								   where  m.IdMatriculacion = ?";
								   
			$query = $this->db->query($sql, array($idmatricula));
			return $query->getResultArray();					
			
		}	
		function devolver_nuevos_domicilios_pendientes($idPerfil,$idColegio){
			
			$cadena = '';
			
			if($idPerfil == 2){///es un usuario de colegio
				$cadena = 'and m.IdColegio = '.$idColegio;
			}
			$query = $this->query("SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
									m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
									d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
									depto.NombreDepartamento as NombreDepartamento,
									p.NombrePartido,
									prov.NombreProvincia,
									muni.NombreMunicipio as NombreLocalidad,
									em.IdTipoEstado as EstadoMatriculacion, tem.NombreTipoEstado
									
									
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado ".$cadena."
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado									
									join domicilios as d on d.IdMatriculacion = m.IdMatriculacion 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									left join municipios as muni on muni.IdMunicipio = d.IdLocalidad
									left join partidos as p on p.Id = d.IdPartido
									left join provincias as prov on prov.IdProvincia = d.IdProvincia
								  
								   where d.Estado = 0 and em.IdTipoEstado <> 1 and d.deleted_at is null
								   order by m.Estado");	
			
			return $query->getResultArray();		
			
		}
		function devolver_matriculacion($idmatriculacion){
			
			$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
								   m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
								   d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
								   depto.NombreDepartamento as NombreColegio,									
								   em.IdTipoEstado as EstadoMatriculacion,
								   lo.NombreLocalidad, lo.Municipio as NombreMunicipio, lo.Departamento as NombreDepartamento, lo.Provincia as NombreProvincia,
								   tem.NombreTipoEstado
								   
								   
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas where FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									join localidades as lo on lo.IdLocalidad = d.IdLocalidad
									where m.IdMatriculacion = ?";						
			
			$query = $this->db->query($sql, array($idmatriculacion));
			return $query->getResultArray();			
			
		}
		/*
		function devolver_matriculacion($idmatriculacion){
			
			$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
									m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
									d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
									depto.NombreDepartamento,
									p.NombrePartido,
									prov.NombreProvincia,
									muni.NombreMunicipio,
									em.IdTipoEstado as EstadoMatriculacion, tem.NombreTipoEstado
									
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(iddomicilio) as ultimoDom, IdMatriculacion from domicilios where Estado = 1 group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.iddomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									left join municipios as muni on muni.IdMunicipio = d.IdLocalidad
									left join partidos as p on p.Id = d.IdPartido
									left join provincias as prov on prov.IdProvincia = d.IdProvincia
									where m.IdMatriculacion = ?";						
			
			$query = $this->db->query($sql, array($idmatriculacion));
			return $query->getResultArray();			
			
		}
		*/
		function devolver_matriculacion_imprimir_viejo($idmatriculacion){
			
			$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
									m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
									d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
									depto.NombreDepartamento,
									p.NombrePartido,
									prov.NombreProvincia,
									muni.NombreMunicipio,
									em.IdTipoEstado as EstadoMatriculacion, tem.NombreTipoEstado
									
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(iddomicilio) as ultimoDom, IdMatriculacion from domicilios  group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.iddomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									left join municipios as muni on muni.IdMunicipio = d.IdLocalidad
									left join partidos as p on p.Id = d.IdPartido
									left join provincias as prov on prov.IdProvincia = d.IdProvincia
									where m.IdMatriculacion = ?";						
			
			$query = $this->db->query($sql, array($idmatriculacion));
			return $query->getResultArray();			
			
		}
		function devolver_matriculacion_inscripto($idmatriculacion){
			
			$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
									m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
									d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
									depto.NombreDepartamento,
									p.NombrePartido,
									prov.NombreProvincia,
									muni.NombreMunicipio,
									em.IdTipoEstado as EstadoMatriculacion, tem.NombreTipoEstado
									
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(iddomicilio) as ultimoDom, IdMatriculacion from domicilios  group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.iddomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									left join municipios as muni on muni.IdMunicipio = d.IdLocalidad
									left join partidos as p on p.Id = d.IdPartido
									left join provincias as prov on prov.IdProvincia = d.IdProvincia
									where m.IdMatriculacion = ?";						
			
			$query = $this->db->query($sql, array($idmatriculacion));
			return $query->getResultArray();			
			
		}
		function devolver_matriculaciones_x_abogado_x_cuit($cuit){
			
			$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
									m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
									d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
									depto.NombreDepartamento,
									p.NombrePartido,l.NombreLocalidad,
									prov.NombreProvincia,
									muni.NombreMunicipio,
									em.IdTipoEstado as EstadoMatriculacion, tem.NombreTipoEstado,em.FechaInicio,em.IdEstadoMatricula
									
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas where FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(iddomicilio) as ultimoDom, IdMatriculacion from domicilios group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.iddomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									left join municipios as muni on muni.IdMunicipio = d.IdLocalidad
									left join partidos as p on p.Id = d.IdPartido
									left join provincias as prov on prov.IdProvincia = d.IdProvincia
									left join localidades as l on l.IdLocalidad = d.IdLocalidad
									where m.deleted_at is null and m.Cuit = ?
									order by m.Estado";						
			
			$query = $this->db->query($sql, array($cuit));
			return $query->getResultArray();			
			
		}		
		function devolver_matriculaciones_x_abogado($cuit){
			
			$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.IdPerfil, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
									m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
									d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
									depto.NombreDepartamento,
									p.NombrePartido,
									prov.NombreProvincia,
									muni.NombreMunicipio,
									em.IdTipoEstado as EstadoMatriculacion, tem.NombreTipoEstado
									
									FROM abogados as a 
									join matriculaciones as m on a.IdAbogado = m.IdAbogado
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
									join (select max(iddomicilio) as ultimoDom, IdMatriculacion from domicilios where Estado = 1  group by IdMatriculacion ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.iddomicilio = ultimodomicilio.ultimoDom 
									join departamentos as depto on depto.IdDepartamento = m.IdColegio
									left join municipios as muni on muni.IdMunicipio = d.IdLocalidad
									left join partidos as p on p.Id = d.IdPartido
									left join provincias as prov on prov.IdProvincia = d.IdProvincia
									where m.deleted_at is null and m.Cuit = ?
									order by m.Estado";						
			
			$query = $this->db->query($sql, array($cuit));
			return $query->getResultArray();			
			
		}
		function devolver_colegios_x_abogado($cuit){
			
			$sql = "SELECT d.NombreDepartamento, d.IdDepartamento, m.IdMatriculacion
										  
				    FROM abogados as a 
				    left join matriculaciones as m on a.IdAbogado = m.IdAbogado
				    join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from  estado_matriculas where  FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula = m.IdMatriculacion 
				    join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual	
				    left join departamentos as d on d.IdDepartamento = m.IdColegio
				  
				    where m.Cuit = ? and m.deleted_at is null and em.IdTipoEstado in (1,2)
                    group by d.IdDepartamento, m.IdMatriculacion
				    order by d.NombreDepartamento";						
			
			$query = $this->db->query($sql, array($cuit));
			return $query->getResultArray();			
			
		}
		//LEFT JOIN (select MAX(IdDomicilio) as IdDomicilio, IdProvincia, IdPartido, IdLocalidad, Calle, Numero, Piso,
								   //Oficina, Email, Telefono, HorariosAtencion,IdMatriculacion from domicilios group by IdMatriculacion)
								   //as ultimoD on ultimoD.IdMatriculacion = m.IdMatriculacion
		//LEFT JOIN (select IdDomicilio, IdProvincia, IdPartido, IdLocalidad, Calle, Numero, Piso, Oficina, Email, Telefono, HorariosAtencion,IdMatriculacion from domicilios order by IdDomicilio desc LIMIT 1) as ultimoD on ultimoD.IdMatriculacion = m.IdMatriculacion
		function devolver_matriculacion_x_cuit_colegio($cuit,$colegio){
			
						$sql = "SELECT a.IdAbogado, a.IdColegio, a.IdEntidad, a.Nombre, a.Apellido, a.Email, a.Cuit, a.Telefono, a.Celular, a.Estado as EstadoAbogado,
										  m.IdMatriculacion, m.Matricula, m.Tomo, m.Folio,
										  d.IdDomicilio, d.IdProvincia, d.IdPartido, d.IdLocalidad, d.Calle, d.Numero, d.Piso, d.Oficina, d.Email, d.Telefono, d.HorariosAtencion,
										  em.IdTipoEstado as EstadoMatriculacion										  
								  
   								   FROM abogados as a 
								   join matriculaciones as m on a.IdAbogado = m.IdAbogado
								   left join estado_matriculas as em on em.IdEstadoMatricula = m.IdEstadoMatricula
								   join domicilios as d on d.IdMatriculacion = m.IdMatriculacion
								  
								  where m.Cuit = ? and m.IdColegio = ? and m.deleted_at is null";						
			
			$query = $this->db->query($sql, array($cuit,$colegio));
			return $query->getResultArray();
			
		}		
		function validar_matriculacion($cuit,$tomo,$folio,$matricula,$departamento){
			/*
			$sql = "select ultimodomicilio.Calle, ultimodomicilio.Numero,ultimodomicilio.Piso,ultimodomicilio.Oficina,ultimodomicilio.Email,ultimodomicilio.ultimoDom,ultimodomicilio.Cuit 
					from matriculaciones as m 
					join (select max(IdDomicilio) as ultimoDom, IdMatriculacion, Cuit, Email, Calle, Numero, Piso, Oficina, deleted_at from domicilios where Estado = 1 and deleted_at is null group by IdMatriculacion, Cuit, Email, Calle, Numero, Piso, Oficina, deleted_at ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion  
					where m.Cuit = ? and (m.Tomo = ? and m.Folio = ? and m.IdColegio = ?) or (m.Matricula = ? and m.IdColegio = ?) and m.deleted_at is null
					UNION
					select ultimodomicilio.Calle, ultimodomicilio.Numero,ultimodomicilio.Piso,ultimodomicilio.Oficina,ultimodomicilio.Email,ultimodomicilio.ultimoDom,ultimodomicilio.Cuit 
					from matriculaciones as m 
					join (select max(IdDomicilio) as ultimoDom, IdMatriculacion, Cuit, Email, Calle, Numero, Piso, Oficina from domicilios where Estado = 1 and deleted_at is null group by IdMatriculacion,Calle, Numero,Piso,Oficina,Email ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion  
					where m.Cuit != ? and m.deleted_at is null limit 4";
			*/	
			/*
			$sql = "select ultimodomicilio.Calle, ultimodomicilio.Numero,ultimodomicilio.Piso,ultimodomicilio.Oficina,ultimodomicilio.Email,ultimodomicilio.ultimoDom,ultimodomicilio.Cuit 
					from matriculaciones as m 
					join (select max(IdDomicilio) as ultimoDom, IdMatriculacion, Cuit, Email, Calle, Numero, Piso, Oficina, deleted_at from domicilios where Estado = 1 and deleted_at is null group by IdMatriculacion,Cuit,Email, Calle, Numero, Piso, Oficina, deleted_at  ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion  
					where m.Cuit = ? and (m.Tomo = ? and m.Folio = ? and m.IdColegio = ?) or (m.Matricula = ? and m.IdColegio = ?) and m.deleted_at is null
					UNION
					select ultimodomicilio.Calle, ultimodomicilio.Numero,ultimodomicilio.Piso,ultimodomicilio.Oficina,ultimodomicilio.Email,ultimodomicilio.ultimoDom,ultimodomicilio.Cuit 
					from matriculaciones as m 
					join (select max(IdDomicilio) as ultimoDom, IdMatriculacion, Cuit, Email, Calle, Numero, Piso, Oficina from domicilios where Estado = 1 and deleted_at is null group by IdMatriculacion,Calle, Numero,Piso,Oficina,Email,Cuit ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion  
					where m.Cuit != ? and m.deleted_at is null limit 4";						
			
			$query = $this->db->query($sql, array($cuit,$tomo,$folio,$departamento,$matricula,$departamento,$cuit));
			*/
			$sql = "select ultimodomicilio.Calle, ultimodomicilio.Numero,ultimodomicilio.Piso,ultimodomicilio.Oficina,ultimodomicilio.Email,ultimodomicilio.ultimoDom,ultimodomicilio.Cuit 
					from matriculaciones as m 
					join (select max(IdDomicilio) as ultimoDom, IdMatriculacion, Cuit, Email, Calle, Numero, Piso, Oficina, deleted_at from domicilios where Estado = 1 and deleted_at is null group by IdMatriculacion,Cuit,Email, Calle, Numero, Piso, Oficina, deleted_at  ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion  
					where m.Cuit = ? and m.IdColegio = ? and m.deleted_at is null
					UNION
					select ultimodomicilio.Calle, ultimodomicilio.Numero,ultimodomicilio.Piso,ultimodomicilio.Oficina,ultimodomicilio.Email,ultimodomicilio.ultimoDom,ultimodomicilio.Cuit 
					from matriculaciones as m 
					join (select max(IdDomicilio) as ultimoDom, IdMatriculacion, Cuit, Email, Calle, Numero, Piso, Oficina from domicilios where Estado = 1 and deleted_at is null group by IdMatriculacion,Calle, Numero,Piso,Oficina,Email,Cuit ) as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion  
					where m.Cuit != ? and m.deleted_at is null limit 4";						
			
			$query = $this->db->query($sql, array($cuit,$departamento,$cuit));
			
			return $query->getResultArray();
			/*
				$sql = "select * from (select concat(SUBSTRING(number,1,12-LENGTH(ticket_id)),ticket_id) as numero_de_bono,cuit,ticket_id, case_name from tickets where cuit= ? and generation_date >= date_sub(CURDATE(),INTERVAL 12 month) and state=2 ORDER BY RAND() limit 1) as a
				union
				select * from (select concat(SUBSTRING(number,1,12-LENGTH(ticket_id)),ticket_id) as numero_de_bono, cuit, ticket_id, case_name from tickets where state=2 and cuit != ? and generation_date >= date_sub(CURDATE(),INTERVAL 12 month) ORDER BY RAND()  limit 2 ) as b
				order by ticket_id";
			*/
		}
		function validar_final_cambio_contrsenia($email,$iddomicilio){
			
			$sql = "SELECT d.*,m.IdAbogado 
					FROM domicilios as d
					join matriculaciones as m on m.IdMatriculacion = d.IdMatriculacion
					where Email like ? and IdDomicilio = ?";						
			
			$query = $this->db->query($sql, array($email,$iddomicilio));
			return $query->getResultArray();
			
		}
		/*
		function actualizar_estado_matricula($IdMatriculacion,$IdEstadoMatricula){
			
			$sql = "UPDATE matriculaciones SET IdEstadoMatricula = ? WHERE IdMatriculacion = ?";						
			
			$query = $this->db->query($sql, array($IdEstadoMatricula,$IdMatriculacion));
			return $query->getResultArray();
			
		}
		*/
		function devolver_matricula_en_provincia_x_abogado($idabogado,$idprovincia){
			
			$sql = "SELECT *										  
					FROM  matriculaciones as m 								   
					join domicilios as d on m.IdMatriculacion = d.IdMatriculacion
					where m.IdAbogado = ? and d.IdProvincia = ? and d.Estado = 1";						
			
			$query = $this->db->query($sql, array($idabogado,$idprovincia));
			return $query->getResultArray();
			
		}		
		function borrar_matriculacion($idmatricula){
			//eliminamos la matricula de ese colegio, los domicilios de esa matricula, el estado de esa matricula y el detalle de cambio de matricula
			$this->db->transBegin();
				
				//detalle de cambio de matricula
				$sql = "delete from detalle_cambio_matricula where IdMatricula = ?";						
				$query = $this->db->query($sql, array($idmatricula));
				
				//estado de esa matricula
				$sql = "delete from estado_matriculas where IdMatricula = ?";						
				$query = $this->db->query($sql, array($idmatricula));
				
				//los domicilios de esa matricula
				$sql = "delete from domicilios where IdMatriculacion = ?";						
				$query = $this->db->query($sql, array($idmatricula));
				
				//la matricula
				$sql = "delete from matriculaciones where IdMatriculacion = ?";						
				$query = $this->db->query($sql, array($idmatricula));
				
				
				if ($this->db->transStatus() === FALSE){
				
					$this->db->transRollback();
					return false;
					
				}else{
					
					$this->db->transCommit();
					return true;
					
				}
			
		}	

}?>