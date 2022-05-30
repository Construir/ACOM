<?php namespace App\Models;

use CodeIgniter\Model;

class Comisiones_modelo extends Model{
	
        protected $table      = 'comisiones_medicas';
        protected $primaryKey = 'IdComisionMedica';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreComisionMedica', 'Domicilio', 'Telefono', 'IdProvincia'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
		
		function devolver_comisiones_medicas(){
			$query = $this->query('SELECT c.*,pro.NombreProvincia
								   FROM comisiones_medicas as c
								   left join provincias as pro on c.IdProvincia = pro.IdProvincia	
								   where c.deleted_at is null
								   order by c.NombreComisionMedica asc');
			return $query->getResultArray();
		}

}?>