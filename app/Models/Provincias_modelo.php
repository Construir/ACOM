<?php namespace App\Models;

use CodeIgniter\Model;

class Provincias_modelo extends Model{
	
        protected $table      = 'provincias';
        protected $primaryKey = 'IdProvincia';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreProvincia', 'IdTipoMatricula'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
		
		function devolver_provincias(){
			
			$query = $this->query('SELECT * FROM provincias order by NombreProvincia asc');
			return $query->getResultArray();
			
		}
		function devolver_provincias_inscripcion(){
			
			$query = $this->query(' select * from provincias  where inscribir <> "N" order by NombreProvincia asc');
			return $query->getResultArray();
			
		}		
		function devolver_provincias_con_abogados(){
			
			$query = $this->query('SELECT DISTINCT NombreProvincia, idProvincia as IdProvincia
								   FROM SituacionPartidos								   
								   order by NombreProvincia asc');
			return $query->getResultArray();
			
		}		
		

}?>