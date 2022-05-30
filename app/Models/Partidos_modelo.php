<?php namespace App\Models;

use CodeIgniter\Model;

class Partidos_modelo extends Model{
	
        protected $table      = 'partidos';
        protected $primaryKey = 'Id';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombrePartido', 'NombreProvincia', 'IdProvincia'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
				
		function devolver_partidos(){
			$query = $this->query('SELECT * FROM partidos order by NombrePartido asc');
			return $query->getResultArray();
		}
		function devolver_partidos_por_provincia($idprovincia){
			
			$sql = "SELECT * FROM partidos where IdProvincia = ?";
									
			$query = $this->db->query($sql, array($idprovincia));
			return $query -> getResultArray();
		}
		function devolver_partidos_con_abogados_aprobados($provincia){
			
			$sql = "SELECT DISTINCT NombrePartido, idPartido as Id
					FROM SituacionPartidos
					where idprovincia = ?
					order by NombrePartido asc";						
			
			$query = $this->db->query($sql, array($provincia));
			return $query->getResultArray();			
			
		}		
		function devolver_partidos_por_provincia_por_colegio($idColegio){
			
			$sql = "SELECT p.*
					FROM departamentos as d
					join partidos as p on p.IdProvincia = d.IdProvincia
					where d.IdDepartamento = ?
					order by p.NombrePartido";						
			
			$query = $this->db->query($sql, array($idColegio));
			return $query->getResultArray();			
			
		}
}?>