<?php namespace App\Models;

use CodeIgniter\Model;

class Tipos_consultas_modelo extends Model{
	
        protected $table      = 'tipos_consultas';
        protected $primaryKey = 'IdTipoConsulta';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreTipoConsulta', 'Estado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		


}?>