<?php namespace App\Models;

use CodeIgniter\Model;

class Domicilios_modelo extends Model{
	
        protected $table      = 'domicilios';
        protected $primaryKey = 'IdDomicilio';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdMatriculacion', 'Cuit', 'IdProvincia', 'IdPartido', 'IdLocalidad', 'Calle', 'Numero', 'Piso', 'Oficina', 'Email', 'Telefono', 'Estado', 'HorariosAtencion', 'IdUsuario', 'Aprobado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;

		function devolver_ultimo_domicilio($idmatriculacion){
			
			$sql = "select max(IdDomicilio) as ultimoDom, IdMatriculacion,Email from domicilios where IdMatriculacion = ? and deleted_at is null  group by IdMatriculacion,Email";						
			
			$query = $this->db->query($sql, array($idmatriculacion));
			return $query->getResultArray();			
			
		}		
		function devolver_domicilios_x_matriculacion($idmatriculacion){
			
			$sql = "SELECT * FROM domicilios where IdMatriculacion = ? order by Estado desc, created_at desc";						
			
			$query = $this->db->query($sql, array($idmatriculacion));
			return $query->getResultArray();			
			
		}			
		function desaprobar_domicilio($idmatricula){
			
			$sql = "UPDATE domicilios SET Estado = 0 WHERE IdMatriculacion = ?";						
			
			$query = $this->db->query($sql, array($idmatricula));
			return $query->getResultArray();			
			
		}
		function desaprobar_domicilios($iddomicilio,$idusuario){
			
			$sql = "UPDATE domicilios SET IdUsuario = ?, Estado = 2 WHERE IdDomicilio = ?";						
			
			$query = $this->db->query($sql, array($idusuario,$iddomicilio));
			return $query->getResultArray();			
			
		}		
		function aprobar_domicilios($iddomicilio,$idusuario){
			
			$sql = "UPDATE domicilios SET IdUsuario = ?, Estado = 1 WHERE IdDomicilio = ?";						
			
			$query = $this->db->query($sql, array($idusuario,$iddomicilio));
			return $query->getResultArray();			
			
		}
		function guardar_nuevo_domicilio($IdMatriculacion,$cuitAbogado,$provincia,$partidoDomicilio,$localidadDomicilio,$calleDomicilio,$numeroDomicilio,
										 $pisoDomicilio,$oficinaDomicilio,$emailEstudio,$telefonoEstudio,$horarioDomicilio,$estado){
				/*
					echo $IdMatriculacion;
					echo $cuitAbogado;
					echo $provincia;
					echo $partidoDomicilio;
					echo $localidadDomicilio;
					echo $calleDomicilio;
					echo $numeroDomicilio;
					echo $pisoDomicilio;
					echo $oficinaDomicilio;
					echo $emailEstudio;
					echo $telefonoEstudio;
					echo $horarioDomicilio;
					echo $estado;								   
				*/
			$sql = "INSERT domicilios(IdMatriculacion,Cuit,IdProvincia,IdPartido,IdLocalidad,Calle,Numero,Piso,Oficina,Email,Telefono,Estado,HorariosAtencion,created_at,updated_at)
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";				
								 
			$query = $this->db->query($sql, array($IdMatriculacion,$cuitAbogado,$provincia,$partidoDomicilio,$localidadDomicilio,$calleDomicilio,$numeroDomicilio,
										$pisoDomicilio,$oficinaDomicilio,$emailEstudio,$telefonoEstudio,$estado,$horarioDomicilio,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
										 
			return $this->db->insertID();		
		
		}
}?>