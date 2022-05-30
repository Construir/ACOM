<?php namespace App\Models;

use CodeIgniter\Model;

class Tipo_estados_matricula_modelo extends Model{
	
        protected $table      = 'tipo_estados_matricula';
        protected $primaryKey = 'IdTiposEstadoMatricula';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreTipoEstado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;	

}?>