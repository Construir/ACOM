<?php namespace App\Models;

use CodeIgniter\Model;

class Departamentos_modelo extends Model{
	
        protected $table      = 'departamentos';
        protected $primaryKey = 'IdDepartamento';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreDepartamento', 'Acronimo', 'IdProvincia', 'Calle', 'Numero', 'Piso', 'Telefono', 'Email'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
		
		function devolver_departamentos(){
			$query = $this->query('SELECT * FROM departamentos order by NombreDepartamento asc');
			return $query->getResultArray();
		}		
		function devolver_departamentos_con_provincia(){
			$query = $this->query('SELECT d.*,p.NombreProvincia FROM departamentos as d join provincias as p on d.IdProvincia = p.IdProvincia order by p.NombreProvincia');
			return $query->getResultArray();
		}
		function devolver_departamentos_x_provincia($idprovincia){
			
			$sql = "SELECT * FROM departamentos where IdProvincia = ? order by NombreDepartamento asc";						
			
			$query = $this->db->query($sql, array($idprovincia));
			return $query->getResultArray();
		}	

}?>