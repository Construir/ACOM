<?php namespace App\Models;

use CodeIgniter\Model;

class Detalle_cambio_matricula_modelo extends Model{
	
        protected $table      = 'detalle_cambio_matricula';
        protected $primaryKey = 'IdDetalleCambioMatricula';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdMatricula', 'FechaRegistro', 'FechaDesde', 'FechaHasta', 'IdTipoEstado', 'DetalleMotivo', 'IdEstadoMatricula'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;	
		
		function guardar_detalle_cambio_matricula($IdMatriculacion,$detalle){					   
				
			$sql = "INSERT detalle_cambio_matricula(IdMatricula,FechaRegistro,FechaDesde,IdTipoEstado,DetalleMotivo,created_at,updated_at)
			VALUES(?,?,?,?,?,?,?)";				
								 
			$query = $this->db->query($sql, array($IdMatriculacion,date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),1,$detalle,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
										 
			return $this->db->insertID();		
		
		}
		
		function devolver_movimiento_matricula($idmatricula){
			
						$sql = "SELECT tem.NombreTipoEstado,dcm.*								  
								   FROM detalle_cambio_matricula as dcm
								   join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = dcm.IdTipoEstado						   
								   
								   where dcm.IdMatricula = ? 
								   order by FechaRegistro asc";						
			
			$query = $this->db->query($sql, array($idmatricula));
			return $query->getResultArray();
			
		}
		function devolver_sanciones($idPerfil,$idColegio){
			
			$cadena = '';
			
			if($idPerfil == 2){///es un usuario de colegio
				$cadena = 'and m.IdColegio = '.$idColegio;
			}

			$query = $this->query("SELECT dcm.IdMatricula, a.Apellido, a.Nombre, a.Cuit, m.Matricula, m.Tomo, m.Folio, d.Email, d.Telefono
									from detalle_cambio_matricula as dcm
									join matriculaciones as m on dcm.IdMatricula = m.IdMatriculacion
									join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios where Estado = 1  group by IdMatriculacion )
									as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom
									join abogados as a on a.IdAbogado = m.IdAbogado									
									where IdTipoEstado = 4 ".$cadena.
									" group by dcm.IdMatricula, a.Apellido, a.Nombre, a.Cuit, m.Matricula, d.Email, d.Telefono");
									
			return $query->getResultArray();											
																			
		}
		function devolver_sanciones_cuit($cuit){			
			
			$sql = "SELECT dcm.IdMatricula, a.Apellido, a.Nombre, a.Cuit, m.Matricula, m.Tomo, m.Folio, d.Email, d.Telefono
									from detalle_cambio_matricula as dcm
									join matriculaciones as m on dcm.IdMatricula = m.IdMatriculacion
									join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios where Estado = 1  group by IdMatriculacion )
									as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
									join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom
									join abogados as a on a.IdAbogado = m.IdAbogado									
									where IdTipoEstado = 4 and m.Cuit = ?
									group by dcm.IdMatricula, a.Apellido, a.Nombre, a.Cuit, m.Matricula, d.Email, d.Telefono";
			
			$query = $this->db->query($sql, array($cuit));
			return $query->getResultArray();	
																					
		}		
		function buscar_sanciones_por_matricula($idmatricula){			
			
			$sql = "SELECT dcm.*

					FROM detalle_cambio_matricula as dcm
					join matriculaciones as m on dcm.IdMatricula = m.IdMatriculacion
					join abogados as a on a.IdAbogado = m.IdAbogado

					where IdTipoEstado = 4 and dcm.IdMatricula = ?";
			
			$query = $this->db->query($sql, array($idmatricula));
			return $query->getResultArray();	
																					
		}		
		
}?>