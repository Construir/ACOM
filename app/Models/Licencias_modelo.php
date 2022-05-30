<?php namespace App\Models;

use CodeIgniter\Model;

class Licencias_modelo extends Model{
	
        protected $table      = 'licencias';
        protected $primaryKey = 'IdLicencia';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['Cuit','IdColegio', 'IdMatriculacion', 'IdTipoLicencia', 'FechaRegistro', 'FechaInicio', 'FechaFin', 'DetalleMotivo', 'Estado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;	
		
		function devolver_licencia($fechaInicio,$FechaFin,$matriculacion){
		
			//$sql = "SELECT * FROM licencias where FechaFin > ? and IdMatriculacion = ?";						
			$sql = "SELECT * FROM licencias where (FechaFin > ? and IdMatriculacion = ?) or (FechaInicio <= ? and FechaFin = '0000-00-00' and IdMatriculacion = ?) ";						
			
			$query = $this->db->query($sql, array($fechaInicio,$matriculacion,$fechaInicio,$matriculacion));
			return $query->getResultArray();
			
		}
		function devolver_licencia_actual($matriculacion){
		
			//$sql = "SELECT * FROM licencias where FechaFin > ? and IdMatriculacion = ?";						
			$sql = "SELECT * FROM licencias where IdMatriculacion = ? and FechaFin <= NOW()";						
			
			$query = $this->db->query($sql, array($matriculacion));
			return $query->getResultArray();
			
		}	
		function devolver_licencias_x_abogado($cuit){
			
			$sql = "SELECT l.*,d.NombreDepartamento as NombreColegio
					FROM licencias as l
					join matriculaciones as m on m.IdMatriculacion = l.IdMatriculacion
					join departamentos as d on m.IdColegio = d.IdDepartamento			
					where m.Cuit = ?
					order by FechaRegistro desc";						
			
			$query = $this->db->query($sql, array($cuit));
			return $query->getResultArray();
			
		}

}?>