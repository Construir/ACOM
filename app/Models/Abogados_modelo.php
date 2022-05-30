<?php namespace App\Models;

use CodeIgniter\Model;

class Abogados_modelo extends Model{
	
        protected $table      = 'abogados';
        protected $primaryKey = 'IdAbogado';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['Nombre', 'Apellido', 'Email', 'Cuit', 'Celular', 'Telefono', 'Usuario', 'Contrasenia', 'IdPerfil', 'IdColegio', 'IdEntidad', 'Estado', 'UltimaLogueado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
		
		function actualizar_contrasenia_abogados($idusuario,$nombre_usuario,$contrasenia){
			
			$sql = "update abogados set Contrasenia = ? where IdAbogado = ? and Usuario = ?";				
			$query = $this->db->query($sql, array($contrasenia,$idusuario,$nombre_usuario));			

		}
		function resetear_contrasenia($cuit){
			
			$sql = "update abogados set Contrasenia = ? where Cuit = ?";				
			$query = $this->db->query($sql, array($cuit,$cuit));			

		}
		function devolver_abogados_inscriptos_por_colegio(){
			
			$query = $this->query('SELECT d.IdDepartamento,d.NombreDepartamento,count(m.IdMatriculacion) as cant_abogados 

									FROM abogados as a
									join matriculaciones as m on a.IdAbogado = m.IdAbogado
									join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas where FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
									join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual 
									join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado and em.IdTipoEstado = 1
									right join departamentos as d on m.IdColegio = d.IdDepartamento
									where a.deleted_at is null
									group by d.IdDepartamento,d.NombreDepartamento
									order by d.NombreDepartamento');
			return $query->getResultArray();
			
		}		
		function devolver_vista_abogados_por_colegio(){
			
			$query = $this->query('SELECT * from Registrados_Colegio');
			return $query->getResultArray();
			
		}		
		function devolver_vista_abogados_por_partido(){
			
			$query = $this->query('SELECT * from Registrados_Partido');
			return $query->getResultArray();
			
		}
		function devolver_abogados_por_provincias(){
			
			$query = $this->query('SELECT 
									`prov`.`NombreProvincia` AS `NombreProvincia`, 
									COUNT(0) AS `REGISTRADOS`,
									COUNT((CASE
										WHEN (`em`.`IdTipoEstado` = 2) THEN 1
									END)) AS `APROBADOS`,
									COUNT((CASE
										WHEN (`em`.`IdTipoEstado` = 1) THEN 1
									END)) AS `PENDIENTES`
								FROM
									(((((((((((`acom_devel`.`abogados` `a`
									JOIN `acom_devel`.`matriculaciones` `m` ON ((`a`.`IdAbogado` = `m`.`IdAbogado`)))
									JOIN (SELECT 
										MAX(`acom_devel`.`estado_matriculas`.`IdEstadoMatricula`) AS `IdEstadoActual`,
											`acom_devel`.`estado_matriculas`.`IdMatricula` AS `idMatricula`
									FROM
										`acom_devel`.`estado_matriculas`
									WHERE
										(`acom_devel`.`estado_matriculas`.`FechaInicio` <= NOW())
									GROUP BY `acom_devel`.`estado_matriculas`.`IdMatricula`) `ultimoEstado` ON ((`ultimoEstado`.`idMatricula` = `m`.`IdMatriculacion`)))
									JOIN `acom_devel`.`estado_matriculas` `em` ON ((`em`.`IdEstadoMatricula` = `ultimoEstado`.`IdEstadoActual`)))
									JOIN `acom_devel`.`tipo_estados_matricula` `tem` ON ((`tem`.`IdTiposEstadoMatricula` = `em`.`IdTipoEstado`)))
									JOIN `acom_devel`.`departamentos` `depto` ON ((`depto`.`IdDepartamento` = `m`.`IdColegio`)))
									JOIN (SELECT 
										MAX(`acom_devel`.`domicilios`.`IdDomicilio`) AS `ultimoDom`,
											`acom_devel`.`domicilios`.`IdMatriculacion` AS `IdMatriculacion`
									FROM
										`acom_devel`.`domicilios`
									GROUP BY `acom_devel`.`domicilios`.`IdMatriculacion`) `ultimodomicilio` ON ((`ultimodomicilio`.`IdMatriculacion` = `m`.`IdMatriculacion`)))
									JOIN `acom_devel`.`domicilios` `d` ON ((`d`.`IdDomicilio` = `ultimodomicilio`.`ultimoDom`)))
									JOIN `acom_devel`.`localidades` `loca` ON ((`loca`.`IdLocalidad` = `d`.`IdLocalidad`)))
									JOIN `acom_devel`.`municipios` `muni` ON ((`muni`.`IdMunicipio` = `loca`.`IdMunicipio`)))
									JOIN `acom_devel`.`partidos` `part` ON ((`part`.`Id` = `muni`.`Id`)))
									JOIN `acom_devel`.`provincias` `prov` ON ((`prov`.`IdProvincia` = `part`.`IdProvincia`)))
								WHERE
									ISNULL(`m`.`deleted_at`)
								GROUP BY  `prov`.`NombreProvincia`
								ORDER BY `prov`.`NombreProvincia` , COUNT(0)');
			return $query->getResultArray();
			
		}
		/*
		function devolver_abogados_por_provincias(){
			
			$query = $this->query('SELECT p.IdProvincia,p.NombreProvincia,count(m.IdMatriculacion) as cant_abogados 

				FROM abogados as a
				join matriculaciones as m on a.IdAbogado = m.IdAbogado
				join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas where FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula=m.IdMatriculacion 
				join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual 
				join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado and em.IdTipoEstado = 2
				join departamentos as d on m.IdColegio = d.IdDepartamento
				right join provincias as p on p.IdProvincia = d.IdProvincia
				where a.deleted_at is null
				group by p.IdProvincia,p.NombreProvincia');
			return $query->getResultArray();
			
		}
		*/
		function guardar_nuevo_abogado($nombreAbogado,$apellidoAbogado,$emailAbogado,$cuitAbogado,$colegioAbogado,$celular,$telefono){
			
			$sql = 'select * FROM abogados where Cuit = ? and deleted_at is null';
				
			$query = $this->db->query($sql, array($cuitAbogado));				
			$abogado = $query->getResultArray();
			
			if(empty($abogado)){
				
				//Guardamos el consultante
				$sql = "INSERT abogados(Nombre, Apellido, Email, Cuit, IdColegio, Celular, Telefono, Usuario, Contrasenia, IdPerfil, Estado, created_at, updated_at)
						VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";				
											 
				$query = $this->db->query($sql, array($nombreAbogado,$apellidoAbogado,$emailAbogado,$cuitAbogado,$colegioAbogado,$celular,$telefono,$cuitAbogado,$cuitAbogado,1,0,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
											 
				return $this->db->insertID();
			}else{
				return 0; //existe
			}
			
		}
		function resetear_contraseña($idabogado,$cuit){
			
			$sql = "UPDATE abogados SET Contrasenia = ? WHERE IdAbogado = ?";						
			
			$query = $this->db->query($sql, array($cuit,$idabogado));
			return $query->getResultArray();
			
		}
		function devolver_abogado($cuit){
			
			$sql = "SELECT * FROM abogados where Cuit = ?";
									
			$query = $this->db->query($sql, array($cuit));
			return $query->getResultArray();						

		}		
		function devolver_abogado_x_matricula($idmatricula){
			
			$sql = "SELECT *
					FROM abogados as a
					join matriculaciones as m on a.IdAbogado = m.IdAbogado
					where m.IdMatriculacion = ?";
									
			$query = $this->db->query($sql, array($idmatricula));
			return $query -> getResultArray();

		}
		function devolver_abogados($idUsuario,$idPerfil,$idColegio){
			
			$cadena = '';
			$cadena = '  ';
			
			if($idPerfil == 2){///es un usuario de colegio
				$cadena = 'where IdColegio = '.$idColegio;
			}			
			
			$query = $this->query("SELECT * 
								  FROM abogados as u 
								  join perfiles as p on p.IdPerfil = u.IdPerfil and u.IdPerfil not in (6,2)
								  left join departamentos as d on u.IdColegio = d.IdDepartamento ".$cadena);						
			return $query->getResultArray();					
			
		}

}?>