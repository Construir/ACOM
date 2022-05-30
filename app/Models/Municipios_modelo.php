<?php namespace App\Models;

use CodeIgniter\Model;

class Municipios_modelo extends Model{
	
        protected $table      = 'municipios';
        protected $primaryKey = 'IdMunicipio';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreMunicipio', 'Departamento', 'Provincia', 'Id'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
		
		function devolver_municipios(){
			$query = $this->query('SELECT * FROM municipios order by NombreMunicipio asc');
			return $query->getResultArray();
		}


}?>